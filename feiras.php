<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de feiras";
	$http_edit = 'feiras_edit.php'; 
	$editar = true;
	$http_redirect = 'feiras.php';
//	$http_ver = 'sistema.php';
	$tabela = "feira";
	$cdf = array('id_feira','feira_nome','feira_codigo');
	$cdm = array('Código','feira','codigo');
	$masc = array('','','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (feira_ativo = 1) ";
	$order  = "feira_nome ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>