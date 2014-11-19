<? ob_start(); ?>
<title>Via Prata - Gestor comercial</title>
<?
global $nocab;
require('db.php');
require('security.php');
require('pdv_config.php');
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
	
if ($login != 1) { security(); }
?>
<body leftmargin="0" topmargin="0" >
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(/img/bg.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<CENTER>