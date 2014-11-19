<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
if ($user_nivel == 9)
	{	
	$http_edit = 'moeda_cotacao_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'moeda_cotacao.php';
//	$http_ver = 'sistema.php';
	$tabela = "moeda_cotacao";
	$cdf = array('id_mc','mc_moeda','mc_dt_inicio','mc_dt_final');
	$cdm = array('Código','Descricao','Dt.Inicial','Dt.Final');
	$masc = array('','','D','D');
	$busca = true;
	$offset = 20;
//	$pre_where = " (bco_ativo = 1) ";
	$order  = "mc_dt_final desc ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>