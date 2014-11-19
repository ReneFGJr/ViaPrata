<?
$sql = "update contas_receber set cr_status = 'A' where cr_status = '@' ";
$rlt = db_query($sql);

$http_ver = '<A HREF="#" onclick="newxy('.chr(39).'pedido_vd_mostra.php';
$http_ver_para = "'".',600,600);">';
$pre_where = " (cr_cliente = '".trim($cliente_codigo)."') ";
$sql = "select * from contas_receber ";
$sql .= " where ".$pre_where;
$sql .= " and cr_status <> 'X' ";
$sql .= " order by cr_venc desc ";

$rlt = db_query($sql);
echo '<TABLE width="'.$tab_max.'" border="0" class="1t0">';
echo '<TR><TD width="50%">';
echo '--';
echo '<TD width="500">';
echo '<font class="lt3"><center>Movimentação Financeira do Cliente</center></font>';
$total = 0;
$saldo = 0;
$atras = 0;
while ($line = db_read($rlt))
	{
	require("finan_receber_mst.php");
	if ($line['cr_status'] == 'A') 
	{ 
		if ($line['cr_venc'] < date("Ymd")) 
			{ 
			$atras = $atras + $line['cr_valor']; 
			} else {
			$total = $total + $line['cr_valor']; 
			} 
		}
	}
?>
	<TABLE cellpadding="2" cellspacing="0" border="1" width="860">
<?
echo '<TR><TD align="right" colspan="7">total '.number_format($saldo,2).', em aberto '.number_format($total,2);
echo ' e <font color="red">'.number_format($atras,2).' atrasado</font></TD></TR>';
?>
	<TR bgcolor="#c0c0c0" align="center" class="lt0">
	<TD width="9%"><B>vencimento</B></TD>
	<TD width="15%"><B>valor</B></TD>
	<TD><B>histórico / tipo</B></TD>
	<TD width="10%"><B>pedido</B></TD>
	<TD width="10%"><B>parcela</B></TD>
	<TD width="10%"><B>documento</B></TD>
	<TD width="2%"><B>st</TD>
	</TR>
	<?=$ss?>

	</TABLE>
<?
echo '</TABLE>';
echo '</TABLE>';
?>	