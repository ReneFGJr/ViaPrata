<?
header("Content-type: application/xml");
require("db.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Cadastro de produto";
	$tabela = "produto";
	$cdf = array('id_p','p_descricao','p_codigo','p_preco_sugerido','p_peso');
	$cdm = array('id','descricao','codigo','preco','peso');
	$masc = array('','','','N','N','N');
	$order = ' p_lastupdate desc ';
	$pre_where = " where (p_ativo = 1) ";
	
	$sql = "select * from ".$tabela.$prewhere;
	$rlt = db_query($sql);
	$crnf = chr(13).chr(10);
	echo '<?xml version="1.0" encoding="UTF-8"?>'.$crnf;
	echo '<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">';
	echo '<responseDate>'.date("Y-m-d").'T'.date('h:i:s').'</responseDate>'.$crnf;
	while ($line = db_read($rlt))
		{
		echo '<produto>'.$crnf;
		for ($r=0;$r < count($cdf);$r++)
			{
			$fld = utf8_encode(trim($cdm[$r]));
			if ($masc[$r] == 'N') 
				{ $con = (intval($line[$cdf[$r]]*100)); } 
			else 
				{ $con = utf8_encode(trim($line[$cdf[$r]])); $con = (trim($line[$cdf[$r]])); }
			echo '<'.$fld.'>';
			echo $con;
			echo '</'.$fld.'>'.$crnf;
			}
		echo '</produto>'.$crnf;
		}
	echo '</OAI-PMH>';
?>