<?
require("cab.php");
//require("db_server.php");

require("cp/cp_vp_vendedor.php");
require("include/sisdoc_form2.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/cp2_gravar.php");
$tab_max = "760";
if (strlen($dd[1]) == 0)
	{ $dd[1] = date("d/m/Y"); }
$dd[7] = $user_id;
$dd[10] = 'Entrada de mercadoria para vendedor';
$dd[11] = '';
$dd[12] = 'M';
echo '<FONT class="lt5">'.$dd[10].'</FONT>';
$http_redirect = "vp_entrada_vendedor.php?dd1=".$dd[1].'&dd2='.$dd[2];

if ($dd[13]=='1')
	{ 
	$sql = "insert into vp_pedido ";
	$sql .= "(vpped_pedido,vpped_quantidade,vpped_ref,";
	$sql .= "vpped_unitario,vpped_fornecedor,vpped_data,";
	$sql .= "vpped_log,vpped_vendedor,vpped_dc,";
	$sql .= "vpped_historico,vpped_doc,vpped_tipo";
	$sql .= ") values (";
	$sql .= "'',".$dd[3].",'".$dd[5]."',";
	$sql .= "1,'".$dd[2]."',".brtos($dd[1]).",";
	$sql .= $user_id.",'','C',";
	$sql .= "'".$dd[10]."','','".$dd[12]."'); ";
	
	$sql .= "insert into vp_pedido ";
	$sql .= "(vpped_pedido,vpped_quantidade,vpped_ref,";
	$sql .= "vpped_unitario,vpped_fornecedor,vpped_data,";
	$sql .= "vpped_log,vpped_vendedor,vpped_dc,";
	$sql .= "vpped_historico,vpped_doc,vpped_tipo";
	$sql .= ") values (";
	$sql .= "'',-".$dd[3].",'".$dd[5]."',";
	$sql .= "1,'EMPR',".brtos($dd[1]).",";
	$sql .= $user_id.",'','D',";
	$sql .= "'Saída de mercadoria para mala','','".$dd[12]."'); ";
	$rlt = db_query($sql);
	redirect($http_redirect);
	exit;
	}
	
echo '<TABLE width="'.$tab_max.'" align="center">';
echo '<TR><TD>';
editar();
echo '</TD></TR>';
echo '</TABLE>';

echo '<TABLE width="'.$tab_max.'" align="center" class="lt1">';
$sql = "select * from vp_pedido where (vpped_tipo='M') order by id_vpped desc limit 20";
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