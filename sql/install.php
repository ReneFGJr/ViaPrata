<?
require('../db.php');

if (strlen($acao) > 0)
	{
	$fp = fopen($acao.'.sql','r');
	$ddd='';
	while ($dados = fread($fp,4096))
	{
		$ddd = $ddd . $dados;
	}	
	$rlt = db_query($ddd);
	fclose($fp);
	if ($acao == 'create_user')
		{
		$base_user = 'ojsbr';
		}
	echo '<CENTER><HR width="704">Processado '.$acao.'<HR width="704">';
	}
?>
<TABLE align="center">
<TR><TD><FORM></TD></TR>
<TR><TD colspan="3">
<input type="hidden" name="base_user" value="<?=$base_user?>">
<HR size="1">
Tabelas
<HR size="1">
</TD></TR>
<TR align="center">
<TD><input type="submit" name="acao" value="pedido" style="width : 120"></TD>
<TD><input type="submit" name="acao" value="orcamento" style="width : 120"></TD>
<TD><input type="submit" name="acao" value="refresh" style="width : 120"></TD>

<TR align="center">
<TD><input type="submit" name="acao" value="alterar" style="width : 120"></TD>
<TD><input type="submit" name="acao" value="orcamento_finan" style="width : 120"></TD>


<TR><TD></FORM></TD></TR>
</TABLE>