<?
$login= 1;
require("cab.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");

require("_class/_class_produto.php");
$prod = new produto;

if (strlen($acao) > 0)
	{
	$sql="select * from produto ";
	$tit = '';
	if (strlen($dd[0]) > 0) { $tit = $tit . 'Codigo '.$dd[0].' '; $wh = $wh . wand($wh). "(p_codigo like '".codean($dd[0])."%') "; }
//	if (strlen($dd[1]) > 0) { $tit = $tit . 'Descrição '.$dd[1]; $wh = $wh . wand($wh).  "(upper(asc7(p_descricao)) like '%".strtoupper($dd[1])."%') "; }
	if (strlen($dd[1]) > 0) { $tit = $tit . 'Descrição '.$dd[1]; $wh = $wh . wand($wh).  "((upper(asc7(p_descricao)) like '%".strtoupper($dd[1])."%') or (((p_obs)) like '%".strtoupper($dd[1])."%')) "; }
	if (strlen($dd[2]) > 0) { $tit = $tit . 'peso de '.$dd[2]; $wh = $wh . wand($wh).  "(p_peso >= ".$dd[2].") "; }
	if (strlen($dd[3]) > 0) { $tit = $tit . ' ate '.$dd[3]; $wh = $wh . wand($wh).  "(p_peso <= ".$dd[3].") "; }

	if (strlen($dd[4]) > 0) { $tit = $tit . ' preço de '.$dd[4]; $wh = $wh . wand($wh).  "(p_preco_sugerido >= ".$dd[4].") "; }
	if (strlen($dd[5]) > 0) { $tit = $tit . ' ate '.$dd[5]; $wh = $wh . wand($wh).  "(p_preco_sugerido <= ".$dd[5].") "; }

	if (strlen($dd[6]) > 0) { $tit = $tit . ' fornecedor '.$dd[6]; $wh = $wh . wand($wh).  "(p_fornecedor = '".$dd[6]."') "; }
	if (strlen($wh) > 0) 
		{ $sql = $sql . 'where '. $wh . ' and p_ativo = 1 '; }
	if ($dd[7] == '0') { $sql = $sql . "order by p_codigo "; }
	if ($dd[7] == '1') { $sql = $sql . "order by p_codigo desc"; }
	if ($dd[7] == '2') { $sql = $sql . "order by p_codigo desc"; }
	if ($dd[7] == '3') { $sql = $sql . "order by p_descricao"; }
	if ($dd[7] == '4') { $sql = $sql . "order by p_fornecedor"; }
	if ($dd[7] == '5') { $sql = $sql . "order by p_codigo"; }
	$rlt = db_query($sql);
	echo '<font class="lt5">Produtos cadastrado</font><BR>';
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
		echo $prod->mostra_imagem($line);
		$col = $col + 1;
		//$img = trim($line['p_codigo']);
		//$codigo = trim($line['p_codigo']);
		//$codfor = trim($line['p_fornecedor_codigo']);
		//$descricao = trim($line['p_descricao']);
		//$preco = trim($line['p_preco_sugerido']);
		//$custo = trim($line['p_preco']);
		//$peso = trim($line['p_peso']);
		//$link = '<A HREF="produto_edit.php?dd0='.$line['id_p'].'" target="editar">';
		//echo '<IMG SRC="/img/produto/'.$img.'_01.jpg" width="281">';
		//echo '<BR>'.$link.'<font class=lt2>Cod. '.$codigo.' '.$codfor.'</font></A>';
		//echo '<BR><B>'.$descricao.'</B>';
		//echo '<BR><B>(R$ '.number_format($preco,2).')</B>&nbsp;&nbsp;(R$ '.number_format($custo,2).')&nbsp;&nbsp;('.number_format($peso,2).'g)';;
		//echo '<BR><font class="lt0">Atualizado em: '.stodbr($line['p_lastupdate']).'</font>';
		}
	echo '</TABLE>';
	} else {
		$tabela = "fornecedor";
		$sql = "select * from fornecedores where f_ativo = 1 order by f_nome ";
		$rlt = db_query($sql);
		$op1 = $op1 . ':--TODOS--';
		while ($line = db_read($rlt))
			{ $op1 = $op1 . '&'.trim($line['f_codigo']).':'.trim($line['f_nome']); }
		$cp = array();
		array_push($cp,array('$S8','','Codigo',False,True,''));
		array_push($cp,array('$S30','','Descrição',False,True,''));
		array_push($cp,array('$N8','','Peso de',False,True,''));
		array_push($cp,array('$N8','','até',False,True,''));
		array_push($cp,array('$N8','','Preço de',False,True,''));
		array_push($cp,array('$N8','','até',False,True,''));
		array_push($cp,array('$O '.$op1,'','Fornecedor',False,True,''));	
		array_push($cp,array('$O 0:Código crescente&1:Código decrescente&2:Descrição&3:fornecedor','','Ordenadar',False,True,''));	
		$dd[2] = '0.00';
		$dd[3] = '999.99';
		$dd[4] = '0.00';
		$dd[5] = '99999.99';
		$tt='';
		for ($k=0;$k<99;$k++)
			{
			if (isset($cp[$k]))
				{
				if (($k==0) or ($k==2) or ($k==4) or ($k==6)) { $tt = $tt . '<TR>'; }
			    $tt=$tt.gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
				}
			}
		$tt = $tt . '</table>';
		echo '<TABLE width="'.$tab_max.'" class="lt1" border1=1>';
		echo '<TR><TD><form method="post" action="rel_produto_peca.php"></TD></TR>';
		echo $tt;
		echo '<TR><TD><input type="submit" name="acao" value="buscar"></TD></TR>';
		echo '<TR><TD></form></TD></TR>';
		echo '</TABLE>';
	}
require('foot.php');	
function wand($ddr)
	{
	if (strlen($ddr) > 0) { return(' and '); }
	else { return(""); }
	}
		
?>