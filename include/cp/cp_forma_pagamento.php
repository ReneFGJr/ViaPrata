<?
$tabela = "forma_pagamento";
$cp = array();
array_push($cp,array('$H4','id_fp','id_fp',False,True,''));
array_push($cp,array('$S2','fp_cod','Codigo',False,True,''));
array_push($cp,array('$S70','fp_descricao','Descricao',False,True,''));
array_push($cp,array('$N8','fp_desconto','Valor Desconto',False,True,''));
array_push($cp,array('$I8','fp_dias','Dias',False,True,''));
array_push($cp,array('$O D:Dinheiro&C:Cheque&B:Boleto Banc�rio&R:Cart�o de Cr�dito&D:Cart�o de D�bito&V:Vale presente&X:Desconto valor&Y:Desconto percentual','fp_tipo','Tipo',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','fp_ativo','Ativo',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.2
?>