<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');
$label = "Devolução de mercadoria de cliente";

if ((strlen($acao) ==0) and (strlen($dd[0]) > 0))
	{ $dd[1] = $dd[0]; $dd[0] = ''; }

	echo '<FONT class="lt5">'.$label.'</FONT>';
$cp = array();
$sss = 'select trim(cliente_nome_fantasia) || '.chr(39).' / '.chr(39).' || trim(cliente_razao_social) as nome, cliente_codigo from clientes where cliente_codigo = '.chr(39).$dd[1].chr(39).' or id_cliente='.chr(39).$dd[1].chr(39);
array_push($cp,array('$H4','','id_bco',False,True,''));
array_push($cp,array('$Q nome:cliente_codigo:'.$sss,'','Nome',False,True,''));
array_push($cp,array('$S10','','Referencia',False,True,''));
array_push($cp,array('$N10','','Valor',False,True,''));
array_push($cp,array('$O 0:NÃO&1:SIM','','Grava',False,True,''));
array_push($cp,array('$S80','','Historico',False,True,''));
array_push($cp,array('$U8','','bco_lastupdate',False,True,''));
array_push($cp,array('$B8','','Gravar',False,True,''));
echo '<TABLE align="center" width="'.$tab_max.'"><TR><TD><form method="post" action="cliente_devolucao_lancar.php">';
echo gets_fld();
echo '</TABLE></form>';

$ok = 0;
if (strlen($dd[1]) > 0) { $ok++; }
if (strlen($dd[3]) > 0) { $ok++; }
if (strlen($dd[4]) == '1') { $ok++; }
if (strlen($dd[2]) > 0)
	{  $sql = "select * from produto where p_codigo='".$dd[2]."' ";
		$rpl = db_query($sql);
		if ($xline = db_read($rpl))
			{ $ok++; $ref = $line['p_codigo']; $des = $line['p_descricao']; $pre = $line['p_preco_sugerido']; }
		else { echo '<font color="red">referencia inválida'; }
	}

if ($ok == 4)
	{
	$sql = "insert into contas_cliente (";
	$sql .= " cr_cliente,cr_valor,cr_venc, ";
	$sql .= " cr_tipo,cr_historico,cr_pedido, ";
	$sql .= " cr_previsao,cr_parcela,cr_dt_quitacao, ";
	$sql .= " cr_status,cr_img,cr_doc, ";
	$sql .= " cr_lastupdate,cr_data,cr_conta, ";
	$sql .= " cr_empresa,cr_valor_original,cr_cc ) ";
	$sql .= " values ";
	$sql .= " ('".$dd[1]."',".$dd[3].",".date("Ymd").",";
	$sql .= " 'A','".$dd[5]."','',";
	$sql .= " 0,'',".date("Ymd").",";
	$sql .= " 'A','','".$dd[2]."',";
	$sql .= date("Ymd").",".date("Ymd").",'',";
	$sql .= "1,".$dd[3].",'') ";
	$rlq = db_query($sql);
	redirect("cliente_devolucao.php");
	}	
require("foot.php");
?>	