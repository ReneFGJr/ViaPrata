<?
$tabela = "documento_tipo";
$cp = array();
array_push($cp,array('$H4','id_dt','id_bco',False,True,''));
array_push($cp,array('$S20','dt_descricao','Nome do documento',False,True,''));
array_push($cp,array('$S3','dt_codigo','Código',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','dt_ativo','Ativo',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','dt_pedido','Ativo (pedido)',False,True,''));
array_push($cp,array('$I3','dt_dias','Dias',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>