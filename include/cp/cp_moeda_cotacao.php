<?

$tabela = "moeda_cotacao";
$cp = array();
array_push($cp,array('$H4','id_mc','id_mc',False,True,''));
array_push($cp,array('$Q moeda_simbolo:moeda_codigo:select * from moeda order by moeda_codigo','mc_moeda','Moeda',False,True,''));
array_push($cp,array('$D8','mc_dt_inicio','Inicio',False,True,''));
array_push($cp,array('$D8','mc_dt_final','final',False,True,''));
array_push($cp,array('$N8','mc_valor','valor',False,True,''));
array_push($cp,array('$U8','mc_lastupdate','mc_lastupdate',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>