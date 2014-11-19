<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_windows.php');
$label = "Cadastro de produto";
if ($user_nivel > 3)
	{	
	$http_edit = 'produto_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'produto.php';
	$http_ver = '#" onclick="newxy('."'imagem.php";
	$http_ver_para="',600,400);";
	$tabela = "(produto left join fornecedores on f_codigo = p_fornecedor) as tabela";
	$cdf = array('id_p','p_codigo','p_descricao','p_preco_sugerido','p_fornecedor_codigo','p_peso','f_nome','p_ativo');
	$cdm = array('Código','codigo','Descricao','preco','Cod. fornecedor','peso','fornecedor','ativo');
	$masc = array('','','','$R','#','$R','','SN');
	$busca = true;
	$offset = 20;
	$order = ' p_lastupdate desc ';
	if (strlen($dd[1]) == 0)
		{
		$pre_where = " (p_ativo = 1) ";
		}
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>