<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_windows.php');
require('include/sisdoc_data.php');
$label = "Pedidos de Cliente";
if ($user_nivel > 0)
	{	
//	$http_edit = 'pedido_edit.php'; 
//	$editar = true;
	}
	$http_redirect = 'orcamento_todos.php';
	$http_ver = '#" onclick="newwin2('.chr(39).'orcamento_vd_mostra.php';
	$http_ver_para = "'".');';
//	$http_ver = 'sistema.php';
	$tabela = "orcamento";
	$cdf = array('id_o','o_orcamento','o_nome','o_valor','o_desconto','o_data','o_cliente');
	$cdm = array('Código','Orçamento','Nome','Valor','Desconto','data','cliente');
	$masc = array('','@','@','$R','$R','D');
	$busca = true;
	$offset = 200;
	$order = " o_orcamento desc ";
	$pre_where = " (o_id = -1) ";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>	
