<?
require("cab.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");

//$sql = "update pedido_sedex_item set pi_pedido='0000007' where pi_orcamento='0000028';";
//$sql .= "update pedido_sedex_item set pi_pedido='0000008' where pi_orcamento='0000029';";
//$sql .= "update pedido_sedex_item set pi_pedido='0000009' where pi_orcamento='0000030';";
//$sql .= "update pedido_sedex_item set pi_pedido='0000010' where pi_orcamento='0000031';";
//$sql .= "update pedido_sedex_item set pi_pedido='0000011' where pi_orcamento='0000032';";
///$sql .= "update pedido_sedex_item set pi_pedido='0000012' where pi_orcamento='0000033';";
///sql .= "update pedido_sedex_item set pi_pedido='0000013' where pi_orcamento='0000033';";
///$sql = "update pedido_sedex_item set pi_pedido='0000013' where pi_orcamento='0000034';";
//$sql = "update pedido_sedex_item set pi_pedido='0000014' where pi_orcamento='0000035';";

//$rlt = db_query($sql);
///////////////////////// devolução por peso
if (strlen($dd[3])>0) { $dd[2] = $dd[3]; }


$sql = "select * from pedido_sedex where id_p = ".sonumero($dd[0]);
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$cliente_codigo = $line['p_cliente'];
	$cliente_status = $line['p_status'];
	$nr_pedido = $line['p_pedido'];
	}
//echo $cliente_codigo;
//echo '<HR>';
$ok = True;
if ($cliente_status != 'A')
	{
	echo '<font class=lt5 >Sedex já fechado !</font>';
	$ok = false;
	}
	
if (strlen($dd[1]) > 0)
	{
	$cod = codean($dd[1]);
	
	$sql = "select * from pedido_sedex_item ";
	$sql .= "where pi_pedido = '".$nr_pedido."' ";
	$sql .= "and pi_codigo = '".$cod."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt)) 
		{
		$tp = $line['pi_quan'];
		$td = $line['pi_quan_dev'];
		if (strlen($dd[2]) == 0) { $dd[2] = 1; }
		$up = intval($dd[2]*10)/10;
		
		if ((($td + $up) >= 0) and (($tp - ($td + $up)) >= 0))
			{
			$sql = "update pedido_sedex_item set pi_quan_dev = pi_quan_dev +  ".$up;
			$sql .= " where pi_pedido = '".$nr_pedido."' ";
			$sql .= "and pi_codigo = '".$cod."' ";
			$rlt = db_query($sql);
			$erro = '<font color="#008000">Codigo baixado '.$cod.'</font>';
			} else { $erro = 'todos os item devolvido'; }
		} else {
			?><script>alert('codigo inválido');</script><?
		}
	}	

//if ((strlen($cliente_codigo) > 0) and $ok)
	{
		$sql = "select sum(pi_vlr_unit * (pi_quan - pi_quan_dev)) as total ";
		$sql .= " from pedido_sedex_item ";
		$sql .= " where pi_pedido = '".$nr_pedido."' group by pi_pedido ";
		$trlt = db_query($sql);
		$total = 0;
		if ($tline = db_read($trlt))
			{
			$total = $tline['total'];
			}
		echo '<FONT CLASS=LT5>Sedex '.strzero($nr_pedido,7).'</FONT>';
		
		//////////////////////////////////////////////////////////relaciona items
		$sql = "select * from pedido_sedex_item ";
		$sql .= " join produto on p_codigo = pi_codigo ";
		$sql .= "where pi_pedido = '".$nr_pedido."' ";
		$sql .= " order by pi_codigo ";
		$rlt = db_query($sql);
		echo '<TABLE width="'.$tab_max.'" class="lt1" border="1">';
		echo '<TR><TD colspan="10" align="right" class="lt5">'.number_format($total,2).'</TD></TR>';
		echo '<TR valign="top"><TD>';
		echo '<TABLE width="99%" class="lt1">';
		echo '<TR bgcolor="#c0c0c0" align="center">';
		echo '<TD>código</TD>';
		echo '<TD>descrição</TD>';
		echo '<TD>quant.</TD>';
		echo '<TD>devolvido</TD>';
		echo '<TD>vlr.unitário</TD>';
		echo '<TD>vlr.total</TD>';
		while ($line = db_read($rlt))
			{
			$link = '<A HREF="orcamento_sedex.php?dd0='.$dd[0].'&dd1='.trim($line['pi_codigo']).'&dd2='.($line['pi_quan']-$line['pi_quan_dev']).'">';
			$linkz = '<A HREF="orcamento_sedex.php?dd0='.$dd[0].'&dd1='.trim($line['pi_codigo']).'&dd2='.($line['pi_quan_dev']*(-1)).'">';
			$color = "<B>";
			$co = trim($line['pi_codigo']);
			$t1 = $line['pi_quan'];
			$t2 = $line['pi_quan_dev'];
			if (($t1 - $t2) == 0)
				{
				$color = "";
				}
			echo '<TR '.coluna().'>';
			echo '<TD>'.$link.$color.$line['pi_codigo'];
			echo '<TD>'.$color.$line['p_descricao'];
			if ($line['p_unidade'] != 'P')
				{
				echo '<TD align="right">'.$color.$line['pi_quan'];
				echo '<TD align="right">'.$linkz.$color.$line['pi_quan_dev'];
				} else {
				echo '<TD align="right">'.$color.number_format($line['pi_quan'],1);
				echo '<TD align="right">'.$linkz.$color.number_format($line['pi_quan_dev'],1);
				}
			echo '<TD align="right">'.$color.number_format($line['pi_vlr_unit'],2);
			echo '<TD align="right">'.$color.number_format($line['pi_vlr_unit']*($line['pi_quan']-$line['pi_quan_dev']),2);
//			echo '<TD>'.$color.$line['pi_pedido'];
//			echo '<TD>'.$color.$line['pi_orcamento'];
			echo '</TR>';
			}
		echo '</TABLE>';
		echo '</TD><TD>';
///////////////////////////////////// Estoque Unidade		
		$cp = array();
		array_push($cp,array('$H8','','Codigo',False,True,''));
		array_push($cp,array('$S8','','Codigo',False,True,''));
		array_push($cp,array('$O 1:1&-1:-1','','quan',False,True,''));
		$dd[1] = '';
		$tt='';
		for ($k=0;$k<99;$k++)
			{
			if (isset($cp[$k]))
				{
				if (($k==1) or ($k==3) or ($k==5) or ($k==7)) { $tt = $tt . '<TR>'; }
			    $tt=$tt.gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
				}
			}
////////////////////////////////////// Estoque Peso
		$cp = array();
		array_push($cp,array('$H8','','Codigo',False,True,''));
		array_push($cp,array('$S8','','Codigo',False,True,''));
		array_push($cp,array('$H8','','quan',False,True,''));
		array_push($cp,array('$N8','','quan',False,True,''));
//		array_push($cp,array('$O +:+&-:-','','quan',False,True,''));
		$dd[1] = '';
		$dd[3] = '0.00';
		$tp='';
		for ($k=0;$k<99;$k++)
			{
			if (isset($cp[$k]))
				{
				if (($k==1) or ($k==3) or ($k==5) or ($k==7)) { $tp = $tp . '<TR>'; }
			    $tp=$tp.gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
				}
			}			
//		$tt = $tt . '</table>';
		echo '<TD width="120">';
		echo '<IMG SRC="/img/produto/'.$cod.'_01.jpg" width="200" height="150"><BR>';
		echo '<form method="post" name="doc" action="orcamento_sedex.php">';
		echo '<center><B>Mercadoria Devolvida</B></center>';
		echo '<BR>';
		echo '<TABLE width="80%" class="lt1">';
		echo $tt;
		echo '</TABLE>';
		echo '</form>';
		echo '<HR>';
		echo '<center>Peso</center>';
		echo '<HR>';
		echo '<form method="post" name="doc2" action="orcamento_sedex.php">';
		echo '<TABLE width="80%" class="lt1">';
		echo $tp;
		echo '<TR><TD colspan="2"><input type="submit" name="dd50" value="lancar"></TD></TR>';
		echo '</TABLE>';
		echo '</form>';

		echo '<font color=red>'.$erro.'</font>';
		?>
		</form>
		<HR>
		<FORM method="POST" action="orcamento_sedex_grava.php">
		<input type="hidden" name="dd0" value="<?=$dd[0]?>">		
		<CENTER><input type="submit" value="atualizar"></CENTER>
		</form>		
		<HR>
		<?
		echo '</TABLE>';
		?>
		<FORM method="POST" action="orcamento_sedex_grava.php">
		<input type="submit" name="acao" value=" gerar pedido " style="width: 300; height: 50">
		<input type="hidden" name="dd0" value="<?=$dd[0]?>">
		<BR><input type="checkbox" name="dd1" value="1">Confirmar geração do pedido
		</FORM>
		<?
	}
require("foot.php");
?>
	<script language="javascript">
		doc.dd1.focus();
		doc.dd1.focus();
	</script>

