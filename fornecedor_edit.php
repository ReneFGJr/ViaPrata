<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('include/sisdoc_data.php');
	require('include/cp/cp_fornecedor.php');
	require('include/cp2_gravar.php');
	$http_edit = 'fornecedor_edit.php';
	$http_redirect = 'update.php?dd0=fornecedor';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>