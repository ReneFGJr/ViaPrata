<?
if ((($tov+$cov) > 0) and ($nrec >0))
	{
	echo '<TABLE border="6" width="100%" bordercolor="#FF8040">';
	echo '<TR><TD><B>Confirmar Fechamento de Pedido';
	echo '<BR><BR>';
	echo '<form method="post" action="orcamento_gravar.php">';
	echo '<CENTER>';
	echo '<input type="submit" name="dd1" value="FINALIZAR PEDIDO" '.$estilo_admin.'>';
	echo '<BR>';
	echo '<input type="checkbox" name="dd2" value="1">Sim, finalizar pedido';
	echo '</form>';
	echo '</TABLE>';
	}
?>