<?
require("cab.php");
require("include/sisdoc_cookie.php");
require("include/sisdoc_form2.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_data.php");
require("cliente_saldo.php");
require("include/cp2_gravar.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$pg = read_cookie("repre");
$http_redirect = "orcamento_vendedor_final.php";

if (strlen($pg) == 0) { exit; }
echo '<font class="lt5">Orçamento de peças nº '.$pg.'</font><BR>';

//	$sql = "ALTER TABLE pedido_sedex ADD COLUMN p_local char(5)";
//	$rlt = db_query($sql);

	$sql = "select * from pedido_vendedor ";
	$sql .= " where p_orcamento = ".$pg;
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$orc_nr = strzero($pg,7);
		$cliente_codigo = trim($line['p_cliente']);
		$cliente_nome = $line['p_nome'];
		$local_venda = $line['feira_nome'];
		$local_codigo = $line['feira_codigo'];
		}

	require("orcamento_vendedor_calcula.php");
		
	//////////////////////////////////////////////////////////
		
	$path = "orcamento_vendedor_final.php";
	$menu = array();
	$sql = "select * from documento_tipo where dt_pedido = 1 order by dt_descricao ";
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
		{
		/////////////////////////////////////////////////// MANAGERS
		array_push($menu,array('Forma de pagamento',trim($line['dt_descricao']),'ocamento_pedido.php?dd0='.$line['dt_codigo'],$line['dt_codigo'],$line['dt_dias'])); 
		}
 
 ?>
 <TABLE width="<?=$tab_max?>" border=1 >
<TR valign="top">
<TD><?=$cliente_nome?>
<BR>Local:<?=$local_venda?>
</TD>
<TD align="right">
<? require('orcamento_calcula_mst.php'); ?>
</TD>
</TR>
</TABLE>
 <?
///////////////////////////////////////////////////// redirecionamento
if ((isset($dd[1])) and (strlen($dd[1]) > 0))
	{
	$col=0;
	for ($k=0;$k <= count($menu);$k++)
		{
//		 if ($dd[1]==CharE($menu[$k][1])) {	header("Location: ".$menu[$k][2]); } 
		}
	}
?>
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
	$link = '<A HREF="orcamento_vendedor_final.php?dd0=DEL&dd1='.$line['of_id'].'">[Excluir]</A>';
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
<?
require('orcamento_venedor_pedido_gravar.php');

require('orcamento_pedido_fp.php');
?>

</TD>
<TD width="200"><FORM method="post" action="<?=$path?>?dd99=admin">
<TABLE width="100%" align="center" border="0">
<?
	echo '<TR><TD>';
	echo '<input type="submit" name="dd1" value="ATUALIZAR" '.$estilo_admin.'>';
if ($dif != 0)
	{	
	?>
	<TR><TD class="lt3"><CENTER>Forma pagamento</TD></TR>
	<TR><TD align="center">
	<?
	$sld = saldo_cc($cliente_codigo);
	if ($sld > 0) { echo '<font color="green">'; }
	if ($sld < 0) { echo '<font color="red">'; }
	if ($sld != 0) { echo 'Saldo CC R$ '.number_format($sld ,2); }
	?></TD></TR>
	<?
	$xcol=0;
	$seto = "X";
	for ($x=0;$x <= count($menu); $x++)
		{
		if (isset($menu[$x][2]))
			{
			echo '<TR><TD align="center">';
			echo '<input type="submit" name="dd1" value="'.CharE($menu[$x][1]).'" '.$estilo_admin.'>';
			echo '</TD>';
			$xcol = $xcol + 1;
			}
		}
	}
?>
</TABLE></TABLE></FORM>
<? require("foot.php");	?>