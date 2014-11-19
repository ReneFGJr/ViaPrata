<?
$login= 1;
require("cab.php");
require("include/sisdoc_form2.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/cp2_gravar.php");


$tabela = "banco";
$cp = array();
array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','','Vendedor ',False,True,''));
array_push($cp,array('$B8','','',False,True,''));

if (strlen($dd[0])==0)
	{
	echo '<TABLE width="'.$tab_max.'">' ;
	echo '<TR><TD><FORM method="post" action="rel_cliente_vendedor.php" >';
	echo '<TR><TD><input type="hidden" name="dd99" value="PR">';
	echo gets_fld();
	echo '</FORM></TD></TR>';
	echo '</TABLE>';
	require("foot.php");
	exit;
	}
	
$sql = "select * from clientes where cliente_id_vendedor = '".$dd[0]."' order by cliente_nome ";
$rlt = db_query($sql);

echo '<TABLE width="'.$tab_max.'" class="lt0" cellpadding="0" cellspacing="1">';
echo '<TR><TD colspan="10"><font class=lt5>Cadastro de cliente - '.$dd[0].'</font></TD></TR>';
$tot = 0;
echo '<TR bgcolor="#c0c0c0" align="center" class="lt0"><TD><B>código</B></TD>';
echo '<TD><B>nome</B></TD>';
echo '<TD><B>fantasia</B></TD>';
echo '<TD><B>cnpj/cpf</B></TD>';
echo '<TD><B>ie/rg</B></TD>';
echo '</TR>';

echo '<TR bgcolor="#c0c0c0" align="center" class="lt0"><TD><B> </B></TD>';
echo '<TD><B>endereço</B></TD>';
echo '<TD><B>cep</B></TD>';
echo '<TD><B>cidade</B></TD>';
echo '<TD><B>telefone</B></TD>';
echo '</TR>';
while ($line = db_read($rlt))
	{
	$col = coluna();
	echo '<TR '.$col.'><TD>'.$line['cliente_codigo'];
	echo '<TD>'.$line['cliente_nome'].'</TD>';
	echo '<TD>'.$line['cliente_nome_fantasia'].'</TD>';
	echo '<TD>'.$line['cliente_cpf_cnpj'].'</TD>';
	echo '<TD>'.$line['cliente_rg_inscr_estadual'].'</TD>';

	echo '<TR '.$col.'><TD>';
	echo '<TD>'.$line['cliente_endereco'].'</TD>';
	echo '<TD>'.$line['cliente_cep'].'</TD>';
	echo '<TD><B>'.$line['cliente_cidade'].'</TD>';
	echo '<TD><B>'.$line['cliente_telefone'].'</TD>';
	
	echo '<TR><TD colspan="10" height="1" bgcolor="#c0c0c0"><img src="img/nada_preto.gif" width="100%" height="1" alt="" border="0"></TD></TR>';
	$tot = $tot + 1;
	}
echo '</TABLE>';
echo '<font class=lt2>total de '.$tot.' clientes</font>';
?>