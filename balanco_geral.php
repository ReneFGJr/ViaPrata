<?
require("cab.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");

if (strlen($dd[0]) == 0)
	{
	$xsql = "	select p_unidade,";
	$xsql .= "sum(pe1) as pe1,sum(pe2) as pe2,sum(pe3) as pe3,sum(pe4) as pe4, ";
	$xsql .= "sum(pr1) as pr1,sum(pr2) as pr2,sum(pr3) as pr3,sum(pr4) as pr4, ";
	$xsql .= "tp, sum(e1) as e1,sum(e2) as e2,sum(e3) as e3,sum(e4) as e4 from ( ";
	$fsql = ") as tabela group by tp, p_unidade order by tp";
	}

$sql = "select substr(estoque_produto.p_codigo,1,2) as tp, ";
$sql .= "p_estoque_1*p_preco as pe1, ";
$sql .= "p_estoque_1*p_preco_sugerido as pr1, ";
$sql .= "p_estoque_2*p_preco as pe2, ";
$sql .= "p_estoque_2*p_preco_sugerido as pr2, ";
$sql .= "p_estoque_3*p_preco as pe3, ";
$sql .= "p_estoque_3*p_preco_sugerido as pr3, ";
$sql .= "p_estoque_4*p_preco as pe4, ";
$sql .= "p_estoque_4*p_preco_sugerido as pr4, ";
$sql .= "p_estoque_1 as e1, ";
$sql .= "p_estoque_2 as e2, ";
$sql .= "p_estoque_3 as e3, ";
$sql .= "p_estoque_4 as e4, ";
$sql .= "produto.p_codigo, ";
$sql .= "produto.p_unidade ";
$sql .= "from estoque_produto ";
$sql .= "inner join produto on estoque_produto.p_codigo = produto.p_codigo ";
if (strlen($dd[0]) > 0) { $sql .= "where produto.p_codigo like '".$dd[0]."%' "; }
$sql .= "order by produto.p_codigo ";
$sql = $xsql . $sql . $fsql;

$rlt = db_query($sql);

echo '<TABLE width="'.$tab_max.'" class="lt1" border="1">';
echo '<TR align="center" bgcolor="#c0c0c0">';
echo '<TD><B></B></TD>';
echo '<TD colspan="3"><B>Estoque Loja</B></TD>';
echo '<TD colspan="3"><B>Representante</B></TD>';
echo '<TD colspan="3"><B>Sedex / Concerto</B></TD>';
echo '<TD colspan="3"><B>estoque 4</B></TD>';
echo '</TR>';
echo '<TR align="center" bgcolor="#c0c0c0">';
echo '<TD><B>cod</B></TD>';
echo '<TD><B>Prc.Custo</B></TD>';
echo '<TD><B>Prc.Etiqueta</B></TD>';
echo '<TD><B>Peças</B></TD>';
echo '<TD><B>Prc.Custo</B></TD>';
echo '<TD><B>Prc.Etiqueta</B></TD>';
echo '<TD><B>Peças</B></TD>';
echo '<TD><B>Prc.Custo</B></TD>';
echo '<TD><B>Prc.Etiqueta</B></TD>';
echo '<TD><B>Peças</B></TD>';
echo '<TD><B>Prc.Custo</B></TD>';
echo '<TD><B>Prc.Etiqueta</B></TD>';
echo '<TD><B>Peças</B></TD>';
echo '<TD><B>U</B></TD>';
echo '</TR>';
echo '<TR>';
$col = 0;
$est = array();
$total = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$totap = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

while ($line = db_read($rlt))
	{
	$tp = $line['tp'];
	
if ((strlen($dd[0]) == 0))
	{
	$link = '<A HREF="balanco_geral.php?dd0='.$tp.'">';
	echo '<TR '.coluna().'>';
	echo '<TD><B>'.$link.$line['tp'];
	echo '<TD align="right" colspan="1">'.number_format($line['pe1'],2);
	echo '<TD align="right" colspan="1">'.number_format($line['pr1'],2);
	echo '<TD align="center">';
	if ($line['p_unidade'] == 'P') { echo '&nbsp;('.number_format($line['e1'],1).')'; } else
		{ echo '&nbsp;('.number_format($line['e1'],0).')'; }
	echo '<TD align="right" colspan="1">'.number_format($line['pe2'],2);
	echo '<TD align="right" colspan="1">'.number_format($line['pr2'],2);
	echo '<TD align="center">';
	if ($line['p_unidade'] == 'P') { echo '&nbsp;('.number_format($line['e2'],1).')'; } else
		{ echo '&nbsp;('.number_format($line['e2'],0).')'; }
	echo '<TD align="right" colspan="1">'.number_format($line['pe3'],2);
	echo '<TD align="right" colspan="1">'.number_format($line['pr3'],2);
	echo '<TD align="center">';
	if ($line['p_unidade'] == 'P') { echo '&nbsp;('.number_format($line['e3'],1).')'; } else
		{ echo '&nbsp;('.number_format($line['e3'],0).')'; }
	echo '<TD align="right" colspan="1">'.number_format($line['pe4'],2);
	echo '<TD align="right" colspan="1">'.number_format($line['pr4'],2);
	echo '<TD align="center">';
	if ($line['p_unidade'] == 'P') { echo '&nbsp;('.number_format($line['e4'],1).')'; } else
		{ echo '&nbsp;('.number_format($line['e4'],0).')'; }
	echo '<TD align="center">';
	echo '&nbsp;('.$line['p_unidade'].')';
	} else {
	$link = '<A HREF="balanco_log.php?dd0='.$line['p_codigo'].'">';
	echo '<TR>';
	echo '<TD><B>'.$link.$line['p_codigo'];
	echo '<TD align="right">'.number_format($line['pe1'],2);
	echo '<TD align="right">'.number_format($line['pr1'],2);
	echo '<TD align="center">';
	if ($line['p_unidade'] == 'P') { echo '&nbsp;('.number_format($line['e1'],1).')'; } else
		{ echo '&nbsp;('.number_format($line['e1'],0).')'; }

	echo '<TD align="right">'.number_format($line['pe2'],2);
	echo '<TD align="right">'.number_format($line['pr2'],2);
	echo '<TD align="center">';
	if ($line['p_unidade'] == 'P') { echo '&nbsp;('.number_format($line['e2'],1).')'; } else
		{ echo '&nbsp;('.number_format($line['e2'],0).')'; }

	echo '<TD align="right">'.number_format($line['pe3'],2);
	echo '<TD align="right">'.number_format($line['pr3'],2);
	echo '<TD align="center">';
	if ($line['p_unidade'] == 'P') { echo '&nbsp;('.number_format($line['e3'],1).')'; } else
		{ echo '&nbsp;('.number_format($line['e3'],0).')'; }

	echo '<TD align="right">'.number_format($line['pe4'],2);
	echo '<TD align="right">'.number_format($line['pr4'],2);
	echo '<TD align="center">';
	if ($line['p_unidade'] == 'P') { echo '&nbsp;('.number_format($line['e4'],1).')'; } else
		{ echo '&nbsp;('.number_format($line['e4'],0).')'; }

	echo '<TD align="center">';
	echo '&nbsp;('.$line['p_unidade'].')';
	}
	if ($line['p_unidade'] == 'P')
		{
			$totap[0] = $totap[0] + $line['pr1'];
			$totap[1] = $totap[1] + $line['pe1'];
			$totap[2] = $totap[2] + $line['e1'];
			$totap[3] = $totap[3] + $line['pr2'];
			$totap[4] = $totap[4] + $line['pe2'];
			$totap[5] = $totap[5] + $line['e2'];
			$totap[6] = $totap[6] + $line['pr3'];
			$totap[7] = $totap[7] + $line['pe3'];
			$totap[8] = $totap[8] + $line['e3'];
			$totap[9] = $totap[9] + $line['pr4'];
			$totap[10] = $totap[10] + $line['pe4'];
			$totap[11] = $totap[11] + $line['e4'];			
		} else {
			$total[0] = $total[0] + $line['pr1'];
			$total[1] = $total[1] + $line['pe1'];
			$total[2] = $total[2] + $line['e1'];
			$total[3] = $total[3] + $line['pr2'];
			$total[4] = $total[4] + $line['pe2'];
			$total[5] = $total[5] + $line['e2'];
			$total[6] = $total[6] + $line['pr3'];
			$total[7] = $total[7] + $line['pe3'];
			$total[8] = $total[8] + $line['e3'];
			$total[9] = $total[9] + $line['pr4'];
			$total[10] = $total[10] + $line['pe4'];
			$total[11] = $total[11] + $line['e4'];	
		}
	}
echo '<TR><TD>&nbsp;</TD>';
for ($r=0;$r < 11;$r=$r+3)
	{
	echo '<TD align="right"><B>'.number_format($total[$r+1],2).'</TD>'; 
	echo '<TD align="right"><B>'.number_format($total[$r],2).'</TD>'; 
	echo '<TD align="center"><B>'.$total[$r+2].'</TD>'; 
	}
echo '<TR><TD>&nbsp;</TD>';
for ($r=0;$r < 11;$r=$r+3)
	{
	echo '<TD align="right"><B>'.number_format($totap[$r+1],2).'</TD>'; 
	echo '<TD align="right"><B>'.number_format($totap[$r],2).'</TD>'; 
	echo '<TD align="center"><B>'.number_format($totap[$r+2],1).'g</TD>'; 
	}
echo '</TABLE>';
require("foot.php");	?>