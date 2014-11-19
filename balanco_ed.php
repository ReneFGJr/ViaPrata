<?
require("db.php");
	$tab_max = 350;
	$sql = "select * from balanco_item ";
	$sql .= " inner join produto on oi_codigo = p_codigo ";
	$sql .= "where oi_id = ".$dd[0];
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$cod = $line['oi_codigo'];
		$tp = $line['p_unidade'];
		}
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	$tabela = "balanco_item";
	$cp = array();
	array_push($cp,array('$H4','oi_id','id_oi',False,True,''));
	if ($tp == 'P')
		{ array_push($cp,array('$N8','oi_quan','quantidade',False,True,'')); } else
		{ array_push($cp,array('$I8','oi_quan','quantidade',False,True,'')); } 
	array_push($cp,array('$H8','oi_vlr_unit','unitário',False,True,''));
	require('include/cp2_gravar.php');
	$http_edit = 'balanco_ed.php';
	$http_redirect = 'close.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
?>