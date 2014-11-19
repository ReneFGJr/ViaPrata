<?
header("Content-type: application/xml");
require("db.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Cadastro de produto";
	$tabela = "clientes";
	$cdf = array('id_cl','cliente_nome','cliente_cpf_cnpj','cliente_rg_inscr_estadual','cliente_codigo','cliente_endereco','cliente_bairro','cliente_cep','cliente_cidade','cliente_nome_fantasia','cliente_telefone','cliente_fax','cliente_celular','cliente_email_geral','cliente__email_alt');
	$cdm = array('id','nome','cpf','rg','codigo','endereco','bairro','cep','cidade','fantasia','fone1','fone2','fone3','email','email_alt');
	$masc = array('','','','','D');
	$order = ' ';
//	$pre_where = " where (cl_ativo = 1) limit 20 ";
	
	$sql = "select * from ".$tabela.$prewhere;
	$rlt = db_query($sql);
	$crnf = chr(13).chr(10);
	echo '<?xml version="1.0" encoding="UTF-8"?>'.$crnf;
	echo '<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">';
	echo '<responseDate>'.date("Y-m-d").'T'.date('h:i:s').'</responseDate>'.$crnf;
	while ($line = db_read($rlt))
		{
		echo '<cliente>'.$crnf;
		for ($r=0;$r < count($cdf);$r++)
			{
			$fld = trim($cdm[$r]);
			$con = trim($line[$cdf[$r]]);
			echo '<'.$fld.'>';
			echo $con;
			echo '</'.$fld.'>'.$crnf;
			}
		echo '</cliente>'.$crnf;
		}
	echo '</OAI-PMH>';
?>