<?
//$login= 1;
require("cab.php");
require("include/cp2_gravar.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_cookie.php");

$pc = array();
$pu = array();
$ds = array();
$cp = array();

if ((strlen($acao) == 0) and (strlen($dd[0]) > 0))
	{
		$sql = "select * from pedido_vendedor where p_orcamento = '".trim($dd[0])."'";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			if ($xline['p_status'] == 'B')
				{			
				echo 'Pedido já lançado, porem sem forma de pagamento '.$dd[5];
				exit;
				}
			}
		setcookie("repre",$dd[0],time()+7200); $pg = $dd[0];
		$dd[0] = '';
	} else {
		$pg = read_cookie("repre");
	}
//////////////////////////////////////////// dados do pedido
$xsql = "select * from pedido_vendedor where p_orcamento='".$pg."'";
$xrlt = db_query($xsql);
if ($xline = db_read($xrlt))
	{
	echo '<BR>Data do pedido:'.stodbr($xline['p_data']);
	echo '<BR>Representante: '.$xline['p_vendedor'];
	}
	
////////////////////////////////////////////////////////////
$xsql = "select * from produto where p_codigo like '04%' or p_codigo like '090000%'";
$xsql .= " order by p_codigo ";
$rlt = db_query($xsql);
array_push($cp,array('$T70:5','','Observações',False,True,''));
while ($line = db_read($rlt))
	{
	$tp = '$N8';
	$tn = '0.00';
	$prc = number_format($line['p_preco_sugerido'],2);
	$pro = number_format($line['p_comissao'],2);

	array_push($pc,trim($line['p_codigo']));
	array_push($pu,trim($line['p_preco_sugerido']));
	array_push($ds,trim($line['p_descricao']));
	array_push($ds,trim($line['p_preco_sugerido']));
	/////////////
	$nr = count($cp);
//	array_push($cp,array($tp,'',trim($line['p_descricao']).' ('.trim($line['p_codigo'].')'),True,True,''));
	array_push($cp,array($tp,'',trim($line['p_descricao']),True,True,''));
	if (strlen($dd[$nr] == 0)) { $dd[$nr] = $tn; }
	
	/////////////
	$nr = count($cp);
	array_push($cp,array($tp,'','Preço',False,True,''));
	if (strlen($dd[$nr] == 0)) { $dd[$nr] = $prc; }

	/////////////
	$nr = count($cp);
	array_push($cp,array($tp,'','Comissão',False,True,''));
	if (strlen($dd[$nr] == 0)) { $dd[$nr] = $pro; }
	}
////////////////////////////////////////////////////////////
//$tab_max = 600;
echo '<CENTER><FONT CLASS="lt5">Pedido Representante '.$pg.'</FONT></CENTER>';

///////////////////////////////////////////////////////////////////////
$psql = '';
echo '<TABLE width='.$tab_max.' border=1 class="lt1" >';
echo '<TR><TD colspan="10"><form action="orcamento_vendedor.php" method="post"></TD></TR>';
echo '<TR>';
$k = 0;
$tot = 0;
$toc = 0;
$pcc=-1;
for ($k=0;$k < count($cp);$k++)
	{
	if ($k == 1)
		{
		echo '</TABLE><TABLE width='.$tab_max.' border=1 class="lt1"  >';
		echo '<TR>';
		}
		
		if ($k <= 0)
		{
			echo '<TR>';
			echo gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
		} else {
			$vlr = round(($dd[$k] * $dd[$k+1])*100)/100;
			$com = round(($dd[$k] * $dd[$k+1] * ($dd[$k+2])/100)*100)/100;
			$prc = $dd[$k+1];
			$qua = $dd[$k];
			echo '<TR>';
			echo gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
			$k = $k + 1;
			echo gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
			$k = $k + 1;
			echo gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
			echo '<TD width="80" align="right">'.number_format($vlr,2).'</TD>';
			echo '<TD width="100" align="right">'.number_format($com,2).'</TD>';
			
			if ($vlr > 0)
				{
//				echo '<BR>(1)k=>'.$pcc;
//				echo '<BR>(1)pc=>'.$pc[$pcc];
//				echo '<BR>(2)vlr=>'.$vlr;
//				echo '<BR>(2)com=>'.$com;
//				echo '<BR>(1)ds=>'.$pu[$pcc];
//				echo '<BR>(1)ds=>'.$prc;
//				echo '<BR>(1)desc=>'.($pu[$pcc]-$prc);
				$desco = ($pu[$pcc]-$prc);
				if ($desco < 0) { $desco = 0; }
				$psql .= "insert into pedido_vendedor_item ";
				$psql .= "(pi_orcamento,pi_codigo,pi_vlr_unit,";
				$psql .= "pi_vlr_total,pi_desconto,pi_comissao,";
				$psql .= "pi_data,pi_hora,pi_log,";
				$psql .= "pi_status,pi_pedido,";
				$psql .= "pi_quan,pi_quan_dev,pi_vlr_unit_original) ";
				$psql .= " values ";
				$psql .= "('".$pg."','".$pc[$pcc]."','".$prc."',";
				$psql .= "'".$vlr."','".$desco."','".$com."',";
				$psql .= "'".date("Ymd")."','".date("H:i")."','".$user_id."',";
				$psql .= "'A','".$pg."',";
				$psql .= "'".$qua."','0','".$pu[$pcc]."'); ".chr(13).chr(10);
				}
		}
		$tot = $tot + $vlr;
		$toc = $toc + $com;
		$pcc++;
	}
echo '</TD></TR>';
echo '<TR><TD colspan="10" align="right">Total do pedido <B>'.number_format($tot,2).'</B>';
echo '<BR>Total do comissão <B>'.number_format($toc,2);
echo '</TD></TR>';
echo '<TR><TD colspan="10" align="center"><select name="dd99" size="1"><option>NÃO</option><option>SIM</option></select>';
echo '<input type="submit" name="acao" value="gravar >>"></form></TD></TR>';
echo '</TABLE>';

//////////////////////////////////////////////////////////// GRAVAR
if ((strlen($acao) > 0) and ($dd[99] =='SIM') and (($tot+$toc) > 0))
	{
	$psql = "delete from pedido_vendedor_item where pi_pedido = '".$pg."'; ".$psql;
	
	$psql .= "update pedido_vendedor set p_valor='".$tot."',";
	$psql .= "p_desconto=0,";
	$psql .= "p_status='B', ";
	$psql .= "p_obs='".$dd[0]."' ";
	$psql .= "where p_orcamento = '".$pg."' ";
	echo 'gravar';
	$rlt = db_query($psql);
	redirect("orcamento_vendedor_final.php?dd0=".$pg);
	echo $psql;
	exit;
	}

require("foot.php");
?>