<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');	

	$http_edit = 'feiras_edicoes_edit.php'; 
	$editar = true;
	$http_redirect = 'feiras_edicoes.php';
//	$http_ver = 'sistema.php';
	$tabela = "feira_edicoes";
	$tabela = "(select id_fe,feira_nome as fe_feira,c_cidade as fe_cidade,fe_dt_inicio,fe_dr_final from feira_edicoes ";
	$tabela = 	$tabela . "inner join feira on fe_feira = feira_codigo ";
	$tabela = 	$tabela . "inner join cidade on fe_cidade = c_codigo) as tabela";

	$cdf = array('id_fe','fe_feira','fe_cidade','fe_dt_inicio','fe_dr_final');
	$cdm = array('Código','feira','cidade','inicio','fim');
	$masc = array('','','','D','D');
	$busca = true;
	$offset = 20;
//	$pre_where = " (feira_ativo = 1) ";
	$order  = "fe_dt_inicio desc ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>