<?
			$sta = trim($line['cr_status']);
			$cor = coluna();
			$linkc = '';
			$link = '';
			$link2 = '<A HREF="#" title="==>'.trim($line['cd_destino']).'">';		
			
			if (trim($line['cr_previsao']) == '1') { $cor = 'bgcolor="#ffdfbf"'; }
			if ($sta == 'A')
				{
				$link='<A HREF="#" onclick="newwin('.chr(39).$pg_edit."?dd0=".$line['id_cr']."');".'">';
				$linkc='<A HREF="#" onclick="newwin('.chr(39).$pg_cr_close."?dd0=".$line['id_cr']."');".'">'; 
				$link2 = '';
				}
			if ($sta == 'B')
				{
				$linkc='<A HREF="#" onclick="newwin('.chr(39).'finan_receber_dev.php'."?dd0=".$line['id_cr']."');".'">';
				}
			$linkd='<A HREF="'.$pg.'?dd0='.$line['cr_venc'].'">'; 
			$linkp='';
			if (strlen(trim($line['cr_pedido'])) > 4) { $linkp='<A HREF="#" onclick="newwin('.chr(39).$pg_pedido."?dd0=".trim($line['cr_pedido'])."');".'">'; }
			$ss = $ss .'<TR '.$cor.' class="lt1">';
			$ss = $ss .'<TD align="center">'.$linkd.stodbr($line['cr_venc']).'</TD>';
			$ss = $ss .'<TD align="right"><B>'.$link.Number_format($line['cr_valor'],2).'</TD>';
			$ss = $ss .'<TD>&nbsp;'.$link.$line['cr_historico'];
			$ss = $ss .'<TD align="center">&nbsp;'.$linkp.$line['cr_pedido'];
			$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_parcela'];
			$ss = $ss .'<TD align="center">&nbsp;'.$link2.$line['cr_doc'];
			$ss = $ss .'<TD align="center">&nbsp;'.$linkc.$line['cr_status'];
			$ss = $ss .'</TR>';
			$saldo = $saldo + $line['cr_valor'];
?>