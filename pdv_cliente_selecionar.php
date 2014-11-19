<?
require("pdv_cab.php");
require($include."sisdoc_cookie.php");
require("orcamento_cookie_nr.php");
$http_redirect = "pdv_cliente_selecionar.php";
require($include.'sisdoc_colunas.php');
$tab_max = "100%";
$label = "Cadastro de clientes";
if ($user_nivel > 0)
	{	
	$http_edit = 'cliente_edit.php'; 
	$editar = true;
	}
	$http_ver = 'pdv_cliente_selecionado.php';
//	$http_ver = 'sistema.php';
	$tabela = " (select trim(cliente_nome_fantasia) || chr(32) || chr(47) || chr(32) || trim(cliente_razao_social) as cliente_nm, * from clientes) as clientes ";
	$cdf = array('id_cliente','cliente_codigo','cliente_nm','cliente_nome','cliente_telefone');
	$cdm = array('Código','Código','Nome Fantasia/Razão social','contato','fone');
	$masc = array('','@','@','@');
	$busca = true;
	$offset = 18;
	$order = "cliente_razao_social";
	$pre_where = " (cliente_ativo = 'S') ";
	require('include/sisdoc_row.php');	
?>	