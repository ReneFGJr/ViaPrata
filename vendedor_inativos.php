<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de vendedores";
if ($user_nivel == 9)
	{	
	$http_edit = 'vendedor_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'vendedor.php';
//	$http_ver = 'sistema.php';
	$tabela = "vendedores";
	$cdf = array('id_vd','vd_codigo','vd_nome','vd_telefone','vd_ativo');
	$cdm = array('Código','código','vendedor','telefone','Ativo');
	$masc = array('','','','','');
	$busca = true;
	$offset = 200;
	$pre_where = " (vd_ativo = 2) ";
	$order  = "vd_nome ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>