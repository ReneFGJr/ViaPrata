<?
//$login= 1;
require("cab.php");
require("include/cp2_gravar.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_cookie.php");

//require("include/sisdoc_debug.php");

$xxx="editar";
$tabela = "";
$cp = array();
$vend = '';

$desc = $dd[53];

if (strlen($dd[54]) > 0)
	{
	$sql = "update pedido set p_desconto = ".$desc." where ";
	$sql .= " p_orcamento = '".intval(read_cookie("ped3"))."' ";
	$sql .= " or p_orcamento = '".strzero(read_cookie("ped3"),7)."'";
	$rlt = db_query($sql);

	setcookie('desconto',$desc);
	} else {
	$desc = read_cookie("desconto");
	}

if ((strlen($acao) ==0) and (strlen($dd[0]) > 0))
	{
	$dd[1]=$dd[0];
	$dd[0]= '';
	}
	
$dd0 = read_cookie("ped0");
$dd1 = read_cookie("ped1");
$dd2 = trim(read_cookie("ped2"));
$dd3 = read_cookie("ped3");
$dd4 = read_cookie("ped4");
$dd5 = read_cookie("ped5");
$dd6 = read_cookie("ped6");
$dd7 = read_cookie("ped7");
$dd8 = read_cookie("ped8");


$qsql = "select * from pedido ";
$qsql .= " where p_orcamento = '".intval(read_cookie("ped3"))."' ";
$qsql .= " or p_orcamento = '".strzero(read_cookie("ped3"),7)."'; ";
$qrlt = db_query($qsql);
if ($qline = db_read($qrlt))
	{
	if (trim($qline['p_status']) != 'A')
		{
		echo '<BR><BR>Pedido Finalizado!';
		exit;
		}
	}


if (($dd[51]=='DEL') )
	{
	$sql = "delete from pedido_item where pi_id=".$dd[50];
	$sql .= " and pi_orcamento = '".$dd3."'; ";
	
	$sql .= "delete from vp_pedido where id_vi = ".$dd[50];
	$rlt = db_query($sql);
	}
	

if (strlen($acao) > 0)
	{
	$xvlr = $dd[1];
	if ($acao != 'adicionar item >>')
		{
		$xvlr = $dd[11];
		$dd[1] = $dd[11];
		$dd[2] = $dd[12];
		$dd[3] = $dd[13];
		$dd[4] = $dd[14];
		$dd[5] = $dd[15];
		$dd[6] = $dd[16];
		}
	$quan = $dd[3];
	$vlr  = $dd[1];
	$cod = substr($dd[2],0,2);

	if ($cod == '56')
		{ $quan = 1; $vlr = $dd[1]; }
		else
		{
		$quan = $dd[1];

		$sql = "select * from produto where p_codigo = '".$dd[2]."'";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$descricao = trim($line['p_descricao']);
			$vlr = $line['p_preco_sugerido'];
			} 
		if (strlen($dd[3]) > 0)
			{ $vlr = $dd[3]; }			
		}
		$preco = $vlr * $quan;
		$xquan = $quan;

	if ($acao == 'adicionar item >>')
		{
		$sql = 'insert into pedido_item ';
		$sql .= '(pi_codigo,pi_vlr_unit,pi_vlr_total,';
		$sql .= 'pi_desconto,pi_data,pi_hora,';
		$sql .= 'pi_log,pi_status,pi_pedido,';
		$sql .= 'pi_orcamento,pi_quan,pi_comissao,pi_estoque,';
		$sql .= 'pi_comissao_vlr) values (';
		$sql .= "'".trim($dd[2])."',0".$vlr.",0".$preco.",";
		$sql .= "0,".date("Ymd").",'".date("H:i")."',";
		$sql .= $user_id.",'L','".$dd3."',";
		$sql .= "'".$dd3."',".$quan.",0".$dd[4];
		$sql .= ",'".$dd[5]."',";
		$sql .= ($preco*($dd[4]/100));
		$sql .= "); ";
		$rll = db_query($sql);
		$sql = "select * from pedido_item where pi_vlr_unit = ".$vlr;
		$sql .= " and pi_orcamento = '".$dd3."' order by pi_id desc ";
		$qrlt = db_query($sql);
		if ($qline = db_read($qrlt))
			{
			$idq = $qline['pi_id'];
			}
		
		$sql = "insert into vp_pedido (";
		$sql .= "vpped_pedido, vpped_quantidade, vpped_ref,";
		$sql .= "vpped_unitario, vpped_fornecedor, vpped_data,";
		$sql .= "vpped_log, vpped_vendedor, vpped_dc, ";
		$sql .= "vpped_historico, vpped_doc, vpped_tipo, ";
		$sql .= "id_vi ";
		$sql .= ") values (";
		$sql .= "'".$dd3."',-".$xvlr.",'".trim($dd[2])."',";
		$sql .= "0".$vlr.",'".$dd2."',".date("Ymd").",";
		$sql .= $user_id.",'','D',";
		$sql .= "'".$descricao."','".$dd3."','V',";
		$sql .= '0'.$idq.");";
		$rll = db_query($sql);
		} else {
		$sql = 'insert into pedido_item ';
		$sql .= '(pi_codigo,pi_vlr_unit,pi_vlr_total,';
		$sql .= 'pi_desconto,pi_data,pi_hora,';
		$sql .= 'pi_log,pi_status,pi_pedido,';
		$sql .= 'pi_orcamento,pi_quan,pi_comissao,pi_estoque,';
		$sql .= 'pi_comissao_vlr) values (';
		$sql .= "'".trim($dd[2])."',-0".$vlr.",-0".$preco.",";
		$sql .= "0,".date("Ymd").",'".date("H:i")."',";
		$sql .= $user_id.",'D','".$dd3."',";
		$sql .= "'".$dd3."',-0".$xquan.",0".$dd[4];
		$sql .= ",'".$dd[5]."'";
		$sql .= ",-".($preco*($dd[4]/100));
		$sql .= ")";
		$rll = db_query($sql);
		
		$sql = "select * from pedido_item where pi_vlr_unit = (-".$vlr.")";
		$sql .= " and pi_status ='D' and pi_orcamento = '".$dd3."' order by pi_id desc ";
		$qrlt = db_query($sql);
		if ($qline = db_read($qrlt))
			{
			$idq = $qline['pi_id'];
			}
		
		$sql = "insert into vp_pedido (";
		$sql .= "vpped_pedido, vpped_quantidade, vpped_ref,";
		$sql .= "vpped_unitario, vpped_fornecedor, vpped_data,";
		$sql .= "vpped_log, vpped_vendedor, vpped_dc, ";
		$sql .= "vpped_historico, vpped_doc, vpped_tipo, ";
		$sql .= "id_vi ";
		$sql .= ") values (";
		$sql .= "'".$dd3."',+".$xvlr.",'".trim($dd[2])."',";
		$sql .= "0".$vlr.",'".$dd2."',".date("Ymd").",";
		$sql .= $user_id.",'','C',";
		$sql .= "'".$descricao."','".$dd3."','R',";
		$sql .= '0'.$idq.");";
		$rll = db_query($sql);				
		}
		$dd[2] = '';
		$dd[4] = '';
		$dd[5] = '';
		$dd[12] = '';
		$dd[14] = '';
		$dd[15] = '';
		
		redirecina("ped_pedido_3.php");
	}
	
if (strlen($dd[5])==0) { $dd[5] = $dd2; }	
if (strlen($dd[15])==0) { $dd[15] = $dd2; }	

echo '<TABLE width="'.$tab_max.'"><TR><TD>';
echo '<BR>Cliente:<B>'.$dd1.' '.$dd6.' / '.$dd7.'</B>';
echo '<BR>Vendedor:'.$dd2.' ['.$dd[5].'/'.$dd[15].']';
echo '<BR>Pedido:'.$dd3;
echo '<BR>Data:'.$dd4;
echo '<BR>'.$dd5;
echo '<TD align="right"><form method="post" action="ped_pedido_3.php"><input type="submit" name="xxx" value="atualizar"></form></TD>';

	echo '<CENTER><Font class="lt5">Lançamento do Pedido '.$dd3.'</FONT></CENTER>';
	echo '<TABLE width="'.$tab_max.'"><TR>';
	echo '<TR align="center"><TH>Quant./Valor';
	echo '<TH>Ref.';
	echo '<TH>Valor';
	echo '<TH>Comis.';
	echo '<TH>Estoque';	
	
	$xsql = '$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 and (vd_codigo='.chr(39).trim($dd2).chr(39).' or vd_codigo='.chr(39).'EMPR'.chr(39).') order by vd_nome desc';	

	$sc = '<TR align="center">';
	$sc .= '<form method="post" action="ped_pedido_3.php">';
	$sc .= sget('dd1','$N8','');
	$sc .= sget('dd2','$Q es_descricao:es_ref:select * from vp_estoque where es_ativo = 1 and es_ref <> '.chr(39).'5699999'.chr(39).' order by es_descricao','');
	$sc .= sget('dd3','$N8','');
	$sc .= sget('dd4','$O 0:0%&5:5%&7.5:7,5%&10:10%&12.5:12.5%&15:15%','');
	$sc .= sget('dd5',$xsql,'');	

	$sc .= '<TD><input type="submit" name="acao" value="adicionar item >>"></TD>';
	$sc .= '<TD></form>';
	echo $sc;
	
	$sc = '<TR align="center">';
	$sc .= '<TD colspan="10" class="lt5" align="center">Devolução</TD>';
	$sc .= '<TR align="center">';
	$sc .= '<form method="post" action="ped_pedido_3.php">';
	$sc .= sget('dd11','$N8','');
	$sc .= sget('dd12','$Q es_descricao:es_ref:select * from vp_estoque where es_ativo = 1 order by es_descricao','');
	$sc .= sget('dd13','$N8','');
	$sc .= sget('dd14','$O 0:0%&5:5%&7.5:7,5%&10:10%&12.5:12.5%&15:15%','');
	$sc .= sget('dd15',$xsql,'');	
	$sc .= '<TD><input type="submit" name="acao" value="<< devolver item"></TD>';
	$sc .= '<TD></form>';
	echo $sc;	
	
	echo '</TABLE>';
	
	require("ped_pedido_3_items.php");
	require("ped_pedido_3_fechar.php");
	$sc = '';
	require("ped_pedido_finan.php");
	
	require("ped_finalizar_gravar.php");
	?>



<? require("foot.php"); ?>