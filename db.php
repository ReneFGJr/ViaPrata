<?
ob_start();
//-------------------------------------- Paramentros para DEBUG
if ($debug == True)
	{
	ini_set('display_errors', 1);
	ini_set('error_reporting', 7);
	} else {
	ini_set('display_errors', 0);
	ini_set('error_reporting',0);
	}
$include = "include/";
//-------------------------------------- Includes Padrões
require('include/sisdoc_sql.php');
require('include/sisdoc_char.php');

//-------------------------------------- Diretórios de Arquivos e Imagens
$dir = $_SERVER['DOCUMENT_ROOT'];
$dir_public = $dir;
$img_dir = '/img/';
$img_pub_dir = '/img/';
$http_site = '/';
$include = 'include/';
$secu = "chloe";
//-------------------------------------- Definições Iniciais
define(site,'http://www2.pucpr.br');
define(http,'http://www2.pucpr.br/reol/');
define(site,'sisdoc.com.br');
define(idioma,"pt_br");
define(path,''.$_SERVER['PATH_INFO']);
define(host,getServerHost());
define(secu,'biblioteca');
$path = substr(path,1,100);
$charset = "ASCII";
$uploaddir = path;
if (!isset($index))
	{
//	if (strlen($path)<=0))
//		{
//		header("Location: catalago.php");
//		break;
//		}
	}

$tab_max = 892;
//-------------------------------------- Leituras das Variaveis dd0 a dd99 (POST/GET)
$vars = array_merge($_GET, $_POST);
for ($k=0;$k < 100;$k++)
	{
	$varf='dd'.$k;
	$varf=$vars[$varf];
	//if (isset($varf) and ($k > 1)) {	//$varf = str_replace($varf,"A","´"); }
	$dd[$k] = troca($varf,"'","´");
	}
$acao = $vars['acao'];
$nocab = $vars['nocab'];
$base = 'pgsql';


//-------------------------------------- Determina o Idioma de Navegação
$idv = $vars['idioma'];
if (strlen($idv) > 0)
	{
	setcookie("idioma",$idv, time()+60*60*24*365);
	$idioma = $idv;
	}
else
	{
	$idioma=$_COOKIE["idioma"];
	}
	if (strlen($idioma)==0) {$idioma="1";}
	if (!isset($jid)) { $jid = '1'; }

//-------------------------------------- Paramentros da Base de Dados PostGres
$base_user=$vars['base_user'];
$base_port = '5432';
$base_host="10.1.1.225";
$base_host="localhost";
$base_name="viaprata";
if (strlen($base_user)==0) { $base_user="postgres"; }
$base_pass="448545ct";

$ok = db_connect();


//-------------------------------------- Recuperar dados de GET / POST
function getServerHost() {
return isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST']
		: (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
		: (isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
		: 'localhost'));
}
?>
