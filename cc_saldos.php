<?
require("include/sisdoc_data.php");
$xsql = "select * from";
$xsql .= "(select max(cr_data) as data, round(sum(cr_valor)*100)/100 as total, cr_cliente from contas_cliente ";
$xsql .= "where cr_status <> 'X' and cr_tipo = 'F' ";
$xsql .= "group by cr_cliente ) as tabela ";
$xsql .= "inner join clientes on cr_cliente = cliente_codigo ";
$xsql .= "order by total ";

$xrlt = db_query($xsql);
$rr = '<TABLE border="1" class="lt1" width="'.$tab_max.'">';
$rr .= '<TR><TD class="lt5" colspan="10">Saldo de conta corrente - Cliente</TD></TR>';
while ($xline = db_read($xrlt))
	{
	$valor = $xline['total'];
	if (($valor > 1) or ($valor < -1))
		{
		$rr .= "<TR>";
		$rr .= "<TD>".trim($xline['cliente_razao_social']).'/'.trim($xline['cliente_nome_fantasia']);
		$rr .= "<TD align=center >".$xline['cr_cliente'];
		$rr .= '<TD align="right">'.number_format($xline['total'],2);
		$rr .= "<TD align=center >".stodbr($xline['data']);
		$rr .= "</TR>";
		}
	}
$rr .= '</TABLE>';
?>