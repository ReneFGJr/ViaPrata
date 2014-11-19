<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Cadastro de produto";
	
$uploaddir = $dir_public.'img/produto/';
$uploadfile = $uploaddir. $_FILES['userfile']['name'];

if (strlen($dd[97]) > 0 )
	{
	$dest = $uploadfile;
	echo "<P>>".$dest."<BR>";
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $dest)) 
		{
	    print "<CENTER><FONT COLOR=GREEN>Arquivo valido e foi salvo.</FONT></CENTER>";
		//    print_r($_FILES);
		} else {
	    print "<CENTER><FONT COLOR=RED>ERRO EM SALVAR O ARQUIVO";
		print "<BR>->".$uploadfile;
	    //print_r($_FILES);
	}
	}
?>
<CENTER>
<TABLE width="710" align="center" border="0" class="lt1">
<TR><TD>IMAGEMS</TD></TR>
<TR><TD colspan="2"><IMG src="<?=$xmst?>"><BR><?=$xmst?></TD>
<TR><TD>
<form enctype="multipart/form-data" action="<?=$path?>" method="POST">
<input type="hidden" name="dd97" value="<homeHeaderLogoImage.jpg">
<input type="hidden" name="dd99" value="<?=$dd[99]?>">
<input type="hidden" name="dd98" value="<?=$dd[98]?>">
<input type="hidden" name="dd97" value="homeHeaderLogoImage">
<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
Imagem: <input name="userfile" type="file" class="lt2">
&nbsp;&nbsp;
<input type="submit" value="e n v i a r" class="lt2">
</form></TD>
<TD><?=$xnome?></TD></TR>
</TABLE>