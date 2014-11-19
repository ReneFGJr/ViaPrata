<?
$tabela = "";
$cp = array();
$vend = ' : ';

$sql = "select vd_nome,* from vendedores where id_vd <> 20 and vd_ativo=1 order by vd_nome ";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	if (strlen($vend) > 0)
		{ $vend .= '&'; }
	$vend .= $line['vd_codigo'].':';
	$vend .= trim($line['vd_nome']).'';
	}

array_push($cp,array('$H8','id_vpped','id_vpped',False,True,''));
array_push($cp,array('$D8','vpped_data','Data',True,True,''));
array_push($cp,array('$O '.$vend,'vpped_fornecedor','Retirar de',False,True,''));
array_push($cp,array('$N8','vpped_quantidade','Quantidade',True,True,''));
array_push($cp,array('$H5','vpped_pedido','Pedido',False,True,''));
array_push($cp,array('$Q es_descricao:es_ref:select * from vp_estoque where es_ativo = 1 order by es_descricao','vpped_ref','Ref.',False,True,''));
array_push($cp,array('$N5','vpped_unitario','Vlr.Unitário',False,True,''));
array_push($cp,array('$H60','vpped_log','vpped_pedido',False,True,''));
array_push($cp,array('$H60','vpped_vendedor','vpped_pedido',False,True,''));
array_push($cp,array('$H60','vpped_dc','vpped_pedido',False,True,''));
array_push($cp,array('$H60','vpped_historico','vpped_pedido',False,True,''));
array_push($cp,array('$H60','vpped_doc','vpped_pedido',False,True,''));
array_push($cp,array('$H60','vpped_tipo','vpped_pedido',False,True,''));
array_push($cp,array('$O :Não&1:Sim','','Gravar',True,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.4

if (strlen($dd[6])==0) { $dd[6] = '1.00'; }
?>