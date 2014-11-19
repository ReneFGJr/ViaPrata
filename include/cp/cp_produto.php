<?
$tabela = "produto";
$cp = array();
array_push($cp,array('$H4','id_p','id_p',False,True,''));
array_push($cp,array('$H8','p_cod_int','p_cod_int',False,True,''));
array_push($cp,array('$S15','p_codigo','Codigo produto',True,True,''));
array_push($cp,array('$S100','p_descricao','Descricao',True,True,''));
array_push($cp,array('$Q f_nome:f_codigo:select * from fornecedores where f_ativo=1','p_fornecedor','Fornecedor',False,True,''));
array_push($cp,array('$S15','p_fornecedor_codigo','Cod.fornecedor',False,True,''));
array_push($cp,array('$N8','p_comissao','Comissao',True,True,''));
array_push($cp,array('$N8','p_peso','Peso',True,True,''));
array_push($cp,array('$Q moeda_simbolo:moeda_codigo:select * from moeda order by moeda_codigo ','p_moeda','Moeda',True,True,''));
//array_push($cp,array('$N8','p_margem','margem % ',True,True,''));
array_push($cp,array('$N8','p_preco_sugerido','preco venda',True,True,''));
array_push($cp,array('$N8','p_preco','preco custo',True,True,''));
array_push($cp,array('$U8','p_lastupdate','p_lastupdate',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','p_est_por_quant','Estoque por unidade',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','p_ativo','Ativo',False,True,''));
array_push($cp,array('$S18','p_barcod','Cod.Barras EAN13',False,True,''));
array_push($cp,array('$S37','p_obs','Cj/obs',False,True,''));
array_push($cp,array('$O U:Unidade&P:Peso','p_unidade','Venda tipo',False,True,''));
array_push($cp,array('$S15','p_codigo_old','Código velho',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.4
?>