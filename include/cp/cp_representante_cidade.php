<?

$tabela = "representante_cidade";
$cp = array();
array_push($cp,array('$H4','id_rc','id_rc',False,True,''));
array_push($cp,array('$Q cidade:c_codigo:select trim(c_cidade) || chr(32) || chr(40) || c_estado || chr(41) as cidade,c_codigo from cidade order by c_cidade','rc_cidade','Cidade',False,True,''));
array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome_fantasia','rc_vendedor','Vendedor',False,True,''));
array_push($cp,array('$D8','rc_dt_inicio','rc_dt_inicio',False,True,''));
array_push($cp,array('$D8','rc_dt_termino','rc_dt_termino',False,True,''));
array_push($cp,array('$U8','rc_lastupdate','rc_lastupdate',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2

?>