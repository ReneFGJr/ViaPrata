<?
//$login= 1;
require("cab.php");
require("include/cp2_gravar.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_cookie.php");
echo '<FONT CLASS=lt5 >Lançar pedido de representante</FONT>';
	$http_redirect = 'orcamento_vendedor_pedido.php';
	$http_ver = 'orcamento_vendedor_pedido_2.php';
	$tabela = "clientes";
	$cdf = array('cliente_codigo','cliente_codigo','cliente_nome_fantasia','cliente_razao_social','cliente_nome','cliente_telefone');
	$cdm = array('Código','Código','Nome Fantasia','Razão social','contato','fone');
	$masc = array('','@','@','@');
	$busca = true;
	$offset = 200;
	$order = "cliente_razao_social";
//	$pre_where = " (cliente_ativo = 'S') ";
	require('include/sisdoc_row.php');	
	?>



<? require("foot.php"); ?>