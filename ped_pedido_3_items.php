<?
$sql = "select sum(pi_vlr_total) as total from pedido_item ";
$sql .= "where pi_orcamento='".$dd3."' and pi_quan > 0";
$rlt = db_query($sql);
$vlrt=0;
if ($line = db_read($rlt))
	{
	$vlrt = $line['total'];
	}
	
$usql = '';
$multd = 0;

if ($vlrt > 0)
	{
	$multd = $desc / $vlrt;
	}

$sql = "select * from pedido_item ";
$sql .= "where pi_orcamento='".$dd3."' and pi_quan > 0";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$comi = $line['pi_comissao']/100;
	$usql .= "update pedido_item set pi_desconto = ";
	$usql .= (100*$line['pi_vlr_total']*$multd)/100;
	$usql .= ", pi_comissao_vlr = ".$line['pi_vlr_total']*(1-$multd)*$comi;
	$usql .= " where pi_id=".$line['pi_id'];
	$usql .= "; ".chr(13).chr(10);
	}
	
if (strlen($usql) > 0)
	{
	$rlt = db_query($usql);
	}
$sql = "select * from pedido_item ";
$sql .= "left join produto on pi_codigo = p_codigo ";
$sql .= "where pi_orcamento='".$dd3."'";
$rlt = db_query($sql);
$tot1=0;
$tot2=0;
$tot3=0;
$tot4=0;
$tot5=0;
$tot6=0;
$tot7=0;
$tot8=0;

while ($line = db_read($rlt))
	{
	$link = '<A Href="ped_pedido_3.php?dd50='.$line['pi_id'].'&dd51=DEL">excluir</A>';
	$s .= '<TR '.coluna().'>';
	$s .= '<TD>'.$line['pi_codigo'];
	$s .= '<TD>'.$line['p_descricao'];
	$s .= '<TD align="right">'.number_format($line['pi_quan'],1);
	$s .= '<TD align="right">'.number_format($line['pi_vlr_unit'],2);
	$s .= '<TD align="right">'.number_format($line['pi_vlr_total'],2);
	$s .= '<TD align="right">'.number_format($line['pi_vlr_total']-$line['pi_desconto'],2);
	$s .= '<TD align="right">'.number_format($line['pi_comissao_vlr'],2);
	$s .= '<TD align="center">'.$line['pi_comissao'].'%';
	$s .= '<TD align="center">'.$line['pi_status'];
	$s .= '<TD align="center">'.$link;
	$s .= '</TR>';
	$tot1 = $tot1 + $line['pi_vlr_total'];
	$tot2++;
	$tot3 = $tot3 + ($line['pi_comissao_vlr']);
	$tot4 = $tot4 + ($line['pi_vlr_total']-$line['pi_desconto']);
	}
?>
<TABLE class="lt1" width="<?=$tab_max;?>">
<TR align="center" bgcolor="#c0c0c0">
<TH>código</TH>
<TH>descrição</TH>
<TH>quant</TH>
<TH>vlr.unitário</TH>
<TH>sub.total</TH>
<TH>vlr.total</TH>
<TH>vlr.comissão</TH>
<TH>comissão</TH>
<TH>st</TH>
<TH>ação</TH>
</TR>
<?=$s;?>
<TR>
<TD></TD>
<TD></TD>
<TD></TD>
<TD></TD>
<TD align="right"><B><?=number_format($tot1,2);?></TD>
<TD align="right"><B><?=number_format($tot4,2);?></TD>
<TD align="right"><B><?=number_format($tot3,2);?></TD>
</TR>
<?

setcookie("total",$tot4);
$total_pedido = $tot4;
if ($desc > 0)
	{ ?>
	<TR><TD colspan="10">Valor do desconto <B><?=number_format($desc,2);?></B></TD></TR>
	<? } ?>
</TABLE>
</form>
<TABLE class="lt1" width="<?=$tab_max;?>">
<?
	$sc = '<TR align="center">';
	$sc .= '<TD><form method="post" action="ped_pedido_3.php">';
	$dd[52]="DES";
	$dd[53]=$desc;
	$sc .= '<TD align="right">Valor do desconto:</TD>';
	$sc .= sget('dd52','$H8','');
	$sc .= sget('dd53','$N8','Valor do desconto');
	$sc .= '<TD><input type="submit" name="dd54" value="aplicar desconto"></TD>';
	$sc .= '<TD></form>';
	echo $sc;	
?>
</TABLE>