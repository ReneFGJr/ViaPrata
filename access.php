<?
$breadcrumbs=array();
array_push($breadcrumbs, array('/fonzaghi/sensual/index.php','Sensual'));

require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Access &copy','Controle de acesso','ed_access_ref.php')); 
?>
<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="index.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require($vinclude."foot.php");	?>