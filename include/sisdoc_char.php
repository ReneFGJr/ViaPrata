<?
///////////////////////////////////////////
// BIBLIOTECA DE FUN��S PHP ///////////////
////////////////////////////// criado por /
////////////////// Rene F. Gabriel Junior /
/////////////////    rene@sisdoc.com.br   /
///////////////////////////////////////////
// Vers�o atual           //    data     //
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
	if (($sn == 'N') or ($sn == '0')) { return("N�O"); }
	
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
	if ($ddv == '&#161;') { $ddr = '�'; }
	if ($ddv == '&#162;') { $ddr = '�'; }
	if ($ddv == '&#163;') { $ddr = '�'; }
	if ($ddv == '&#164;') { $ddr = '�'; }
	if ($ddv == '&#165;') { $ddr = '�'; }
	if ($ddv == '&#166;') { $ddr = '�'; }
	if ($ddv == '&#167;') { $ddr = '�'; }
	if ($ddv == '&#168;') { $ddr = '�'; }
	if ($ddv == '&#169;') { $ddr = '�'; }

	if ($ddv == '&#170;') { $ddr = '�'; }
	if ($ddv == '&#171;') { $ddr = '�'; }
	if ($ddv == '&#172;') { $ddr = '�'; }
	if ($ddv == '&#173;') { $ddr = ' '; }
	if ($ddv == '&#174;') { $ddr = '�'; }
	if ($ddv == '&#175;') { $ddr = '�'; }
	if ($ddv == '&#176;') { $ddr = '�'; }
	if ($ddv == '&#177;') { $ddr = '�'; }
	if ($ddv == '&#178;') { $ddr = '�'; }
	if ($ddv == '&#179;') { $ddr = '�'; }

	if ($ddv == '&#180;') { $ddr = '�'; }
	if ($ddv == '&#181;') { $ddr = '�'; }
	if ($ddv == '&#182;') { $ddr = '�'; }
	if ($ddv == '&#183;') { $ddr = '�'; }
	if ($ddv == '&#184;') { $ddr = '�'; }
	if ($ddv == '&#185;') { $ddr = '�'; }
	if ($ddv == '&#186;') { $ddr = '�'; }
	if ($ddv == '&#187;') { $ddr = '�'; }
	if ($ddv == '&#188;') { $ddr = '�'; }
	if ($ddv == '&#189;') { $ddr = '�'; }

	if ($ddv == '&#190;') { $ddr = '�'; }
	if ($ddv == '&#191;') { $ddr = '�'; }
	if ($ddv == '&#192;') { $ddr = '�'; }
	if ($ddv == '&#193;') { $ddr = '�'; }
	if ($ddv == '&#194;') { $ddr = '�'; }
	if ($ddv == '&#195;') { $ddr = '�'; }
	if ($ddv == '&#196;') { $ddr = '�'; }
	if ($ddv == '&#197;') { $ddr = '�'; }
	if ($ddv == '&#198;') { $ddr = '�'; }
	if ($ddv == '&#199;') { $ddr = '�'; }

	if ($ddv == '&#200;') { $ddr = '�'; }
	if ($ddv == '&#201;') { $ddr = '�'; }
	if ($ddv == '&#202;') { $ddr = '�'; }
	if ($ddv == '&#203;') { $ddr = '�'; }
	if ($ddv == '&#204;') { $ddr = '�'; }
	if ($ddv == '&#205;') { $ddr = '�'; }
	if ($ddv == '&#206;') { $ddr = '�'; }
	if ($ddv == '&#207;') { $ddr = '�'; }
	if ($ddv == '&#208;') { $ddr = '�'; }
	if ($ddv == '&#209;') { $ddr = '�'; }

	if ($ddv == '&#210;') { $ddr = '�'; }
	if ($ddv == '&#211;') { $ddr = '�'; }
	if ($ddv == '&#212;') { $ddr = '�'; }
	if ($ddv == '&#213;') { $ddr = '�'; }
	if ($ddv == '&#214;') { $ddr = '�'; }
	if ($ddv == '&#215;') { $ddr = '�'; }
	if ($ddv == '&#216;') { $ddr = '�'; }
	if ($ddv == '&#217;') { $ddr = '�'; }
	if ($ddv == '&#218;') { $ddr = '�'; }
	if ($ddv == '&#219;') { $ddr = '�'; }

	if ($ddv == '&#220;') { $ddr = '�'; }
	if ($ddv == '&#221;') { $ddr = '�'; }
	if ($ddv == '&#222;') { $ddr = '�'; }
	if ($ddv == '&#223;') { $ddr = '�'; }
	if ($ddv == '&#224;') { $ddr = '�'; }
	if ($ddv == '&#225;') { $ddr = '�'; }
	if ($ddv == '&#226;') { $ddr = '�'; }
	if ($ddv == '&#227;') { $ddr = '�'; }
	if ($ddv == '&#228;') { $ddr = '�'; }
	if ($ddv == '&#229;') { $ddr = '�'; }

	if ($ddv == '&#230;') { $ddr = '�'; }
	if ($ddv == '&#231;') { $ddr = '�'; }
	if ($ddv == '&#232;') { $ddr = '�'; }
	if ($ddv == '&#233;') { $ddr = '�'; }
	if ($ddv == '&#234;') { $ddr = '�'; }
	if ($ddv == '&#235;') { $ddr = '�'; }
	if ($ddv == '&#236;') { $ddr = '�'; }
	if ($ddv == '&#237;') { $ddr = '�'; }
	if ($ddv == '&#238;') { $ddr = '�'; }
	if ($ddv == '&#239;') { $ddr = '�'; }

	if ($ddv == '&#240;') { $ddr = '�'; }
	if ($ddv == '&#241;') { $ddr = '�'; }
	if ($ddv == '&#242;') { $ddr = '�'; }
	if ($ddv == '&#243;') { $ddr = '�'; }
	if ($ddv == '&#244;') { $ddr = '�'; }
	if ($ddv == '&#245;') { $ddr = '�'; }
	if ($ddv == '&#246;') { $ddr = '�'; }
	if ($ddv == '&#247;') { $ddr = '�'; }
	if ($ddv == '&#248;') { $ddr = '�'; }
	if ($ddv == '&#249;') { $ddr = '�'; }

	if ($ddv == '&#250;') { $ddr = '�'; }
	if ($ddv == '&#251;') { $ddr = '�'; }
	if ($ddv == '&#252;') { $ddr = '�'; }
	if ($ddv == '&#253;') { $ddr = '�'; }
	if ($ddv == '&#254;') { $ddr = '�'; }
	if ($ddv == '&#255;') { $ddr = '�'; }
	
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
	$xok = strpos($utt,UTF8_encode('�'));
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }

	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
	if ($xok===False) { $xok = strpos($utt,UTF8_encode('�')); }
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
	$qch1="����������������������������������������������";
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
	$qch1='����������������������������������������������';
	$qch2='����������������������������������������������';
	
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
	$qch1='����������������������������������������������';
	$qch2='����������������������������������������������';
	
	$d = strtolower($d);
	for ($qk=0;$qk < strlen($qch2);$qk++)
		{
		$d = troca($d,substr($qch1,$qk,1),substr($qch2,$qk,1));
		}
		 
	return trim($d);
	}
		
function LowerCaseSQL($d)
	{
	$qch1="����������������������������������������������";
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