<?
require($include."viaprata_funcoes.php");
$prod_ok = False;
if (strlen($dd[0]) > 0)
	{
	$sql="select * from produto ";
	$tit = '';
	if (strlen($dd[0]) > 0) { $tit = $tit . 'Codigo '.$dd[0].' '; $wh = $wh . wand($wh). "(p_codigo like '".codean($dd[0])."%') "; }
	if (strlen($wh) > 0) 
		{ $sql = $sql . 'where '. $wh . ' and p_ativo = 1 '; }
	$sql .= " order by p_codigo ";

	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$img = trim($line['p_codigo']);
		$img_dir = $dir . 'img/' . 'produto/';
		$fimg = $img_dir.$img.'_01.jpg';
		if (!file_exists($fimg))
			{
			$fimg = 'semimagem.jpg';
			} else {
			$fimg = $img.'_01.jpg';
			}
		$codigo = trim($line['p_codigo']);
		$descricao = trim($line['p_descricao']);
		$preco = trim($line['p_preco_sugerido']);
		$custo = trim($line['p_preco']);
		$custo = trim($line['p_peso']);
		$link = '<A HREF="produto_edit.php?dd0='.$line['id_p'].'" target="editar">';
		$ximg .= '<IMG SRC="/img/produto/'.$fimg.'" width="160" height="120">';

		$st = '<TD rowspan="10">'.$ximg;
		$st .= '<TR><TD colspan="1" class="lt2">';
		$st .= '<B>'.$descricao.'</B>';
		$st .= '<TR align="center"><TD class="lt2">';
		$st .= '<B><FONT COLOR="#C06600">(R$ '.number_format($preco,2).')</FONT></B>&nbsp;&nbsp;('.number_format($peso,2).'g)';;
		$st .= '<TR align="center"><TD colspan="2">';
		$st .= ''.$link.'<font class=lt1>Cod. '.$codigo.'</font></A>';
		
		$prod_ok = True;
		}
	} 
	
	?>
	<TABLE cellpadding="0" cellspacing="0" width="95%" align="center" class="lt1">
	<TR class="lt0"><TD>ref. / código produto</TD><TD><form method="post" name="prod" action="<?=$http_edit?>"></TD></TR>
	<TR><TD><input type="text" name="dd0" size="15" maxlength="15" <?=estilo?>></TD><TD></form></TD><?=$st?></TR>
	</TABLE>
	<script language="javascript">
		prod.dd0.focus();
	</script>
	
<?
function wand($ddr)
	{
	if (strlen($ddr) > 0) { return(' and '); }
	else { return(""); }
	}
?>	