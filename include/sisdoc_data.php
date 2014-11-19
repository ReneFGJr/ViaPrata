<?
/**
* Esta classe é a responsável pela conexão com o banco de dados.
* @author Rene F. Gabriel Junior <rene@sisdoc.com.br>
* @version 0.0i
* @copyright Copyright © 2011, Rene F. Gabriel Junior.
* @access public
* @package BIBLIOTECA
* @subpackage sisdoc_data
*/
///////////////////////////////////////////
// Versão atual           //    data     //
//---------------------------------------//
// 0.0i						  03/11/2010 // Função DiffDataDias
// 0.0h                       05/02/2009 // Função StoUS
// 0.0g                       05/02/2009 // Função DateDiff
// 0.0f                       25/07/2008 //
// 0.0e                       19/02/2008 //
// 0.0d                       23/01/2008 //
// 0.0c                       17/01/2008 //
// 0.0b                       27/08/2007 //
// 0.0a                       09/08/2007 //
///////////////////////////////////////////
if ($mostar_versao == True) {array_push($sis_versao,array("sisDOC (Data/Hora)","0.0h",20100314)); }
if (strlen($include) == 0) { exit; }
if (strlen($sisdoc_data) == 0)
{
$sisdoc_data = True;
/*
 * Função que Calcula diferenças de datas em dias.
 * @param int[] $idUsuario Array com os Id's do usuários.
*/
function DiffDataDias($ddf,$ddi)
	{
	$ddano = intval("0".substr($ddi,0,4));
	$ddmes = intval("0".substr($ddi,4,2));
	$dddia = intval("0".substr($ddi,6,2));
	$ddr=mktime(0,0,0,$ddmes,$dddia,$ddano);
	
	$ddano = intval("0".substr($ddf,0,4));
	$ddmes = intval("0".substr($ddf,4,2));
	$dddia = intval("0".substr($ddf,6,2));
	$dds=mktime(0,0,0,$ddmes,$dddia,$ddano);
	
	$dias = (($ddr-$dds)/(24*60*60));
	return($dias);
	}

function DateDif($dtt1,$dtt2,$tpd)
	{
	$date_ddt1   = mktime (0, 0, 0, substr($dtt1,4,2)  , substr($dtt1,6,2), substr($dtt1,0,4));	
	$date_ddt2   = mktime (0, 0, 0, substr($dtt2,4,2)  , substr($dtt2,6,2), substr($dtt2,0,4));	
//	echo '<BR>=ddt1==> ';
//	echo $date_ddt1.','.$dtt1;
//	echo '<BR>=ddt2==> ';
//	echo $date_ddt2.','.$dtt2;
//	echo '<BR>===>'.($date_ddt2 - $date_ddt1);
//	echo '<BR>=TIPO=>'.$tpd;
//	echo '<BR>';
	$rst = ($date_ddt2 - $date_ddt1);
	if ($tpd == 'y') { $rst = intval($rst / (60 * 60 * 24 * 365)); }
	if ($tpd == 'm') { $rst = intval($rst / (60 * 60 * 24 * 30)); }
	if ($tpd == 'w') { $rst = intval($rst / (60 * 60 * 24 * 7)); }
	if ($tpd == 'd') { $rst = intval($rst / (60 * 60 * 24)); }
	if ($tpd == 'h') { $rst = intval($rst / (60 * 60)); }
	if ($tpd == 'm') { $rst = intval($rst / (60)); }
	if ($tpd == 's') { $rst = intval($rst / 1); }
	return($rst);
	}
	
function calcmeses($df1,$df2)
	{
	$dxm = substr($df1,4,2);
	$dxa = substr($df1,0,4);
	$dym = substr($df2,4,2);
	$dya = substr($df2,0,4);
	
	while (($dxa*100+$dxm) <= ($dya*100+$dym))
		{
//		echo '<BR>'.($dxa*100+$dxm).'=='.($dafim*100+$dmfim).', '.$meses;
		$dxm = intval($dxm) + 1;
		if ($dxm > 12)
			{ $dxa++; $dxm = 1; }
		$dxm = strzero($dxm,2);
		$meses = $meses + 1;
		}
	return($meses);
	}
	
function htom($dds)
	{
	if (strpos($dds,':') > 0)
		{
		$_hora = substr($dds,0,strpos($dds,':'));
		$_minu = substr($dds,strpos($dds,':')+1,strlen($dds));
		} else {
		$_hora = substr($dds,0,strlen($dds)-2);
		$_minu = substr($dds,strlen($dds)-2,2);
		}
	$tmp = intval("0".$_hora)*60;
	$tmp = $tmp + intval("0".$_minu);
//	echo '<BR>===>'.$_hora.':'.$_minu;
	return($tmp);
	}
 
function mtoh($dds) 
	{
	$hora = 0;
	$minu = intval('0'.$dds);
	if ($minu >= 60)
		{ $hora = intval($minu / 60); $minu = $minu - ($hora * 60); }
	if (strlen($minu) < 2) { $minu = '0'.$minu; }
	if (strlen($hora) < 2) { $hora = '0'.$hora; }
	return($hora.':'.$minu);
	}
function stod($dds)
	{
	$ddt = mktime(0, 0, 0, substr($dds,4,2),substr($dds,6,2) , substr($dds,0,4));
	return($ddt);
	}
	
function weekday($dds)
	{
	$ddt = date('l',$dds);
	$dda = array('Sunday'=>1,'Monday'=>2,'Tuesday'=>3,'Wednesday'=>4,'Thursday'=>5,'Friday'=>6,'Saturday'=>7);
	return($dda[$ddt]);
	}

function nomedia($dds)
	{
	if ($dds == 1) { $ddt = 'Domingo'; }
	if ($dds == 2) { $ddt = 'Segunda-feira'; }
	if ($dds == 3) { $ddt = 'Terça-feira'; }
	if ($dds == 4) { $ddt = 'Quarta-feira'; }
	if ($dds == 5) { $ddt = 'Quinta-feira'; }
	if ($dds == 6) { $ddt = 'Sexta-feira'; }
	if ($dds == 7) { $ddt = 'Sábado'; }
	return($ddt);
	}
function DateAdd($ddf,$ddi,$ddt)
	{
	$ddano = intval("0".substr($ddt,0,4));
	$ddmes = intval("0".substr($ddt,4,2));
	$dddia = intval("0".substr($ddt,6,2));
	$ddr=mktime(0,0,0,1,1,1900);
	if ($ddf == 'd')
		{
		$ddt=mktime(0,0,0,$ddmes,$dddia+$ddi,$ddano);
		}
	if ($ddf == 'w')
		{
		$ddt=mktime(0,0,0,$ddmes,$dddia+7,$ddano);
		}		
	if ($ddf == 'm')
		{
		$ddt=mktime(0,0,0,$ddmes+$ddi,$dddia,$ddano);
		}
	if ($ddf == 'y')
		{
		$ddt=mktime(0,0,0,$ddmes,$dddia,$ddano+$ddi);
		}
	return(date("Ymd",$ddt));
	}
function ano_bisexto($ddb)	
	{
	if (intval($ddb/4) == ($ddb/4))
		{ return(True); } else
		{ return(False); }
	}
function dtosql()
{
	$ds = date("Y-m-d");
	return $ds;
}

function dtos($dd)
{
	$ds = date("Ymd");
	return $ds;
}

function brtos($dd)
{
	$ds = substr($dd,6,4).substr($dd,3,2).substr($dd,0,2);
	if (strlen($ds) == 0) { $ds = '19000101'; }
	return $ds;
}

function stodbr($dd)
{
	if ($ds == '19000101') { $ds = ''; } else
	{
		$ds = substr($dd,6,2).'/'.substr($dd,4,2).'/'.substr($dd,0,4);
	}
	return $ds;
}

function stodus($dd)
{
	$ds = substr($dd,4,2).'/'.substr($dd,6,2).'/'.substr($dd,0,4);
	return $ds;
}


function nomemes($dx)
	{
	global $idioma;
	$cp = array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

	if ($idioma == "2")
		{
		$cp = array("","January","February","March","April","May","June","July","August","Septeber","October","November","Dezember");
		}
	$rt = $cp[$dx];
	return($cp[$dx]);
	}
	
function nomemes_short($dx)
	{
	global $idioma;
	$dx = intval($dx);
	$cp = array("","jan.","fev.","mar.","abr.","maio","jun.","jul.","ago.","set.","out.","nov.","dez.");

	if ($idioma == "2")
		{
		$cp = array("","jan.","feb.","mar.","apr.","may","jun.","jul.","aug.","sep.","oct.","nov.","dez.");
		}
	$rt = $cp[$dx];
	return($cp[$dx]);
	}	


function dhtos($dd)
{
	$ds = date("YmdHi");
	return $ds;
}
}
?>