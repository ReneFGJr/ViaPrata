<TABLE width="<?=$tab_max;?>" align="center" border=0>
<TR><TD>
<?

$cp = array();
$tabela = 'contas_cliente';
array_push($cp,array('$H4','id_crp','id_bco',False,True,''));
array_push($cp,array('$H4','cr_fp','Forma Pagamento',True,True,''));
array_push($cp,array('$H4','cr_cliente','Cliente',True,True,''));
array_push($cp,array('$H4','cr_vendedor','Vendedor',True,True,''));
array_push($cp,array('$H4','cr_tipo','Tipo',True,True,''));
array_push($cp,array('$H4','cr_pedido','pedido',True,True,''));
array_push($cp,array('$H4','cr_previsao','previsao',False,True,''));
array_push($cp,array('$H4','cr_parcela','parcela',False,True,''));
array_push($cp,array('$H4','cr_dt_quitacao','parcela',False,True,''));
array_push($cp,array('$H4','cr_status','parcela',False,True,''));
array_push($cp,array('$H4','cr_empresa','parcela',False,True,''));
array_push($cp,array('$U8','cr_lastupdate','parcela',False,True,''));
array_push($cp,array('$U8','cr_data','parcela',False,True,''));
array_push($cp,array('$H8','cr_valor_original','parcela',False,True,''));

array_push($cp,array('$H3','cr_banco','Banco',False,True,''));
array_push($cp,array('$A6','cr_doc','Carteira / Depósito',False,True,''));
array_push($cp,array('$N8','cr_valor','Valor',True,True,''));
array_push($cp,array('$D8','cr_venc','Bom para dia',True,True,''));
array_push($cp,array('$S80','cr_historico','Histórico',True,True,''));

$dd[2] = $dd1;
$dd[3] = $dd2;
$dd[4] = strtoupper($dd[1]);
$dd[5] = strzero($dd3,7);
$dd[6] = 1;
$dd[7] = strzero($par + 1,2);
$dd[8] = 19000101;
$dd[9] = '@';
$dd[10] = 1;
$dd[13] = $dd[16];
$dd[17] = date("d/m/Y");
if (strlen($dd[18]) == 0) { $dd[18] = $dd7.' (careita)'; }
$dd[14]= 'DEP';
$dd[15]= 'CARTEIRA';
//vendedor
//cliente
$saved = editar();

if ($saved > 0)
	{
	$link = "ped_pedido_pagamento.php?dd1=".$dd[1];
	$link .= '&dd14='.$dd[14];
	$link .= '&dd15='.strzero(intval($dd[15])+1,6);
	$link .= '&dd18='.$dd[18];
	redirect($link);
	}
?>
</TD></TR>
</TABLE>