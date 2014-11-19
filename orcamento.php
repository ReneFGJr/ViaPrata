<?
//$login= 1;
require("cab.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_cookie.php");
$pg = read_cookie("orcamento");
if (strlen($pg) == 0) { $pg = 1; }

if (strlen($dd[49]) > 0)
	{ setcookie("orcamento",$dd[49],time()+7200); $pg = $dd[49]; }
$tot=0;
$tov=0;

//////////////////////////////////////////////////// EXCLUIR PECAS
if ($dd[4]=='DEL')
	{
	$sql = "update orcamento_item set oi_quan = (oi_quan + (".$dd[3].")) ";
	$sql .= ", oi_vlr_total = ((oi_quan +(".$dd[3].")) * oi_vlr_unit)";
	$sql .= " where oi_id=".$dd[1]." and oi_codigo = '".$dd[2]."'; ";
	$sql .= "delete from orcamento_item where oi_quan = 0; ";
	$rlt = db_query($sql);
	}

setcookie("orcamento",$pg,time()+7200);
echo '<font class="lt5">Orçamento nº '.$pg.'</font><BR>';
$st = '';
if (strlen($dd[0]) > 0)
	{
	$sql="select * from produto ";
	$tit = '';
	if (strlen($dd[0]) > 0) { $tit = $tit . 'Codigo '.$dd[0].' '; $wh = $wh . wand($wh). "(p_codigo like '".codean($dd[0])."%') "; }
	if (strlen($wh) > 0) 
		{ $sql = $sql . 'where '. $wh . ' and p_ativo = 1 '; }
	$sql .= " order by p_codigo ";

	$rlt = db_query($sql);
	$st .=  '<font class="lt2">'.$tit.'</font>';
	$st .= '<TABLE width="150" class="lt1" border1=1>';
	$col = 10;
	while ($line = db_read($rlt))
		{
		if ($col >= 3)
			{
			$st .= '<TR align="center">';
			$col = 0;
			}
		$st .= '<TD>';
		$col = $col + 1;
		$img = trim($line['p_codigo']);
		$codigo = trim($line['p_codigo']);
		$descricao = trim($line['p_descricao']);
		$preco = trim($line['p_preco_sugerido']);
		$custo = trim($line['p_preco']);
		$custo = trim($line['p_peso']);
		$link = '<A HREF="produto_edit.php?dd0='.$line['id_p'].'" target="editar">';
		$st .= '<IMG SRC="/img/produto/'.$img.'_01.jpg" width="140">';
		$st .= '<BR>'.$link.'<font class=lt2>Cod. '.$codigo.'</font></A>';
		$st .= '<BR><B>'.$descricao.'</B>';
		$st .= '<BR><B>(R$ '.number_format($preco,2).')</B>&nbsp;&nbsp;('.number_format($peso,2).'g)';;
		
		}
	$st .= '</TABLE>';
	} 
	{
		$tabela = "fornecedor";
		$sql = "select * from fornecedores where f_ativo = 1 order by f_nome limit 1 ";
		$rlt = db_query($sql);
		$op1 = $op1 . ':--TODOS--';
		while ($line = db_read($rlt))
			{ $op1 = $op1 . '&'.trim($line['f_codigo']).':'.trim($line['f_nome']); }
		$cp = array();
		array_push($cp,array('$S8','','Codigo',False,True,''));
//		array_push($cp,array('$N8','','Qta',False,True,''));
		$dd[2] = '0.00';
		$dd[3] = '999.99';
		$dd[4] = '0.00';
		$dd[5] = '99999.99';
		$tt='';
		$dd[0]='';
		for ($k=0;$k<99;$k++)
			{
			if (isset($cp[$k]))
				{
				if (($k==0) or ($k==2) or ($k==4) or ($k==6)) { $tt = $tt . '<TR>'; }
			    $tt=$tt.gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
				}
			}
		$tt = $tt . '</table>';
		$st .= '<TABLE  class="lt1" border1=1 align="center">';
		$st .= '<TR><TD><form method="post" name="doc" action="orcamento.php"></TD></TR>';
		$st .= $tt;
//		echo '<TR><TD><input type="submit" name="acao" value="buscar"></TD></TR>';
		$st .= '<TR><TD></form></TD></TR>';
		$st .= '</TABLE>';
	}
	
	/////////////////////////////////////////////////////
	$sql = "select * from orcamento where o_id = ".$pg;
	$rlt = db_query($sql);
	if (!($line = db_read($rlt)))
		{
		$sql = "insert into orcamento (o_local,o_orcamento,o_valor,o_desconto,o_data,";
		$sql .= "o_hora,o_lastupdate,o_id,";
		$sql .= "o_cliente ) ";
		$sql .= " values ('".$local."','', ";
		$sql .= '0,0,'.date("Ymd").',';
		$sql .= "'".date("H:m")."',".date("Ymd").','.$pg.',';
		$sql .= "'');";
		$sql .= "update orcamento set o_orcamento = lpad(id_o,7,'0') ";
		$sql .= " where length(o_orcamento) = 0; ";
		$rlt = db_query($sql);
		} else {
			$cliente_codigo = trim($line['o_cliente']);
			$cliente_nome = $line['o_nome'];
			$xlocal = trim($line['o_local']);
		}

	$sql = "select * from orcamento where o_id = ".$pg;
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$orc_nr = strzero($line['id_o'],7);
		
		if (strlen($codigo) > 0)
			{
			$sql = "select * from orcamento_item where oi_codigo='".$codigo."' and oi_orcamento='".$orc_nr."'";

			$rlt2 = db_query($sql);
			if ($xline = db_read($rlt2))
				{ $sql = "update orcamento_item set oi_quan = (oi_quan + 1) ";
				$sql .= ", oi_vlr_total = ((oi_quan+1) * oi_vlr_unit)";
				$sql .= " where oi_id=".$xline['oi_id']; } 
				else
				{ $sql = "insert into orcamento_item (oi_codigo,oi_quan,oi_vlr_unit,";
				$sql .= "oi_vlr_total,oi_desconto,oi_data,";
				$sql .= "oi_hora,oi_log,oi_status, ";
				$sql .= "oi_orcamento ) values (";
				$sql .= "'".$codigo."',1,".$preco.",";
				$sql .= $preco.",0,".date("Ymd").',';
				$sql .= "'".date("H:m")."','".$user_id."','A',";
				$sql .= "'".$orc_nr."');";
				}
			$rlt2 = db_query($sql);
			}
		}
		//////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////// FEIRA //
		//////////////////////////////////////////////////////////////////////
		$local = trim(read_cookie("local"));
		if ((strlen($xlocal) == 0) and (strlen($local) > 0))
			{
			$dd[10]= $local;
			}
		if (strlen($local) == 0) { $dd[10] = '00002'; }
		if (strlen($dd[10]) > 0)
			{ 
			setcookie("local",$dd[10],time()+7200); $local = $dd[10]; 
			$sql = "update orcamento set o_local = '".$local."' where o_orcamento = '".$orc_nr."'";
			$rlt = db_query($sql);
			}
	    $sa .= '<TABLE>';
		$sa .='<TR><TD><form method="post" action="orcamento.php">';
		$sa .= gets('dd10',$local,'$Q feira_nome:feira_codigo:select * from feira where feira_ativo=1 order by feira_nome','Local da venda:',true,true,true);
		$sa .= '<TD><input type="submit" name="acao" value="selecionar >>"></TD>';
		$sa .= '</TD><TD>'.$local.'</TD><TD></form></TD></TR>';
		$sa .= '</TABLE>';		
		echo $sa;
		//////////////////////////////////////////////////////////////////////
//		$tab_max = $tab_max -200;
	require("orcamento_calcula.php");
	/////////////////////////////////////////////////////
	$usql = "update orcamento where o_id = ".$pg;
	
//////////////////////////////////////////////////// EXCLUIR PECAS
if ($dd[40]=='EXCLUIR')
	{
	$sql = "delete from orcamento_item ";
	$sql .= " where oi_orcamento='".$orc_nr."'";
	echo $sql;
	$rlt = db_query($sql);
	
	redirecina("orcamento.php");
	}	
	?>

<TABLE width="<?=$tab_max?>" border=1 >
<TR>
<TD><?require('orcamento_ordem.php');?></TD>
<TD align="right" class="lt0">
<? require('orcamento_calcula_mst.php'); ?>
</TD>
</TR>
</TABLE>
<? echo $s; ?>
<TABLE>
<TR valign="top">
<TD><? echo $si; ?></TD>
<TD><? echo $st	; ?></TD>

</TR>
<TR>
<TD>
</form>
<? if ((strlen($cliente_codigo) != 0) and (($top+$cop) > 0)) { ?>
<form method="post" action="orcamento_pedido.php">
<input type="submit" name="acao" value=" fechar pedido " style="width: 300; height: 50">
</form>
<? } ?>
<A HREF="#" onclick="newxy2('orcamento_prn.php?dd49=<?=$pg?>',300,400);">
PR</A>
</TD>
</TR>
</TABLE>
<A HREF="orcamento.php?dd40=EXCLUIR">Excluir Tudo</A>
	<script language="javascript">
		doc.dd0.focus();
		doc.dd0.focus();
	</script>
	<?
require('foot.php');	
function wand($ddr)
	{
	if (strlen($ddr) > 0) { return(' and '); }
	else { return(""); }
	}
		
?>
<CENTER><font class=lt0><?=$orc_nr?></font></CENTER>
