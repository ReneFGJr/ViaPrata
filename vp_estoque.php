<?
require("cab.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_data.php");

if (strlen($acao) == 0)
	{

	require('include/sisdoc_form2.php');
	require('include/cp2_gravar.php');
	$tabela = "";
	$cp = array();
	$vend = '';

	array_push($cp,array('$H8','','id_vpped',False,True,''));
	array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','','Representante',False,True,''));
//	array_push($cp,array('$B8','','Visualizar',False,True,''));
	echo '<CENTER><Font class="lt5">Total de Estoque</FONT></CENTER>';
	echo '<TABLE width="'.$tab_max.'"><TR><TD>';
	editar();	
	echo '</TABLE>';
	} else {
		$sql = "select es_descricao,vpped_ref,vpped_fornecedor,sum(vpped_quantidade) as saldo ";
		$sql .= "from vp_pedido ";
		$sql .= " left join vp_estoque on vpped_ref = es_ref ";
		$sql .= "where (vpped_fornecedor = '".trim($dd[1])."' ";
		if (trim($dd[1])=='EMPR') { $sql .= "or vpped_fornecedor = '0000' "; }
		$sql .= ") ";
		$sql .= "group by vpped_ref,vpped_fornecedor,es_descricao ";
		$sql .= "order by vpped_fornecedor,vpped_ref ";

		$rlt = db_query($sql);
		echo '<CENTER><Font class="lt5">Total de Estoque '.$dd[1].'</FONT></CENTER>';
		echo '<TABLE width="'.$tab_max.'">';
		echo '<TR align="center" bgcolor="#c0c0c0">';
		echo '<TH><B>Ref.</B>';
		echo '<TH><B>Estoque</B>';
		echo '<TH><B>Quant.</B>';
		echo '<TH><B>Saldo</B>';
		while ($line=db_read($rlt))
			{
			$sld = $line['saldo'];
			if ($sld != 0)
				{
				echo '<TR '.coluna().'><TD align="center">';
				$ref = trim($line['vpped_ref']);
				echo substr($ref,0,2).'.'.substr($ref,2,10);
				echo '<TD>';
				echo $line['es_descricao'];
				echo '<TD align="center">';
				echo $line['vpped_fornecedor'];
				echo '<TD align="right">';
				echo number_format($line['saldo'],2);
				echo '</TD></TR>';
				}
			}
		echo '<TR><TD><a href="vp_estoque_log.php?dd1='.$dd[1].'">log</a></TD></TR>';
	}
echo '</TABLE>';

require("foot.php");
?>