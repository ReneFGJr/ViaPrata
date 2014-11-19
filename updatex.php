<?
require("db.php");
$dr = 'ed_'.$dd[0].'.php';
if ($dd[0] == 'fornecedores')
	{$dx1 = "fo_codfor";	$dx2 = "fo"; 	$dx3 = "7";	$dr = "ed_".$dd[0].".php"; }

if ($dd[0] == 'pedido')
	{$dx1 = "";	$dx2 = ""; 	$dx3 = "";	$dr = "pedido_todos.php"; }


if (strlen($dx1) > 0)
	{
	$sql = "update ".$dd[0]." set ".$dx1."=lpad(id_".$dx2.",".$dx3.",0) where (length(trim(".$dx1.")) < ".$dx3.") or (".$dx1." isnull);";
	$sql = "update ".$dd[0]." set ".$dx1."=trim(to_char(id_".$dx2.",'".strzero(0,$dx3)."')) where (length(trim(".$dx1.")) < ".$dx3.") or (".$dx1." isnull);";
	
	//echo $sql;
	$rlt = db_query($sql);
	}
header("Location: ".$dr);
echo 'Stoped'; exit;
?>