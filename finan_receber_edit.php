<? ob_start(); ?>
<title>Via Prata - Gestor comercial</title>
<?
global $nocab;
$tabela = "contas_receber";

require('db.php');
require('security.php');
require('include/sisdoc_form2.php');
require('include/sisdoc_data.php');
require('include/cp2_gravar.php');
require('include/sisdoc_colunas.php');
//require('include/sisdoc_debug.php');

$user_id = $HTTP_COOKIE_VARS['nw_user'];
$user_nome = $HTTP_COOKIE_VARS['nw_user_nome'];
$user_nivel = $HTTP_COOKIE_VARS['nw_nivel'];
$user_log = $HTTP_COOKIE_VARS['nw_log'];
$bb1 = 'e x c l u i r';
security();
?>
<body leftmargin="0" topmargin="0" >
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(img/bg2.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<CENTER>
<FONT class="lt5">Contas a Receber</FONT>
<?
if (strlen(trim($dd[0])) > 0) { $xnovo = '0'; } else { $xnovo = '1'; }
	
$cp = array();
array_push($cp,array('$H4','id_cr','cod',False,True,''));
array_push($cp,array('$S4','cr_cliente','Cliente',True,True,''));
array_push($cp,array('$Q dt_descricao:dt_codigo:select * from documento_tipo where dt_ativo=1 order by dt_descricao','cr_tipo','Tipo documento',False,True,''));
array_push($cp,array('$H8','cr_dt_quitacao','Dt.Quita��o',False,True,''));
array_push($cp,array('$H1','cr_status','A',False,True,''));
array_push($cp,array('$H1','cr_img','Img',False,True,''));

array_push($cp,array('$N10','cr_valor','valor',True,True,''));
array_push($cp,array('$D8','cr_venc','vencimento',True,True,''));
array_push($cp,array('$S80','cr_historico','hist�rico',True,True,''));
array_push($cp,array('$S10','cr_pedido','pedido',True,True,''));
array_push($cp,array('$S10','cr_parcela','parcela',True,True,''));
array_push($cp,array('$O 0:N�o&1:SIM','cr_previsao','Previs�o',True,True,''));
array_push($cp,array('$S10','cr_doc','nr. doc.',False,True,''));
array_push($cp,array('$Q e_nome:e_codigo:select * from empresa where e_ativo=1 order by id_e','cr_empresa','Empresa',False,True,''));
array_push($cp,array('$Q ct_descricao:ct_codigo:select * from contas_tipo where ct_ativo=1 and ct_tipo=1','cr_conta','Conta',False,True,''));

if (strlen($dd[6]) ==0) { $dd[6] = '0.00'; }
if (strlen($dd[3]) ==0) { $dd[3] = '19000101'; }
if (strlen($dd[7]) ==0) { $dd[7] = date("d/m/Y"); }
if (strlen($dd[7]) ==8) { $dd[7] = stodbr($dd[7]); }
if (strlen($dd[61]) ==0) { $dd[61] = '1'; }
if (strlen($dd[60]) ==0) { $dd[60] = '1'; }

echo gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);

if (strlen($acao) > 0)
	{
	$ok = 1;
	for ($k =0;$k < count($cp);$k++)
		{ if (($cp[$k][3] == True) and (strlen($dd[$k]) == 0)) { $ok = -1; } }
		//////// Novo Lancamento
		if (($ok == 1) and ($xnovo == '1'))
			{
			$vz = $dd[61];
			$data = brtos($dd[7]);
			$tpi = $dd[60];			
			$par = $dd[10];
			for ($dt=1;$dt <= $vz;$dt++)
				{
				if ($vz == 1) { $parc = $dd[10]; } else
				{ $parc = $dt.'/'.$vz; }
				$ndata = $data;
				while ((weekday(stod($ndata)) == 1) or (weekday(stod($ndata)) == 7))
					{ $ndata = DateAdd("d",1,$ndata); }
					$sql = "insert into ".$tabela." (cr_venc,cr_valor,cr_historico,cr_pedido,cr_parcela,cr_doc,cr_status,cr_data,cr_previsao) values ";
					$sql = $sql . "('".$ndata."','".$dd[6]."','".$dd[8]."','".$dd[9]."','".$parc."','".$dd[12]."','A','".date("Ymd")."','".$dd[11]."');";
					$data = DateAdd($tpi,1,$data);
					$rlt = db_query($sql);
					}
			echo 'todos os dados ok';
			?>
			<script>
				close();
			</script>
			<?
			exit;
			}
		if (($ok == 1) and ($xnovo == '0'))
			{
			if (trim($acao) == trim($bb1))
				{ $sql = "update ".$tabela." set cr_status='X' where id_cr = ".$dd[0]; db_query($sql); echo $sql; header("Location: close.php"); exit;}
				if (cp2_gravar()) 	{ echo 'Gravado'; header("Location: close.php"); }
			}
		$nerro = '<font color=red><B>Alguns dados est�o incompletos</B></font>';
	} else {
	////////////////// Coleta de dados
		if ($xnovo == '0')
			{ cp2_gravar(); }
	}
	


?>
<TABLE class="lt1" border="0">
<TR valign="top"><TD><form method="post" action="finan_receber_edit.php">
<TABLE class="lt1">
<?
	for ($k=0;$k<99;$k++)
		{
		if (isset($cp[$k]))
			{
			$tt=$tt."<TR ".coluna().">";
		    $tt=$tt.gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
			$tt=$tt."</TR>";
			}
		}
echo $tt;	
if ($xnovo == '1')
	{
	echo '<TR><TD colspan="2" align="center"><input type="submit" name="acao" value=" g r a v a r "></TD></TR>';
	} else {
	echo '<TR><TD colspan="2" align="center"><input type="submit" name="acao" value=" g r a v a r ">';
	echo '&nbsp;&nbsp;';
	if ($dd[4] == 'A') { echo '<input type="submit" name="acao" value="'.$bb1.'">'; }
	}
?></TABLE>
</TD>
<TD>&nbsp;&nbsp;</TD>
<TD>
<? if ($xnovo == '1') { 
if ($dd[60] == '1') { $chk1="checked"; }
if ($dd[60] == '2') { $chk2="checked"; }
if ($dd[60] == '3') { $chk3="checked"; }
if ($dd[60] == '4') { $chk4="checked"; }
if ($dd[60] == '5') { $chk5="checked"; }
?>
<B>Periodicidade<BR></B>
<BR><input type="radio" name="dd60" value="d" <?=$chk1?>>S� este
<BR><input type="radio" name="dd60" value="d" <?=$chk2?>>todo dia (�til)
<BR><input type="radio" name="dd60" value="w" <?=$chk3?>>toda semana
<BR><input type="radio" name="dd60" value="m" <?=$chk4?>>todo mes
<P>
<B>Lan�ar:</B>
<BR><input type="text" name="dd61" value="<?=$dd[61]?>" size="5" maxlength="5">&nbsp;vez(es).
<? } ?>
</form>
</TD>
</TR>
</TABLE>
<CENTER><?=$nerro?></CENTER>