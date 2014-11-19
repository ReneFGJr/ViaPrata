<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de bancos";
if ($user_nivel == 9)
	{	
	$http_edit = 'banco_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'banco.php';
//	$http_ver = 'sistema.php';
	$tabela = "banco";
	$cdf = array('id_bco','bco_nome','bco_nr');
	$cdm = array('Código','Banco','nr');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (bco_ativo = 1) ";
	$order  = "bco_nome ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>