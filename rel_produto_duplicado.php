<?
require("cab.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$sql = "delete from produto where p_codigo like '*%'";
$rlt = db_query($sql);

$sql = "select * from (select p_codigo, count(*) as total, p_descricao from produto group by p_codigo, p_descricao ";
$sql .= ") as tabelas ";
$sql .= " where total > 1 ";
$sql .= "order by total desc ";
$rlt = db_query($sql);
$tot = 0;
while ($line = db_read($rlt))
	{
	$tot++;
	$s .= '<TR>';
	$s .= '<TD>'.$line['p_codigo'];
	$s .= '<TD>'.$line['total'];
	$s .= '<TD>'.$line['p_descricao'];
	$s .= '</TR>';
	}
?>
<BR><BR>
<CENTER><FONT CLASS="lt5">Relatório de Códigos Duplicados</FONT></CENTER>
<TABLE width="<?=$tab_max;?>">
<TR bgcolor="#c0c0c0"><TH>código
<TH>quan</TH>
<TH>Descricao</TH>
	<?=$s;?>
<TR><TD colspan="10">Total <?=$tot;?> duplicados</TD></TR>
</TABLE>

<? require("foot.php");	?>