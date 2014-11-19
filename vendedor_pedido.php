<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_windows.php');
require('include/sisdoc_data.php');
$label = "Pedidos de Cliente";
if ($user_nivel > 0)
	{	
//	$http_edit = 'vendedor_pedido_edit.php'; 
//	$editar = true;
	}
	$http_redirect = 'vendedor_pedido.php';
	$http_ver = '#" onclick="newxy('.chr(39).'vendedor_pedido_vd_mostra.php';
	$http_ver_para = "'".',600,600);';
//	$http_ver = 'sistema.php';
	$tabela = "(select * from pedido_vendedor inner join clientes on p_cliente = cliente_codigo) as tabela ";
	$cdf = array('id_p','p_orcamento','p_cliente','cliente_nome_fantasia','cliente_razao_social','p_vendedor','p_valor','p_desconto','p_data','p_status');
	$cdm = array('Código','Pedido','Codigo','Nome','Razao social','vendedor','Valor','Desconto','data','S');
	$masc = array('','@','@','@','@','@','$R','$R','D');
	$busca = true;
	$offset = 200;
	$order = "p_data desc";
//	$pre_where = " (cliente_ativo = 'S') ";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>	
