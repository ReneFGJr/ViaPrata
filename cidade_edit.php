<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('include/cp/cp_cidade.php');
	require('include/cp2_gravar.php');
	$http_edit = 'cidade_edit.php';
	$http_redirect = 'cidade.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>