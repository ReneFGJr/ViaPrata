<? 
require("db.php");
require("include/sisdoc_data.php");
require("include/sisdoc_windows.php");
$nucleo = 'cep';
$filename = trim($_FILES['userfile']['name']);

?>
<TITLE>Anexar arquivo</TITLE>
<BODY topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">
<link rel="stylesheet" href="letras.css" type="text/css" />
<TABLE width="100%" align="center" border="0" class="lt1">
<TR><TD align="right">
<form enctype="multipart/form-data" action="upload.php" method="POST">
</TD><TD>
<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
<TR valign="top"><TD align="right">
Arquivo para anexar</TD><TD colspan="3"><input name="userfile" type="file" class="lt2">
&nbsp;<input type="submit" value="e n v i a r" class="lt2" <?=$estilo?>>
<input type="hidden" name="dd0" value="<?=$dd[0]?>">
<input type="hidden" name="dd1" value="<?=$dd[1]?>">
<input type="hidden" name="dd2" value="<?=$dd[2]?>">
<input type="hidden" name="dd3" value="<?=$dd[3]?>">
</form>
</TD>
<TD><?=$xnome?></TD></TR>
<TR><TD colspan="5"><font color="#ff8040">Tamanho máximo por arquivo (2 Mega bytes)</font></TD></TR>
</TABLE>
<?
///////////
if (strlen($filename) == 0) { exit; }

echo '<HR size="1"><font class=lt1>Filename : '.$filename;
if (strlen($filename) > 0 )
	{
	////////////////////////////////////////////////////////////////
	$uploaddir = $dir;
	echo '<TABLE class="lt1">';
	$arq = $filename;
	$uploadfile = $uploaddir.'img/produto/'.strtolower($arq);
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
		{
			echo '<P>&nbsp;</P><font color="green">Transferencia ok!</font>';
		} else {
		    print "<CENTER><FONT COLOR=RED>ERRO EM SALVAR O ARQUIVO";
			print "<BR>->".$uploadfile;
	    //print_r($_FILES);
		}
	echo '</TABLE>';
	}
	
?>