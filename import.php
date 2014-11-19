<? 
set_time_limit(400);
require('cab.php'); ?>

<TABLE width="704" align="center">
<TR><TD><form method="post"></TD></TR>
<TR><TD><textarea cols="60" rows="10" name="dd1" wrap="off"><?=$dd[1];?></textarea></TD></TR>
<TR><TD><input type="submit" name="analisar"></TD></TR>
<TR><TD></form></TD></TR>
</TABLE>

<?
if (strlen($dd[1]) > 0)
	{
	$d = $dd[1];
	$d = $d . chr(13);
	while (strpos($d,chr(13)) > 0)
		{
		$pos = strpos($d,chr(13));
		$ln = substr($d,0,$pos-1);
		$d = substr($d,$pos+1,strlen($d));
//		echo '<HR>'.$ln;
		echo '<HR>';
		///////////////////////////////////
		$aa = split(';',$ln);
		$protocol = intval("0".trim($aa[0]));
		$versao  = intval("0".trim($aa[1]));
		$fr  = trim($aa[2]);
		$caae = trim($aa[3]);
		$data = trim($aa[4]);
		$titulo = trim($aa[5]);
		$pesquisador = trim($aa[6]);
		$endereco = trim($aa[7]);
		$conhecimento = trim($aa[8]);
		$grupo = trim($aa[9]);
		$local = trim($aa[10]);
		$relator = trim($aa[11]);
		$status = trim($aa[12]);
		$parecer = trim($aa[13]);
		
//		echo '--'.$aa[0];
		if ($protocol > 3)
			{
			echo '<BR>Protocolo : '.$protocol;
			echo '<BR>Versão : '.$versao;
			echo '<BR>FR : '.$fr;
			echo '<BR>CAAE : '.$caae;
			echo '<BR>Data : '.$data;
			echo '<BR>Projeto de pesquisa : '.$titulo;
			}
			
		if (strlen($protocol) > 3)
			{
			$sql = "select * from produto where p_codigo = '".$protocol."'";
			$rlt = db_query($sql);
			
			if (!($line = db_read($rlt)))
				{
				$fr = strtoupper(substr($fr,0,1)).strtolower(substr($fr,1,100));
				$sql = "insert into produto (p_codigo,p_fornecedor_codigo,p_descricao,p_preco,p_peso,p_preco_sugerido) values ";
				$sql = $sql . "('".($protocol)."','".$versao."','".$fr."','".$caae."','".$data."','".$titulo."')";
				echo $sql;
				$rrr = db_query($sql);
				$sql = "select * from produto where upper(asc7(p_codigo)) = upper(asc7('".$protocol."'))";
				$rlt = db_query($sql);
				} else {
				$pesquisador_cod = $line['p_codigo'];
				}
			}
		echo '<BR>codigo pesquisador: '.$protocol;
		}
	}
	echo '<BR>==========FIM DO PROCESSO DE IMPORTAÇÃO==========';