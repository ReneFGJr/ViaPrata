<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de cheques";
if ($user_nivel == 9)
	{	
	$http_edit = 'cheque_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'cheque.php';
//	$http_ver = 'sistema.php';
	$tabela = "cheque";
	$cdf = array('id_ch','ch_nome_cliente','ch_nr');
	$cdm = array('Código','Banco','nr');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
	$order  = "ch_nome_cliente ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>