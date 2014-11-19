<?
require("cab.php");
require('include/sisdoc_colunas.php');
if ($user_nivel == 9)
	{	
	$http_edit = 'estoque_tipo_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'estoque_tipo.php';
//	$http_ver = 'sistema.php';
	$tabela = "estoque_tipo";
	$cdf = array('id_et','et_descricao','et_codigo');
	$cdm = array('Código','Banco','nr');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (et_ativo = 1) ";
	$order  = "et_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>