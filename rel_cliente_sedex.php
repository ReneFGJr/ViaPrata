<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Sedex/Conserto enviados para Clientes";
if ($user_nivel > 0)
	{	
//	$editar = true;
	}
	$http_redirect = 'rel_cliente_sedex.php';
	$http_ver = 'orcamento_sedex.php';
//	$http_ver = 'sistema.php';
	$tabela = "(select * from pedido_sedex inner join clientes on p_cliente = cliente_codigo) as pedido";
	$cdf = array('id_p','p_pedido','cliente_nome','p_data','p_valor','p_orcamento');
	$cdm = array('Código','Ped. Sedex','Nome Fantasia','Data envio','Valor enviado','nº orçamento');
	$masc = array('','@','@','D','$R','#');
	$busca = true;
	$offset = 200;
	$order = "";
	if (strlen($dd[0]) == 0) { $pre_where = " (p_status = 'A') "; }
	require('include/sisdoc_row.php');	
require("foot.php");	?>