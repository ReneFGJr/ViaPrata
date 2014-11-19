<?
require("cab.php");
require("include/sisdoc_cookie.php");
require("include/sisdoc_form2.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_data.php");
require("cliente_saldo.php");
require("include/cp2_gravar.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$orc_nr = strzero($dd[0],7);

echo '<font class="lt5">Sedex / Conserto de peças nº '.$orc_nr.'</font><BR>';

$sql = "select * from pedido_sedex where p_pedido = ".$orc_nr;
$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$orc_nr = strzero($line['id_p'],7);
		$cliente_codigo = trim($line['p_cliente']);
		$cliente_nome = $line['p_nome'];
		}

	$sql = "select * from pedido_sedex_item ";
	$sql .= "inner join produto on p_codigo = pi_codigo ";
	$sql .= "where pi_orcamento='".$orc_nr."'";
	$rlt = db_query($sql);
	$tot=0;
	$top=0;
	$tov=0;
	$tog=0;
	while ($line = db_read($rlt))
		{
		$qta  = $line['oi_quan'];
		$desc = $line['oi_desconto'];
		$vlr_brt = round(10*($line['oi_vlr_unit']*(1-$desc/100)))/10;
		$vlr_brt = ($line['oi_vlr_unit']*(1-$desc/100));
		$xtp = $line['p_unidade'];
		$tot = $tot + 1;
		$top = $top + $qta;
		$tov = $tov + $line['oi_vlr_total'];			
		}
		
	//////////////////////////////////////////////////////////
		
	$path = "orcamento_pedido.php";
	if (strlen($pg) == 0) { redirect("orcamento.php"); }
	$menu = array();
	$sql = "select * from documento_tipo where dt_pedido = 1 order by dt_descricao ";
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
		{
		/////////////////////////////////////////////////// MANAGERS
		array_push($menu,array('Forma de pagamento',trim($line['dt_descricao']),'ocamento_pedido.php?dd0='.$line['dt_codigo'],$line['dt_codigo'],$line['dt_dias'])); 
		}
 
 ?>
 <TABLE width="<?=$tab_max?>" border=1 >
<TR valign="top">
<TD><?=$cliente_nome?></TD>
<TD align="right">
<font class=lt5><?=number_format($tov,2)?></font>
<BR><font class=lt1><B><?=$top?></font></B> peças,&nbsp;
<font class=lt1><B><?=$tot?></font></B> itens
</TD>
</TR>
</TABLE>

<? require("foot.php");	?>