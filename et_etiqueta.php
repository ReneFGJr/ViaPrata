<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de descricao das etiquetas";
	$tab_max = $tab_max -20;
	$http_edit = 'et_etiqueta_edit.php';
	$http_redirect = 'et_etiqueta.php';
//	$http_ver = 'sistema.php';
	$tabela = "et_descricao";
	$cdf = array('id_et','et_descricao');
	$cdm = array('Código','Descricao');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (et_ativo = 1) ";
	$order  = "et_descricao ";
	$editar = true;
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>