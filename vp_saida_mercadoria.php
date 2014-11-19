<?
require("cab.php");
//require("db_server.php");

require("cp/cp_vp_saida.php");
require("include/sisdoc_form2.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/cp2_gravar.php");
$tab_max = "760";
if (strlen($dd[1]) == 0)
	{ $dd[1] = date("d/m/Y"); }
$dd[7] = $user_id;
if (strlen($dd[10]) ==0) { $dd[10] = 'Saída de mercadoria'; }
$dd[11] = '';
$dd[12] = 'S';
echo '<FONT class="lt5">'.$dd[10].'</FONT>';
$http_redirect = "vp_saida_mercadoria.php?dd1=".$dd[1];

if ($dd[13]=='1')
	{ 
		if ($dd[3] > 0)
			{ $dd[3] = ($dd[3] * (-1)); }
		if (cp2_gravar())
		{
		redirect($http_redirect);
		echo 'gravado';
		exit;
		}
	}
	
echo '<TABLE width="'.$tab_max.'" align="center">';
echo '<TR><TD>';
editar();
echo '</TD></TR>';
echo '</TABLE>';

echo '<TABLE width="'.$tab_max.'" align="center" class="lt1">';
$sql = "select * from vp_pedido where vpped_tipo='S' order by id_vpped desc limit 20";
$rlt = db_query($sql);
echo '<TR align="center" bgcolor="#c0c0c0">';
echo '<TH><B>data</B>';
echo '<TH><B>ref.</B>';
echo '<TH><B>historico</B>';
echo '<TH><B>estoque</B>';
echo '<TH><B>quant</B>';
while ($line=db_read($rlt))
	{
	echo '<TR '.coluna().'><TD align="center">';
	echo stodbr($line['vpped_data']);
	echo '<TD align="center">';
	$ref = trim($line['vpped_ref']);
	echo substr($ref,0,2).'.'.substr($ref,2,10);
	echo '<TD>';
	echo $line['vpped_historico'];
	echo '<TD>';
	echo $line['vpped_fornecedor'];
	echo '<TD align="right">';
	echo number_format($line['vpped_quantidade'],2);
	echo '</TD></TR>';
	}

echo '</TABLE>';

require("foot.php");
?>