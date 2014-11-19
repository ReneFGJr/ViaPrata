<?
//$login= 1;
require("cab.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");

	echo '<font class="lt5">Movimentação de estoque</font><BR>';

echo '<font class="lt2">'.$tit.'</font>';
echo '<TABLE width="'.$tab_max.'" class="lt1" border=1 >';
echo '<TR align="center"><TD>';
	
if (strlen($dd[0]) > 0)
	{
	$sql="select * from produto ";
	$tit = '';
	if (strlen($dd[0]) > 0) { $tit = $tit . 'Codigo '.$dd[0].' '; $wh = $wh . wand($wh). "(p_codigo like '".codean($dd[0])."%') "; }
	if (strlen($wh) > 0) 
		{ $sql = $sql . 'where '. $wh . ' and p_ativo = 1 '; }
	$rlt = db_query($sql);
	$col = 10;
	if ($line = db_read($rlt))
		{
		$col = $col + 1;
		$img = trim($line['p_codigo']);
		$codigo = trim($line['p_codigo']);
		$descricao = trim($line['p_descricao']);
		$tipop = trim($line['p_unidade']);
		$preco = trim($line['p_preco_sugerido']);
		$custo = trim($line['p_preco']);
		$custo = trim($line['p_peso']);
		$link = '<A HREF="produto_edit.php?dd0='.$line['id_p'].'" target="editar">';
		$img = '<IMG SRC="/img/produto/'.$img.'_01.jpg" width="140">';
		$img .=  '<BR>'.$link.'<font class=lt2>Cod. '.$codigo.'</font></A>';
		$img .=  '<BR><B>'.$descricao.'</B>';
		$img .=  '<BR><B>(R$ '.number_format($preco,2).')</B>&nbsp;&nbsp;(R$ '.number_format($custo,2).')&nbsp;&nbsp;('.number_format($peso,2).'g)';;
		
		}
	} 
	{
		if (trim($dd[5]) == 'S')
			{
			$sql ='';
			if ($dd[1] > 0)
			{
			$sql .= "insert into estoque_produto_log (";
			$sql .= "ep_codigo,ep_estoque,ep_quan, ";
			$sql .= "ep_doc,ep_data,ep_hora, ";
			$sql .= "ep_log, ep_tipo) values (";
			$sql .= "'".$dd[0]."',".$dd[1].",-".$dd[3].',';
			$sql .= "'','".date("Ymd")."','".date("H:i")."',";
			$sql .= $user_id.",'S'); ";
			
			$sql .= "update estoque_produto set ";
			$sql .= "p_estoque_".$dd[1]." = p_estoque_".$dd[1]." - ".$dd[3];
			$sql .= " where p_codigo = '".$dd[0]."'; ";
			}
			
			if ($dd[2] > 0)
			{
			$sql .= "insert into estoque_produto_log (";
			$sql .= "ep_codigo,ep_estoque,ep_quan, ";
			$sql .= "ep_doc,ep_data,ep_hora, ";
			$sql .= "ep_log, ep_tipo) values (";
			$sql .= "'".$dd[0]."',".$dd[2].",".$dd[3].',';
			$sql .= "'','".date("Ymd")."','".date("H:i")."',";
			$sql .= $user_id.",'E'); ";

			$sql .= "update estoque_produto set ";
			$sql .= "p_estoque_".$dd[2]." = p_estoque_".$dd[2]." + ".$dd[3];
			$sql .= " where p_codigo = '".$dd[0]."'; ";
			}

			if (strlen($sql) > 0)
				{
				$rlt = db_query($sql);
				}
			redirect("estoque_produto.php");
			exit;
			}	
	
		$cp = array();
		array_push($cp,array('$S8','','Codigo',False,True,''));
		array_push($cp,array('$O 0:Nenhum&1:Estoque loja&2:Estoque Maleta&3:Estoque Sedex&4:Outros','','Saida do estoque',False,True,''));
		array_push($cp,array('$O 0:Nenhum&1:Estoque loja&2:Estoque Maleta&3:Estoque Sedex&4:Outros','','Entrada no estoque',False,True,''));
		if ($tipop == 'P') 
			{ array_push($cp,array('$N8','','Peso',False,True,'')); if (strlen($dd[3]) == 0) { $dd[3] = '0.00'; } } else
			{ array_push($cp,array('$I8','','Quantidade',False,True,'')); if (strlen($dd[3]) == 0) { $dd[3] = '0'; } else { $dd[3] = intval($dd[3]); } }
		array_push($cp,array('$S40','','Motivo',False,True,''));
		array_push($cp,array('$O : &S:SIM','','Confirma',False,True,''));
		array_push($cp,array('$B8','','Gravar',False,True,''));
		$dd[7] = '';
		$tt='';
		for ($k=0;$k<99;$k++)
			{
			if (isset($cp[$k]))
				{
				if (($k==1) or ($k==3) or ($k==5) or ($k==7)) { $tt = $tt . '<TR>'; }
			    $tt=$tt.gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
				}
			}
//		$tt = $tt . '</table>';
		echo '<TABLE  class="lt1" border=4 align="center">';
		echo '<TR><TD><form method="post" name="doc" action="estoque_produto.php"></TD></TR>';
		echo $tt;
		echo '<TR><TD></form></TD></TR>';
		echo '</TABLE>';
	}
	echo '<TD>'.$img.'</TD>';
	echo '</TABLE>';
	require("balanco_log_body_mov.php");
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