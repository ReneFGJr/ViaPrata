<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('include/cp/cp_produto.php');
	require('include/cp2_gravar.php');
	$http_edit = 'produto_edit.php';
	$http_redirect = 'update.php?dd0=produto&dd10='.$dd[2];
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>