<?
require("pdv_cab.php");
require($include."sisdoc_cookie.php");
require("orcamento_cookie_nr.php");
$http_edit = "pdv_produto.php";

require("pdv_produto_in.php");

if ($prod_ok)
	{
	/////////////////////////////////////////////////////
	$sql = "select * from orcamento where o_id = ".$pg;
	$rlt = db_query($sql);
	if (!($line = db_read($rlt)))
		{
		$sql = "insert into orcamento (o_local,o_orcamento,o_valor,o_desconto,o_data,";
		$sql .= "o_hora,o_lastupdate,o_id,";
		$sql .= "o_cliente ) ";
		$sql .= " values ('".$local."','', ";
		$sql .= '0,0,'.date("Ymd").',';
		$sql .= "'".date("H:m")."',".date("Ymd").','.$pg.',';
		$sql .= "'');";
		$sql .= "update orcamento set o_orcamento = lpad(id_o,7,'0') ";
		$sql .= " where length(o_orcamento) = 0; ";
		$rlt = db_query($sql);
		}
		
	$sql = "select * from orcamento where o_id = ".$pg;
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$orc_nr = strzero($line['id_o'],7);
		if (strlen($codigo) > 0)
			{
			$sql = "select * from orcamento_item where oi_codigo='".$codigo."' and oi_orcamento='".$orc_nr."'";
			$rlt2 = db_query($sql);
			if ($xline = db_read($rlt2))
				{ $sql = "update orcamento_item set oi_quan = (oi_quan + 1) ";
				$sql .= ", oi_vlr_total = ((oi_quan+1) * oi_vlr_unit)";
				$sql .= " where oi_id=".$xline['oi_id']; } 
				else
				{ $sql = "insert into orcamento_item (oi_codigo,oi_quan,oi_vlr_unit,";
				$sql .= "oi_vlr_total,oi_desconto,oi_data,";
				$sql .= "oi_hora,oi_log,oi_status, ";
				$sql .= "oi_orcamento ) values (";
				$sql .= "'".$codigo."',1,".$preco.",";
				$sql .= $preco.",0,".date("Ymd").',';
				$sql .= "'".date("H:m")."','".$user_id."','A',";
				$sql .= "'".$orc_nr."');";
				}
			$rlt2 = db_query($sql);
			}
		}
	?><script>
		window.open('pdv_orcamento.php','pdv_area');
	</script>
	<?		
	}
?>
