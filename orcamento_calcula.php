<?
	$sql = "select * from orcamento_item ";
	$sql .= " inner join produto on p_codigo = oi_codigo ";
	$sql .= " where oi_orcamento='".$orc_nr."'";
	$sql .= " order by p_codigo ";
	$rlt = db_query($sql);
	$si = '<TABLE width="'.($tab_max-200).'" class="lt1">';
	$si .= '<TR align="center" bgcolor="#c0c0c0"><TD width="5%"><B>c�digo</B></TD>';
	$si .= '<td><b>descri��o</b></td>';
	$si .= '<td><b>quant</b></td>';
	$si .= '<td><b>vlr.unit�rio</b></td>';
	$si .= '<td><b>vlr.total</b></td>';
	$si .= '<td><b>a��o</b></td>';
	$si .= '<td><b>DP</b></td>';
	$si .= '</TR>';
	$tot = 0;
	$tov = 0;
	$top = 0;

	$cot = 0;
	$cov = 0;
	$cop = 0;
	if (strlen($pdv_cartao) == 0) { $pdv_cartao = 1; }
	while ($line = db_read($rlt))
		{
		$qta  = $line['oi_quan'];
		$desc = $line['oi_desconto'];
		$unidade = $line['p_unidade'];
		$vlr_uni = intval(10*($line['oi_vlr_unit']*$pdv_cartao*(1-$desc/100)))/10;
		$vlr_brt = round(($line['oi_vlr_unit']*100)*(1-$desc/100))/100;
		$vlr_brt = intval($pdv_cartao*$vlr_brt*10)/10;
		$xtp = $line['p_unidade'];
		$link = '<A HREF="#" onclick="newxy('."'orcamento_ed.php?dd0=".$line['oi_id'].'&dd1='.trim($line['oi_codigo'])."',400,150);".chr(34).'>';
		$si .= '<TR '.coluna().'>';
		$si .= '<td>';
		$si .= $line['oi_codigo'];
		$si .= '<td>';
		$si .= $line['p_descricao'];
		$si .= '<td align="right">';
		$si .= $link;
		if ($xtp == 'P')
			{
			$si .= number_format($line['oi_quan'],1);
			} else {
			$si .= number_format($line['oi_quan'],0);
			}
		$si .= '<td align="right">';
		if ($desc > 0)
			{
				$si .= '<S>'.number_format($vlr_uni,2);
				$si .= '</S> por ';
				$si .= ' '.number_format($vlr_brt,2);
			} else {
				$si .= number_format($vlr_uni,2);
			}
//		$si .= '<td align="right"><B>';
//		$si .= number_format($vlr_brt,2);
		$si .= '<td align="right">';
		$si .= number_format($vlr_brt * $qta,2);
		$si .= '<td align="center">';
		if ($xtp != 'P') { $si .= '<A HREF="orcamento.php?dd1='.$line['oi_id'].'&dd2='.trim($line['oi_codigo']).'&dd3=-1&dd4=DEL">(-1)</A>'; }
		$si .= '&nbsp;<A HREF="orcamento.php?dd1='.$line['oi_id'].'&dd2='.trim($line['oi_codigo']).'&dd3=-'.$line['oi_quan'].'&dd4=DEL">(EXLUIR)</A>';
		if ($xtp != 'P') { $si .= '&nbsp;<A HREF="orcamento.php?dd1='.$line['oi_id'].'&dd2='.trim($line['oi_codigo']).'&dd3=+1&dd4=DEL">(+1)</A>'; }
		$si .= '<td align="center">';
		$si .= $link;
		if ($desc > 0) { $si .= $desc.'%'; }

		$si .= $xpt;
		if ($unidade == 'P')
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
	$si .= '</TABLE>';
	$total_pedido = $tov + $cov;
?>