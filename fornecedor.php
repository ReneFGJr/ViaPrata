<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de fornecedor";
if ($user_nivel == 9)
	{	
	$http_edit = 'fornecedor_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'fornecedor.php';
//	$http_ver = 'sistema.php';
	$tabela = "fornecedores";
	$cdf = array('id_f','f_nome','f_contato','f_telefone');
	$cdm = array('Código','Nome','contato','fone');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (f_ativo = 1) ";
	$order  = "f_nome ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>