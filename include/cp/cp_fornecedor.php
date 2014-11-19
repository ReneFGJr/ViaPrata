<?
$tabela = "fornecedores";
$cp = array();
array_push($cp,array('$H4','id_f','id_f',False,True,''));
array_push($cp,array('$H5','f_codigo','f_codigo',False,True,''));
array_push($cp,array('$A1','','Dados do fornecedor',False,True,''));
array_push($cp,array('$S100','f_nome','Nome',True,True,''));
array_push($cp,array('$S100','f_razao_social','Razao social',False,True,''));
array_push($cp,array('$O J:Juridica&F:Fisica','f_tipo','Tipo',False,True,''));
array_push($cp,array('$S20','f_cnpj','Cnpj/cpf',False,True,''));
array_push($cp,array('$S15','f_ie','ie/rg',False,True,''));
array_push($cp,array('$A','','Endereço',False,True,''));
array_push($cp,array('$S100','f_endereco','Endereco',False,True,''));
array_push($cp,array('$S20','f_bairro','Bairro',False,True,''));
array_push($cp,array('$Q cidade:c_codigo:select trim(c_cidade) || chr(32) || chr(40) || c_estado || chr(41) as cidade,c_codigo from cidade order by c_cidade','f_cidade','Cidade',False,True,''));
array_push($cp,array('$S10','f_cep','cep',False,True,''));
array_push($cp,array('$A','','Contato',False,True,''));
array_push($cp,array('$S100','f_contato','Contato',False,True,''));
array_push($cp,array('$S100','f_email','e-mail',False,True,''));
array_push($cp,array('$S15','f_telefone','telefone',False,True,''));
array_push($cp,array('$S15','f_fax','fax',False,True,''));
array_push($cp,array('$S15','f_celular','celular',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','f_ativo','Ativo',False,True,''));
array_push($cp,array('$A','','Dados bancários',False,True,''));
array_push($cp,array('$S5','f_conta_corrente','Conta corrente',False,True,''));
array_push($cp,array('$T60:7','f_obs','Observacao',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.4
?>