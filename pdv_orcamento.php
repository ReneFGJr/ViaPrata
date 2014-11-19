<?
//$login= 1;
require("pdv_cab.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_cookie.php");
$tab_max = '100%';
$http_edit = 'pdv_orcamento.php';
$pg = read_cookie("orcamento");
if (strlen($dd[49]) > 0)
	{ setcookie("orcamento",$dd[49],time()+7200); $pg = $dd[49]; }
$tot=0;
$tov=0;
//////////////////////////////////////////////////// EXCLUIR PECAS
if ($dd[4]=='DEL')
	{
	$sql = "update orcamento_item set oi_quan = (oi_quan + (".$dd[3].")) ";
	$sql .= ", oi_vlr_total = ((oi_quan +(".$dd[3].")) * oi_vlr_unit)";
	$sql .= " where oi_id=".$dd[1]." and oi_codigo = '".$dd[2]."'; ";
	$sql .= "delete from orcamento_item where oi_quan = 0; ";
	$rlt = db_query($sql);
	}
if (strlen($pg) == 0) { $pg = 1; }
setcookie("orcamento",$pg,time()+7200);

$st = '';

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
		} else {
			$cliente_codigo = trim($line['o_cliente']);
			$cliente_nome = $line['o_nome'];
			$xlocal = trim($line['o_local']);
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
		//////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////// FEIRA //
		//////////////////////////////////////////////////////////////////////
		$local = trim(read_cookie("local"));
		if ((strlen($xlocal) == 0) and (strlen($local) > 0))
			{
			$dd[10]= $local;
			}
		if (strlen($local) == 0) { $dd[10] = '00002'; }
		if (strlen($dd[10]) > 0)
			{ 
			setcookie("local",$dd[10],time()+7200); $local = $dd[10]; 
			$sql = "update orcamento set o_local = '".$local."' where o_orcamento = '".$orc_nr."'";
			$rlt = db_query($sql);
			}
	    $sa .= '<TABLE class=lt1>';
		$sa .='<TR><TD><form method="post" action="'.$http_edit.'">';
		$sa .= gets('dd10',$local,'$Q feira_nome:feira_codigo:select * from feira where feira_ativo=1 order by feira_nome','Local da venda:',true,true,true);
		$sa .= '<TR><TD colspan="10" align="right">'.$local.'&nbsp;<input type="submit" name="acao" value="selecionar >>"></TD>';
		$sa .= '<TR><TD></form></TD></TR>';
		$sa .= '</TABLE>';		
		//////////////////////////////////////////////////////////////////////
	require("orcamento_calcula.php");
	/////////////////////////////////////////////////////
	$usql = "update orcamento where o_id = ".$pg;
	?>

<TABLE width="<?=$tab_max?>" border=1 class="lt1" >
<TR>
<TD class="lt5">Orçamento nº <?=$pg?>/<?=$orc_nr?><?=$sa?></TD>
<TD align="right" class="lt0">
<? require('orcamento_calcula_mst.php'); ?>
</TD>
</TR>
</TABLE>
<!---- peças ---->
<? echo $s; ?>
<TD><? echo $si; ?></TD>
<!---- peças (fim) ---->
<TR>
<TD>
</form>
<? if ((strlen($cliente_codigo) != 0) and (($top+$cop) > 0)) { ?>
<form method="post" action="pdv_orcamento_fecha.php">
<input type="submit" name="acao" value=" fechar pedido " style="width: 300; height: 50">
</form>
<? } ?>
<A HREF="#" onclick="newxycs('orcamento_prn.php?dd49=<?=$pg?>',300,400);">
PR</A>
</TD>
</TR>
</TABLE>
	<script language="javascript">
		doc.dd0.focus();
		doc.dd0.focus();
	</script>
	<?

function wand($ddr)
	{
	if (strlen($ddr) > 0) { return(' and '); }
	else { return(""); }
	}
		
?>
<CENTER><font class=lt0><?=$orc_nr?></font></CENTER>