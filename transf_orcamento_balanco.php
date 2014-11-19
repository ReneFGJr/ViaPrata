<?
require("db.php");

$sql = "select * from orcamento_item where oi_orcamento='".$dd[0]."'";
$rlt = db_query($sql);
$orc_nr = $dd[1];
if ((strlen($dd[1]) == 0) or (strlen($dd[0]) == 0))
	{
	echo 'paramentros incorreto dd0=orcamento, dd1=balanco';
	exit;
	}
while ($line = db_read($rlt))
	{
	$xsql .= "insert into balanco_item (oi_codigo,oi_quan,oi_vlr_unit,";
	$xsql .= "oi_vlr_total,oi_desconto,oi_data,";
	$xsql .= "oi_hora,oi_log,oi_status, ";
	$xsql .= "oi_balanco ) values (";
	$xsql .= "'".$line['oi_codigo']."',".$line['oi_quan'].",".$line['oi_vlr_unit'].",";
	$xsql .= $line['oi_vlr_total'].",0,".date("Ymd").',';
	$xsql .= "'".date("H:m")."','".$line['oi_log']."','A',";
	$xsql .= "'".$orc_nr."');".chr(13);
	}
$rlt = db_query($xsql);		
echo $xsql;	
?>