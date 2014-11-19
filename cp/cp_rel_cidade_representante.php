<?
$tabela = "";
$cp = array();
$vend = '';

array_push($cp,array('$H8','','id_vpped',False,True,''));

array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','','Representante',False,True,''));

array_push($cp,array('$C1','','SIM, Filtrar pedidos',False,True,''));
array_push($cp,array('$D8','','Pedidos de',False,True,''));
array_push($cp,array('$D8','','Até',False,True,''));

if (strlen($dd[2]) ==0)
	{ $dd[2] == '01/01/'.date("Y"); }
if (strlen($dd[3]) ==0)
	{ $dd[3] == date("d/m/Y"); }
/// Gerado pelo sistem "base.php" versao 1.0.4
?>