<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('include/cp/cp_banco.php');
	require('include/cp2_gravar.php');
	$http_edit = 'banco_edit.php';
	$http_redirect = 'banco.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>