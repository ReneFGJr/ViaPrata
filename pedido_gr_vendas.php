<?
require("cab.php");
require($include."sisdoc_grafico.php");
require($include."sisdoc_data.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_colunas.php");
require($include."cp2_gravar.php");

$sql = "select substr(p_data,1,6) as data,";
if (strlen($dd[0]) > 0) { $sql .= "p_local,"; }
$sql .= "sum(p_valor) as valor from pedido ";
$sql .= "where p_data >= 20070101 and p_data <= ".(date("Y")+1)."0101 and p_status = 'A' ";
if (strlen($dd[0]) > 0) { $sql .= " and p_local ='".$dd[0]."' "; }
$sql .= "group by data "; 
if (strlen($dd[0]) > 0) { $sql .= ",p_local "; }
$sql .= "order by data";
if (strlen($dd[0]) > 0) { $sql .= ",p_local "; }
$rlt = db_query($sql);


$mm=array();
$max = 120000;
for ($m = 1;$m < 13;$m++)
		{ array_push($mm,''); }
$vnd= array();
for ($r=2007;$r <= date("Y");$r++)
	{ array_push($vnd,$mm); }
	
while ($line = db_read($rlt))
	{
	$data = $line['data'];
	$valo = $line['valor'];
	$ln = intval(substr($data,0,4))-2007;
	$cn = intval(substr($data,4,2));
	$vnd[$ln][$cn] = $valo;
	if ($valo > $max) { $max = $valo; }
	}
?>
<TABLE cellpadding="2" cellspacing="0" border="1" width="704">
<TR><TD><form method="post"></TD></TR>
<TR><TD>
<?
$cp = array();
array_push($cp,array('$Q feira_nome:feira_codigo:select * from feira order by feira_nome','','Local',False,True,''));
echo gets_fld();
echo '<TD><input type="submit" name="acao" value="filtrar"></TD>';
?>
<TR><TD></form></TD>
</TABLE>
<?
	
	{
	for ($k=count($vnd)-1;$k >= 0 ;$k--)
		{
		$tot=0;
		$vv = array();
		for ($m=1;$m <= 12;$m++)
			{
			$tot = $tot + $vnd[$k][$m];
			array_push($vv,array($vnd[$k][$m],nomemes($m)));
			}
		echo '<CENTER><font class="lt5">'.($k+2007).' '.$dd[0].'</font></CENTER>';
		echo gr_barras($vv,'',250);
		echo '<CENTER>Acumulado ano '.number_format($tot,2).'</CENTER><BR><HR width="400">';
		}
	}
		
require("foot.php");
?>