<?
require("pdv_cab.php");
require($include."sisdoc_cookie.php");
require("orcamento_cookie_nr.php");
$http_edit = "pdv_produto.php";
	/////////////////////////////////////////////////////
	$sql = "select * from orcamento where o_id = ".$pg;
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
		$cliente_codigo = trim($line['o_cliente']);
		$cliente_nome = $line['o_nome'];
		$xlocal = trim($line['o_local']);
		$orc_nr = strzero($line['id_o'],7);
		echo '<CENTER><FONT CLASS=lt3>Dados do Cliente '.$pg.'/'.$orc_nr.'</FONT></CENTER>';
		if (strlen($cliente_codigo) > 0)
				{
				$tabela = "clientes";
				$sql = "select * from ".$tabela." where cliente_codigo = '".$cliente_codigo."' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
					echo '<TABLE width="100%">';
					echo '<TR><TD class="lt0">nome fantasia';
					echo '<TR><TD>';
					echo $line['cliente_nome_fantasia'];
					echo '<TR><TD class="lt0">razão social';
					echo '<TR><TD>';
					echo $line['cliente_razao_social'];
					echo '<TR><TD class="lt0">contato';
					echo '<TR><TD>';
					echo $line['cliente_contato'];
					echo '<TR><TD class="lt0">telefone';
					echo '<TR><TD>';
					echo $line['cliente_telefone'];
					echo '</TABLE>';
					} else {
					echo 'Codigo inválido';
					}
			}
			if (strlen($dd[99]) ==0)
				{
				?>
				<form method="post" action="pdv_cliente_selecionar.php" target="pdv_area">
				<input type="submit" name="acao" value=" selecionar cliente" style="width: 300; height: 50">
				</form>
				<?
				}
			
		}
?>
</body>
</html>
