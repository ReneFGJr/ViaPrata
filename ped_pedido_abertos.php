<?
require("cab.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
echo '<font class="lt5">Pedido não fechados</font>';

$sql = "select * from pedido where p_status = 'A' ";
$sql .= " order by p_data desc ";
//$sql .= " where ";
$rlt = db_query($sql);
echo '<TABLE width="'.$tab_max.'" class="lt1">';
while ($line = db_read($rlt))
	{
	echo '<TR '.coluna().'>';
	echo '<TD>';
	echo $line['p_pedido'];
	echo '<TD>';
	echo $line['p_nome'];
	echo '<TD align="righr">';
	echo number_format($line['p_valor'],2);
	echo '<TD>';
	echo stodbr($line['p_data']);
	echo '<TD>';
	echo $line['p_vendedor'];
	echo '</TR>';
	}
echo '</TABLE>';

require("foot.php");
?>