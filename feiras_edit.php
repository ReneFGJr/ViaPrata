<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('include/cp/cp_feira.php');
	require('include/cp2_gravar.php');
	$http_edit = 'feiras_edit.php';
	$http_redirect = 'update.php?dd0=feira';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>