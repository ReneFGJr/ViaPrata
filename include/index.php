<?
global $mostar_versao,$sis_versao;
$mostar_versao = True;
$sis_versao = array ();
echo '<CENTER><FONT SIZE=5 face="Garamond">Vers�es das Biblitoecas</FONT></CENTER>';
require("sisdoc_autor.php");
require("sisdoc_char.php");
require("sisdoc_colunas.php");
require("sisdoc_data.php");
require("sisdoc_dv.php");
require("sisdoc_email.php");
require("sisdoc_form2.php");
require("sisdoc_grafico.php");
require("sisdoc_html.php");
require("sisdoc_marc.php");
require("sisdoc_ro8.php");
require("sisdoc_row.php");
require("sisdoc_search.php");
require("sisdoc_security.php");
require("sisdoc_sql.php");
require("sisdoc_spell.php");
require("sisdoc_tips.php");
require("sisdoc_windows.php");

echo '<TABLE width="450" align="center">';
for ($kk=0;$kk < count($sis_versao);$kk++)
	{
	echo '<TR '.coluna().'>';
	echo '<TD>'.$sis_versao[$kk][0].'</TD>';
	echo '<TD align="center">'.$sis_versao[$kk][1].'</TD>';
	echo '<TD align="center">'.stodbr($sis_versao[$kk][2]).'</TD>';
	echo '</TR>';
	}
echo '</TABLE>';
?>