<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_windows.php');
$label = "Ajuste de estoque de produto";
if ($user_nivel == 9)
	{	
	$http_edit = 'produto_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'balanco_produto.php';
	$http_ver = '#" onclick="newxy('."'balanco_estoque.php";
	$http_ver_para="',600,400);";
	$tabela = "(produto left join fornecedores on f_codigo = p_fornecedor) as tabela";
	$cdf = array('id_p','p_codigo','p_descricao','p_preco_sugerido','p_lastupdate','f_nome');
	$cdm = array('Código','codigo','Descricao','preco','atualizado','fornecedor');
	$masc = array('','','','$R','D');
	$busca = true;
	$offset = 20;
	$order = ' p_lastupdate desc ';
	$pre_where = " (p_ativo = 1) ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>