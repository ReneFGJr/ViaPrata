<?
//$login= 1;
require("cab.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");

	echo '<font class="lt5">Produtos cadastrado</font><BR>';
	
if (strlen($dd[0]) > 0)
	{
	$sql="select * from produto ";
	$tit = '';
	if (strlen($dd[0]) > 0) { $tit = $tit . 'Codigo '.$dd[0].' '; $wh = $wh . wand($wh). "(p_codigo like '".codean($dd[0])."%') "; }
	if (strlen($wh) > 0) 
		{ $sql = $sql . 'where '. $wh . ' and p_ativo = 1 '; }
	$rlt = db_query($sql);
	echo '<font class="lt2">'.$tit.'</font>';
	echo '<TABLE width="'.$tab_max.'" class="lt1" border1=1>';
	$col = 10;
	while ($line = db_read($rlt))
		{
		if ($col >= 3)
			{
			echo '<TR align="center">';
			$col = 0;
			}
		echo '<TD>';
		$col = $col + 1;
		$img = trim($line['p_codigo']);
		$codigo = trim($line['p_codigo']);
		$descricao = trim($line['p_descricao']);
		$preco = trim($line['p_preco_sugerido']);
		$custo = trim($line['p_preco']);
		$custo = trim($line['p_peso']);
		$link = '<A HREF="produto_edit.php?dd0='.$line['id_p'].'" target="editar">';
		echo '<IMG SRC="/img/produto/'.$img.'_01.jpg" width="281">';
		echo '<BR>'.$link.'<font class=lt2>Cod. '.$codigo.'</font></A>';
		echo '<BR><B>'.$descricao.'</B>';
		echo '<BR><B>(R$ '.number_format($preco,2).')</B>&nbsp;&nbsp;(R$ '.number_format($custo,2).')&nbsp;&nbsp;('.number_format($peso,2).'g)';;
		
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
		$cp = array();
		array_push($cp,array('$S8','','Codigo',False,True,''));
		$dd[2] = '0.00';
		$dd[3] = '999.99';
		$dd[4] = '0.00';
		$dd[5] = '99999.99';
		$tt='';
		$dd[0]='';
		for ($k=0;$k<99;$k++)
			{
			if (isset($cp[$k]))
				{
				if (($k==0) or ($k==2) or ($k==4) or ($k==6)) { $tt = $tt . '<TR>'; }
			    $tt=$tt.gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
				}
			}
		$tt = $tt . '</table>';
		echo '<TABLE  class="lt1" border1=1 align="center">';
		echo '<TR><TD><form method="post" name="doc" action="rel_produto_peca_codigo.php"></TD></TR>';
		echo $tt;
//		echo '<TR><TD><input type="submit" name="acao" value="buscar"></TD></TR>';
		echo '<TR><TD></form></TD></TR>';
		echo '</TABLE>';
	}
	?>
	<script language="javascript">
		doc.dd0.focus();
		doc.dd0.focus();
	</script>
	<?
require('foot.php');	
function wand($ddr)
	{
	if (strlen($ddr) > 0) { return(' and '); }
	else { return(""); }
	}
		
?>