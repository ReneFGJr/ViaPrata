<TABLE cellpadding="0" cellspacing="0" width="<?=$tab_max?>" border=0 class=lt1>
<TR align="center" bgcolor="#c0c0c0">
<TD width="5">|</TD>
<TD><A href="main.php"><NOBR><B>&nbsp;inicial&nbsp;</A></TD>
<TD width="5">|</TD>
<?
$sql = "select * from sistema where sis_ativo=1 and sis_nivel <= 0".$user_nivel;
$sql .= " order by sis_menu ";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	echo '<TD><NOBR><B><A HREF="'.trim($line['sis_pagina']).'">&nbsp;'.trim($line['sis_menu']).'&nbsp;</A></TD>';
	echo '<TD width="5">|</TD>';
	}
?>
<TD width="95%">&nbsp;</TD>
<TD width="5">|</TD>
<TD><A href="logout.php"><NOBR>&nbsp;sair&nbsp;</A></TD>
<TD width="5">|</TD>
</TR>
</TABLE>