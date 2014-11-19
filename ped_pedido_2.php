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

$tabela = "";
$cp = array();
$vend = '';

if ((strlen($acao) ==0) and (strlen($dd[0]) > 0))
	{
	$dd[1]=$dd[0];
	$dd[0]= '';
	}

if (strlen($dd[2]) ==0)
	{
	$sql = "select * from clientes where cliente_codigo = '".$dd[1]."' and cliente_ativo='S' ";
	$rrr = db_query($sql);
	if ($line = db_read($rrr))
		{
		$dd[2] = $line['cliente_id_vendedor'];
		}
	}	
array_push($cp,array('$H8','','id_vpped',False,True,''));
array_push($cp,array('$Q nome:cliente_codigo:select substr(trim(cliente_nome) || chr(32) ||trim(cliente_nome_fantasia) || chr(32) || chr(47) || chr(32) ||trim(cliente_razao_social),1,60) as nome,cliente_codigo from clientes where cliente_ativo =\'S\' and cliente_codigo='.chr(39).$dd[1].chr(39),'p_cliente','Cliente',False,True,''));
array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','','Representante',False,True,''));
array_push($cp,array('$S8','','N pedido',True,True,''));
array_push($cp,array('$D8','','Data do pedido',True,True,''));

	echo '<CENTER><Font class="lt5">Lançamento do Pedido</FONT></CENTER>';
	echo '<TABLE width="'.$tab_max.'" border="1"><TR valign="top"><TD>';
	$saved = editar();	
	echo '<TD>';
	$sql = "select * from pedido where p_cliente = '".$dd[1]."' order by p_pedido desc ";
	$rlt = db_query($sql);
	echo '<TABLE class="lt1" width="250">';
	while ($line = db_read($rlt))
		{
		$link = '<a href="ped_pedido_2.php?acao=gava&dd0='.$line['id_p'].'&dd1='.$line['p_cliente'].'&dd2='.$line['p_vendedor'].'&dd3='.intval($line['p_pedido']).'&dd4='.$line['p_data'].'">';
		echo '<TR><TD>';
		echo $link.$line['p_pedido'];
		echo '<TD align="center">';
		echo stodbr($line['p_data']);
		echo '<TD align="center">';
		echo $line['p_status'];
		echo '<TD align="right">';
		echo number_format($line['p_valor']-$line['p_desconto'],2);
		echo '</TD></TR>';
		}
	echo '</TABLE>';
	
	echo '</TABLE>';
	
	if ($saved > 0)
		{
		$desc = 0;
		$xsql = "select * from pedido where p_orcamento = '".intval($dd[3])."' ";
		$xsql .= " or p_orcamento = '".strzero($dd[3],7)."'";
		echo $sql;
		$xrlt = db_query($xsql);
		if ($xline = db_read($xrlt))
			{
				echo '<BR><BR><CENTER>';
				echo 'Pedido já lançado '.$dd[5];
				$dd[0] = $xline['id_p'];
				$desc = $xline['p_desconto'];
			}
			$sql = "select * from clientes where cliente_codigo = '".$dd[1]."' and cliente_ativo='S'";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
				$dd6 = trim($line['cliente_nome_fantasia']);
				$dd7 = trim($line['cliente_razao_social']);
				$dd8 = trim($line['cliente_nome']);
				$dd9 = trim($line['cliente_id_vendedor']);
				}
			setcookie("ped0",$dd[0]);
			setcookie("ped1",$dd[1]);
			setcookie("ped2",$dd[2]);
			setcookie("ped3",$dd[3]);
			setcookie("ped4",$dd[4]);
			setcookie("ped5",$dd[5]);
			setcookie("ped6",$dd6);
			setcookie("ped7",$dd7);
			setcookie("ped8",$dd8);
			setcookie("ped9",$dd9);
			setcookie('desconto',$desc);
			redirect("ped_pedido_3.php");
		}
		

	?>



<? require("foot.php"); ?>