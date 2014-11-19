<?
//$login= 1;
require("cab.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_cookie.php");

$pg = read_cookie("balanco");
if (strlen($pg) == 0) { $pg = 1; }
if (strlen($dd[49]) > 0)
	{ setcookie("balanco",$dd[49],time()+7200); $pg = $dd[49]; }
	else
	{ setcookie("balanco",$pg,time()+7200); }
$tot=0;
$tov=0;

	$sql = "select * from balanco where o_id = ".$pg;
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$orc_nr = strzero($line['id_o'],7);

		$sql = "select * from balanco_item ";
		$sql .= "inner join produto on p_codigo = oi_codigo ";
		$sql .= "where oi_balanco='".$orc_nr."'";
		$rlt = db_query($sql);
		$tot = 0;
		$tov = 0;
		$top = 0;
		while ($line = db_read($rlt))
		{
			$qta  = $line['oi_quan'];
			$desc = $line['oi_desconto'];
			$cod  = trim($line['oi_codigo']);
			$xtp = $line['p_unidade'];
			
			$sql = "select * from estoque_produto where p_codigo='".$cod."'";
			$xrlt = db_query($sql);
			if (!($xline = db_read($xrlt)))
				{
				$xsql = "insert into estoque_produto (p_codigo,";
				$xsql .= "p_estoque_1,";
				$xsql .= "p_estoque_2,";
				$xsql .= "p_estoque_3,";
				$xsql .= "p_estoque_4";
				$xsql .= ") values (";
				$xsql .= "'".$cod."',";
				$xsql .= "0,0,0,0)";
				$xrlt = db_query($xsql);

				$sql = "select * from estoque_produto where p_codigo='".$cod."'";
				$xrlt = db_query($sql);
				
				$xrlt = db_query($sql);
				if ($xline = db_read($xrlt)) { echo '';}
				}
			$idp = $xline['id_p'];
			echo '>>>>'.$idp;

			$sql = "insert into estoque_produto_log ";
			$sql .= ""."(ep_codigo,ep_data,ep_hora,";
			$sql .= ""."ep_quan,ep_doc,ep_log,";
			$sql .= ""."ep_tipo) values (";
			$sql .= "'".$cod."',".date("Ymd").",'".date("H:i")."',";
			$sql .= ""."".$qta.",'".$orc_nr."','".$user_login."',";
			$sql .= ""."'I');";

			$sql .= chr(13).chr(10);
			$sql .= "update estoque_produto set p_estoque_1 = p_estoque_1 + ".$qta." where id_p = ".$idp.";";

			$sql .= chr(13).chr(10);
			$sql .= "insert into estoque_balanco (eb_doc,eb_data,eb_hora,eb_log,eb_estoque) ";
			$sql .= " values ";
			$sql .= "('".$orc_nr."',".date("Ymd").",'".date("H:i")."','".$user_id."',1); ";
			$xrlt = db_query($sql);

			$tot = $tot + 1;
			$top = $top + $qta;
			$tov = $tov + $line['oi_vlr_total'];		
		}
		}
		$sql = "update balanco_item set oi_status='B' ";
		$sql .= "where oi_balanco='".$orc_nr."'; ";
		$sql .= "update balanco set o_id = -1 where o_id = ".$pg;

		$xrlt = db_query($sql);
		
		redirect("balanco_relatorio.php");
//////////////////////////////////////////////////// EXCLUIR PECAS
require("foot.php");
?>