<?
require("cab.php");

$sql = "select * from pedido where p_local = '09999' ";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	echo $line['p_orcamento'].'='.$line['p_cliente'];
	$sql = "select * from pedido_vendedor where p_orcamento='".intval($line['p_orcamento'])."'";
	$rrr = db_query($sql);
	while ($lll = db_read($rrr))
		{
		echo '=='.$line['p_data'].'--'.$lll['p_data'].' '.$line['p_orcamento'].'=='.$lll['p_orcamento'];
		$sql = "update pedido set p_data = ".$lll['p_data']." ";
		$sql .= "where id_p = ".$line['id_p'];
		if ($line['p_data'] != $lll['p_data'])
			{
			$rxlt = db_query($sql);
			//
			echo '<HR>'.$sql.'<HR>';
			}
		}
	echo '<BR>';
	}
	
?>