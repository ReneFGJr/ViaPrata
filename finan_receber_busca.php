<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');

$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$titulo_cab = "Contas a Receber";
$pg = 'finan_receber.php';
$pg_edit = 'finan_receber_edit.php';
$pagina_form = 'finan_receber.php';
$pg_search = 'finan_receber_busca.php';
$pg_pedido = 'pedido_vd_mostra.php';
$pg_edit_chq = '';

$vlr = array();
for ($k=0;$k < 35;$k++) { array_push($vlr,0); }

if (strlen($dd[0]) ==0) { $dd[0] = date('Ymd'); }

if (strlen($acao) == 0)
	{
		echo '<P><TABLE width="700" border="1">';
		echo '<TR><TD class="lt5"><CENTER>Busca no '.$titulo_cab.'</CENTER></TD></TR>';
		echo '<TR><TD align="center">';
		require("finan_busca.php");
		echo '</TABLE>';
	} else {
		$sql = "select * from contas_receber ";
		$wh = array();
		$dd[7] = sonumero($dd[7]);
		$dd[8] = sonumero($dd[8]);
		if (strlen($dd[1])==10) { array_push($wh,'cr_venc >= '.brtos($dd[1])); }
		if (strlen($dd[2])==10) { array_push($wh,'cr_venc <= '.brtos($dd[2])); }
		if (strlen($dd[3]) > 0 ) { array_push($wh,"upper(asc7(cr_historico)) like '%".UpperCaseSQL($dd[3]). "%'"); }
		if (strlen($dd[3]) > 0 ) { array_push($wh,"(cr_historico like '%".UpperCaseSQL($dd[3]). "%')"); }
		if (strlen($dd[4]) > 0 ) { array_push($wh,"upper(asc7(cr_pedido)) like '%".UpperCaseSQL(trim($dd[4])). "%'"); }
		if (strlen($dd[5]) > 0 ) { array_push($wh,"(upper(asc7(cr_doc)) like '%".UpperCaseSQL($dd[5]). "%') or (upper(asc7(cd_destino)) = '".UpperCaseSQL($dd[5]). "')"); }
		if (($dd[6] != 'Z' ) and ($dd[6] != 'T' )) { array_push($wh,"cr_status = '".$dd[6]."'"); }
				else { if ($dd[6] == 'Z' ) { array_push($wh,"cr_status != 'X'"); } }

		if ($dd[7] != -1 ) { array_push($wh,'cr_valor >= '.($dd[7]/100)); }
		if ($dd[8] < 9999999.99 ) { array_push($wh,'cr_valor <= '.($dd[8]/100)); }
			
		$where = '';
		for ($wk = 0 ; $wk < count($wh); $wk++)
			{
			if (strlen($where) > 0) { $where = $where . ' and '; } else { $where = 'where '; }
			$where = $where . ' ('.trim($wh[$wk]).') ';
			}
		$sql = $sql . $where;
		$sql = $sql . ' order by cr_venc desc ';
		
//		echo $sql;

		$rlt = db_query($sql);
		$saldo = 0;
		$ss = '';
		$pg_cr_close = 'finan_receber_fechar.php';
		while ($line = db_read($rlt))
			{
			require("finan_receber_mst.php");
			}
	require("finan_cab.php");
	?>
	<TABLE cellpadding="2" cellspacing="0" border="1" width="<?=$tab_max?>">
	<TR bgcolor="#c0c0c0" align="center" class="lt0">
	<TD width="9%"><B>vencimento</B></TD>
	<TD width="15%"><B>valor</B></TD>
	<TD><B>histórico / tipo</B></TD>
	<TD width="10%"><B>pedido</B></TD>
	<TD width="10%"><B>parcela</B></TD>
	<TD width="10%"><B>documento</B></TD>
	<TD width="2%"><B>st</TD>
	</TR>
	<?=$ss?>

	</TABLE>
<? } ?>
<? require("foot.php");	?>
