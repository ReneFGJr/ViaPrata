<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de moedas";
if ($user_nivel == 9)
	{	
	$http_edit = 'moeda_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'moeda.php';
//	$http_ver = 'sistema.php';
	$tabela = "moeda";
	$cdf = array('id_moeda','moeda_descricao','moeda_simbolo','moeda_codigo');
	$cdm = array('Código','Descricao','simbolo','codigo');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (bco_ativo = 1) ";
	$order  = "moeda_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>