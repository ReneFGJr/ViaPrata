<?

$tabela = "feira_edicoes";
$cp = array();
array_push($cp,array('$H4','id_fe','id_fe',False,True,''));
array_push($cp,array('$Q feira_nome:feira_codigo:select * from feira where feira_ativo=1 order by feira_nome','fe_feira','Nome da feira',False,True,''));
array_push($cp,array('$S20','fe_edicao','Edicao',False,True,''));
array_push($cp,array('$D8','fe_dt_inicio','Inicio',False,True,''));
array_push($cp,array('$D8','fe_dr_final','Final',False,True,''));
array_push($cp,array('$S20','fe_local','Local',False,True,''));
array_push($cp,array('$U8','fe_dt_cadastro','fe_dt_cadastro',False,True,''));
array_push($cp,array('$Q cidade:c_codigo:select trim(c_cidade) || chr(32) || chr(40) || c_estado || chr(41) as cidade,c_codigo from cidade order by c_cidade','fe_cidade','Cidade',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>