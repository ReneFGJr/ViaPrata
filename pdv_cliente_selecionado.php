<?
require("pdv_cab.php");
require($include."sisdoc_cookie.php");
require("orcamento_cookie_nr.php");
$http_redirect = "pdv_cliente_selecionar.php";
require($include.'sisdoc_colunas.php');
$tab_max = "100%";
if (strlen($dd[0]) > 0)
	{
	$sql = "select * from clientes where id_cliente = ".$dd[0];
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
		echo '<CENTER>AGUARDE...';
		$nome = trim($line['cliente_nome_fantasia']).'/'.trim($line['cliente_razao_social']);
		$sql = "update orcamento set o_cliente='".$line['cliente_codigo']."', ";
		$sql .= " o_nome = '".substr($nome,0,40)."' ";
		$sql .= " where o_id = ".$pg;
		$rlt = db_query($sql);
		?>
		<script>
		window.open('pdv_orcamento.php','pdv_area');
		window.open('pdv_cliente.php','pdv_cliente');
		</script>
		<?
		}
	}
?>	