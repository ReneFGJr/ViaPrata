<?
require("cab.php");
require($include.'sisdoc_menus.php');
$estilo_admin = 'style="width: 250; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
//array_push($menu,array('Representante','Pedido','vendedor_pedido.php')); 
//array_push($menu,array('Representante','Lan�ar pedido venda','orcamento_vendedor_pedido.php')); 
array_push($menu,array('Representante','Cadastro','vendedor.php'));
array_push($menu,array('Representante','Cadastro Inativos','vendedor_inativos.php')); 
array_push($menu,array('Representante','Troca de Representante/Cliente','vendedor_cliente.php')); 
array_push($menu,array('Representante','Extrato Conta Corrente','representante_finan.php')); 
array_push($menu,array('Representante','Relat�rio de Comiss�es','representante_finan_comissao.php')); 
array_push($menu,array('Representante','Relat�rio de Pagamentos/Cliente/Representante','representante_finan_detalhe.php')); 

array_push($menu,array('Representante','Grafico Vendas','representante_gr_vendas.php')); 
//array_push($menu,array('Representante','Resumo estoque','representante_resumo.php')); 

array_push($menu,array('Relat�rio','Cidade/Representante','rel_cidade_cliente.php')); 
array_push($menu,array('Relat�rio','Cliente/Venda','rel_cidade_cliente_vendas.php')); 
array_push($menu,array('Pedidos','Lan�ar Pedido','ped_pedido.php')); 
 
echo menus($menu,3);

require("foot.php");	?>