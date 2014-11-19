<?
require("db.php");
require("include/sisdoc_cookie.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_data.php");
?>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">
<?
	$pgx = read_cookie("orcamento");
	if (strlen($pgx) ==0) { echo 'erro de cookies'; exit; }
	
if (strlen($dd[0]) > 0)
	{
	$sql = "select * from clientes where id_cliente = ".$dd[0];
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
		$snome = trim($line['cliente_nome_fantasia']);
		$snome1 = trim($line['cliente_razao_social']);
		if (strlen($snome1) > 0) { $snome .= ' ('.$snome1.')'; }
		$sql = "update orcamento set o_nome = '".substr($snome,0,60)."' ,";
		$sql .= " o_cliente = '".$line['cliente_codigo']."' ";
		$sql .= " where o_status = 'A' and o_id =".$pgx;
		$rlt = db_query($sql);
		?>
		<script>
			close();
		</script>
		<?
		}
	}
?>
</body>
