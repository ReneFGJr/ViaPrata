<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_windows.php');
require('include/sisdoc_data.php');
$label = "Pedidos de Cliente";
if ($user_nivel > 0)
	{	
	$http_edit = 'ed_edit.php'; 
	$http_edit_para = '&dd99=pedido'; 

	$editar = true;
	}
	$http_redirect = 'pedido_todos.php';
	$http_ver = '#" onclick="newxy('.chr(39).'pedido_vd_mostra.php';
	$http_ver_para = "'".',600,600);';
//	$http_ver = 'sistema.php';
	$tabela = "pedido";
	$cdf = array('id_p','p_pedido','p_nome','p_cliente','p_valor','p_desconto','p_data','p_orcamento','p_local');
	$cdm = array('Código','Pedido','Nome','Cod.Clie','Valor','Desconto','data','orcamento','local');
	$masc = array('','@','@','','$R','$R','D');
	$busca = true;
	$offset = 200;
	$order = "p_pedido desc";
//	$pre_where = " (cliente_ativo = 'S') ";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>	
