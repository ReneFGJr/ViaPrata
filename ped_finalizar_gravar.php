<?
if (intval($saldo) == 0)
	{
	echo 'Encerrar pedido !';
	$bbx = 'Finalizar Pedido';
	?>
	<form action="ped_pedido_3.php">
		<input type="submit" name="ddx" value="<?=$bbx;?>">
	</form>
	<?
	if ($vars['ddx'] == $bbx)
		{
		$sql = "update pedido set p_status='C' ";
		$sql .= " where p_orcamento = '".intval(read_cookie("ped3"))."' ";
		$sql .= " or p_orcamento = '".strzero(read_cookie("ped3"),7)."'; ";
		
		$sql .= 'insert into contas_representante (';
	$sql .= "cr_cliente, cr_valor, cr_venc, cr_tipo, ";
	$sql .= "cr_historico, cr_pedido, cr_previsao, ";
	$sql .= "cr_parcela, cr_dt_quitacao, cr_status,";
	$sql .= "cr_img, cr_doc, cr_lastupdate, cr_data, ";
	$sql .= "cr_conta, cr_empresa, cr_valor_original, ";
	$sql .= "cr_cc, cr_peso, cr_ref ";
	$sql .= ') values (';
	$sql .= "'".$dd2."',0".$tot3.",".date("Ymd").",'V',";
	$sql .= "'Pg. Comissão ".$dd1."','".$dd3."',0,";
	$sql .= "'NT',".date("Ymd").",'A',";
	$sql .= "'','".$dd3."',".date("Ymd").",".date("Ymd").",";
	$sql .= "'COM','1',0".$tot3.",";
	$sql .= "'',0,''); ";

	$rlt = db_query($sql);
	redirecina("ped_pedido_3.php");
	exit;
		?>
		<TABLE><TR>
		<TD align="right"><B><?=number_format($tot1,2);?></TD>
		<TD align="right"><B><?=number_format($tot4,2);?></TD>
		<TD align="right"><B>Comissão <?=number_format($tot3,2);?></TD>
		</TR></TABLE>
		<?
		}
	}
?>