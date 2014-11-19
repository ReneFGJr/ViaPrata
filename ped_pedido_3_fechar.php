<?
if (intval($tot1*10) != 0)
	{
	$ped_nr = strzero($dd3,7);
	$sql = "select * from pedido where p_orcamento = '".$ped_nr."' ";
	$sql .= " and p_cliente = '".$dd1."' ";

	$rlt = db_query($sql);
	$dtped = substr($dd4,6,4).substr($dd4,3,2).substr($dd4,0,2);
	if (!($line = db_read($rlt)))
		{
		$xsql = "insert into pedido ";
		$xsql .= "(p_pedido,p_nome,p_itens,";
		$xsql .= "p_valor,p_desconto,p_data,";
		$xsql .= "p_hora,p_log,p_status,";
		$xsql .= "p_lastupdate,p_cliente,p_orcamento,";
		$xsql .= "p_local,p_vendedor)";
		$xsql .= " values ";
		$xsql .= "('".$ped_nr."','".$dd6."',0,";
		$xsql .= $tot4.",0".$desc.",".$dtped.",";
		$xsql .= "'".date("H:i")."',0".$user_id.",'A',";
		$xsql .= date("Ymd").",'".$dd1."','".$ped_nr."',";
		$xsql .= "'00999','".strzero($dd2,4)."'";
		$xsql .= ")";
		$rlt = db_query($xsql);
		}
	?>
	<TABLE align="center" width="<?=$tab_max;?>">
	<TR><TD colspan="4"><HR></TD></TR>
	<TR>
	<TD><form method="post" action="ped_pedido_pagamento.php">
	<TD><input type="submit" name="acao" value="lançar pagamentos"></TD>
	<TD></form></TD>
	</TR>
	<TR><TD colspan="4"><HR></TD></TR>
	</TABLE>
	<?
	}
?>