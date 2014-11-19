<?
require("cab.php");
require($include."sisdoc_grafico.php");
require($include."sisdoc_data.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_colunas.php");
require($include."cp2_gravar.php");

if (trim($dd[0]) == 'EMPR') { $dd[0] = ''; }
$sql = "select substr(p_data,1,6) as data,";
if (strlen($dd[0]) > 0) { $sql .= "p_vendedor,"; }
$sql .= "sum(p_valor) as valor from pedido ";
$sql .= "where p_data >= 20070101 and p_data <= ".date("Ymd")." and p_status = 'C' ";
if (strlen($dd[0]) > 0) { $sql .= " and p_vendedor ='".$dd[0]."' "; }
$sql .= "group by data "; 
if (strlen($dd[0]) > 0) { $sql .= ",p_vendedor "; }
$sql .= "order by data";
if (strlen($dd[0]) > 0) { $sql .= ",p_vendedor "; }
$rlt = db_query($sql);

$mm=array();
$max = 40000;
for ($m = 1;$m < 13;$m++)
		{ array_push($mm,''); }
$vnd= array();
for ($r=2007;$r <= date("Y");$r++)
	{ array_push($vnd,$mm); }
	
while ($line = db_read($rlt))
	{
	$data = $line['data'];
	$valo = $line['valor'];
	if ($valo < 0) { $valo = 0; }
	$ln = intval(substr($data,0,4))-2007;
	$cn = intval(substr($data,4,2));
//	print_r($line);
//	echo '<BR>';
//	echo '==>'.$ln;
//	echo '<BR>==>'.$cn;
//	echo '<HR>';
	$vnd[$ln][$cn] = $valo;
	if ($valo > $max) { $max = $valo; }
	}
?>
<TABLE cellpadding="2" cellspacing="0" border="1" width="704">
<TR><TD><form method="post"></TD></TR>
<TR><TD>
<?
$cp = array();
array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','','Representante',False,True,''));
echo gets_fld();
echo '<TD><input type="submit" name="acao" value="filtrar"></TD>';
?>
<TR><TD></form></TD>
</TABLE>
<?
	
	{
	for ($k=count($vnd)-1;$k >= 0 ;$k--)
		{
		$vv = array();
		for ($m=1;$m <= 12;$m++)
			{
			array_push($vv,array(intval($vnd[$k][$m]),nomemes($m)));
			}
		echo '<CENTER><font class="lt5">'.($k+2007).' '.$dd[0].'</font></CENTER>';
		echo gr_barras($vv,'',250);
		}
	}
		
require("foot.php");
?>