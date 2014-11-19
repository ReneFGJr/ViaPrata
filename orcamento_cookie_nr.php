<?
$pg = read_cookie("orcamento");
if (strlen($dd[49]) > 0)
	{ setcookie("orcamento",$dd[49],time()+7200); $pg = $dd[49]; }
if (strlen($pg) == 0) { $pg = 1; }
setcookie("orcamento",$pg,time()+7200);
?>