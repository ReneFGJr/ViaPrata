<?
function saldo_cc($cliente)
	{
	$xsaldo = 0;
	$cliente = trim($cliente);
	if (strlen($cliente) > 0)
		{
		$csql = "select sum(cr_valor) as total from contas_cliente where cr_cliente='".trim($cliente)."'";
		$crlt = db_query($csql);
		if ($cline = db_read($crlt))
			{
			$xsaldo = (-1) * $cline['total'];
			}
		}
	return($xsaldo);
	}
?>