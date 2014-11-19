<?
$sql = "select * from estoque_log where el_codigo='".$dd[0]."' order by el_data desc, el_hora desc limit 100";
$rlt = db_query($sql);
echo '<TABLE width="'.$tab_max.'" align="center" class="lt1">';
echo '<TR bgcolor="#c0c0c0" align="center">';
echo '<TD><B>data</B></TD>';
echo '<TD><B>hora</B></TD>';
echo '<TD><B>estoque</B></TD>';
echo '<TD><B>quantidade</B></TD>';
echo '<TD><B>documento</B></TD>';
echo '<TD><B>status</B></TD>';
echo '<TD><B>IP</B></TD>';
echo '<TD bgcolor="#c0c0c0" rowspan="100"><img src="img/nada_preto.gif"></TD>';
echo '<TD><B>data</B></TD>';
echo '<TD><B>hora</B></TD>';
echo '<TD><B>estoque</B></TD>';
echo '<TD><B>quantidade</B></TD>';
echo '<TD><B>documento</B></TD>';
echo '<TD><B>status</B></TD>';
echo '<TD><B>IP</B></TD>';
echo '</TR>';
$col = 0;
while ($line = db_read($rlt))
	{
	if ($col == 0) {	echo '<TR>'; $col = 1; } else {$col = 0; }
	echo '<TD align="center">';
	echo stodbr($line['el_data']);
	echo '<TD align="center">';
	echo $line['el_hora'];
	echo '<TD align="center">';
	echo $line['el_estoque'];
	echo '<TD align="right">';
	echo $line['el_quan'];
	echo '<TD align="center">';
	echo $line['el_pedido'];
	echo '<TD align="center">';
	echo $line['el_status'];
	echo '<TD align="center">';
	echo $line['el_ip'];
	}
echo '</TABLE>';
?>