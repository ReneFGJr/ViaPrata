<?
//$login= 1;
require("cab.php");
require("include/cp2_gravar.php");
require("include/sisdoc_form2.php");
require("include/viaprata_funcoes.php");
require("include/sisdoc_data.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_cookie.php");
//$sql = "delete from pedido_vendedor where p_status ='A' ";
//$rlt = db_query($sql);

if ((strlen($acao) ==0) and (strlen($dd[0]) > 0))
	{
	$dd[1]=$dd[0];
	$dd[0]= '';
	}
	$tabela = "pedido_vendedor";
	$cp = array();
	array_push($cp,array('$h8','id_p','',false,True));
	array_push($cp,array('$Q nome:cliente_codigo:select trim(cliente_nome_fantasia) || chr(32) || chr(47) || chr(32) ||trim(cliente_razao_social) as nome,cliente_codigo from clientes where cliente_codigo='.chr(39).$dd[1].chr(39),'p_cliente','Cliente',False,True,''));
	array_push($cp,array('$Q vd_nome:vd_codigo:select * from vendedores where vd_ativo=1 order by vd_nome','p_vendedor','Representante',False,True,''));
	array_push($cp,array('$D8','p_data','Data da venda ',True,True,''));
	array_push($cp,array('$S20','p_orcamento','Nº pedido vendedor ',True,True,''));
	array_push($cp,array('$T70:5','p_obs','Observações ',False,True,''));
	array_push($cp,array('$U8','p_update','Nº pedido vendedor ',True,True,''));
	array_push($cp,array('$U8','p_status',' ',True,True,''));
	$dd[7] = 'A';


	$http_edit = 'orcamento_vendedor_pedido_2.php';
	$http_redirect = 'orcamento_vendedor.php?dd0='.$dd[4];
	echo '<CENTER><FONT CLASS="lt5">Pedido Representante</FONT></CENTER>';	
	?><TABLE width="<?=$tab_max?>" align="center"><TR valign="top"><TD><?
	if (strlen($dd[4]) > 0)
		{
//		$xsql = "delete from pedido_vendedor where p_orcamento = ".intval($dd[4]).'; ';
//		$xsql .= "delete from pedido_vendedor_item where pi_orcamento = ".intval($dd[4]);
//		$xrlt = db_query($xsql);
//	exit;		
		$xsql = "select * from pedido_vendedor where p_orcamento = ".intval($dd[4]);
		$xrlt = db_query($xsql);
		if ($xline = db_read($xrlt))
			{
			if ($xline['p_status'] == 'B')
				{
				echo '<BR><BR><CENTER>';
				echo 'Pedido já lançado '.$dd[5];
				exit;
				} else {
					$dd[0] = $xline['id_p'];
				}
			}
		}
	editar();
	?></TD>
	<TD width="200">
	<?
	///////////////////////////////// pedidos antigos
	$xsql = "select * from pedido_vendedor where p_cliente = '".$dd[1]."'";
	$xrlt = db_query($xsql);
	$rr = '<TABLE border="1" class="lt1" width="100%">';
	$rr .= '<TR><TD class="lt5" colspan="10">Pedidos</TD></TR>';	
	while ($xline = db_read($xrlt))
		{
		$link = '';
		if (trim($xline['p_status'])=='A')
			{
			$link = '<A HREF="orcamento_vendedor.php?dd0='.$xline['p_orcamento'].'">';
			}
		if (trim($xline['p_status'])=='B')
			{
			$link = '<A HREF="orcamento_vendedor_final.php?dd0='.$xline['p_orcamento'].'">';
			}			
		
		$rr .= "<TR>";
		$rr .= '<TD align="center">'.$link.trim($xline['p_orcamento']).'</A>';
		$rr .= '<TD align="right">'.number_format($xline['p_valor'],2);
		$rr .= "<TD align=center >".stodbr($xline['p_data']);
		$rr .= "<TD align=center >".$xline['p_status'];
		$rr .= "</TR>";		
		}
	$rr .= '</TABLE>';	
	echo $rr;
	/////////////////////////////////////////////////
	?>
	</TD>
	
	</TR></TABLE><?	
	?>



<? require("foot.php"); ?>