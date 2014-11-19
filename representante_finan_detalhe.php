<?
//$login= 1;
require("cab.php");
require("include/sisdoc_cookie.php");
require("include/sisdoc_data.php");
require("include/sisdoc_debug.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_form2.php");
require("include/cp2_gravar.php");

$titulo_cab = "Contas a Receber";
$pg = 'finan_receber.php';
$pg_edit = 'finan_receber_edit.php';
$pagina_form = 'finan_receber.php';
$pg_search = 'finan_receber_busca.php';
$pg_pedido = 'pedido_vd_mostra.php';
$pg_edit_chq = '';

$cp = array();
array_push($cp,array('$H8','','id',False,True,''));
array_push($cp,array('$D8','','Data inicial',False,True,''));
array_push($cp,array('$D8','','Data final',False,True,''));
array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','','Representante',False,True,''));

$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$titulo_cab = "Conta Corrente Representante";
$pg = 'representante_finan.php';
//$pg_edit = 'finan_pagar_edit.php';
//$pg_search = 'finan_pagar_busca.php';

?>
<table width="800">
<TR><TD>
<?
editar();
?>
</TD></TR>
</table>
<?
if($saved < 1) { exit; }?>
<?
$sql = "select * from pedido ";
$sql .= "left join contas_receber on p_pedido = cr_pedido ";
$sql .= " where p_vendedor = '".$dd[3]."' ";
$sql .= " and p_data >= ".brtos($dd[1]);
$sql .= " and p_data <= ".brtos($dd[2]);
$sql .= " and cr_status <> 'X' ";
$sql .= "order by p_pedido ";
$rlt = db_query($sql);
$line = db_read($rlt);

$ped = "X";
$saldo = 0;
while ($line = db_read($rlt))
	{
	if ($ped != $line['p_pedido'])
		{
		$ss .= '<TR><TD colspan="5" class="lt4">'.$line['p_nome'].' ('.$line['p_cliente'].') '.stodbr($line['p_data']).' - Pedido '.$line['p_pedido'].'</TD></TR>';
		$ped = $line['p_pedido'];
		}
	require("finan_receber_mst.php");
	}
		echo '<H1>Representante '.$dd[3].' de '.($dd[1]).' até '.($dd[2]).'</H1>';
		echo '<P><TABLE width="'.$tab_max.'" border="1">';
		echo $ss;
		echo '<TR><TD colspan="10">Total de '.number_format($saldo,2).'</TD></TR>';
		echo '</TABLE>';	
	require("foot.php");
?>