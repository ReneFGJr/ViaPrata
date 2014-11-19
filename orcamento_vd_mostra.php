<? ob_start(); ?>
<title>Via Prata - Pedido</title>
<?
global $nocab;
$tabela = "pedido";

require('db.php');
require('security.php');
require('include/sisdoc_data.php');

$user_id = $HTTP_COOKIE_VARS['nw_user'];
$user_nome = $HTTP_COOKIE_VARS['nw_user_nome'];
$user_nivel = $HTTP_COOKIE_VARS['nw_nivel'];
$user_log = $HTTP_COOKIE_VARS['nw_log'];
security();
$tab_max = "98%";
$pedido = sonumero($dd[0]);
if ($pedido == 0) { $npedido = 999999; } else {$npedido = $pedido; }

while (strlen($pedido) < 6) { $pedido = '0'.$pedido; }
?>
<body leftmargin="0" topmargin="0" >
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(img/bg2.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<?
/////////////////////////////////// FINANCEIRO /////////////////
$pedido = sonumero($dd[0]);
if ($pedido == 0) { $npedido = 999999; } else {$npedido = $pedido; }

$sql = "select * from pedido ";
$sql .= "left join feira on feira_codigo = p_local ";
$sql .= "where p_pedido = '".strzero($dd[0],7)."' or p_pedido = ".intval($dd[0]);
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$cliente_nome = $line['p_nome'];
	$cliente_codigo = $line['p_cliente'];
	$valo = $line['p_valor'];
	$desc = $line['p_desconto'];
	$data = $line['p_data'];
	$hora = $line['p_hora'];
	$pedido_desconto = $line['p_desconto'];
	$local_venda = $line['feira_nome'];
	$local_codigo = $line['feira_codigo'];	
	echo '<HR>'.$local_codigo;	
	}
/////////////////////////////////////////////////////
require("cab_pr.php");
/////////////////////////////////////////////////////

$sql = "select * from clientes where cliente_codigo='".$cliente_codigo."'";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$cliente_cnpj = $line['cliente_cpf_cnpj'];
	$cliente_ie = $line['cliente_rg_inscr_estadual'];
	$cliente_fantasia = $line['cliente_nome_fantasia'];
	$cliente_social = $line['cliente_razao_social'];
	$cliente_endereco = $line['cliente_endereco'];
	$cliente_bairro = $line['cliente_bairro'];
	$cliente_cidade = $line['cliente_cidade'];
	$cliente_uf = $line['cliente_estado'];
	$cliente_geral = $line['cliente_email_geral'];
	$cliente_telefone = $line['cliente_telefone'];
	$cliente_codigo = $line['cliente_codigo'];
	}
$item=array();
$sql = "select * from pedido_item ";
$sql .= "inner join produto on pi_codigo = p_codigo ";
$sql .= "where pi_pedido = '".strzero($dd[0],7)."' or pi_pedido = '".intval($dd[0])."'";
$sql .= "order by pi_codigo ";
//echo $sql;
$rlt = db_query($sql);
$pecas = '';
$total = 0;
while ($line = db_read($rlt))
	{
	array_push($item,array($line['pi_codigo'],$line['pi_quan'],$line['pi_vlr_unit'],$line['pi_desconto'],$line['pi_vlr_total'],$line['p_descricao']));
	$peca .= chr(13).chr(10).'<TR>';
	$peca .= '<TD align="center">'.$line['p_codigo'].'</TD>';
	$peca .= '<TD align="left">'.$line['p_descricao'].'</TD>';
	if ($line['p_unidade'] == 'P')
		{
		$peca .= '<TD align="right">'.number_format($line['pi_quan'],1).'</TD>';
		} else {
		$peca .= '<TD align="right">'.number_format($line['pi_quan'],0).'</TD>';
		}
	$peca .= '<TD align="right">'.number_format($line['pi_vlr_unit'],2).'</TD>';
	if ($line['pi_desconto'] > 0)
		{
		$peca .= '<TD align="right">'.number_format($line['pi_desconto'],2).'</TD>';
		} else { $peca .= '<TD>&nbsp;</TD>'; }
	$peca .= '<TD align="right">'.number_format($line['pi_vlr_total']-$line['pi_desconto'] ,2).'</TD>';
	$peca     .= '<TR><TD colspan="10"><img src="img/nada_preto.gif" width="100%" height="1"></TD></TR>';

	$total = $total + $line['pi_vlr_total'] - ($line['pi_desconto']);
	}

$sql = "select * from contas_receber where cr_status <> 'X' and ";
$sql = $sql . " cr_pedido = '".strzero($npedido,7)."'";
$rlt = db_query($sql);

$tot1=0;
$tot2=0;
$sr = '';
$sc = '<TR><TD colspan="10" class="lt2"><B>Informações sobre pagamento</TD></TR>';
$sc .= '<TR bgcolor="#c0c0c0" class="lt0" align="center">';
$sc = $sc . '<TD width="10%">venc.</TD>';
$sc = $sc . '<TD width="10%">valor</TD>';
$sc = $sc . '<TD>histórico</TD>';
$sc = $sc . '<TD width="10%">doc</TD>';
$sc = $sc . '<TD width="8%"><I>status</I></TD>';
$sc = $sc . '</TR>';
while ($line = db_read($rlt))
	{
	$bg = '';
	$venc = intval($line['cr_venc']);
	$hoje = intval(date("Ymd"));
	$status = $line['cr_status'];
	if (($status == 'A') and ($venc < $hoje)) {$bg = 'bgcolor="#ffdddd" '; $tr = ' <font color="#990000">'; $status = 'Atrasado'; }
	if ($status == 'A') {$bg = 'bgcolor="#eaffea" '; $tr = ' <font color="#000000">'; $status = 'Aberto'; }
	if ($status == 'B') { $tr = ' <font color="#006600">'; $status = 'Quitado'; }
	if ($status == 'X') { $tr = ' <font color="#b7b7b7">'; $status = 'Cancelado'; }
	
	$sr = $sr . '<TR '.$bg.'>';
	$sr = $sr . '<TD align="center">'.$tr.stodbr($venc).'</TD>';
	$sr = $sr . '<TD align="right"><B>'.$tr.Number_Format($line['cr_valor'],2).'&nbsp;</TD>';
	$sr = $sr . '<TD>&nbsp;'.$tr.$line['cr_historico'].'</TD>';
	$sr = $sr . '<TD align="center">&nbsp;'.$tr.$line['cr_doc'].'</TD>';
	$sr = $sr . '<TD align="center">'.$tr.$status.'</TD>';
	$tot1 = $tot1 + 1;
	$tot2 = $tot2 + $line['cr_valor'];
	}
	echo $cab;
	
	////////////////////////////////////////////////////////////////
	$cab_ped = '<TABLE cellpadding="1" cellspacing="0" border="0" width="'.$tab_max.'" class="lt2">';
	$cab_ped .= '<TR valign="top"><TD>';
	$cab_ped .= '<TABLE cellpadding="1" cellspacing="0" border="0" width="100%" class="lt1">';
	$cab_ped .= '<TR><TD class="lt0">nome cliente</TD></TR>';
	$cab_ped .= '<TR><TD colspan="6"><B>'.$cliente_nome.'</B></TD></TR>';
	$cab_ped .= '<TR><TD class="lt0">razão social</TD></TR>';
	$cab_ped .= '<TR><TD colspan="6"><B>'.$cliente_razao.'</B></TD></TR>';
	$cab_ped .= '<TR><TD class="lt0">endereço</TD></TR>';
	$cab_ped .= '<TR><TD colspan="4"><B>'.$cliente_endereco.'</B></TD></TR>';

	$cab_ped .= '<TR><TD class="lt0">Bairro</TD>';
	$cab_ped .= '<TD class="lt0">Cidade/UF</TD>';
	$cab_ped .= '<TD class="lt0">CEP</TD>';
	$cab_ped .= '<TR><TD colspan="1"><B>'.$cliente_bairro.'</B></TD>';
	$cab_ped .= '<TD colspan="1"><B>'.$cliente_uf.'</B></TD></TR>';
	$cab_ped .= '<TD colspan="1"><B>'.$cliente_cep.'</B></TD></TR>';

	$cab_ped .= '<TR><TD class="lt0">CNPJ/CPF</TD>';
	$cab_ped .= '<TD class="lt0">IE/RG</TD></TR>';
	$cab_ped .= '<TR><TD colspan="1"><B>'.$cliente_cnpj.'</B></TD>';
	$cab_ped .= '<TD colspan="1"><B>'.$cliente_ie.'</B></TD></TR>';

	$cab_ped .= '</TABLE>';
	$cab_ped .= '<TD width="10%"><fieldset><legend><font class=lt0 ><B>Pedido Nº</font></legend>';
	$cab_ped .= '<FONT class="lt5"><nobr>'.strzero($pedido,5).'</FONT></fieldset>';
	$cab_ped .= "</TABLE>";
	
	echo $cab_ped;
	/////////////////////////////////////////////////////////////////
	if (strlen($peca) > 0)
		{
		$peca_cab = '<TABLE cellpadding="1" cellspacing="0" border="0" width="'.$tab_max.'" class="lt1">';
		$peca_cab .= '<TR bgcolor="#c0c0c0" align="center">';
		$peca_cab .= '<TD>código</TD>';
		$peca_cab .= '<TD>descrição</TD>';
		$peca_cab .= '<TD>quan/peso</TD>';
		$peca_cab .= '<TD>vlr. unitário</TD>';
		$peca_cab .= '<TD>desconto</TD>';
		$peca_cab .= '<TD>vlr. total</TD>';
		$desc = '';
		if ($pedido_desconto > 0)
			{ $desc = 'Desconto '.Number_Format($pedido_desconto,2).'&nbsp;&nbsp;&nbsp;&nbsp;'; }
		$peca     .= '<TR><TD colspan="10"><img src="img/nada_preto.gif" width="100%" height="2"></TD></TR>';
		$peca     .= '<TR><TD colspan="10" align="right">'.$desc.'<B>Total '.Number_Format($total,2).'</B></TD></TR>';
		$peca = $peca_cab. $peca .'</TABLE>';
		echo $peca;
		}
	if (strlen($sc) > 0)
		{
		$sc = '<TABLE cellpadding="1" cellspacing="0" border="0" width="'.$tab_max.'" class="lt0">'.$sc;
		$sc = $sc . $sr . '</TABLE>';
		echo $sc;
		}
?>

