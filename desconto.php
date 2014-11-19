<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro descontos";
if ($user_nivel == 9)
	{	
	$http_edit = 'desconto_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'desconto.php';
//	$http_ver = 'sistema.php';
	$tabela = "desconto";
	$cdf = array('id_d','d_descricao','d_cod','d_valor');
	$cdm = array('Código','descricao','cod','valor');
	$masc = array('','','','','','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (d_ativo = 1) ";
	$order  = "d_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>