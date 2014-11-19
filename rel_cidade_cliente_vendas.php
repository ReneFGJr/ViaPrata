<?
$debug = false;
require("cab.php");
require('include/sisdoc_colunas.php');
require($include.'sisdoc_data.php');
if (strlen($acao)==0)
	{

	require('include/sisdoc_form2.php');
	require('cp/cp_rel_cidade_representante.php');
	array_push($cp,array('$B8','','Listar',False,True,''));
	require($include.'cp2_gravar.php');
	$http_redirect = 'rel_cidade_cliente_vendas.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	} else {
		$tot = 0;
		$sql = "select * from clientes ";
		$sql .= " left join ( ";
		
		$sql .= " select 1 as ped, p_valor as total, p_data as data,p_cliente ";
		$sql .= " from pedido ";
//		$slq .= " p_data >= "
//		$sql .= " group by p_cliente";
		
		$sql .= ") as pedidos on cliente_codigo = p_cliente ";
		$sql .= " where cliente_id_vendedor = '".$dd[1]."' ";
		$sql .= " order by asc7(upper(cliente_cidade)), cliente_nome, data desc ";
//		$sql .= 'limit 20';
		
		$rlt = db_query($sql);
		$s = '';
		$sc .= '<TR align="center" bgcolor="#c0c0c0">';
		$sc .= '<TH>COD';
		$sc .= '<TH>Nome';
		$sc .= '<TH>Fantasia';
		$sc .= '<TH>CNPJ/CPF - IE/RG';
		$sc .= '<TH>CEP';

		$sc .= '<TR align="center" bgcolor="#c0c0c0">';
		$sc .= '<TH>';
		$sc .= '<TH>Endereço';
		$sc .= '<TH>Cidade';
		$sc .= '<TH>Fones';
		$sc .= '<TH>Repres.';
		
		$s .= $sc;
		$CID = "XX";
		$clie = "XX";
		while ($line = db_read($rlt))
			{
			if ($clie != $line['cliente_nome'])
				{
				$clie = $line['cliente_nome'];
				$cida = trim($line['cliente_cidade']);
				$link = '<A HREF="cliente_edit.php?dd0='.$line['id_cliente'].'" target="news'.date("mid").'">';
				$col = coluna();
				$tot++;
				$tp = trim($line['cliente_tipo_pessoa']);
				
				if (UpperCaseSQL($cida) != $CID)
					{
					$CID = UpperCaseSQL($cida);
					$s .= '<TR><TD colspan="10" class="lt5">'.$CID.'</TD></TR>';
					}
				$s .= '<TR '.$col.'>';
				$s .= '<TD>'.$link;
				$s .= strzero(intval($line['cliente_codigo']),4);
				$s .= '<TD>';
				$s .= '<B>'.$line['cliente_nome'];
				$s .= '<TD>';
				$s .= $line['cliente_nome_fantasia'];
				$s .= '<TD class="lt0">';
				$s .= $line['cliente_cpf_cnpj'];
				$sw = trim($line['cliente_rg_inscr_estadual']);
				if (strlen($sp) > 0)
					{
					if ($tp == 'F')
						{ $s .= '&nbsp;&nbsp;RG '.$sw; } else
						{ $s .= '&nbsp;&nbsp;I.E. '.$sw; }
					}
				$s .= '<TD><NOBR>';
				$scep = sonumero($line['cliente_cep']);
				if (strlen($scep) == 8)
					{ $s .= substr($scep,0,2).'.'.substr($scep,2,3).'-'.substr($scep,5,3); }
				$s .= '<TR '.$col.' valign="top">';
				$s .= '<TD>';
				$s .= '<TD>';
				$s .= $line['cliente_endereco'];
				$s .= '<TD>';
				$s .= trim($line['cliente_cidade']);
				$sp = trim($line['cliente_estado']);
				if (strlen($sp) > 0)
					{ $s .= ' - '.$sp; }
				$s .= '<TD colspan="1"><B><NOBR>';
				$s1 = trim($line['cliente_telefone']);
				$s2 = trim($line['cliente_fax']);
				$s3 = trim($line['cliente_celular']);
				if (strlen($s1) > 0) { $s .= $s1; }
				if (strlen($s2) > 0) { $s .= ' fax.'.$s2; }
				if (strlen($s3) > 4) { $s .= '<BR>cel.'.$s3; }
				$s .= '<TD class="lt0">';
				$s .= $line['cliente_id_vendedor'];
				
				if ($line['ped'] > 0)
					{
					$s .=  '<TR '.$col.' valign="top">';
					$s .=  '<TD><TD colspan="3"><font color="organge">';
					$s .=  '('.$line['ped'].' pedido(s), valor total de ';
					$s .= number_format($line['total'],2);
					$s .= ') último pedido em '.stodbr($line['data']);
					}
				
				$s .= '<TR><TD colspan="10"><HR></TD></TR>';
				}
			}
		}
echo '<CENTER><font class="lt5">Relatório por Cidade</font></CENTER>';
$s = '<TABLE class="lt1" width="'.$tab_max.'">'.$s;
$s .= '<TR><TD colspan="10">Total de <B>'.$tot.'</B> clientes</TD></TR>';
$s .= '</TABLE>';
echo $s;
require("foot.php");
?>
