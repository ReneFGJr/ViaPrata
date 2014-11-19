<TABLE border="0" cellspacing="4" class="lt1" width="100%">
<TR valign="top" align="15%"><TD>
Orcamento<BR>
<?
$orc = "orcamento.php?dd49=";
for ($k=1;$k < 10;$k++)
	{
	$ks = '';
	if ($pg == $k) { echo '<B>';} else
	{ echo $ks.'<A HREF ="'.$orc.$k.'">'; }
	echo '<font class=lt1>';
	echo '&nbsp;[';
	echo $k;
	echo ']&nbsp;</A>';
	echo '</B>';
	}
?>
<TD align="center" width="15%"><BR><A HREF="orcamento.php" onmouseover="return true"><font class=lt1><B>[ATUALIZAR]</A></TD>
<TD width="70%">Cliente: <?=$cliente_codigo?>
<?
echo '<BR><B>';
if (strlen($cliente_codigo) == 0) { 
	echo '<A HREF="#" onclick="newxy2('."'orcamento_cliente.php',800,450);".'">';
	echo 'Sem nome de cliente definido</A>'; 
}
else { 
	echo '<A HREF="#" onclick="newxy2('."'orcamento_cliente.php',800,450);".'">';
	$cliente_nome = trim($cliente_nome);
	if (strlen($cliente_nome) == 0) { echo '[nome e razao social em branco]'; }
	echo $cliente_nome; 
	}
?>
</TD>
</TABLE>