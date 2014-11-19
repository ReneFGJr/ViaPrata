<?
require("cab.php");
$estilo_admin = 'style="width: 250; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
//array_push($menu,array('Representante','Pedido','vendedor_pedido.php')); 
//array_push($menu,array('Representante','Lançar pedido venda','orcamento_vendedor_pedido.php')); 
array_push($menu,array('Representante','Cadastro','vendedor.php')); 
array_push($menu,array('Representante','Troca de Representante/Cliente','vendedor_cliente.php')); 
array_push($menu,array('Representante','Extrato Conta Corrente','representante_finan.php')); 
array_push($menu,array('Representante','Relatório de Comissôes','representante_finan_comissao.php')); 
array_push($menu,array('Representante','Relatório de Pagamentos/Cliente/Representante','representante_finan_detalhe.php')); 

array_push($menu,array('Representante','Grafico Vendas','representante_gr_vendas.php')); 
//array_push($menu,array('Representante','Resumo estoque','representante_resumo.php')); 

array_push($menu,array('Relatório','Cidade/Representante','rel_cidade_cliente.php')); 
array_push($menu,array('Relatório','Cliente/Venda','rel_cidade_cliente_vendas.php')); 
array_push($menu,array('Pedidos','Lançar Pedido','ped_pedido.php')); 
 
///////////////////////////////////////////////////// redirecionamento
if ((isset($dd[1])) and (strlen($dd[1]) > 0))
	{
	$col=0;
	for ($k=0;$k <= count($menu);$k++)
		{
		 if ($dd[1]==CharE($menu[$k][1])) {	header("Location: ".$menu[$k][2]); } 
		}
	}
?>
<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="vendedores.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?
$xcol=0;
$seto = "X";
for ($x=0;$x <= count($menu); $x++)
	{
	if (isset($menu[$x][2]))
		{
			
			{
			$xseto = $menu[$x][0];
			if (!($seto == $xseto))
				{
				echo '<TR><TD colspan="10">';
				echo '<TABLE width="100%" cellpadding="0" cellspacing="0">';
				echo '<TR><TD class="lt3" width="1%"><NOBR><B><font color="#C0C0C0">'.$xseto.'&nbsp;</TD>';
				echo '<TD><HR width="100%" size="2"></TD></TR>';
				echo '</TABLE>';
				echo '<TR class="lt3">';
				$seto = $xseto;
				$xcol=0;
				}
			}
		if ($xcol >= 3) { echo '<TR><TD><img src="'.$img_dir.'nada.gif" width="1" height="5" alt="" border="0"></TD><TR>'; $xcol=0; }
		echo '<TD align="center">';
		echo '<input type="submit" name="dd1" value="'.CharE($menu[$x][1]).'" '.$estilo_admin.'>';
		echo '</TD>';
		$xcol = $xcol + 1;
		}
	}
?>
</TABLE></FORM>
<? require("foot.php");	?>