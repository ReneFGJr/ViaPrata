<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_windows.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');

$pg = 'finan_receber.php';
$pg_edit = 'finan_receber_edit.php';
$pagina_form = 'finan_receber.php';
$pg_search = 'finan_receber_busca.php';
$pg_pedido = 'pedido_vd_mostra.php';
$pg_edit_chq = '';

$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$titulo_cab = "Contas a Receber";

		$tabela = '';
		if (strlen($dd[1]) == 0) { $dd[1] = '01/01/2009'; }
		if (strlen($dd[2]) == 0) { $dd[2] = stodbr(DateAdd("m",6,date("Ymd"))); }
		if (strlen($dd[7]) == 0) { $dd[7] = '0.00'; }
		if (strlen($dd[8]) == 0) { $dd[8] = '9999999.99'; }

		$cp = array();
		array_push($cp,array('$H8','','id',False,True,''));
		array_push($cp,array('$d8','','Data inicial',True,True,''));
		array_push($cp,array('$d9','','Data final',True,True,''));
	
		echo '<P><TABLE width="'.$tab_max.'" border="1">';
		echo '<TR><TD class="lt5"><CENTER>Busca no '.$titulo_cab.'</CENTER></TD></TR>';
		echo '<TR><TD align="center">';
		editar();
		echo '</TABLE>';
if ($saved > 0)
	{
		echo '<P><TABLE width="'.$tab_max.'" border="1">';
		$sql = "select * from contas_receber ";
		$sql .= " where cr_status = 'A' ";
		$sql .= " and cr_venc >= ".brtos($dd[1]);
		$sql .= " and cr_venc <= ".brtos($dd[2]);
		$sql .= " order by cr_venc desc ";

		$rlt = db_query($sql);
		$saldo = 0;
		$tit = 0;
		while ($line = db_read($rlt))
			{
			$tit++;
			require("finan_receber_mst.php");
			}
		echo '<TR><TD colspan="6">Total de '.$tit.' títulos em aberto, com saldo de '.number_format($saldo,2).'</TD></TR>';
		echo $ss;
		echo '</TABLE>';
	}
?>
<? require("foot.php");	?>
