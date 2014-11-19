<?
require("cab.php");
require($include.'sisdoc_menus.php');
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
array_push($menu,array('Produto','Catalogo Coleção','rel_produto_catalogo_colecao.php')); 
array_push($menu,array('Produto','Código duplicado','rel_produto_duplicado.php')); 
//array_push($menu,array('Estoque','Movimento do estoque','estoque_produto.php')); 
//array_push($menu,array('Ferramentas','Entrada de pecas','balanco.php')); 
//array_push($menu,array('Ferramentas','Balanco relatorio','balanco_relatorio.php')); 
//array_push($menu,array('Ferramentas','Balanco geral','balanco_geral.php')); 
//if ($user_nivel >= 9) { array_push($menu,array('Ferramentas','Ajuste estoque','balanco_produto.php')); }
if ($user_nivel >= 9) { array_push($menu,array('Gráficos','Gráfico Pedidos','pedido_gr_vendas.php')); }

//array_push($menu,array('Representante','Vendedores','vendedor.php')); 
echo menus($menu,3);
require("foot.php");	?>