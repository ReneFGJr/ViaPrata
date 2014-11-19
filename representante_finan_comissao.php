<?
require("cab.php");
require("include/sisdoc_form2.php");
require("include/sisdoc_data.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_colunas.php");
require("include/cp2_gravar.php");


$tabela = "banco";
$cp = array();
array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','','Vendedor ',False,True,''));
array_push($cp,array('$D8','','Vendas lançadas de ',False,True,''));
array_push($cp,array('$D8','','até ',False,True,''));
array_push($cp,array('$B8','','',False,True,''));

if (strlen($dd[0])==0)
	{
	if (strlen($dd[1]) == 0) { $dd[1] = date("d/m/Y"); }
	if (strlen($dd[2]) == 0) { $dd[2] = date("d/m/Y"); }
	echo '<TABLE width="'.$tab_max.'">' ;
	echo '<TR><TD><FORM method="post" action="representante_finan_comissao.php" >';
	echo '<TR><TD><input type="hidden" name="dd99" value="PR">';
	echo gets_fld();
	echo '</FORM></TD></TR>';
	echo '</TABLE>';
	require("foot.php");
	exit;
	}
	
$sql = "select * from contas_representante ";
$sql .= "left join contas_tipo on ct_codigo = cr_conta ";
$sql .= " where cr_status <> 'X' ";
//$sql .= 'and cr_venc = ".$dd[0];
if (strlen($dd[0] ) > 0)
	{
	$sql .= " and cr_cliente = '".trim($dd[0])."' ";
	}
	
$sql .= " and (cr_venc >= ".brtos($dd[1])." and cr_venc <= ".brtos($dd[2]).") ";
$sql .= " order by cr_pedido desc ";
$sql .= " limit 100 ";
//echo '<HR>';
//echo $sql;
//echo '<HR>';
$rlt = db_query($sql);
$saldo = 0;
$saldo2 = 0;
$ss = '';
//$pg_edit = 'finan_pagar_edit.php';
//$pg_cr_close = 'finan_pagar_fechar.php';
$pg_edit = 'representante_finan_lanca.php';
$tot = 0;
$pc1=array();
$pc2=array();
$tot = 0;
$total = 0;
$items = 0;
while ($line = db_read($rlt))
	{
	$items++;
	
	$dc = $line['ct_dc'];
	$sta = trim($line['cr_status']);
	$ref = trim($line['cr_ref']);
	$valor = $line['cr_valor'];
	$valor_2 = $line['cr_peso'];
	$mlt = 1;
	if ($dc == 'D') { $mlt = (-1); }
	if (strlen($ref) > 0)
		{
		$ok = -1;
		for ($k = 0; $k <= count($pc1);$k++)
			{ if (trim($pc1[$k]) == trim($ref)) { $ok = $k; } }
		if ($ok == -1)
			{ array_push($pc1,$ref); array_push($pc2,$mlt*$valor_2); } else
			{ $pc2[$ok] = $pc2[$ok] + $mlt*$valor_2; }
		}
	$linkc = '';
	$link = '';
	$tc = $line['ct_dc'];
//	if ($tc == 'D') { $valor = $valor * (-1); }
	$linkd = '<A HREF="#" onclick="newwin2('.chr(39).'orcamento_vd_mostra.php?dd0='.$line['cr_doc'];
	$linkd .= "');".'" >';	
	
	if (trim($line['cr_previsao']) == '1') { $cor = 'bgcolor="#ffdfbf"'; }
	if (($sta == 'A') or (strlen($sta) ==0))
		{
		if ($user_nivel == 9)
			{
			$link='<A HREF="#" onclick="newwin2('.chr(39).$pg_edit."?dd0=".$line['id_cr']."');".'">';
			}
		}

	$dsp_valor = Number_format($valor,2);
	$dsp_valor_2 = Number_format($valor_2,1);

	if ($dsp_valor == '0.00' ) { $dsp_valor = '<CENTER>&nbsp;'; }			
	if ($dsp_valor_2 == '0.00' ) { $dsp_valor_2 = '<CENTER>&nbsp;'; }
	
	if ($dc == 'D')
		{
		$saldo = $saldo - $valor;
		$saldo2 = $saldo2 - $valor_2;
		$vlcor = '<font color="red">';
		$total = $total - $line['cr_valor'];
		} else {
		$saldo = $saldo + $valor;
		$saldo2 = $saldo2 + $valor_2;
		$vlcor = '<font color="blue">';
		$total = $total + $line['cr_valor'];
		}
	if ($tot < 99)
	{			
	$ss = $ss .'<TR '.coluna().' class="lt1">';
	$ss = $ss .'<TD align="right"><B>'.$link.$vlcor.$dsp_valor.'</TD>';
	$ss = $ss .'<TD align="right"><B>'.$link.$vlcor.$dsp_valor_2.'</TD>';
	$ss = $ss .'<TD>&nbsp;'.$link.substr(trim($line['cr_ref']).' '.trim($line['cr_historico']),0,60);
	$ss = $ss .'<TD align="center">&nbsp;'.stodbr($line['cr_venc']);
	$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_pedido'];
	$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_cliente'];
	$ss = $ss .'<TD align="center">&nbsp;'.$linkd.$line['cr_doc'];
	$ss = $ss .'<TD align="center">&nbsp;'.$linkc.$line['cr_status'];
	$ss = $ss .'<TD>'.$line['ct_dc'].'</TD>';
	$ss = $ss .'</TR>';
	}
	$tot = 0;

	}
//require("finan_cab.php");
?>
<font class="lt5">Representante</font>
<TABLE cellpadding="2" cellspacing="0" border="1" width="704">
<TR><TD><form method="post"></TD></TR>
<TR><TD>
<?
$cp = array();
array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','','Representante',False,True,''));
echo gets_fld();
echo '<TD><input type="submit" name="acao" value="filtrar"></TD>';
?>
<TR><TD></form></TD>
<TD><A href="#" onclick="newwin2('representante_finan_lanca.php?dd1=<?=$dd[0]?>')">[+]</A></TD>
</TR>
<TABLE cellpadding="2" cellspacing="0" border="1" width="<?=$tab_max?>">
<TR><TD colspan="10" align="right">Saldo: <?=number_format($saldo,2)?> / <?=number_format($saldo2,1)?>g</TD></TR>
<TR bgcolor="#c0c0c0" align="center" class="lt0">
<TD width="12%"><B>valor</B></TD>
<TD width="8%"><B>peso</B></TD>
<TD><B>histórico / tipo</B></TD>
<TD width="7%"><B>data</B></TD>
<TD width="7%"><B>fornecimento</B></TD>
<TD width="7%"><B>vendedor</B></TD>
<TD width="7%"><B>orçamento</B></TD>
<TD width="2%"><B>st</TD>
</TR>
<?=$ss?>
<TR><TD colspan="10" align="right" class="lt2">Saldo: <B><?=number_format($saldo,2)?></B><BR>Peso: <B><?=number_format($saldo2,1)?>g</B></TD></TR>
</TABLE>
<table class="lt0" width="<?=$tab_max?>">
<?
for ($k=0;$k < count($pc1);$k++)
	{
	echo '<TR>';
	echo '<TD>'.$pc1[$k].'</TD>';
	echo '<TD align="right">'.number_format($pc2[$k],1).'</TD>';
	echo '<TD width="85%">&nbsp;</TD>';
	echo '</TR>';
	}
?>
<TR><TD colspan="10" align="right" class="lt3">total de <?=$items;?>, R$ <?=number_format($total,2);?></B></TD></TR>
</table>
<?
require('foot.php');	
?>