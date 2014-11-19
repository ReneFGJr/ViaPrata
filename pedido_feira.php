<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_windows.php');
require('include/sisdoc_data.php');
$label = "Pedidos de Feiras";
if ($user_nivel > 0)
	{	
	$http_edit = 'pedido_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'pedido_feira.php';
	$http_ver = '#" onclick="newxy('.chr(39).'pedido_feira_vd_mostra.php';
	$http_ver_para = "'".',600,600);';
//	$http_ver = 'sistema.php';
	$tabela = "pedido_feira";
	$cdf = array('p_pedido','p_pedido','p_nome','p_valor','p_desconto','p_data');
	$cdm = array('Código','Pedido','Nome','Valor','Desconto','data');
	$masc = array('','@','@','$R','$R','D');
	$busca = true;
	$offset = 200;
	$order = "p_pedido desc";
//	$pre_where = " (cliente_ativo = 'S') ";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>	
