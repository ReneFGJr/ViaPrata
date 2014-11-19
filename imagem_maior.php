<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
<link rel="stylesheet" href="letras.css" type="text/css" />
<?
require("db.php");
require("include/viaprata_funcoes.php");
if (strlen($dd[0]) > 0)
	{
	$sql="select * from produto ";
	$sql = $sql . " where (id_p = ".(sonumero($dd[0])-3).' ) ';
	$sql = $sql . ' and p_ativo = 1 ';	
	$rlt = db_query($sql);
	$tit = '';
	echo '<font class="lt2">'.$tit.'</font>';
	echo '<TABLE width="100%" class="lt1" border=1><TR valign="top"><TD>';
	$col = 10;
	while ($line = db_read($rlt))
		{
		$col = $col + 1;
		$img = trim($line['p_codigo']);
		$codigo = trim($line['p_codigo']);
		$descricao = trim($line['p_descricao']);
		$preco = trim($line['p_preco_sugerido']);
		$custo = trim($line['p_preco']);
		$custo = trim($line['p_peso']);
		$link = '<A HREF="imagem.php?dd0='.$line['id_p'].'" >';
			{ 
			echo '<TD><center>'.$link.'<IMG SRC="/img/produto/'.$img.'_01.jpg" border="0" ><BR>'.$link.'<font class=lt2>'; 
			echo 'Cod. '.$codigo.'</font></A>';
			echo '<BR><B>'.$descricao.'</B>';
			echo '<BR><B>(R$ '.number_format($preco,2).')</B>&nbsp;&nbsp;(R$ '.number_format($custo,2).')&nbsp;&nbsp;('.number_format($peso,2).'g)';
			echo '<TD align="right">';
			}
		}
	echo '</TABLE>';
	} 
	{
		$tabela = "fornecedor";
		$sql = "select * from fornecedores where f_ativo = 1 order by f_nome limit 1 ";
		$rlt = db_query($sql);
		$op1 = $op1 . ':--TODOS--';
		while ($line = db_read($rlt))
			{ $op1 = $op1 . '&'.trim($line['f_codigo']).':'.trim($line['f_nome']); }
	}
?>
<TR><TD colspan="10" align="center">
<form method="post" action="upload.php">
<center><input type="submit" name="acao" value="enviar nova imagem"></center>
</form>
</TD></TR>
</TABLE>
<?
function wand($ddr)
	{
	if (strlen($ddr) > 0) { return(' and '); }
	else { return(""); }
	}
			
?>
