<?
require("db.php");
require("include/sisdoc_cookie.php");
$nome_vendedor = "venda balcão";
$pg = $dd[49];
if (strlen($pg) == 0) { $pg = 9; }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Pedido</title>
</head>
<style>
.lta { font-family: Tahoma; font-size: 8px; color: #000000; text-decoration: none }
.lt0 { font-family: Tahoma; font-size: 10px; color: #000000; text-decoration: none }
.lt1 { font-family: Tahoma; font-size: 12px; color: #000000; text-decoration: none }
.lt2 { font-family: Tahoma; font-size: 14px; color: #000000; text-decoration: none }
</style>
<body>
<CENTER>
<TABLE width="260">
<?
//<TR><TD align="center" colspan="2"><@IMG SRC="img/logo_viaprata_mini_2.gif" width="100"></TD></TR>
?>
<TR><TD align="center" colspan="2"><font face="arial" size="1">
<B>Via Prata Comércio de Jóias em Prata Ltda</B>
<BR>Rua Ebano Pereira, 60 cj.1402 - Centro
<BR>Curitiba - Paraná - CEP 80410.240
<BR>Fone/Fax:(41)3015.8877
<HR>
</font></TD></TR>
<TR><TD class="lt0">
<?=date("d/m/Y H:i")?>
<TD align="right" class="lt1">Orçamento:<?=strzero($pg,6)?></TD>
<?
//<TR><TD colspan="2"><font face="arial" size="1">
//Cliente:<B>
//<BR>VIA PRATA LTDA</B>
//<BR>RUA EBANO PEREIRA, 60 CJ.1401
//<BR>CNPJ 00.000.000/0001-00  IE 000.000.000
?>
<TR><TD colspan="2"><HR></TD></TR>
<TR><TD align="right" class="lt0" colspan=10>vendedor: <?=$nome_vendedor?></TD></TR>
</TABLE>
	<?
	$sql = "select * from orcamento where o_id = ".$pg;
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$orc_nr = strzero($line['id_o'],7);
		}	
	$sql = "select * from orcamento_item ";
	$sql .= "inner join produto on p_codigo = oi_codigo ";
	$sql .= "where oi_orcamento='".$orc_nr."'";
	$sql .= " order by p_codigo ";

	$rlt = db_query($sql);
	$tab_max = 260;
	$si = '<TABLE width="'.($tab_max).'" class="lt0" cellpadding="2" cellspacing="0">';
	$si .= '<TR align="center" bgcolor="#c0c0c0"><TD width="5%"><B>ref</B></TD>';
	$si .= '<td><b>descrição</b></td>';
	$si .= '<td><b>quan</b></td>';
	$si .= '<td><b>v.unit.</b></td>';
	$si .= '<td><b>total</b></td>';
//	$si .= '<td><b>DP</b></td>';
	$si .= '</TR>';
	$si .= '<TR><TD colspan="10" height="2"><HR color="#303030"></TD></TR>';
	
	$tot = 0;
	$tov = 0;
	$top = 0;
	while ($line = db_read($rlt))
		{
		$qta  = $line['oi_quan'];
		$desc = $line['oi_desconto'];
		$vlr_brt = intval(10*($line['oi_vlr_unit']*(1-$desc/100)))/10;
		$vlr_brt = round(($line['oi_vlr_unit']*100)*(1-$desc/100))/100;
		$xtp = $line['p_unidade'];
		$si .= '<TR valign="top" >';
		$si .= '<td class="lta">';
		$si .= $line['oi_codigo'];
		$si .= '<td>';
		$si .= $line['p_descricao'];
		$si .= '<td align="right">';
		$si .= $link;
		if ($xtp == 'P')
			{
			$si .= number_format($line['oi_quan'],1);
			} else {
			$si .= number_format($line['oi_quan'],0);
			}
		$si .= '<td align="right">';
		if ($desc > 0)
			{
//				$si .= '<S>'.number_format($line['oi_vlr_unit'],2);
//				$si .= '</S> por ';
				$si .= ' '.number_format($vlr_brt,2);
			} else {
				$si .= number_format($line['oi_vlr_unit'],2);
			}
//		$si .= '<td align="right"><B>';
//		$si .= number_format($vlr_brt,2);
		$si .= '<td align="right">';
		$si .= number_format($vlr_brt * $qta,2);
//		$si .= '<td align="center">';
//		if ($xtp != 'P') { $si .= '<A HREF="orcamento.php?dd1='.$line['oi_id'].'&dd2='.trim($line['oi_codigo']).'&dd3=-1&dd4=DEL">(-1)</A>'; }
//		$si .= '&nbsp;<A HREF="orcamento.php?dd1='.$line['oi_id'].'&dd2='.trim($line['oi_codigo']).'&dd3=-'.$line['oi_quan'].'&dd4=DEL">(EXLUIR)</A>';
//		if ($xtp != 'P') { $si .= '&nbsp;<A HREF="orcamento.php?dd1='.$line['oi_id'].'&dd2='.trim($line['oi_codigo']).'&dd3=+1&dd4=DEL">(+1)</A>'; }
//		$si .= '<td align="center">';
//		$si .= $link;
//		if ($desc > 0) { $si .= $desc.'%'; }
		$si .= '<TR><TD colspan="10" height="2"><HR size=1 color="#303030"></TD></TR>';
		$si .= $xpt;
		$tot = $tot + 1;
		$top = $top + $qta;
		$tov = $tov + $vlr_brt * $qta;		
		}
		$totv=number_format($tov,2);
		$totv = troca($totv,',','#');
		$totv = troca($totv,'.',',');
		$totv = troca($totv,'#','.');
    $si .= '<TR><TD align="right" class="lt2" colspan="10">total <B>'.$totv.'</B></TD></TR>';
	$si .= '</TABLE>';
	/////////////////////////////////////////////////////
	echo $si;
	echo $st;
	?>
</TABLE>
<font class=lt0>
<BR>
<BR>
<BR>
&copy <?=date("Y")?> sisDOC

</body>
</html>
