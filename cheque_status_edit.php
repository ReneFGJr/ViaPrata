<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('include/cp/cp_cheque_status.php');
	require('include/cp2_gravar.php');
	$http_edit = 'cheque_status_edit.php';
	$http_redirect = 'cheque_status.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>