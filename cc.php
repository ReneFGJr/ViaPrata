<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de vendedores";
if ($user_nivel == 9)
	{	
	$http_edit = 'cc_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'cc.php';
//	$http_ver = 'sistema.php';
	$tabela = "cc";
	$cdf = array('id_cc','cc_descricao','cc_banco','cc_agencia','cc_conta','cc_codigo');
	$cdm = array('Código','descricao','banco','agencia','conta','codigo');
	$masc = array('','','','','','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (cc_ativo = 1) ";
	$order  = "cc_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>