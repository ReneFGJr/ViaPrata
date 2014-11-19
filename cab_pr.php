<?
$cab = '<TABLE width="'.$tab_max.'">';
$cab .= '<TR><TD rowspan="2" width="10%"><a href="main.php"><img src="img/logo_viaprata_mini.gif"  border="0"></a></TD>';
$cab .= '<TD>Via Prata<BR>';
if (strlen($local_venda) > 0)
	{
	echo 'Local da venda: <B>'.$local_venda.'</B>'; 
	}
$cab .= '';
$cab .= '</TD></TR>';
$cab .= '<TR valign="bottom"><TD align="right"><font face="Arial"><font style="font-size: 10px;">'.date("d/m/Y H:i").'</font></TD>';
$cab .= '</TABLE>';
?>