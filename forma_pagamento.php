<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro forma de pagamento";
if ($user_nivel == 9)
	{	
	$http_edit = 'forma_pagamento_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'forma_pagamento.php';
//	$http_ver = 'sistema.php';
	$tabela = "forma_pagamento";
	$cdf = array('id_fp','fp_descricao','fp_cod','fp_desconto','fp_ativo');
	$cdm = array('Código','descricao','cod','valor','ativo');
	$masc = array('','','','','SN','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (fp_ativo = 1) ";
	$order  = "fp_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>