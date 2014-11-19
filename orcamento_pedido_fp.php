<?
//if (($dif != 0) and ($tov > 0)) {
if (($tov + +$cov)> 0) 
{
$cp = '';
for ($x=0;$x <= count($menu); $x++)
	{
	if ($menu[$x][1]==$dd[1])
		{
		$tp = $menu[$x][3];
		$fpaga = $menu[$x][1];
		$dias = $menu[$x][4];
		$cp = array();		
		array_push($cp,array('$H4','','',False,False,''));
		array_push($cp,array('$H4','','',False,False,''));

		if ($tp == 'X')
		{
			array_push($cp,array('$H4','id_d','id_feira',False,True,''));
			array_push($cp,array('$H8','_cod','Tipo',False,True,''));
			array_push($cp,array('$H8','_cod','Vencimento',True,True,''));
			array_push($cp,array('$H8','_cod','nº cheque',False,True,''));
			array_push($cp,array('$S80','d_descricao','Descricao',False,True,''));
			array_push($cp,array('$N8','d_valor','Valor',True,True,''));
			array_push($cp,array('$B8','','Gravar',False,True,''));
			$dd[4] = date("d/m/Y");
			$dd[5] = "DESCONTO";
		}
		///////////////////////////////////////////////////////////////////
		if (($tp == 'P') or ($tp == 'A'))
		{
			array_push($cp,array('$H4','id_d','id_feira',False,True,''));
			array_push($cp,array('$H8','_cod','Tipo',False,True,''));
			array_push($cp,array('$D8','_cod','Vencimento',True,True,''));
			array_push($cp,array('$H30','_cod','nº cheque',False,True,''));
			array_push($cp,array('$S70','d_descricao','CPF (Titular)/Nome',True,True,''));
			array_push($cp,array('$N8','d_valor','Valor',True,True,''));
			array_push($cp,array('$S3','','Banco',True,True,''));
			array_push($cp,array('$S6','','Nº cheque',True,True,''));
			array_push($cp,array('$B8','','Gravar',False,True,''));
			$dd[5] = $dd[8].'0000000'.$dd[9];
		}
		if ($tp == 'B')
		{
			array_push($cp,array('$H4','id_d','id_feira',False,True,''));
			array_push($cp,array('$H8','_cod','Tipo',False,True,''));
			array_push($cp,array('$D8','_cod','Vencimento',True,True,''));
			array_push($cp,array('$S30','_cod','Nosso numero',False,True,''));
			array_push($cp,array('$H8','d_descricao','Descricao',False,True,''));
			array_push($cp,array('$N8','d_valor','Valor',True,True,''));
			array_push($cp,array('$B8','','Gravar',False,True,''));
			$dd[6] = "Boleto Bancário";
		}		
		if ($tp == '8')
		{
			array_push($cp,array('$H4','id_d','id_feira',False,True,''));
			array_push($cp,array('$H8','_cod','Tipo',False,True,''));
			array_push($cp,array('$H8','_cod','Vencimento',False,True,''));
			array_push($cp,array('$H8','_cod','Observação',False,True,''));
			array_push($cp,array('$S70','d_descricao','Observação',False,True,''));
			array_push($cp,array('$N8','d_valor','Valor',True,True,''));
			array_push($cp,array('$B8','','Gravar',False,True,''));
		}		
		if ($tp == 'V')
		{
			array_push($cp,array('$H4','id_d','id_feira',False,True,''));
			array_push($cp,array('$H8','_cod','Tipo',False,True,''));
			array_push($cp,array('$H8','_cod','Vencimento',False,True,''));
			array_push($cp,array('$H8','_cod','Observação',False,True,''));
			array_push($cp,array('$S70','d_descricao','Observação',False,True,''));
			array_push($cp,array('$N8','d_valor','Valor',True,True,''));
			array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','_cod','Observação',False,True,''));
			array_push($cp,array('$B8','','Gravar',False,True,''));
			$dd[6] = "Maleta ".date("d/m/Y");
			$dd[7] = troca(number_format($tov+$cov,2),',','');
		}
		if ($tp == 'W')
		{
			array_push($cp,array('$H4','id_d','id_feira',False,True,''));
			array_push($cp,array('$H8','_cod','Tipo',False,True,''));
			array_push($cp,array('$H8','_cod','Vencimento',False,True,''));
			array_push($cp,array('$H8','_cod','Observação',False,True,''));
			array_push($cp,array('$S70','d_descricao','Observação',False,True,''));
			array_push($cp,array('$N8','d_valor','Valor',True,True,''));
			array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','_cod','Observação',False,True,''));
			array_push($cp,array('$B8','','Gravar',False,True,''));
			$dd[6] = "Maleta ".date("d/m/Y");
			$dd[7] = troca(number_format($tov+$cov,2),',','');
		}		
		if ($tp == 'G')
		{
			array_push($cp,array('$H4','id_d','id_feira',False,True,''));
			array_push($cp,array('$H8','_cod','Tipo',False,True,''));
			array_push($cp,array('$D8','_cod','Devolução Sedex',False,True,''));
			array_push($cp,array('$H8','_cod','Observação',False,True,''));
			array_push($cp,array('$S70','d_descricao','Observação',False,True,''));
			array_push($cp,array('$N8','d_valor','Valor',True,True,''));
			array_push($cp,array('$B8','','Gravar',False,True,''));
			$dd[6] = "Sedex:".$cliente_nome;
			$dd[7] = troca(number_format($tov+$cov,2),',','');
		}
		}
	}
	
if ($acao == 'gravar')
	{
	$ok=1;
	for ($k=0;$k < count($cp);$k++)
		{
		if (($cp[$k][3]==True) and (strlen($dd[$k]) ==0) or (round("0".$dd[7]) < 0)) {$ok = 0; }
		}
	if ($ok == 1)
		{
		$sql = "select * from orcamento_fp where of_orcamento = '".$orc_nr."' and ";
		$sql .= "of_valor = ".$dd[7]." and ";
		$sql .= "of_venc = ".brtos($dd[4]). " and ";
		$sql .= "of_doc = '".$dd[5]."'";
		$rrv = db_query($sql);
		if (!($line = db_read($rrv)))
			{
			$vendedor = $user_id;
			if (strlen($dd[8]) > 0) { $vendedor = $dd[8]; }
			$sql = "insert into orcamento_fp ";
			$sql .= "(of_orcamento,of_valor,of_data,";
			$sql .= "of_hora,of_venc,of_vendedor,";
			$sql .= "of_status,of_cliente,of_descricao,";
			$sql .= "of_doc,of_tipo) values (";
			$sql .= "'".$orc_nr."','".$dd[7]."','".date("Ymd")."',";
			$sql .= "'".date("H:i")."','".brtos($dd[4])."','".$vendedor."',";
			$sql .= "'A','".$cliente_codigo."','".$dd[6]."',";
			$sql .= "'".$dd[5]."','".$tp."');";
			$rrv = db_query($sql);
			redirect($http_redirect);
			}
		}
	}
if (count($cp) > 2)
	{
	if (strlen($dd[7]) ==0) { $dd[7] = '0.00'; }
	if (strlen($dd[4]) ==0) { $dd[4] = stodbr(DateAdd('d',$dias,date("Ymd"))); }
	echo '<TABLE border="12"><TR><TD>Descrição do pagamento';
	echo '<BR><B>'.$fpaga."</B>";
	echo '<FORM method="post">';
	echo gets_fld();
	echo '</FORM>';
	echo '</TABLE>';
	}
}
?>