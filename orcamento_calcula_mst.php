<font class="lt0">Diversos:<font class=lt3><B><?=number_format($tov,2)?></B></font>
<BR><font class=lt1><B><?=$top?></font></B> peças,&nbsp;
<font class=lt1><B><?=$tot?></font></B> itens
<? if ($cot > 0) { ?>
<BR>Correntes:<font class=lt3><B><?=number_format($cov,2)?></B></font>
<BR><font class=lt1><B><?=$cop?></font></B> g,&nbsp;
<font class=lt1><B><?=$cot?></font></B> itens
<BR><B>TOTAL</B><font class=lt5><?=number_format($total_pedido,2)?>
<? } ?>
