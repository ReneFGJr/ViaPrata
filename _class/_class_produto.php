<?php
class produto {
	function mostra_imagem($line) {
		$sx = '';
		$img = trim($line['p_codigo']);
		$codigo = trim($line['p_codigo']);
		$codfor = trim($line['p_fornecedor_codigo']);
		$descricao = trim($line['p_descricao']);
		$preco = trim($line['p_preco_sugerido']);
		$custo = trim($line['p_preco']);
		$peso = trim($line['p_peso']);
		$link = '<A HREF="produto_edit.php?dd0=' . $line['id_p'] . '" target="editar">';
		$sx .= '<IMG SRC="/img/produto/' . $img . '_01.jpg" width="281">';
		$sx .= '<BR>' . $link . '<font class=lt2>Cod. ' . $codigo . ' ' . $codfor . '</font></A>';
		$sx .= '<BR><B>' . $descricao . '</B>';
		$sx .= '<BR><B>(R$ ' . number_format($preco, 2) . ')</B>&nbsp;&nbsp;(R$ ' . number_format($custo, 2) . ')&nbsp;&nbsp;(' . number_format($peso, 2) . 'g)';
		$sx .= '<BR><font class="lt0">Atualizado em: ' . stodbr($line['p_lastupdate']) . '</font>';
		return($sx);
	}

}
