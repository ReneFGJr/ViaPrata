<?
$tabela = "clientes";
$cp = array();
array_push($cp,array('$H4','id_cliente','id_cliente',False,True,''));
array_push($cp,array('$S4','cliente_codigo','Número',False,True,''));
array_push($cp,array('$A','','Identificação do cliente',False,True,''));
array_push($cp,array('$S100','cliente_nome','Nome',False,True,''));
array_push($cp,array('$S100','cliente_nome_fantasia','Nome fantasia',False,True,''));
array_push($cp,array('$S100','cliente_razao_social','Razao social',False,True,''));
array_push($cp,array('$O : &J:Pessoa Jurídica&F:Pessoa Física','cliente_tipo_pessoa','Tipo pessoa',False,True,''));
array_push($cp,array('$S22','cliente_cpf_cnpj','CPF/CNPJ',False,True,''));
array_push($cp,array('$S20','cliente_rg_inscr_estadual','RG/IE',False,True,''));
array_push($cp,array('$A','','Localização',False,True,''));
array_push($cp,array('$S60','cliente_endereco','Endereco',False,True,''));
array_push($cp,array('$S20','cliente_bairro','Bairro',False,True,''));
array_push($cp,array('$S20','cliente_cidade','Cidade',False,True,''));
array_push($cp,array('$UF','cliente_estado','Estado',False,True,''));
array_push($cp,array('$I8','cliente_cep','CEP',False,True,''));
array_push($cp,array('$A','','Contato',False,True,''));
array_push($cp,array('$S80','cliente_email_geral','e-mail',False,True,''));
array_push($cp,array('$S15','cliente_telefone','Telefone',False,True,''));
array_push($cp,array('$S20','cliente_celular','Celular',False,True,''));
array_push($cp,array('$S20','cliente_fax','Fax',False,True,''));
//array_push($cp,array('$H8','cliente_id_conta_corrente','Conta corrente',False,True,''));
array_push($cp,array('$A','','Outras informações',False,True,''));
array_push($cp,array('$O S:Sim&N:Não','cliente_ativo','Cliente ativo',False,True,''));
array_push($cp,array('$O N:Não&S:Sim','cliente_vip','Cliente VIP',False,True,''));
array_push($cp,array('$O N:Não&S:Sim','cliente_inadimplente','Cliente inadimplente',False,True,''));
array_push($cp,array('$T60:7','cliente_observacoes','Observações',False,True,''));
array_push($cp,array('$U8','cliente_dt_cadastro','cliente_dt_cadastro',False,True,''));
array_push($cp,array('$U8','cliente_id_logon_cadastro','cliente_id_logon_cadastro',False,False,''));
array_push($cp,array('$U8','cliente_lastupdate','cliente_lastupdate',False,False,''));
array_push($cp,array('$A','','Representante',False,True,''));
array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','cliente_id_vendedor','Representante',False,True,''));
array_push($cp,array('$S','cliente_id_moeda_limite','Limite de compra',False,True,''));
array_push($cp,array('$O R$:R$&Ag:Ag&Au:Au&US:US','cliente_id_moeda_potencial','Moeda limite',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>