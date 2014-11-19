<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de Roteiro vendodor / cidade";
if ($user_nivel == 9)
	{	
	$http_edit = 'vendedor_cidade_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'vendedor_cidade.php.php';
//	$http_ver = 'sistema.php';
	$tabela = "representante_cidade";
	$cdf = array('id_rc','rc_cidade','rc_vendedor');
	$cdm = array('Código','Cidade','vendedor');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (bco_ativo = 1) ";
	$order  = "rc_lastupdate desc ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>