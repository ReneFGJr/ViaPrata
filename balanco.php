<?
//$login= 1;
require("cab.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_cookie.php");

$pg = read_cookie("balanco");
if (strlen($dd[49]) > 0)
	{ setcookie("balanco",$dd[49],time()+7200); $pg = $dd[49]; }
$tot=0;
$tov=0;
//////////////////////////////////////////////////// EXCLUIR PECAS
if ($dd[4]=='DEL')
	{
	$sql = "update balanco_item set oi_quan = (oi_quan + (".$dd[3].")) ";
	$sql .= ", oi_vlr_total = ((oi_quan +(".$dd[3].")) * oi_vlr_unit)";
	$sql .= " where oi_id=".$dd[1]." and oi_codigo = '".$dd[2]."'; ";
	$sql .= "delete from balanco_item where oi_quan = 0; ";
	$rlt = db_query($sql);
	}
if (strlen($pg) == 0) { $pg = 1; }
setcookie("balanco",$pg,time()+7200);
echo '<font class="lt5">Balanço de Produto em Estoque ['.$pg.']</font><BR>';
$st = '';
if (strlen($dd[0]) > 0)
	{
	$sql="select * from produto ";
	$tit = '';
	if (strlen($dd[0]) > 0) { $tit = $tit . 'Codigo '.$dd[0].' '; $wh = $wh . wand($wh). "(p_codigo like '".codean($dd[0])."%') "; }
	if (strlen($wh) > 0) 
		{ $sql = $sql . 'where '. $wh . ' and p_ativo = 1 '; }
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
		$st .= '<TR><TD><form method="post" name="doc" action="balanco.php"></TD></TR>';
		$st .= $tt;
//		echo '<TR><TD><input type="submit" name="acao" value="buscar"></TD></TR>';
		$st .= '<TR><TD></form></TD></TR>';
		$st .= '</TABLE>';
	}
	
	/////////////////////////////////////////////////////
	$sql = "select * from balanco where o_id = ".$pg;
	$rlt = db_query($sql);
	if (!($line = db_read($rlt)))
		{
		echo $sql;
		$sql = "insert into balanco (o_valor,o_desconto,o_data,";
		$sql .= "o_hora,o_lastupdate,o_id,";
		$sql .= "o_cliente ) ";
		$sql .= " values ( ";
		$sql .= '0,0,'.date("Ymd").',';
		$sql .= "'".date("H:m")."',".date("Ymd").','.$pg.',';
		$sql .= "'');";
		$rlt = db_query($sql);
		} else {
			$cliente_codigo = trim($line['o_cliente']);
			$cliente_nome = $line['o_nome'];
		}

	$sql = "select * from balanco where o_id = ".$pg;
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$orc_nr = strzero($line['id_o'],7);
		
		if (strlen($codigo) > 0)
			{
			$sql = "select * from balanco_item where oi_codigo='".$codigo."' and oi_balanco='".$orc_nr."'";
			$rlt2 = db_query($sql);
			if ($xline = db_read($rlt2))
				{ $sql = "update balanco_item set oi_quan = (oi_quan + 1) ";
				$sql .= ", oi_vlr_total = ((oi_quan+1) * oi_vlr_unit)";
				$sql .= " where oi_id=".$xline['oi_id']; } 
				else
				{ $sql = "insert into balanco_item (oi_codigo,oi_quan,oi_vlr_unit,";
				$sql .= "oi_vlr_total,oi_desconto,oi_data,";
				$sql .= "oi_hora,oi_log,oi_status, ";
				$sql .= "oi_balanco ) values (";
				$sql .= "'".$codigo."',1,".$preco.",";
				$sql .= $preco.",0,".date("Ymd").',';
				$sql .= "'".date("H:m")."','".$user_id."','A',";
				$sql .= "'".$orc_nr."');";
				}
			$rlt2 = db_query($sql);
			}
		}
	$sql = "select * from balanco_item ";
	$sql .= "inner join produto on p_codigo = oi_codigo ";
	$sql .= "where oi_balanco='".$orc_nr."'";
	$sql .= " order by oi_codigo ";

	$rlt = db_query($sql);
	$si = '<TABLE width="'.($tab_max-200).'" class="lt1">';
	$si .= '<TR align="center" bgcolor="#c0c0c0">';
	$si .= '<td><b>quant</b></td>';	
	$si .= '<TD width="5%"><B>código</B></TD>';
	$si .= '<td><b>descrição</b></td>';
	$si .= '<td><b>vlr.unitário</b></td>';
	$si .= '<td><b>vlr.total</b></td>';
	$si .= '<td><b>ação</b></td>';
	$si .= '<td><b>DP</b></td>';
	$si .= '</TR>';
	$tot = 0;
	$tov = 0;
	$top = 0;
	while ($line = db_read($rlt))
		{
		$qta  = $line['oi_quan'];
		$desc = $line['oi_desconto'];
		$vlr_brt = round(10*($line['oi_vlr_unit']*(1-$desc/100)))/10;
		$vlr_brt = ($line['oi_vlr_unit']*(1-$desc/100));
		$xtp = $line['p_unidade'];
		$link = '<A HREF="#" onclick="newxy('."'balanco_ed.php?dd0=".$line['oi_id'].'&dd1='.trim($line['oi_codigo'])."',400,150);".chr(34).'>';
		$si .= '<TR '.coluna().'>';
		$si .= '<td align="right">';
		$si .= $link;
		if ($xtp == 'P')
			{
			$si .= number_format($line['oi_quan'],1);
			} else {
			$si .= number_format($line['oi_quan'],0);
			}		
		$si .= '<td>';
		$si .= $line['oi_codigo'];
		$si .= '<td>';
		$si .= $line['p_descricao'];

		$si .= '<td align="right">';
		if ($desc > 0)
			{
				$si .= '<S>'.number_format($line['oi_vlr_unit'],2);
				$si .= '</S> por ';
				$si .= ' '.number_format($vlr_brt,2);
			} else {
				$si .= number_format($line['oi_vlr_unit'],2);
			}
//		$si .= '<td align="right"><B>';
//		$si .= number_format($vlr_brt,2);
		$si .= '<td align="right">';
		$si .= number_format($vlr_brt * $qta,2);
		$si .= '<td align="center">';
//		if ($xtp != 'P') { $si .= '<A HREF="balanco.php?dd1='.$line['oi_id'].'&dd2='.trim($line['oi_codigo']).'&dd3=-1&dd4=DEL">(-1)</A>'; }
		$si .= '&nbsp;<A HREF="balanco.php?dd1='.$line['oi_id'].'&dd2='.trim($line['oi_codigo']).'&dd3=-'.$line['oi_quan'].'&dd4=DEL">(EXLUIR)</A>';
//		if ($xtp != 'P') { $si .= '&nbsp;<A HREF="balanco.php?dd1='.$line['oi_id'].'&dd2='.trim($line['oi_codigo']).'&dd3=+1&dd4=DEL">(+1)</A>'; }
		$si .= '<td align="center">';
		$si .= $link;
		if ($desc > 0) { $si .= $desc.'%'; }

		$si .= $xpt;
		$tot = $tot + 1;
		$top = $top + $qta;
		$tov = $tov + $line['oi_vlr_unit'] * $qta;		
		}
	$si .= '</TABLE>';
	/////////////////////////////////////////////////////
	?>

<TABLE width="<?=$tab_max?>" border=1 >
<TR>
<TD><?require('balanco_ordem.php');?></TD>
<TD align="right">
<font class=lt5><?=number_format($tov,2)?></font>
<BR><font class=lt1><B><?=$top?></font></B> peças,&nbsp;
<font class=lt1><B><?=$tot?></font></B> itens
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
<? if ($top > 0) { ?>
<form method="post" action="balanco_pedido.php">
<input type="submit" name="acao" value=" finalizar lote " style="width: 300; height: 50">
</form>
<? } ?>

</TD>
</TR>
</TABLE>
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