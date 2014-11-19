<?
//$login= 1;
require("cab.php");
require("include/sisdoc_cookie.php");
require("include/sisdoc_data.php");
require("include/sisdoc_form2.php");
$pg = read_cookie("orcamento");
$tot=0;
$tov=0;
$ok = 0;
$sql1 = '';
$sql2 = '';
$sql3 = '';
$sql4 = '';
if (strlen($dd[2]) == 0)
	{
	redirect("orcamento_pedido.php");
	}
?><TABLE width="<?=$tab_max?>" border=1 >
<TR valign="top">
<TD><?
	$tabela = "pedido";
	$tabela_cr = "contas_receber";
	$tipo_fornece = "N";
//////////////////////////////////////////////////// RECUPERAR
	$sql = "select * from orcamento ";
	$sql .= " left join feira on o_local = feira_codigo ";
	$sql .= " where o_id = ".$pg;	
	
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$orc_nr = strzero($line['id_o'],7);
		$cliente_codigo = trim($line['o_cliente']);
		$cliente_nome = $line['o_nome'];
		$local_venda = $line['feira_nome'];
		$local_codigo = $line['o_local'];		
		}
//////////////////////////////////////////////////// FINANCEIRO 1
		$sql = "select * from orcamento_fp where of_orcamento = '".$orc_nr."' ";
		$sql .= " and of_cliente='".$cliente_codigo."' ";
		$rlt = db_query($sql);
		$fpp1 = array();
		$fpp2 = array();
		$totp = 0;
		$total = 0;
		$xtotal = 0;
		$descp = 0;
		$malet = 0;
//		echo $sql;
		while ($line = db_read($rlt))
			{
			$fpa2 = trim($line['of_tipo']);
			$fpa3 = $line['of_valor'];
			$fpa4 = $line['of_doc'];
			$fpa5 = $line['of_vendedor'];
			$xtotal = $xtotal + $fpa3;
			if ($fpa2 == 'X')
				{ $descp = $descp + $fpa3; } else
				{ 
				if (($fpa2 == 'V') or ($fpa2 == 'W'))
					{ 
					///////////////////////////////// maleta
					$malet = $malet + $fpa3; 
					$tabela = "pedido_consignado";
					$tabela_cr = "contas_representante";
					$tipo_fornece = $fpa2;
					$cliente_codigo_vendedor = $fpa5;
					} 
				if ($fpa2 == 'G')
					{ 
					///////////////////////////////// maleta
					$malet = $malet + $fpa3; 
					$tabela = "pedido_sedex";
					$tabela_cr = "";
					$tipo_fornece = "G";
					} 
					
					if (($fpa2 != 'V') and ($fpa2 != 'G'))
					{ $total = $total + $fpa3; $totp++; }
				}
			}
//////////////////////////////////////////////////// PECAS
	$sql = "select * from orcamento_item ";
	$sql .= "inner join produto on p_codigo = oi_codigo ";
	$sql .= "where oi_orcamento='".$orc_nr."'";
	$rlt = db_query($sql);
	$tot=0;
	$top=0;
	$tov=0;
	$tog=0;
	$pecas = array();
	while ($line = db_read($rlt))
		{
		$qta  = $line['oi_quan'];
		$desc = $line['oi_desconto'];
		$vlr_brt = intval(10*($line['oi_vlr_unit']*(1-$desc/100)))/10;
		$vlr_brt = round(($line['oi_vlr_unit']*100)*(1-$desc/100))/100;
		$xtp = $line['p_unidade'];

		if ($xtp == 'P')
			{
				$cot = $cot + 1;
				$cop = $cop + $qta;
				$cov = $cov + round($vlr_brt * $qta * 100)/100;		
			} else {
				$tot = $tot + 1;
				$top = $top + $qta;
				$tov = $tov + round($vlr_brt * $qta * 100)/100;		
			}		
		}
////////////////////////////////////// verefica diferença
	$dif = $total - $tov - $cov + $descp;
	if ($tipo_fornece == "V") { echo '-xxxxxxxxxxxx-'; $total = $tov; $dif = 0; }
	if ($tipo_fornece == "W") { echo '-xxxxxxxxxxxx-'; $total = $tov; $dif = 0; }
	if ($tipo_fornece == "G") { echo '-xxxxxxxxxxxx-'; $total = $malet; $dif = intval($total - $tov - $cov + $descp); }
	if ($dif == 0) { echo '<BR>financeiro ok'; $ok++;}	
	echo '<BR>Total:'.$total;
	echo '<BR>Maleta:'.$malet;
	echo '<BR>Desconto:'.$descp;
	echo '<BR>Dif:'.$dif;
	echo '<BR>Total:'.$tov;
	echo '<BR>Total peso:'.$cov;
	echo '<HR>';

////////////////////////////////////// gravar pedido
//	if ((($tov > 0) and ($dif == 0)))
	if ($tov + $cov > 0)
		{
//		$sql = "delete from ".$tabela." ";
//		$rlt = db_query($sql);

		$sql = "select * from ".$tabela." where p_orcamento = '".$orc_nr."'; ";
		$rlt = db_query($sql);
		if (!($line = db_read($rlt)))
			{
			$sql = "insert into ".$tabela." (p_local,p_pedido,p_nome,p_itens,";
			$sql .= "p_vendedor,p_valor,p_desconto,p_data, ";
			$sql .= "p_hora,p_log,p_status, ";
			$sql .= "p_lastupdate,p_cliente,p_orcamento) values (";
			$sql .= "'".$local_codigo."','TEMP','".$cliente_nome."',".$qta.",";
			$sql .= "'0000',".$tov.",".$descp.",".date("Ymd").",";
			$sql .= "'".date("H:i")."',".$user_id.",'A',";
			$sql .= date("Ymd").",'".$cliente_codigo."','".$orc_nr."'); ";
			$sql .= "update ".$tabela." set p_pedido=lpad(id_p,7,'0') where p_orcamento = '".$orc_nr."'; ";
			$sql .= "select * from ".$tabela." where p_orcamento = '".$orc_nr."'; ";
			$rlt = db_query($sql);
			$line = db_read($rlt);
			}
		$nr_pedido = $line['p_pedido'];
		echo 'Pedido:'.$nr_pedido;
		}
	
	if (($tov+$cov) > 0) { echo '<BR>peças ok'; $ok++;}			
//////////////////////////////////////////////////// PECAS
	$sql = "select * from orcamento_item ";
	$sql .= "inner join produto on p_codigo = oi_codigo ";
	$sql .= "where oi_orcamento='".$orc_nr."'";
	$rlt = db_query($sql);
//	$tot=0;
//	$top=0;
//	$tov=0;
//	$tog=0;
	$pecas = array();
	$peca_peso = array(array('',0));
	while ($line = db_read($rlt))
		{
		$qta  = $line['oi_quan'];
		$desc = $line['oi_desconto'];
		$vlr_brt = round(10*($line['oi_vlr_unit']*(1-$desc/100)))/10;
		$vlr_brt = ($line['oi_vlr_unit']*(1-$desc/100));
		$xtp = $line['p_unidade'];
		array_push($pecas,array($line['oi_codigo'],$line['oi_quan'],$line['oi_desconto'],$line['oi_vlr_unit'],$line['p_unidade'],$line['oi_vlr_total']));
		$sql1 .= "insert into ".$tabela."_item ( ";
		$sql1 .= "pi_pedido, pi_codigo,pi_vlr_unit,pi_vlr_total, ";
		$sql1 .= "pi_desconto,pi_data,pi_hora, ";
		$sql1 .= "pi_log, pi_status,pi_orcamento, ";
		$sql1 .= "pi_quan) values ('".$nr_pedido."',";
		$sql1 .= "'".$line['oi_codigo']."','".$line['oi_vlr_unit']."','".$line['oi_vlr_total']."',";
		$sql1 .= "'".$line['oi_desconto']."','".date("Ymd")."','".date("H:i")."',";
		$sql1 .= "'".$user_id."','A','".$orc_nr."',";
		$sql1 .= "'".$line['oi_quan']."');".chr(10).chr(13);
		///////////////////////////////////////// pecas peso
		if ($xtp == 'P')
			{
			array_push($peca_peso,array($line['oi_codigo'],$line['oi_quan']));
			}
		////////////////////////////////////////////////////
		$ip = $_SERVER["REMOTE_ADDR"];
		$sinal = ' - ';
		if ($tipo_fornece == "W") { $sinal = '+'; }
		$sql3 .= "update estoque_produto set p_estoque_1 = p_estoque_1 ".$sinal." ".$line['oi_quan']." ";
		if ($tipo_fornece == "V") { $sql3 .= ", p_estoque_2 = p_estoque_2 + ".$line['oi_quan']." "; }
		if ($tipo_fornece == "W") { $sql3 .= ", p_estoque_2 = p_estoque_2 - ".$line['oi_quan']." "; }
		if ($tipo_fornece == "G") { $sql3 .= ", p_estoque_3 = p_estoque_3 + ".$line['oi_quan']." "; }
		$sql3 .= " where p_codigo ='".$line['oi_codigo']."'; " .chr(13);
		
		//// LOG
		$sql3 .= "insert into estoque_log ";
		$sql3 .= "(el_estoque,el_data,el_hora,el_ip, ";
		$sql3 .= "el_user,el_codigo,el_quan,el_pedido,el_status) values ";
		$sql3 .= "(1,'".date("Ymd")."','".date("H:i")."','".$ip."', ";
		$sql3 .= $user_id.",'".$line['oi_codigo']."',".$line['oi_quan'].",'".$nr_pedido."', ";
		$sql3 .= "'".$tipo_fornece."');".chr(13);
		}
////////////////////////////////////////////////////
//////////////////////////////////////////////////// FINANCEIRO 2
		$tipopagar = array();
		$tipodescr = array();
		$sql = "select * from documento_tipo order by dt_descricao";
		$rlt = db_query($sql);
		while ($line = db_read($rlt))
			{
			if (!(in_array($line['dt_codigo'],$tipopagar)))
				{
				array_push($tipopagar,trim($line['dt_codigo']));
				array_push($tipodescr,$line['dt_descricao']);
				}
			}
		$pagar = array();
		$sql = "select * from orcamento_fp ";
		$sql .= "where of_orcamento = '".$orc_nr."' ";
		$sql .= " and of_cliente='".$cliente_codigo."'";
		$rlt = db_query($sql);
		$par = 1;
		while ($line = db_read($rlt))
			{
			////////////// forma de pagamento
			$otp = trim($line['of_tipo']);
			$tp_paga = " (".$otp.")";
			for ($k = 0; $k < count($tipopagar);$k++)
				{
				if ($tipopagar[$k] == $otp) {$tp_paga = trim($tipodescr[$k] . $tp_paga); }
				}
			////////////////////////////// ignorar se for desconto
			if ($otp != "X")
				{
				$par."/".$totp;
				$nrpar = strzero($par,2)."/".strzero($totp,2);
				$par++;	
				} else { 
				$nrpar = "desconto";
				}
			array_push($pagar,array($line['of_venc'],$line['of_valor'],$line['of_tipo'],$line['of_doc']));
			$total = $total + $line['of_valor'];
			if ($otp != "X")
				{
				$sinal2 = '';
				$valor = $line['of_valor'];
				$of_doc = $line['of_doc'];
				$of_des = trim($line['of_descricao']);
				$nome_cl = $cliente_codigo;
				$tp_paga = substr(trim($cliente_nome).' '.$tp_paga,0,80);
				if ($otp == "A") { $tp_paga = $of_des.' (BCO='.substr($of_doc,0,3).'/CHQ '.substr($of_doc,11,6).')'; }
				if ($otp == "1") { $tp_paga = $of_des.' (BCO='.substr($of_doc,0,3).'/CHQ '.substr($of_doc,11,6).')'; }
				if ($otp == "P") { $tp_paga = $of_des.' (BCO='.substr($of_doc,0,3).'/CHQ '.substr($of_doc,11,6).')'; }
				if ($otp == "V") { $cr_conta = '00013'; $nome_cl = $cliente_codigo_vendedor; $valor = $tov; $cliente_codigo = $cliente_codigo_vendedor; }
				if ($otp == "W") { $cr_conta = '00012'; $sinal2 = '-'; $nome_cl = $cliente_codigo_vendedor; $valor = $tov; $cliente_codigo = $cliente_codigo_vendedor; }
				if (strlen($tabela_cr) > 0)
					{
					$vlr_unit = $line['of_valor'];
					if (($otp != "V") and ($otp != "W"))
						{
						$peca_peso = array(array('',0));
						}
					for ($kk=0;$kk < count($peca_peso);$kk++)
						{	
						$cop = $peca_peso[$kk][1];
						$ref = $peca_peso[$kk][0];
						echo '<HR>'.$cop;
						echo '=='.$ref;
						$sql2 .= "insert into ".$tabela_cr." ";
						$sql2 .= "(cr_cliente,cr_valor,cr_venc, ";
						$sql2 .= "cr_tipo,cr_historico,cr_pedido, ";
						$sql2 .= "cr_previsao,cr_parcela,cr_dt_quitacao, ";
						$sql2 .= "cr_status,cr_img,cr_doc,";
						
						$sql2 .= "cr_lastupdate,cr_data,cr_conta, ";
						$sql2 .= "cr_empresa,cr_valor_original,cr_cc ";
						if (($otp == "V") or ($otp == "W")) { $sql2 .= ',cr_peso,cr_ref'; }
						$sql2 .= ") values (";
						
						$sql2 .= "'".$cliente_codigo."',".$valor.",'".$line['of_venc']."', ";
						$sql2 .= "'".$otp."','".$tp_paga."','".$nr_pedido."', ";
						$sql2 .= "1,'".$nrpar."','19000101', ";
						$sql2 .= "'A','','".$orc_nr."', ";
						
						$sql2 .= date("Ymd").",".date("Ymd").",'".$cr_conta."', ";
						$sql2 .= "001,".$vlr_unit.",''";
						if (($otp == "V") or ($otp == "W")) { $sql2 .= ',' . (intval('0'.$cop*100)/100).",'".$ref."' "; }
						$sql2 .= ");".chr(13).chr(10);
						$vlr_unit = 0;
						$valor = 0;
						}
					}
				}
			}
					
			if ($dif != 0)
						{
						echo '<BR><HR>total = '.$total;
						echo '<BR><HR>tov = '.$tov;
						$tabela_cc = 'contas_cliente';
						$sql2 .= "insert into ".$tabela_cc." ";
						$sql2 .= "(cr_cliente,cr_valor,cr_venc, ";
						$sql2 .= "cr_tipo,cr_historico,cr_pedido, ";
						$sql2 .= "cr_previsao,cr_parcela,cr_dt_quitacao, ";
						$sql2 .= "cr_status,cr_img,cr_doc,";
						$sql2 .= "cr_lastupdate,cr_data,cr_conta, ";
						$sql2 .= "cr_empresa,cr_valor_original,cr_cc) values (";
						$sql2 .= "'".$cliente_codigo."','".$dif."','".date("Ymd")."', ";
						$sql2 .= "'A','','".$nr_pedido."', ";
						$sql2 .= "1,'','19000101', ";
						$sql2 .= "'A','','".$orc_nr."', ";
						$sql2 .= date("Ymd").",".date("Ymd").",'', ";
						$sql2 .= "001,".$dif.",'');".chr(13).chr(10);						
						}			
	$dif = $total - $tov;
if ($dif == 0) { echo '<BR>financeiro ok'; $ok++;}	

$sql5 = "update orcamento set o_id=-1 where o_id = ".$pg."; ";

$sql = $sql1 . $sql3 . $sql2 . $sql5;
//echo $sql;
$rlt = db_query($sql);
echo '<BR>==PEDIDO ENCERRADO COM SUCESSO!==';
require('foot.php');	
?>