<?
require("db.php");

if ($dd[0]=='feira') { $sql = "update feira set feira_codigo = lpad(id_feira,5,'0') where feira_codigo = ''"; $http_redirect = "feiras.php"; }
if ($dd[0]=='fornecedor') { $sql = "update fornecedores set f_codigo = lpad(id_f,5,'0') where f_codigo = ''"; $http_redirect = "fornecedor.php"; }
if ($dd[0]=='produto') { $sql = "update produto set p_cod_int = lpad(id_p,8,'0') where p_cod_int = ''"; $http_redirect = "produto.php?dd1=".$dd[10].'&dd2=p_codigo'; }
if ($dd[0]=='contas') { $sql = "update contas_tipo set ct_codigo = lpad(id_ct,5,'0') where ct_codigo = ''"; $http_redirect = "contas.php"; }
if ($dd[0]=='empresa') { $sql = "update empresa set e_codigo = lpad(id_e,3,'0') where e_codigo = ''"; $http_redirect = "empresa.php"; }
if ($dd[0]=='cc') { $sql = "update cc set cc_codigo = lpad(id_cc,7,'0') where length(cc_codigo) < 7"; $http_redirect = "cc.php"; }
if ($dd[0]=='clientes') { $sql = "update clientes set cliente_codigo = lpad(id_cliente,4,'0') where length(cliente_codigo) = 0 "; $tt= "where length(cliente_codigo) = 0"; $http_redirect = "cliente.php"; }
if (strlen($sql) > 0)
	{
	$rlt = db_query($sql);
	}
	
header("Location: ".$http_redirect);	
?>