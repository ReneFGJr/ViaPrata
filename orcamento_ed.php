<?
require("db.php");
	$tab_max = 350;

	$sql = "select * from orcamento_item ";
	$sql .= " inner join produto on oi_codigo = p_codigo ";
	$sql .= "where oi_id = ".$dd[0];
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$cod  = $line['oi_codigo'];
		$tp   = $line['p_unidade'];
		if (strlen($acao) == 0)
			{
				$dd[1] = $line['oi_quan'];
				if ($tp == 'P')
					{ 
					$dd[1] = number_format($line['oi_quan'],2);
					$dd[1] = troca($dd[1],',','');
					}
				$dd[2] = $line['oi_vlr_unit'];
				$dd[3] = $line['oi_vlr_total'];
				$dd[4] = $line['oi_desconto'];
				$dd[5] = number_format($line['oi_vlr_unit']*(100-$line['oi_desconto'])/100,2);
				$dd[5] = troca($dd[5],',','');
			} else {
				if ($dd[5] > 0)
					{
					$vlu = $line['oi_vlr_unit']*100; // valor unitario
					$vld = ($dd[5]*100);
					echo $dd[5].'==='.$vld.'===';
					$dd[5] = 100-intval(($vld/$vlu)*10000)/100;
					echo '<BR>'.$vlu;
					echo '<BR>'.$vld/$vld;
					echo '<BR>'.$dd[5];
					$dd[4] = $dd[5];
					}
				$sql = "update orcamento_item set ";
				$sql .= " oi_quan = ".$dd[1];
				$sql .= ", oi_desconto = ".$dd[4];
				$sql .= " where oi_id = ".$dd[0];
				echo $sql;
				echo 'ACAO';
				$rlt = db_query($sql);
				?><script>close();</script><?
				exit;
			}
		}
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	$tabela = "orcamento_item";
	$cp = array();
	
	array_push($cp,array('$H4','oi_id','id_oi',False,True,''));
	if ($tp == 'P')
		{ array_push($cp,array('$N8','oi_quan','quantidade',False,True,'')); } else
		{ array_push($cp,array('$I8','oi_quan','quantidade',False,True,'')); } 
	array_push($cp,array('$H8','oi_vlr_unit','unitário',False,True,''));
	array_push($cp,array('$H8','oi_vlr_total','total',False,True,''));
	array_push($cp,array('$N4','oi_desconto','Desconto (%)',False,True,''));
	array_push($cp,array('$N8','oi_desconto','Valor peça',False,True,''));
	array_push($cp,array('$B8','','gravar',False,False,''));	
	$dd[3] = $dd[2] * $dd[1];
//	array_push($cp,array('$N8','oi_quan','quantidade',False,True,''));
	require('include/cp2_gravar.php');
	$http_edit = 'orcamento_ed.php';
	$http_redirect = 'close.php';
	///////////////////////////////
	echo '<form method="post" ';
	if (strlen($pagina_form) > 0) { echo 'action="'.$http_edit.$http_edit_para.'"'; }
	echo ' >';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo gets_fld();
	?></TD></TR></TABLE><?	
	echo '</form>';
?>