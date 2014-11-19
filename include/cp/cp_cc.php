<?
$tabela = "cc";
$cp = array();
array_push($cp,array('$H4','id_cc','id_bco',False,True,''));
array_push($cp,array('$S40','cc_descricao','Descriчуo',False,True,''));
array_push($cp,array('$S10','cc_agencia','Agencia',False,True,''));
array_push($cp,array('$S15','cc_conta','Conta corrente',False,True,''));
array_push($cp,array('$Q bco_nome:bco_nr:select * from banco order by bco_nome','cc_banco','Nome do banco',False,True,''));
array_push($cp,array('$O 1:SIM&0:NУO','cc_ativo','Ativo',False,True,''));
array_push($cp,array('$H8','cc_codigo','',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>