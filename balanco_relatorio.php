<?
require("cab.php");
require("include/sisdoc_data.php");
$sql = "select * from estoque_balanco";
$sql .= " inner join usuario on eb_log = id_us ";
$sql .= " order by id_eb desc limit 100";
$rlt = db_query($sql);

echo '<TABLE width="'.$tab_max.'" class="lt1">';
echo '<TR bgcolor="#c0c0c0" align="center">';
echo '<TD><B>doc</B></TD>';
echo '<TD><B>data</B></TD>';
echo '<TD><B>login</B></TD>';
echo '<TR>';
$col = 0;
while ($line = db_read($rlt))
	{
	IF ($col >= 2) { echo '<TR>'; $col = 0; }
	echo "<TD>";
	echo $line['eb_doc'];
	echo '&nbsp;&nbsp;';
	echo '[';
	echo stodbr($line['eb_data']);
	echo '-';
	echo $line['eb_hora'];
	echo ']&nbsp;';
	echo $line['us_nome'];
	echo "</TD>";
	$col++;
	}
echo '</TABLE>';
require("foot.php");	?>