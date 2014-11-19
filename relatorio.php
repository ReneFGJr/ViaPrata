<?
require("cab.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Cliente','Cliente / Vendedor','rel_cliente_vendedor.php')); 
array_push($menu,array('Cliente','Sedex','rel_cliente_sedex.php')); 
//array_push($menu,array('Cliente','Maleta','rel_cliente_maleta.php')); 
//array_push($menu,array('Cliente','Devolução items','cliente_devolucao.php')); 
array_push($menu,array('Produto','Peças Imagem','rel_produto_peca.php')); 
array_push($menu,array('Produto','Codigo / Imagem','rel_produto_peca_codigo.php')); 
array_push($menu,array('Produto','Catalogo','rel_produto_catalogo.php')); 
array_push($menu,array('Produto','Código duplicado','rel_produto_duplicado.php')); 
//array_push($menu,array('Estoque','Movimento do estoque','estoque_produto.php')); 
//array_push($menu,array('Ferramentas','Entrada de pecas','balanco.php')); 
//array_push($menu,array('Ferramentas','Balanco relatorio','balanco_relatorio.php')); 
//array_push($menu,array('Ferramentas','Balanco geral','balanco_geral.php')); 
//if ($user_nivel >= 9) { array_push($menu,array('Ferramentas','Ajuste estoque','balanco_produto.php')); }
if ($user_nivel >= 9) { array_push($menu,array('Gráficos','Gráfico Pedidos','pedido_gr_vendas.php')); }

//array_push($menu,array('Representante','Vendedores','vendedor.php')); 

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
</FONT><FORM method="post" action="relatorio.php">
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