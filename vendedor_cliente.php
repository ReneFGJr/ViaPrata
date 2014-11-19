<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Indicar Representante / Cliente";
$bb2=" setar para representante ";
if (trim($acao) == 'setar para representante')
	{
		$sql = " select id_cliente from clientes ";
		echo $sql;
		$rlt = db_query($sql);
		while ($line = db_read($rlt))
			{
				$ps = 'chk'.trim($line['id_cliente']);
				$vr = trim($_POST[$ps]);
				if ($vr=='1')
					{
					$sql = "update clientes set 
							cliente_id_vendedor = '".$dd[8]."'
							where id_cliente = ".$line['id_cliente'];
					$rrr = db_query($sql);
					
					}
			}	
	} 
echo '<form method="post" action="vendedor_cliente.php">';
if ($user_nivel > 0)
	{	
	$http_edit = 'cliente_edit.php'; 
	$editar = false;
	}
	$http_redirect = 'vendedor_cliente.php';
	$http_ver = 'cliente_ver.php';
//	$http_ver = 'sistema.php';
	$tabela = "(clientes left join vendedores on vd_codigo = cliente_id_vendedor) as cliene ";
	$cdf = array('id_cliente','id_cliente','cliente_nome_fantasia','cliente_razao_social','cliente_nome','vd_nome','cliente_cep','cliente_cidade','cliente_estado');
	$cdm = array('Código','ch','Nome fantasia','Razao social','Nome/contato','Representante','Cep','Cidade','UF');
	$masc = array('','CB','B','','','SHORT','CEP','@');
	$busca = true;
	$offset = 200;
	$order = "vd_nome,cliente_nome_fantasia";
	$pre_where = " (cliente_ativo = 'S') ";

	require('include/sisdoc_row.php');
	
	$sql = "select * from vendedores order by vd_nome ";
	$rlt = db_query($sql);
	echo 'Representante : ';
	echo '<select name="dd8">';
	while ($line = db_read($rlt))
		{
		echo chr(13).chr(10).'<option value="'.trim($line['vd_codigo']).'">'.trim($line['vd_nome']).'</option>';
		}
	echo '</select>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<input type="submit" name="acao" value="'.$bb2.'">';
require("foot.php");
?>	