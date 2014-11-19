<?
require("db.php");
require("include/sisdoc_cookie.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_data.php");
?>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">
<?
//	$tab_max = 600;
	$pgx = read_cookie("orcamento");
	if (strlen($pgx) ==0) { echo 'erro de cookies'; exit; }
	$http_redirect = 'orcamento_cliente.php';
	$http_ver = 'orcamento_cliente_selecionado.php';
//	$http_ver = 'sistema.php';
	$tabela = "clientes";
	$cdf = array('id_cliente','cliente_codigo','cliente_nome_fantasia','cliente_razao_social','cliente_nome','cliente_telefone');
	$cdm = array('Código','Código','Nome Fantasia','Razão social','contato','fone');
	$masc = array('','@','@','@');
	$busca = true;
	$offset = 200;
	$order = "cliente_razao_social";
//	$pre_where = " (cliente_ativo = 'S') ";
	require('include/sisdoc_row.php');	
?>
</body>
