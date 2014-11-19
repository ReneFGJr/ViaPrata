<TABLE border="0" cellspacing="4" class="lt1" width="100%">
<TR valign="top" align="15%"><TD>
Balanço<BR>
<?
$orc = "balanco.php?dd49=";
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
<TD align="center" width="15%"><BR><A HREF="balanco.php" onmouseover="return true"><font class=lt1><B>[ATUALIZAR]</A></TD>
</TD>
</TABLE>