<?
///////////////////////////////////////////
// BIBLIOTECA DE FUNÇÕS PHP ///////////////
////////////////////////////// criado por /
////////////////// Rene F. Gabriel Junior /
/////////////////    rene@sisdoc.com.br   /
///////////////////////////////////////////
// Versão atual           //    data     //
//---------------------------------------//
// 0.0a                       20/05/2008 //
///////////////////////////////////////////
if ($mostar_versao == True) { array_push($sis_versao,array("sisDOC (Char)","0.0a",20080520)); }
function redirecina($pg)
	{
	header("Location: ".$pg);
	echo 'Stoped'; exit;
	}

function sonumero($it)
	{
	$rlt = '0';
	for ($ki=0;$ki < strlen($it);$ki++)
		{
		$ord = ord(substr($it,$ki,1));
		if (($ord >= 48) and ($ord <= 57)) { $rlt = $rlt . substr($it,$ki,1); }
		}
	$rlt = intval($rlt);
	if ($rlt == 0) { $rlt = -1; }
	return $rlt;
	}

function dsp_sn($sn)
	{
	if (($sn == 'S') or ($sn == '1')) { return("SIM"); }
	if (($sn == 'N') or ($sn == '0')) { return("NÃO"); }
	
	}
function strzero($ddx,$ttz)
	{
	$ddx = round($ddx);
	while (strlen($ddx) < $ttz)
		{ $ddx = "0".$ddx; }
	return($ddx);
	}
	
function mst($ddx)
	{
	$ddx = troca($ddx,chr(13),'<BR>');
	return($ddx);
	}
	
function charConv($ddx)
	{
	while (strpos($ddx,'&#') > 0)
		{
		$ix = strpos($ddx,'&#');
		$ivlr = substr($ddx,$ix,6);
		$icha = char_ISO_Latin_1($ivlr);
		$ddx = troca($ddx,$ivlr,$icha);
		}
	return($ddx);
	}
	
function char_ISO_Latin_1($ddv)
	{
	////// ISO Latin-1 Characters and Control Characters
	$ddr = '?';
	if ($ddv == '&#160;') { $ddr = ' '; }
	if ($ddv == '&#161;') { $ddr = '¡'; }
	if ($ddv == '&#162;') { $ddr = '¢'; }
	if ($ddv == '&#163;') { $ddr = '£'; }
	if ($ddv == '&#164;') { $ddr = '¤'; }
	if ($ddv == '&#165;') { $ddr = '¥'; }
	if ($ddv == '&#166;') { $ddr = '¦'; }
	if ($ddv == '&#167;') { $ddr = '§'; }
	if ($ddv == '&#168;') { $ddr = '¨'; }
	if ($ddv == '&#169;') { $ddr = '©'; }

	if ($ddv == '&#170;') { $ddr = 'ª'; }
	if ($ddv == '&#171;') { $ddr = '«'; }
	if ($ddv == '&#172;') { $ddr = '¬'; }
	if ($ddv == '&#173;') { $ddr = ' '; }
	if ($ddv == '&#174;') { $ddr = '®'; }
	if ($ddv == '&#175;') { $ddr = '¯'; }
	if ($ddv == '&#176;') { $ddr = '·'; }
	if ($ddv == '&#177;') { $ddr = '±'; }
	if ($ddv == '&#178;') { $ddr = '²'; }
	if ($ddv == '&#179;') { $ddr = '³'; }

	if ($ddv == '&#180;') { $ddr = '´'; }
	if ($ddv == '&#181;') { $ddr = 'µ'; }
	if ($ddv == '&#182;') { $ddr = '¶'; }
	if ($ddv == '&#183;') { $ddr = '·'; }
	if ($ddv == '&#184;') { $ddr = '¸'; }
	if ($ddv == '&#185;') { $ddr = '¹'; }
	if ($ddv == '&#186;') { $ddr = 'º'; }
	if ($ddv == '&#187;') { $ddr = '»'; }
	if ($ddv == '&#188;') { $ddr = '¼'; }
	if ($ddv == '&#189;') { $ddr = '½'; }

	if ($ddv == '&#190;') { $ddr = '¾'; }
	if ($ddv == '&#191;') { $ddr = '¿'; }
	if ($ddv == '&#192;') { $ddr = 'À'; }
	if ($ddv == '&#193;') { $ddr = 'Á'; }
	if ($ddv == '&#194;') { $ddr = 'Â'; }
	if ($ddv == '&#195;') { $ddr = 'Ã'; }
	if ($ddv == '&#196;') { $ddr = 'Ä'; }
	if ($ddv == '&#197;') { $ddr = 'Å'; }
	if ($ddv == '&#198;') { $ddr = 'Æ'; }
	if ($ddv == '&#199;') { $ddr = 'Ç'; }

	if ($ddv == '&#200;') { $ddr = 'È'; }
	if ($ddv == '&#201;') { $ddr = 'É'; }
	if ($ddv == '&#202;') { $ddr = 'Ê'; }
	if ($ddv == '&#203;') { $ddr = 'Ë'; }
	if ($ddv == '&#204;') { $ddr = 'Ì'; }
	if ($ddv == '&#205;') { $ddr = 'Í'; }
	if ($ddv == '&#206;') { $ddr = 'Î'; }
	if ($ddv == '&#207;') { $ddr = 'Ï'; }
	if ($ddv == '&#208;') { $ddr = 'Ð'; }
	if ($ddv == '&#209;') { $ddr = 'Ñ'; }

	if ($ddv == '&#210;') { $ddr = 'Ò'; }
	if ($ddv == '&#211;') { $ddr = 'Ó'; }
	if ($ddv == '&#212;') { $ddr = 'Ô'; }
	if ($ddv == '&#213;') { $ddr = 'Õ'; }
	if ($ddv == '&#214;') { $ddr = 'Ö'; }
	if ($ddv == '&#215;') { $ddr = '×'; }
	if ($ddv == '&#216;') { $ddr = 'Ø'; }
	if ($ddv == '&#217;') { $ddr = 'Ù'; }
	if ($ddv == '&#218;') { $ddr = 'Ú'; }
	if ($ddv == '&#219;') { $ddr = 'Û'; }

	if ($ddv == '&#220;') { $ddr = 'Ü'; }
	if ($ddv == '&#221;') { $ddr = 'Ý'; }
	if ($ddv == '&#222;') { $ddr = 'Þ'; }
	if ($ddv == '&#223;') { $ddr = 'ß'; }
	if ($ddv == '&#224;') { $ddr = 'à'; }
	if ($ddv == '&#225;') { $ddr = 'á'; }
	if ($ddv == '&#226;') { $ddr = 'â'; }
	if ($ddv == '&#227;') { $ddr = 'ã'; }
	if ($ddv == '&#228;') { $ddr = 'ä'; }
	if ($ddv == '&#229;') { $ddr = 'å'; }

	if ($ddv == '&#230;') { $ddr = 'æ'; }
	if ($ddv == '&#231;') { $ddr = 'ç'; }
	if ($ddv == '&#232;') { $ddr = 'è'; }
	if ($ddv == '&#233;') { $ddr = 'é'; }
	if ($ddv == '&#234;') { $ddr = 'ê'; }
	if ($ddv == '&#235;') { $ddr = 'ë'; }
	if ($ddv == '&#236;') { $ddr = 'ì'; }
	if ($ddv == '&#237;') { $ddr = 'í'; }
	if ($ddv == '&#238;') { $ddr = 'î'; }
	if ($ddv == '&#239;') { $ddr = 'ï'; }

	if ($ddv == '&#240;') { $ddr = 'ð'; }
	if ($ddv == '&#241;') { $ddr = 'ñ'; }
	if ($ddv == '&#242;') { $ddr = 'ò'; }
	if ($ddv == '&#243;') { $ddr = 'ó'; }
	if ($ddv == '&#244;') { $ddr = 'ô'; }
	if ($ddv == '&#245;') { $ddr = 'õ'; }
	if ($ddv == '&#246;') { $ddr = 'ö'; }
	if ($ddv == '&#247;') { $ddr = '÷'; }
	if ($ddv == '&#248;') { $ddr = 'ø'; }
	if ($ddv == '&#249;') { $ddr = 'ù'; }

	if ($ddv == '&#250;') { $ddr = 'ú'; }
	if ($ddv == '&#251;') { $ddr = 'û'; }
	if ($ddv == '&#252;') { $ddr = 'ü'; }
	if ($ddv == '&#253;') { $ddr = 'ý'; }
	if ($ddv == '&#254;') { $ddr = 'þ'; }
	if ($ddv == '&#255;') { $ddr = 'ÿ'; }
	
	return($ddr);
	}

function charset_start()
	{
	global $qcharset;
	if ($qcharset=='UTF8')
		{
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		return("UFT8");
		}
	else
		{
		return("ASCII");
		}
	}
	
function utf8_detect($utt)
	{
	$xok = strpos($utt,UTF8_encode('Ã'));
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('É')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Í')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Ó')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Ú')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('á')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('é')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('í')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('ó')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('ú')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('ñ')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Ñ')); }

	if ($xok===False) { $xok = strpos($utt,UTF8_encode('ã')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('õ')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Â')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Ê')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Î')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Ô')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Û')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('â')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('ê')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('î')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('ô')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('û')); }
	
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('ç')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('Ç')); }
	if ($xok===False)
		{
		return 1;
		} else {
		return 0;
		}
	}
	
function CharE($rr)
	{
	global $qcharset;
	if ($qcharset=='UTF8')
		{
			return(UTF8_encode($rr));
		}
	else
		{
			//while(utf8_detect($rr)) { $rr=utf8_decode($rr); }
			return($rr);
		}
	}
	
function UpperCaseSQL($d)
	{
	$qch1="ÁÉÍÓÚáéíóúàèìòùÀÈÌÒÙÂÊÎÔÛâêîôûÇçäëïöüÄËÏÖÜÃÕãõ";
	$qch2="AEIOUaeiouaeiouAEIOUAEIOUaeiouCcaeiouAEIOUAOAO";
	for ($qk=0;$qk < strlen($qch2);$qk++)
		{
		$d = troca($d,substr($qch1,$qk,1),substr($qch2,$qk,1));
		}
		 
	$d = strtoupper($d);
	return $d;
	}

function UpperCase($dx)
	{
	$qch1='ÁÉÍÓÚáéíóúàèìòùÀÈÌÒÙÂÊÎÔÛâêîôûÇçäëïöüÄËÏÖÜÃÕãõ';
	$qch2='ÁÉÍÓÚÁÉÍÓÚÀÈÌÒÙÀÈÌÒÙÂÊÎÔÛÂÊÎÔÛÇÇÄËÏÖÜÄËÏÖÜÃÕÃÕ';
	
	$dx = strtoupper($dx);
	
	for ($qk=0;$qk < strlen($qch2);$qk++)
		{
		$dx = troca($dx,substr($qch1,$qk,1),substr($qch2,$qk,1));
		}
	
	return $dx;
	}
	
function LowerCase($d)
	{
	$d = $d . ' ';
	$qch1='ÁÉÍÓÚáéíóúàèìòùÀÈÌÒÙÂÊÎÔÛâêîôûÇçäëïöüÄËÏÖÜÃÕãõ';
	$qch2='áéíóúáéíóúàèìòùàèìòùâêîôûâêîôûççäëïöüäëïöüãõãõ';
	
	$d = strtolower($d);
	for ($qk=0;$qk < strlen($qch2);$qk++)
		{
		$d = troca($d,substr($qch1,$qk,1),substr($qch2,$qk,1));
		}
		 
	return trim($d);
	}
		
function LowerCaseSQL($d)
	{
	$qch1="ÁÉÍÓÚáéíóúàèìòùÀÈÌÒÙÂÊÎÔÛâêîôûÇçäëïöüÄËÏÖÜÃÕãõ";
	$qch2="aeiouaeiouaeiouaeiouaeiouaeiouccaeiouaeiouaoao";
	
	for ($qk=0;$qk < strlen($qch2);$qk++)
		{
		$d = troca($d,substr($qch1,$qk,1),substr($qch2,$qk,1));
		}
		 
	$d = strtolower($d);
	return $d;
	}		
	
function troca($qutf,$qc,$qt)
	{
	return(str_replace(array($qc), array($qt),$qutf));
	}
?>