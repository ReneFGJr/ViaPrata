<?
require("cab.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");


///////////////////////////////////////////////////////////// phase I
if (strlen($dd[1]) == 0) 
	{
	redirect("orcamento_sedex.php?dd0=".$dd[0]);
	}

///////////////////////////////////////////////////////////// phase II
$sql = "select * from pedido_sedex where id_p = ".sonumero($dd[0]);
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$cliente_codigo = $line['p_cliente'];
	$cliente_status = $line['p_status'];
	$cliente_nome = $line['p_nome'];
	$nr_pedido = $line['p_pedido'];
	}
	
if ($cliente_status != 'A')
	{
	echo '<font class=lt5 >Sedex já fechado !</font>';
	$ok = false;
	}

echo $cliente_codigo;
echo '<HR>';
$ok = True;

//////////////////////////////////////////////////////////// phase III
$sql = "select count(*) as total, o_id, sum(oi_quan) as o_item from orcamento ";
$sql .= "inner join orcamento_item on o_orcamento = oi_orcamento ";
$sql .= "where o_id >=0 group by o_id order by o_id";
$rlt = db_query($sql);

$odi = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
while ($line = db_read($rlt))
	{ 
	$od = $line['o_id'];
	$odi[$od] = $line['o_item']; 
	}
$id = -1;
for ($k=1;$k < 10;$k++)
	{
//	echo '<BR>'.$k.'='.$odi[$k];
	if (($odi[$k] == 0) and ($id == -1)) { $id = $k; }
	}

if ($id < 0)
	{
	echo "<FONT COLOR=RED >Não existe posição de Orcamento Livre</FONT>";
	exit;
	}
///////////////////////////////////////////////////////// PHASE IV
$pg = $id;

$xsql = "";	
$sql3 = '';
$sql1 = '';
$tabela = "orcamento";
if (strlen($nr_pedido) > 0)
	{
	///////////////////////////// GRAVAR ORCAMENTO
	setcookie("orcamento",$pg,time()+7200);  
	$sql = "update orcamento set o_id = -1 where o_id = ".$pg."; ";
	$sql .= "insert into orcamento (o_orcamento,o_valor,o_desconto,o_data,";
	$sql .= "o_hora,o_lastupdate,o_id,";
	$sql .= "o_cliente,o_nome ) ";
	$sql .= " values ('', ";
	$sql .= '0,0,'.date("Ymd").',';
	$sql .= "'".date("H:m")."',".date("Ymd").','.$pg.',';
	$sql .= "'".$cliente_codigo."','".$cliente_nome."');";
	$sql .= "update orcamento set o_orcamento = lpad(id_o,7,'0') ";
	$sql .= " where length(o_orcamento) = 0; ";
	echo '<HR>1.'.$sql;
	$rlt = db_query($sql);		
	$sql = "select * from orcamento where o_id = ".$pg;
	echo '<HR>2.'.$sql;
	$rlt = db_query($sql);

	$line = db_read($rlt);
	$nr_orcamento = $line['o_orcamento'];
	echo '=====================';
	echo $nr_orcamento;

/////////////////////////////////////////// Phase IV
	$sql = "select * from pedido_sedex_item ";
	$sql .= "where pi_pedido = '".$nr_pedido."' ";
//	$sql .= "and pi_codigo = '".$dd[1]."' ";
	echo $sql;
	$rlt = db_query($sql);
	while ($iline = db_read($rlt)) 
		{
		$tp   = $iline['pi_quan'];
		$td   = $iline['pi_quan_dev'];
		$qta  = $iline['pi_quan'];
		$desc = $iline['pi_desconto'];
		$codp = $iline['pi_codigo'];
		$xtp  = $iline['p_unidade'];
		$vlu  = $iline['pi_vlr_unit'];
		$vlt  = $iline['pi_vlr_total'];
		$vld  = $iline['pi_desconto'];

		//////////////////////////////////// Atualizar estoque
		$sql3 .= "update estoque_produto set p_estoque_1 = p_estoque_1 + ".$tp." ";
		$sql3 .= ", p_estoque_3 = p_estoque_3 - ".$tp." "; 
		$sql3 .= " where p_codigo ='".$codp."'; " .chr(13);
		
		$sql3 .= "insert into estoque_log ";
		$sql3 .= "(el_estoque,el_data,el_hora,el_ip, ";
		$sql3 .= "el_user,el_codigo,el_quan,el_pedido,el_status) values ";
		$sql3 .= "(1,'".date("Ymd")."','".date("H:i")."','".$ip."', ";
		$sql3 .= $user_id.",'".$codp."',".$tp.",'S".$nr_pedido."', ";
		$sql3 .= "'E');".chr(13);
		
		/////////////////////////////////////// Inserir no orcamento
		if (($tp-$td) > 0)
			{
			$sql1 .= "insert into orcamento_item ( ";
			$sql1 .= "oi_orcamento, oi_codigo,oi_vlr_unit,oi_vlr_total, ";
			$sql1 .= "oi_desconto,oi_data,oi_hora, ";
			$sql1 .= "oi_log, oi_status, ";
			$sql1 .= "oi_quan) values ('".$nr_orcamento."',";
			$sql1 .= "'".$codp."','".$vlu."','".$vlt."',";
			$sql1 .= "'".$vld."','".date("Ymd")."','".date("H:i")."',";
			$sql1 .= "'".$user_id."','A',";
			$sql1 .= "".($tp-$td).");".chr(10).chr(13);		
			}
		
		}
		echo '<HR>'.$sql1;
		echo '<HR>'.$sql2;
		echo '<HR>'.$sql3;

		$sql = $sql1. $sql2. $sql3;
		
		$sql .= " update pedido_sedex set p_status = 'B' ";
		$sql .= " where id_p = ".sonumero($dd[0]);
		$rlt = db_query($sql);
		redirect("orcamento.php");
	}	

?>
