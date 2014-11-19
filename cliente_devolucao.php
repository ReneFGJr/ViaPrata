<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Devolução de mercadoria de cliente";

	$http_redirect = 'cliente_devolucao.php';
	$http_ver = 'cliente_devolucao_lancar.php';
//	$http_ver = 'sistema.php';
	$tabela = "clientes";
	$cdf = array('id_cliente','cliente_codigo','cliente_nome_fantasia','cliente_razao_social','cliente_nome','cliente_telefone');
	$cdm = array('Código','Código','Nome Fantasia','Razão social','contato','fone');
	$masc = array('','@','@','@');
	$busca = true;
	$offset = 200;
	$order = "cliente_razao_social";
	$pre_where = " (cliente_ativo = 'S') ";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>	