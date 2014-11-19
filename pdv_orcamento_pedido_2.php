<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT>
</TD></TR>
</TABLE>
<TABLE cellpadding="2" cellspacing="0" width="<?=$tab_max?>" align="center" border="0">
<TR valign="top">
<TD>
<TABLE width="100%" align="center" border="1">
<TR bgcolor="#c0c0c0" align="center" class="lt1">
<TD width="15%"><B>venc</B></TD>
<TD width="15%"><B>valor</B></TD>
<TD width="50%"><B>tipo</B></TD>
<TD width="20%"><B>Nº Documento</B></TD>
<TD width="20%"><B>ação</B></TD>
</TR>
<?
if (($dd[0]=="DEL") and (strlen($dd[1]) > 0))
	{
	$sql = "delete from orcamento_fp ";
	$sql .= "where of_orcamento = '".$orc_nr."' ";
	$sql .= " and of_cliente='".$cliente_codigo."'";
	$sql .= " and of_id='".$dd[1]."'";
	$rlt = db_query($sql);
	}
$total = 0;

$sql = "select * from orcamento_fp ";
$sql .= "where of_orcamento = '".$orc_nr."' ";
$sql .= " and of_cliente='".$cliente_codigo."'";
$rlt = db_query($sql);

$xsql="select * from documento_tipo";
$xrlt = db_query($xsql);
$tp1 = array();
$tp2 = array();
while ($xline = db_read($xrlt))
	{
	$vr1=$xline['dt_descricao'];
	$vr2=$xline['dt_codigo'];
//	echo '<BR>'.$vr2."=".$vr1;
	array_push($tp1,$vr1);
	array_push($tp2,$vr2);
	}
$nrec = 0;
while ($line = db_read($rlt))
	{
	$link = '<A HREF="orcamento_pedido.php?dd0=DEL&dd1='.$line['of_id'].'">[Excluir]</A>';
	echo '<TR class="lt2">';
	echo '<TD align="center">'.stodbr($line['of_venc']);
	echo '<TD align="right">'.number_format($line['of_valor'],2);
	$idt=-1;
	$ofdoc = trim($line['of_tipo']);
	for ($kk=0;$kk < count($tp2);$kk++)
		{
		if (trim($tp2[$kk])==$ofdoc) { $idt=$kk; }
		}
	echo '<TD>'.$tp1[$idt].' ('.$ofdoc.') '.trim($line['of_descricao']);
	echo '<TD>'.trim($line['of_doc']).' '.trim($line['of_vendedor']);
	echo '<TD>'.$link;
	$total = $total + $line['of_valor'];
	$nrec++;
	}
$dif = $total - $total_pedido;
if ($total > 0)
	{
	$dif = $total - $total_pedido;
	echo '<TR><TD colspan="2" align="right"><B>Total :R$ '.number_format($total,2).'</B>';
	echo '<TD>';
	if ($dif == 0) { echo ''; }
	if ($dif > 0) { echo ', sobrando <font color="green"><B>R$&nbsp;'.number_format($dif,2); }
	if ($dif < 0) { echo ', faltando <font color="#ff8040"><B> R$&nbsp;'.number_format($dif*-1,2); }
	}
?>
</TABLE>