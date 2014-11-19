<?
require("pdv_cab.php");
require($include."sisdoc_cookie.php");
require("orcamento_cookie_nr.php");
$http_redirect = "pdv_cliente_selecionar.php";
require($include.'sisdoc_colunas.php');
require("cliente_saldo.php");
$tab_max = "100%";
$estilo_admin = 'style="width: 180; height: 50; background-color: #dfdfdf; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$http_edit = "pdv_orcamento_pedido.php";
	/////////////////////////////////////////////////////
	$sql = "select * from orcamento where o_id = ".$pg;
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
		$cliente_codigo = trim($line['o_cliente']);
		$cliente_nome = $line['o_nome'];
		$xlocal = trim($line['o_local']);
		$orc_nr = strzero($line['id_o'],7);
		
		$sql = "select * from orcamento_item where oi_orcamento = '".$orc_nr."'";
		$xrlt = db_query($sql);
		$total = 0;
		$ite = 0;
		$pec = 0;
		while ($xline = db_read($xrlt))
			{
			$vlr = intval($xline['oi_quan']*intval($xline['oi_vlr_unit']*10))/10;
			$total = $total + $vlr;
			$ite++;
			$pec = $pec + $xline['oi_quan'];
			}
		$total_cartao = $total * $pdv_cartao;
		?>
		<TABLE width="<?=$tab_max?>">
		<TR>
		<TD>Cartão R$ <?=number_format($total_cartao,2);?></TD>
		<TD>A Vista (5%) R$ <?=number_format($total,2);?></TD>
		<TD align="right">Orcamento <?=$orc_nr?></TD>
		</TR>
		</TABLE>
		<HR>
		<?
		require("pdv_orcamento_pedido_2.php");
		require('orcamento_pedido_fp.php');
		$sql = "select * from forma_pagamento order by fp_descricao";
		
//		fp_descricao
//		fp_cod
?>
<form method="post" action="pdv_orcamento_pedido.php">
<TABLE width="100%" align="center" border="0">
<?
	echo '<TR><TD>';
	echo '<input type="submit" name="dd1" value="ATUALIZAR" '.$estilo_admin.'>';
	{	
	?>
	<TR><TD class="lt3"><CENTER>Forma pagamento</TD></TR>
	<TR><TD align="center">
	<?
	$sld = saldo_cc($cliente_codigo);
	if ($sld > 0) { echo '<font color="green">'; }
	if ($sld < 0) { echo '<font color="red">'; }
	if ($sld != 0) { echo 'Saldo CC R$ '.number_format($sld ,2); }
	?></TD></TR>
	<?
	$xcol=0;
	$seto = "X";
	$menu = array();
	$sql = "select * from documento_tipo where dt_pedido = 1 order by dt_descricao ";
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
		{
		/////////////////////////////////////////////////// MANAGERS
		array_push($menu,array('Forma de pagamento',trim($line['dt_descricao']),'ocamento_pedido.php?dd0='.$line['dt_codigo'],$line['dt_codigo'],$line['dt_dias'])); 
		}	
	$xcol = 99;
	for ($x=0;$x <= count($menu); $x++)
		{
		if (isset($menu[$x][2]))
			{
			if ($xcol >= 3) { echo '<TR align="center">'; $xcol = 0; }
			echo '<TD align="center">';
			echo '<input type="submit" name="dd1" value="'.CharE($menu[$x][1]).'" '.$estilo_admin.'>';
			echo '</TD>';
			$xcol = $xcol + 1;
			}
		}
	}
	?>
</TABLE></TABLE></FORM>
<?
		}
?>	
<!----

vlr = ( 100 / 105.265 ) 0,95 VLR/(1-por)
( 50% 100-200 ) : 2

------>