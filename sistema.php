<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de rotinas do sistema";
if ($user_nivel == 9)
	{	
	$http_edit = 'sistema_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'sistema.php';
//	$http_ver = 'sistema.php';
	$tabela = "sistema";
	$cdf = array('id_sis','sis_nome','sis_menu','sis_nivel');
	$cdm = array('C�digo','Titulo','Menu','N�vel');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (sis_ativo = 1) ";
	$order  = "sis_menu ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>