<?
$tabela = "cheque";
$cp = array();
array_push($cp,array('$H4','id_ch','id_ch',False,True,''));
array_push($cp,array('$S30','ch_nome_cliente','Nome cliente',False,True,''));
array_push($cp,array('$Q bco_nome:bco_nr:select * from banco where bco_ativo=1 order by bco_nome','ch_banco','Banco',False,True,''));
array_push($cp,array('$S6','ch_nr','Nº cheque',False,True,''));
array_push($cp,array('$Q moeda_simbolo:moeda_simbolo:select * from moeda order by moeda_codigo','ch_moeda','Moeda',False,True,''));
array_push($cp,array('$D8','ch_data','Data',False,True,''));
array_push($cp,array('$D8','ch_dt_pre','Data pré',False,True,''));
array_push($cp,array('$D8','ch_dt_deposito','Depositado em',False,True,''));
array_push($cp,array('$S50','ch_titular','Nome titular',False,True,''));
array_push($cp,array('$S20','ch_cpf','CPF/CNPJ',False,True,''));
array_push($cp,array('$Q cs_descricao:cs_codigo:select * from cheque_status where cs_ativo=1 order by cs_descricao','ch_status','Status',False,True,''));
array_push($cp,array('$T60:7','ch_observacao','Observacao',False,True,''));
array_push($cp,array('$S5','ch_deposito_conta','Conta depósito',False,True,''));
array_push($cp,array('$S30','ch_deposito_descricao','Repassado para',False,True,''));
array_push($cp,array('$S8','ch_dig_1','DIGI (8)',False,True,''));
array_push($cp,array('$S10','ch_dig_2','DIGI (10)',False,True,''));
array_push($cp,array('$S12','ch_dig_3','DIGI (12)',False,True,''));
array_push($cp,array('$U8','ch_update','ch_update',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2