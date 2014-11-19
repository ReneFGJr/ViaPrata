<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de clientes";
if ($user_nivel > 0)
	{	
	$http_edit = 'cliente_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'cliente.php';
	$http_ver = 'cliente_ver.php';
//	$http_ver = 'sistema.php';
	$tabela = "clientes";
	$cdf = array('id_cliente','cliente_codigo','cliente_nome_fantasia','cliente_nome','cliente_razao_social','cliente_cidade','cliente_telefone','cliente_estado');
	$cdm = array('Codigo','codigo','Nome fantasia','nome','Razao social','cidade','fone','UF');
	$masc = array('','','','','','','','');
	$busca = true;
	$offset = 200;
	if (strlen($dd[2]) == 0) 
		{ $order = "cliente_codigo"; }
		else
		{ $order = $dd[2]; }
	$pre_where = " (cliente_ativo = 'S') ";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>	