<?
//$login= 1;
require("cab.php");
require("include/cp2_gravar.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_cookie.php");

$tabela = "";
$cp = array();
$vend = '';
	
$dd0 = read_cookie("ped0");
$dd1 = read_cookie("ped1");
$dd2 = read_cookie("ped2");
$dd3 = read_cookie("ped3");
$dd4 = read_cookie("ped4");
$dd5 = read_cookie("ped5");
$dd6 = read_cookie("ped6");
$dd7 = read_cookie("ped7");
$dd8 = read_cookie("ped8");
$total_pedido = read_cookie("total");

echo '<TABLE width="'.$tab_max.'"><TR><TD>';
echo '<BR>Cliente:<B>'.$dd1.' '.$dd6.' / '.$dd7.'</B>';
echo '<BR>Vendedor:'.$dd2;
echo '<BR>Pedido:'.$dd3;
echo '<BR>Data:'.$dd4;
echo '<BR>'.$dd5;
echo '&nbsp;&nbsp;&nbsp;&nbsp;Total do pedido: <B>'.Number_format($total_pedido,2);
echo '<TD align="right"><form method="post" action="ped_pedido_pagamento.php"><input type="submit" name="xxx" value="atualizar"></form></TD>';
echo '<TD align="right"><form method="post" action="ped_pedido_3.php"><input type="submit" name="voltar" value="voltar"></form></TD>';
echo '<TR><TD colspan="10"><HR></TD></TR>';
echo '</TABLE>';

$sql = "select * from forma_pagamento where fp_ativo = 1 ";
$rlt = db_query($sql);

$cpf = array();
while ($line = db_read($rlt))
	{
	array_push($cpf,array(strtolower(trim($line['fp_cod'])),$line['fp_descricao']));
	}
echo '<TABLE width="'.$tab_max.'">';
echo '<TR align="center">';
$col = 0;
for ($k=0;$k < count($cpf);$k++)
	{
	$col++;
	if ($col > 4) { echo '<TR align="center">'; $col = 0; }
	$link = '<a href="ped_pedido_pagamento.php?dd1='.$cpf[$k][0].'">';
	echo '<TD>';
	echo $link;
	echo '<img src="img/pg_'.$cpf[$k][0].'.jpg" width="150" height="64" alt="" border="0">';
	echo '</A>';
	}
echo '</TABLE>';

require("ped_pedido_finan.php");

if (strlen($dd[1]) > 0)
	{
	require("ped_pedido_pagamento_".$dd[1].".php");
	}
	
//if ($saldo != 0)
	{
	$fcor = '<font color="red">';
	if ($saldo > 0)
		{
		$fcor = '<font color="green">';
		}
	echo '<font class="lt4">'.$fcor.'Saldo '.number_format($saldo,2).'</font>';
	}
	echo '<BR><BR>';
	require("ped_finalizar_gravar.php");	// -- nao gera valor do extrato
?>



<? require("foot.php"); ?>