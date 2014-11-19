<?
require("db.php");
$nrr=$dd[51];
$sql = "select * from pedido where p_orcamento = 'F".$nrr."' ";
$rlt = db_query($sql);
if (($line = db_read($rlt)))
	{
	echo '<FONT COLOR="GREEN">X>></FONT>';
	$nr_ped = $line['p_pedido'];
	echo $nr_ped;
	}

/////////////////////////////////////////////////////////////////////////
if ($dd[50] == 'FPG')
	{
	if (strlen($dd[0]) == 7)
		{
			$sql = "select * from orcamento_fp_feira where of_orcamento = '".$dd[1]."' ";
			$sql .= " and (of_valor = '".$dd[2]."') and (of_descricao = '".$dd[10]."') ";
			$sql .= " and (of_venc = '".$dd[5]."') and (of_cliente = '".$dd[8]."') ";
			$rlt = db_query($sql);
			$par = 1;
			if (!($line = db_read($rlt)))
				{
					$sql = "insert into orcamento_fp_feira ";
					$sql .= "(of_orcamento,of_valor,of_data,";
					$sql .= "of_hora,of_venc,of_vendedor,";
					$sql .= "of_status,of_cliente,of_tipo,";
					$sql .= "of_descricao,of_doc";
					$sql .= ") values (";
					$sql .= "'".$dd[1]."','".$dd[2]."','".$dd[3]."',";
					$sql .= "'".$dd[4]."','".$dd[5]."','".$dd[6]."',";
					$sql .= "'".$dd[7]."','".$dd[8]."','".$dd[9]."',";
					$sql .= "'".$dd[10]."','".$dd[11]."'";
					$sql .= ");";
					$rlt = db_query($sql);
				}
			$sql = "select * from contas_receber where cr_pedido = '".$nr_ped."' ";
			$sql .= " and (cr_valor = '".$dd[2]."') and (cr_historico = '".$dd[10]."') ";
			$sql .= " and (cr_venc = '".$dd[3]."') and (cr_cliente = '".$dd[8]."') ";
			$rlt = db_query($sql);
			$par = 1;
			if (!($line = db_read($rlt)))
					{
					$pad = $par++;
					$sql = "insert into contas_receber ";
					$sql .= "(cr_cliente,cr_valor,cr_venc, ";
					$sql .= "cr_tipo,cr_historico,cr_pedido,";
					$sql .= "cr_previsao,cr_parcela,cr_dt_quitacao,";
					$sql .= "cr_status,cr_img,cr_doc,";
					$sql .= "cr_lastupdate,cr_data,cr_conta,";
					$sql .= "cr_empresa,cr_valor_original,cr_cc";
					$sql .= ") values (";
					$sql .= "'".$dd[8]."','".$dd[2]."','".$dd[3]."',";
					$sql .= "'".$dd[9]."','".$dd[10]."','".$nr_ped."',";
					$sql .= "'1','".$pad."','19000101',";
					$sql .= "'A','','".$dd[11]."',";
					$sql .= date("Ymd").",'".$dd[3]."','',";
					$sql .= "'1','".$dd[2]."','')";
					$rlt = db_query($sql);
					echo "STA20-OK";
				} else {
					echo "ERR22-Item Pedido já exportado";
				}
			
		} else {
			echo 'ERR01-Nº do pedido não informado';
		}
	}
/////////////////////////////////////////////////////////////////////////
if ($dd[50] == 'PEI')
	{
	if (strlen($dd[0]) == 7)
		{
			$sql = "select * from pedido_feira_item where pi_pedido = '".$dd[51]."' ";
			$sql .= " and (pi_codigo = '".$dd[1]."') and (pi_quan = '".$dd[2]."') ";
			$rlt = db_query($sql);
			if (!($line = db_read($rlt)))
				{
					$sql = "insert into pedido_feira_item ";
					$sql .= "(pi_pedido,pi_codigo,pi_quan,";
					$sql .= "pi_vlr_unit,pi_vlr_total,pi_desconto,";
					$sql .= "pi_data,pi_hora,pi_log,";
					$sql .= "pi_status";
					$sql .= ") values (";
					$sql .= "'".$dd[51]."','".$dd[1]."','".$dd[2]."',";
					$sql .= "'".$dd[3]."','".$dd[4]."','".$dd[5]."',";
					$sql .= "'".$dd[6]."','".$dd[7]."','".$dd[8]."',";
					$sql .= "'".$dd[9]."'";
					$sql .= ");";
					$rlt = db_query($sql);
					echo "STA10-OK";
				} else {
					echo "ERR12-Item Pedido já exportado";
				}
				
			$sql = "select * from pedido_item where pi_pedido = '".$nr_ped."' ";
			$sql .= " and (pi_codigo = '".$dd[1]."') and (pi_quan = '".$dd[2]."') ";

			$rlt = db_query($sql);
			if (!($line = db_read($rlt)))
				{
					$sql = "insert into pedido_item ";
					$sql .= "(pi_pedido,pi_codigo,pi_quan,";
					$sql .= "pi_vlr_unit,pi_vlr_total,pi_desconto,";
					$sql .= "pi_data,pi_hora,pi_log,";
					$sql .= "pi_status";
					$sql .= ") values (";
					$sql .= "'".$nr_ped."','".$dd[1]."','".$dd[2]."',";
					$sql .= "'".$dd[3]."','".$dd[4]."','".$dd[5]."',";
					$sql .= "'".$dd[6]."','".$dd[7]."','".$dd[8]."',";
					$sql .= "'".$dd[9]."'";
					$sql .= ");";
					$rlt = db_query($sql);
					echo "STA80-OK";
				} else {
					echo "ERR82-Item Pedido já exportado";
				}				
			
		} else {
			echo 'ERR01-Nº do pedido não informado';
		}
	}
	
/////////////////////////////////////////////////////////////////////////
if ($dd[50] == 'PED')
	{
	if (strlen($dd[0]) == 7)
		{
			$ok = 0;
			$sql = "select * from pedido where p_orcamento = 'F".$dd[51]."' ";
			$rlt = db_query($sql);
			if (!($line = db_read($rlt)))
				{
					$xsql = "insert into pedido ";
					$xsql .= "(p_pedido,p_nome,p_itens,";
					$xsql .= "p_valor,p_desconto,p_data,";
					$xsql .= "p_hora,p_vendedor,p_status,";
					$xsql .= "p_lastupdate,p_cliente,p_orcamento,";
					$xsql .= "p_local";
					$xsql .= ") values (";
					$xsql .= "'','".$dd[12]."','".$dd[7]."',";
					$xsql .= "'".$dd[8]."','".$dd[9]."','".$dd[2]."',";
					$xsql .= "'".$dd[3]."','".$dd[4]."','".$dd[13]."',";
					$xsql .= "'".date("Ymd")."','".strzero($dd[1],7)."','F".$dd[51]."',";
					$xsql .= "'".$dd[11]."'";
					$xsql .= ");";
					$rlt = db_query($xsql);
					echo "STA90-OK";
					$xsql = "update pedido set p_pedido = lpad(id_p,7,0) where length(p_pedido) < 4";
					$rlt = db_query($xsql);
				}

			$sql = "select * from pedido_feira where p_pedido = '".$dd[51]."' ";
			$rlt = db_query($sql);
			if (!($line = db_read($rlt)))
				{
					$sql = "insert into pedido_feira ";
					$sql .= "(p_pedido,p_nome,p_itens,";
					$sql .= "p_valor,p_desconto,p_data,";
					$sql .= "p_hora,p_vendedor,p_status,";
					$sql .= "p_lastupdate,p_cliente,p_local";
					$sql .= ") values (";
					$sql .= "'".$dd[51]."','".$dd[12]."','".$dd[7]."',";
					$sql .= "'".$dd[8]."','".$dd[9]."','".$dd[2]."',";
					$sql .= "'".$dd[3]."','".$dd[4]."','".$dd[13]."',";
					$sql .= "'".date("Ymd")."','".strzero($dd[1],7)."','".$dd[11]."'";
					$sql .= ");";
					$rlt = db_query($sql);
					echo "STA00-OK";
				} else {
					echo "ERR02-Pedido já exportado";
				}
			
		} else {
			echo 'ERR01-Nº do pedido não informado';
		}
	}
?>