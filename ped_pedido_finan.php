<?
$sql = "insert into vp_estoque(es_descricao,es_ref,es_ativo,es_valor) values ('Outros/Desconto','5700099   ','1','1'); ";
//$sql = "delete from vp_estoque where es_descricao = 'Outros/Conserto' ";
//$rlt = db_query($sql);

if ($dd[50] == 'DEL')
	{
	$ttt = "contas_receber";
	if ($dd[51]=='B') { $ttt = "contas_cliente"; }
	$xsql = "update ".$ttt." set cr_status = 'X' ";
	$xsql .= " where cr_cliente = '".$dd1."' and cr_pedido = '".strzero($dd3,7)."' ";
	$xsql .= " and id_cr = ".$dd[0];
	$xrlt = db_query($xsql);
	}
$saldo = 0;
?>
<TABLE width="<?=$tab_max;?>" align="center" border=0 class=lt1>
<TR bgcolor="#c0c0c0">
<TH width="3%">Banco
<TH width="9%">Nr.Cheque
<TH width="12%">Valor
<TH width="12%">Bom para
<TH>Histórico
<TH width="3%">Parcela
<TH width="5%">Ação
<?
$xsql = "select 'A' as tp,cr_banco,cr_doc,cr_valor,cr_venc,cr_historico,cr_parcela,cr_status,cr_fp,id_cr from contas_receber where ";
$xsql .= "cr_cliente = '".$dd1."' ";
$xsql .= " and cr_pedido = '".strzero($dd3,7)."' ";
$xsql .= " and cr_status <> 'X' ";
$xsql .= ' union ';
$xsql .= "select 'B' as tp,cr_banco,cr_doc,cr_valor,cr_venc,cr_historico,cr_parcela,cr_status,cr_fp,id_cr from contas_cliente where ";
$xsql .= "cr_cliente = '".$dd1."' ";
$xsql .= " and cr_pedido = '".strzero($dd3,7)."' ";
$xsql .= " and cr_status <> 'X' ";
$xrlt = db_query($xsql);

$par = 0;
$tot = 0;
while ($xline = db_read($xrlt))
	{
	$mult_ = 1;
	if ($xline['cr_fp'] == 'y') { $mult_ = -1; }
	$link = '';
	if ((strlen($xxx) == 0) and ($xline['cr_status'] == '@'))
		{
		$link = $http_edit.'?dd0='.$xline['id_cr'].'&dd50=DEL&dd51='.$xline['tp'];
		$link = '<A HREF="'.$link.'">excluir</A>';
		}
	$sc .= '<TR '.coluna().'>';
	$sc .= '<TD align="center">';
	$sc .= $xline['cr_banco'];	
	$sc .= '<TD align="center">';
	$sc .= $xline['cr_doc'];
	$sc .= '<TD align="right">';
	$sc .= number_format($mult_ * $xline['cr_valor'],2);
	$sc .= '<TD align="center">';
	$sc .= stodbr($xline['cr_venc']);
	$sc .= '<TD>';
	$sc .= $xline['cr_historico'];
	$sc .= '<TD align="center">';
	$sc .= $xline['cr_parcela'];
	$sc .= '<TD>';
	$sc .= $link;
//	$sc .= '='.$xline['cr_fp'];
	$sc .= '</TR>';
	$par++;
	$tot = $tot + intval($xline['cr_valor'] * $mult_ *100)/100;
	}
echo $sc;
$saldo = intval(($tot-$total_pedido)*100)/100;
if ($tot <> 0)
	{
	echo '<TR><TD colspan="3" align="right">';
	echo 'Sub-Total &nbsp; <B>'.number_format($tot,2);
	echo '</TD></TR>';
	echo '<TR><TD colspan="3" align="right">';
	echo 'Saldo &nbsp; <B>'.number_format($saldo,2);
	echo '</TD></TR>';
	}
	
$saldo = intval(($tot - $total_pedido)*10)/10;

$sql = "update pedido set p_valor = 0".$total_pedido;
$sql .= ", p_desconto = 0".$desc. " where p_pedido = '".strzero(trim($dd3),7)."' ";

$sql .= " and p_cliente = '".trim($dd1)."' ";
$rlt = db_query($sql);
?>
</TABLE>