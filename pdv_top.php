<? 
require("db.php"); 
require($include."sisdoc_cookie.php"); 
require("orcamento_cookie_nr.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>PDV--TOP</title>
</head>

<body bgcolor="#828282" marginheight="0" marginwidth="0" >
<TABLE width="100%" height="55">
<TR><TD height="44">
<? for ($k = 1;$k < 16;$k++) 
	{
	$img = $k;
	if (strlen($img)==1) { $img = '0'.$img; }
	if ($k == $pg) { $img .= 'a'; }
	$link = '<A HREF="pdv_top.php?dd49='.$k.'">';
	echo $link.'<img src="img/pdv_icone_'.$img.'.png" width="32" height="29" alt="" border="0"></A>';
	}
	?>
</TD></TR>
<TR><TD height="7" background="img/pdv_border_4.gif"><img src="img/pdv_border_4.gif" width="1" height="7" alt="" border="0"></TD></TR>
</TABLE>
<?
if (strlen($dd[49]) > 0)
	{
	?><script>
		window.open('pdv_orcamento.php','pdv_area');
		window.open('pdv_cliente.php','pdv_cliente');
		window.open('pdv_produto.php','pdv_produto');
	</script>
	<?
	}
?>



</body>
</html>
