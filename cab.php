<? ob_start(); ?>
<title>Via Prata - Gestor comercial</title>
<?
global $nocab;
require('db.php');
require('security.php');
require($include.'sisdoc_access.php');

$user_id = $HTTP_COOKIE_VARS['nw_user'];
$user_nome = $HTTP_COOKIE_VARS['nw_user_nome'];
$user_nivel = $HTTP_COOKIE_VARS['nw_nivel'];
$user_log = $HTTP_COOKIE_VARS['nw_log'];
if (strlen($user_id) > 0)
	{
	setcookie('nw_log',$user_log,time()+3600);
	setcookie('nw_user',$user_id,time()+3600);
	setcookie('nw_user_nome',$user_nome,time()+3600);
	setcookie('nw_nivel',$user_nivel,time()+3600);
	}
	
if ($login != 1) { $access = access(); }
if ($login != 1) { security(); }
?>
<body leftmargin="0" topmargin="0" >
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(/img/bg.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<CENTER>
<TABLE width="<?=$tab_max?>" cellpadding="0" cellspacing="0" border="0" align="center">
<TR><TD height="8"></TD></TR>
<TR><TD><a href="main.php"><img src="img/logo_viaprata_mini.gif"  border="0"></a></TD>
<TD align="right"><img src="img/logo_chloe_mini.gif"  border="0"></TD>
</TR>
<TR><TD height="8"></TD></TR>
<TR bgcolor="#c0c0c0"><TD colspan="4" height="1"></TD></TR>
<TR class="lt0"><TD>&nbsp;<?=date('d-m-Y h:i')?>&nbsp;<?=$user_nome;?> (<?=$user_log;?>, <?=$user_nivel?>)</TD><TD colspan="5" align="right" >vers�o 0.0.1c&nbsp;</TD></TR>
</TABLE>
<?
if ($login != 1) { require('menu_top.php'); }
?>