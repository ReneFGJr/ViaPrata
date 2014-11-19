<?
require("pdv_cab.php");
require($include."sisdoc_cookie.php");
require("orcamento_cookie_nr.php");
$http_redirect = "pdv_cliente_selecionar.php";
require($include.'sisdoc_colunas.php');
require("cliente_saldo.php");
$tab_max = "100%";
$estilo_admin = 'style="width: 180; height: 50; background-color: #dfdfdf; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

	?><script>
		window.open('pdv_cliente.php?dd99=xadmin','pdv_produto');
		window.open('orcamento_prn.php?dd49=<?=$pg?>','pdv_cliente');
		window.open('pdv_orcamento_pedido.php','pdv_area');
	</script>
	<?
?>