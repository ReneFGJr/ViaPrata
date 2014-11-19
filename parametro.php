<?
require("cab.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Representante','Cidade','cidade.php')); 
array_push($menu,array('Representante','Cidade/Atuacao','vendedor_cidade.php')); 
array_push($menu,array('Representante','Vendedores','vendedor.php')); 

if (($user_nivel) >=1) { 
	array_push($menu,array('Cheques','Banco','banco.php')); 
	 array_push($menu,array('Cheques','Status cheque','cheque_status.php')); 
	 array_push($menu,array('Cheques','Moeda','moeda.php')); 
	 array_push($menu,array('Cheques','Moeda/Cotação','moeda_cotacao.php')); 
	}
if (($user_nivel) >=9) { 	 
	 array_push($menu,array('Cheques','Cheque','cheque.php')); 
	array_push($menu,array('Contas Pagar/Receber','Cadastro de contas','contas.php')); 
	array_push($menu,array('Contas Pagar/Receber','Tipos de documentos','documento_tipo.php')); 
	array_push($menu,array('Contas Pagar/Receber','Conta Corrente','cc.php')); 
	array_push($menu,array('Empresa','Empresas','empresa.php')); 
	array_push($menu,array('Produtos','Desconto pecas','desconto.php')); 
    array_push($menu,array('Cheques','Moeda','moeda.php')); 
    array_push($menu,array('Contas Pagar/Receber','Forma de pagmento','documento_tipo.php')); 
	array_push($menu,array('Cadastro','Usuários','user.php')); 
	array_push($menu,array('Cadastro','Feira','feira.php')); 
	 }
array_push($menu,array('Cadastro','Descricao etiqueta','et_etiqueta.php')); 
array_push($menu,array('Cadastro','Fornecedor','fornecedor.php')); 
	 
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
</FONT><FORM method="post" action="<?=$path?>?dd99=admin">
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