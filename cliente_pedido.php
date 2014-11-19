<?

$http_ver = '<A HREF="#" onclick="newxy('.chr(39).'pedido_vd_mostra.php';
$http_ver_para = "'".',600,600);">';
$pre_where = " (p_cliente = '".trim($cliente_codigo)."') ";
$sql = "select id_p , p_pedido , p_nome , p_valor , p_desconto , p_data from pedido where ".$pre_where;
$sql .= " order by p_data desc ";

$rlt = db_query($sql);
echo '<TABLE width="'.$tab_max.'" border="0" class="1t0">';
echo '<TR><TD width="50%">';
echo '--';
echo '<TD width="500">';
echo '<font class="lt3"><center>Pedidos do cliente</center></font>';
echo '<HR>';
echo '<TABLE class="lt1" width="500">';
echo '<TR bgcolor="#c0c0c0"><TH>pedido</TH><TH>cliente</TH><TH>valor</TH></TR>';
$total = 0;
while ($line = db_read($rlt))
	{
	$total = $total + $line['p_valor'];
	$link = $http_ver.'?dd0='.$line['p_pedido'].$http_ver_para;
	echo '<TR>';
	echo '<TD>';
	echo $link;
	echo $line['p_pedido'];
	echo '<TD>';
	echo $line['p_nome'];
	echo '<TD align="right">';
	echo number_format($line['p_valor'],2);
	echo '<TD align="right">';
	echo number_format($line['p_desconto'],2);
	echo '<TD align="center">';
	echo stodbr($line['p_data']);
	echo '</TR>';
	}
	echo '<TR><TD align="right" colspan="5">total '.number_format($total,2).'</TD></TR>';
echo '</TABLE>';
echo '</TABLE>';
?>	