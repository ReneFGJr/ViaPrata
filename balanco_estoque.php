<?
require("db.php");
$user_id = $HTTP_COOKIE_VARS['nw_user'];
$user_nome = $HTTP_COOKIE_VARS['nw_user_nome'];
$user_nivel = $HTTP_COOKIE_VARS['nw_nivel'];
$user_log = $HTTP_COOKIE_VARS['nw_log'];
require('include/sisdoc_colunas.php');
require('include/sisdoc_form2.php');
require('include/cp/cp_documento_tipo.php');
require('include/cp2_gravar.php');
if ($user_nivel >= 9)
{
if (strlen($acao) == 0)
	{
	$sql = "select * from produto where id_p = ".sonumero($dd[0]);
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$dd[0] = trim($line['p_codigo']);
		echo '<BR>';
		$sql = "select * from estoque_produto where p_codigo ='".$dd[0]."'";
		$xrlt = db_query($sql);
		if ($Xline = db_read($xrlt))
			{
			$dd[1] = $Xline['p_unidade'];
			$dd[2] = $Xline['p_estoque_1'];
			$dd[3] = $Xline['p_estoque_2'];
			$dd[4] = $Xline['p_estoque_3'];
			$dd[5] = $Xline['p_estoque_4'];
			$dd[6] = $Xline['p_estoque_1'];
			$dd[7] = $Xline['p_estoque_2'];
			$dd[8] = $Xline['p_estoque_3'];
			$dd[9] = $Xline['p_estoque_4'];
			}
		}
	}
	echo 'Cod.Produto:'.$dd[0];
	
	$tabela = "estoque_produto";
	$cp = array();
	if ($dd[1] == 'P')
		{
		array_push($cp,array('$H4','id_p','id_bco',False,True,''));	
		array_push($cp,array('$H8','','',False,False,''));	
		array_push($cp,array('$N4','p_estoque_1','Estoque local',False,True,''));	
		array_push($cp,array('$N4','p_estoque_2','Estoque 2',False,True,''));	
		array_push($cp,array('$N4','p_estoque_3','Estoque 3',False,True,''));	
		array_push($cp,array('$N4','p_estoque_4','Estoque 4',False,True,''));	
		} else {
		array_push($cp,array('$H4','id_p','id_bco',False,True,''));	
		array_push($cp,array('$H8','','',False,False,''));	
		array_push($cp,array('$I4','p_estoque_1','Estoque local',False,True,''));	
		array_push($cp,array('$I4','p_estoque_2','Estoque 2',False,True,''));	
		array_push($cp,array('$I4','p_estoque_3','Estoque 3',False,True,''));	
		array_push($cp,array('$I4','p_estoque_4','Estoque 4',False,True,''));	
		}
		array_push($cp,array('$H4','','',False,False,''));	
		array_push($cp,array('$H4','','',False,False,''));	
		array_push($cp,array('$H4','','',False,False,''));	
		array_push($cp,array('$H4','','',False,False,''));	
		array_push($cp,array('$B8','','',False,False,''));	

	if (strlen($acao) > 0)
		{
		echo "Gravando Acao";
		$sql = "update estoque_produto set ";
		$sql .= "p_estoque_1 = ".$dd[2]." , ";
		$sql .= "p_estoque_2 = ".$dd[3]." , ";
		$sql .= "p_estoque_3 = ".$dd[4]." , ";
		$sql .= "p_estoque_4 = ".$dd[5]."  ";
		$sql = $sql . " where p_codigo ='".$dd[0]."'; " .chr(13);
		echo $sql;
		
		if ($dd[2] != $dd[6]) 
			{
			$ip = $_SERVER["REMOTE_ADDR"];
			$sql .= "insert into estoque_log ";
			$sql .= "(el_estoque,el_data,el_hora,el_ip,";
			$sql .= "el_user,el_codigo,el_quan,el_pedido,el_status) values ";
			$sql .= "(1,'".date("Ymd")."','".date("H:i")."','".$ip."',";
			$sql .= $user_id.",'".$dd[0]."',".($dd[2]-$dd[6]).",'',";
			$sql .= "'J');".chr(13);
			}
		if ($dd[3] != $dd[7]) 
			{
			$ip = $_SERVER["REMOTE_ADDR"];
			$sql .= "insert into estoque_log ";
			$sql .= "(el_estoque,el_data,el_hora,el_ip,";
			$sql .= "el_user,el_codigo,el_quan,el_pedido,el_status) values ";
			$sql .= "(2,'".date("Ymd")."','".date("H:i")."','".$ip."',";
			$sql .= $user_id.",'".$dd[0]."',".($dd[3]-$dd[7]).",'',";
			$sql .= "'J');".chr(13);
			}
		if ($dd[4] != $dd[8]) 
			{
			$ip = $_SERVER["REMOTE_ADDR"];
			$sql .= "insert into estoque_log ";
			$sql .= "(el_estoque,el_data,el_hora,el_ip,";
			$sql .= "el_user,el_codigo,el_quan,el_pedido,el_status) values ";
			$sql .= "(3,'".date("Ymd")."','".date("H:i")."','".$ip."',";
			$sql .= $user_id.",'".$dd[0]."',".($dd[4]-$dd[8]).",'',";
			$sql .= "'J');".chr(13);
			}
		if ($dd[5] != $dd[9]) 
			{
			$ip = $_SERVER["REMOTE_ADDR"];
			$sql .= "insert into estoque_log ";
			$sql .= "(el_estoque,el_data,el_hora,el_ip,";
			$sql .= "el_user,el_codigo,el_quan,el_pedido,el_status) values ";
			$sql .= "(4,'".date("Ymd")."','".date("H:i")."','".$ip."',";
			$sql .= $user_id.",'".$dd[0]."',".($dd[5]-$dd[9]).",'',";
			$sql .= "'J');".chr(13);
			}			
			$rlt = db_query($sql);
			?>
			<script>
				close();
			</script>
			<?
		}
	?><TABLE width="100%" align="center">
	<TR><TD><form method="post" action="balanco_estoque.php"><?
	echo gets_fld();
	?></TD></TR><TR><TD></form></TD></TR></TABLE><?	
}


?>