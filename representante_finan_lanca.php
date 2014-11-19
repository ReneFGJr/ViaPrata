<? ob_start(); ?>
<title>Via Prata - Gestor comercial</title>
<?

global $nocab;
$tabela = "contas_representante";

require('db.php');
require('security.php');
require('include/sisdoc_form2.php');
require('include/sisdoc_data.php');
require('include/cp2_gravar.php');
require('include/sisdoc_colunas.php');

//$sql = "ALTER TABLE ".$tabela." ADD COLUMN cr_ref char(10)";
//$rlt = db_query($sql);

$user_id = $HTTP_COOKIE_VARS['nw_user'];
$user_nome = $HTTP_COOKIE_VARS['nw_user_nome'];
$user_nivel = $HTTP_COOKIE_VARS['nw_nivel'];
$user_log = $HTTP_COOKIE_VARS['nw_log'];
$bb1 = 'e x c l u i r';
security();

if ($acao == $bb1)
	{ $sql = "update ".$tabela." set cr_status='X' where id_cr = ".$dd[0]; db_query($sql); echo $sql; header("Location: close.php"); exit;}
?>
<body leftmargin="0" topmargin="0" >
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(img/bg2.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<CENTER>
<FONT class="lt5">Conta Corrente Representante</FONT>
<?
if (strlen(trim($dd[0])) > 0) { $xnovo = '0'; } else { $xnovo = '1'; }
	
$cp = array();
array_push($cp,array('$H4','id_cr','cod',False,True,''));
array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','cr_cliente','Representante',False,True,''));
array_push($cp,array('$H8','cr_tipo','Tipo documento',False,True,''));
array_push($cp,array('$H8','cr_dt_quitacao','Dt.Quitação',False,True,''));
array_push($cp,array('$H1','cr_status','A',False,True,''));
array_push($cp,array('$H1','cr_img','Img',False,True,''));

array_push($cp,array('$N10','cr_valor','valor',True,True,''));
array_push($cp,array('$N10','cr_peso','peso',True,True,''));
array_push($cp,array('$S10','cr_ref','Ref.Peça (quando peso)',False,True,''));
array_push($cp,array('$D8','cr_venc','Dt. lançamento',True,True,''));
array_push($cp,array('$S80','cr_historico','histórico',True,True,''));
array_push($cp,array('$S10','cr_pedido','pedido',True,True,''));
array_push($cp,array('$S10','cr_parcela','parcela',True,True,''));
array_push($cp,array('$O 0:Não&1:SIM','cr_previsao','Previsão',True,True,''));
array_push($cp,array('$S10','cr_doc','nr. doc.',False,True,''));
array_push($cp,array('$H8','cr_empresa','Empresa',False,True,''));
array_push($cp,array('$Q ct_descricao:ct_codigo:select * from contas_tipo where ct_ativo=1 and ct_tipo=3','cr_conta','Tipo',False,True,''));

if (strlen($dd[4]) ==0) { $dd[4] = 'A'; }
if (strlen($dd[6]) ==0) { $dd[6] = '0.00'; }
if (strlen($dd[7]) ==0) { $dd[7] = '0.00'; }
if (strlen($dd[3]) ==0) { $dd[3] = '19000101'; }
if (strlen($dd[9]) ==0) { $dd[9] = date("d/m/Y"); }
if (strlen($dd[9]) ==8) { $dd[9] = stodbr($dd[7]); }

	$tab_max = 350;
	$http_edit = 'representante_finan_lanca.php';
	$http_redirect = 'close.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE>
<?
if (strlen($dd[0]) > 0)
	{	
	echo '<FORM method="post" action="'.$http_edit.'">';
	echo '<input type="submit" name="acao" value="'.$bb1.'">';
	echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
	echo '</form>';
	}
	