<?
require('cab.php');
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_data.php');	
	require('include/sisdoc_form2.php');
	require('include/cp/cp_cliente.php');
	require('include/cp2_gravar.php');
$http_redirect = 'update.php?dd0=clientes';
$http_edit = 'cliente_edit.php';
?><TABLE width="700" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE><?
require('foot.php');
?>