<?
require("cab.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_data.php");

		$sql = "select vpped_data,es_descricao,vpped_ref,vpped_fornecedor,vpped_quantidade as saldo,vpped_pedido ";
		$sql .= "from vp_pedido ";
		$sql .= " left join vp_estoque on vpped_ref = es_ref ";
		$sql .= "where (vpped_fornecedor = '".trim($dd[1])."' ";
		if (trim($dd[1])=='EMPR') { $sql .= "or vpped_fornecedor = '0000' "; }
		$sql .= ") ";
//		$sql .= "group by vpped_ref,vpped_fornecedor,es_descricao ";
		$sql .= "order by vpped_data desc,vpped_ref ";

		$rlt = db_query($sql);
		echo '<CENTER><Font class="lt5">Total de Estoque '.$dd[1].'</FONT></CENTER>';
		echo '<TABLE width="'.$tab_max.'">';
		echo '<TR align="center" bgcolor="#c0c0c0">';
		echo '<TH><B>Ref.</B>';
		echo '<TH><B>Data</B>';
		echo '<TH><B>Estoque</B>';
		echo '<TH><B>Quant.</B>';
		echo '<TH><B>Pedido</B>';
		echo '<TH><B>Saldo</B>';
		while ($line=db_read($rlt))
			{
			$sld = $line['saldo'];
			if ($sld != 0)
				{
				$link = '<A HREF="javascript:newxy2(\'pedido_vd_mostra.php?dd0='.$line['vpped_pedido'].'\',600,450);">';
				echo '<TR '.coluna().'><TD align="center">';
				$ref = trim($line['vpped_ref']);
				echo substr($ref,0,2).'.'.substr($ref,2,10);
				echo '<TD>';
				echo stodbr($line['vpped_data']);
				echo '<TD>';
				echo $line['es_descricao'];
				echo '<TD align="center">';
				echo $line['vpped_fornecedor'];
				echo '<TD align="center">';
				echo $link.$line['vpped_pedido'];
				echo '<TD align="right">';
				echo number_format($line['saldo'],2);
				echo '</TD></TR>';
				}
			}
echo '</TABLE>';

require("foot.php");
?>