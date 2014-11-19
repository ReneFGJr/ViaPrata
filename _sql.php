<?
require("db.php");
$sql = "update orcamento set o_id=4 where o_orcamento = '0000072'";
$rlt = db_query($sql);
?>