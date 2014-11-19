<?
require("cab.php");
require('include/sisdoc_colunas.php');
if ($user_nivel == 9)
	{	
	$http_edit = 'cheque_status_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'cheque_status.php';
//	$http_ver = 'sistema.php';
	$tabela = "cheque_status";
	$cdf = array('id_cs','cs_descricao','cs_codigo');
	$cdm = array('Código','Descricao','status');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (cs_ativo = 1) ";
	$order  = "cs_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>