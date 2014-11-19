<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_windows.php');
require('cliente_saldo.php');

$label = "Dados do clientes";
	echo '<TABLE width="'.$tab_max.'">';
	echo '<TR><TD>';
	echo '<font class=lt5>'.$label.'</font>';
	echo '</TD></TR>';
	echo '</TABLE>';
	
	$sql = "select * from clientes where id_cliente = ".$dd[0];
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
		$cliente_codigo = $line['cliente_codigo'];
		echo '<TABLE width="'.$tab_max.'" border="0" class="1t0">';
		echo '<TR><TD align="right" class="1t1">Fantasia';
		echo '<TD colspan="10"><B>'.trim($line['cliente_nome_fantasia']).' ('.trim($cliente_codigo).')</B></TD>';

		echo '<TR><TD align="right">Razão Social';
		echo '<TD colspan="10"><B>'.$line['cliente_razao_social'].'</B></TD>';

		echo '<TR><TD align="right">Contato';
		echo '<TD colspan="10"><B>'.$line['cliente_nome'].'</B></TD>';

		echo '<TR><TD align="right">Endereço';
		echo '<TD colspan="10"><B>'.$line['cliente_endereco'].'</B></TD>';

		echo '<TR>';
		echo '<TD align="right">Bairro';
		echo '<TD><B>'.$line['cliente_bairro'].'</B></TD>';

		echo '<TD align="right">Cidade';
		$estado = trim($line['cliente_estado']);
		if (strlen($estado) > 0) { $estado = ' - '.$estado; }
		echo '<TD><B>'.$line['cliente_cidade'].$estado.'</B></TD>';
		
		echo '<TD align="right">CEP';
		echo '<TD><B>'.$line['cliente_cep'].'</B></TD>';
		
		echo '<TR><TD colspan="10"><HR></TD></TR>';

		echo '<TR><TD align="right">CNPJ/CPF';
		echo '<TD><B>'.$line['cliente_cpf_cnpj'].'</B></TD>';
		echo '<TD align="right">IE/RG';
		echo '<TD><B>'.$line['cliente_rg_inscr_estadual'].'</B></TD>';

		echo '<TR><TD align="right">e-mail';
		echo '<TD colspan="10"><B><A HREF="mailto:'.$line['cliente_email_geral'].'">'.$line['cliente_email_geral'].'</A></B></TD>';

		echo '<TR><TD align="right">Telefones';
		echo '<TD colspan="10"><B>';
		$tel = $line['cliente_telefone'];
		$fax = $line['cliente_fax'];
		$cel = $line['cliente_celular'];
		echo trim($tel).'&nbsp;&nbsp; fax.'.trim($fax).'&nbsp;&nbsp; cel.'.trim($cel);


		$status = $line['cliente_ativo'];
		$inadimplente = $line['cliente_inadimplente'];
		$vip = $line['cliente_vip'];

		echo '<TR><TD align="right">status';
		echo '<TD><B>'.dsp_sn($status);

		echo '<TD align="right">VIP';
		echo '<TD><B>'.dsp_sn($vip);

		echo '<TD align="right">inadimplente';
		echo '<TD><B>'.dsp_sn($inadimplente);

		echo '<TR><TD colspan="10"><HR></TD></TR>';
		echo '<TR><TD align="right">Ultimo pedido';
		$lped = 'sem registro';
		echo '<TD><B>'.$lped;
		
		echo '<TD align="right">Limite crédido';
		echo '<TD><B>'.number_format($line['cliente_limite_credito'],2);

		echo '<TD align="right">Saldo CC';
		echo '<TD><B>'.number_format(saldo_cc($cliente_codigo),2);


if (($user_nivel) >=1) 
		{
		$link = '<a href="cliente_edit.php?dd0='.$line['id_cliente'].'">';
		echo '<TR><TD colspan="10" align="right">'.$link.'<img src="img/icone_editar.gif" width="20" height="19" alt="" border="0">';
		}

		echo '</TABLE>';
		}
require("cliente_pedido.php");
require("cliente_financeiro.php");
require("foot.php");
?>	