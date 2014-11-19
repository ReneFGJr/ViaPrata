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
if ($mostar_versao == True) {array_push($sis_versao,array("sisDOC (Search)","0.0a",20080520)); }

	function buscatextual($xxx)
	{
	global $cp_nome;
	if (strlen($cp_nome) == 0) { $cp_nome = 'sc_texto_asc'; }
	$slac = 1;
//	echo '<HR>'.$xxx."<HR>";
	if (utf8_detect($xxx)==0) { $xxx = UTF8_decode($xxx); echo 'UTF8';}
//	echo '<HR>'.$xxx."<HR>";
	$xxx = UpperCaseSQL($xxx). ' ';
//	echo '<HR>'.$xxx."<HR>";
	$pbs=str_word_count($xxx,1);
	if (count($pbs) == 1) { $pbs = array(trim($xxx)); }
//	$pbs = array_unique($pbs);	
	$pcmd = '';
	$ops = 0;
	for ($kkk=0;$kkk < count($pbs); $kkk++)
		{
		$boo = 0;
		if ($kkk > 0)
			{
			if ($kkk < (count($pbs)-1))
				{
				if ($pbs[$kkk] == 'OR') { $pcmd = $pcmd . ' Or '; $boo = 1; $ope = 1;}
				if ($pbs[$kkk] == 'OU') { $pcmd = $pcmd . ' Or '; $boo = 1; $ope = 1;}
				if ($pbs[$kkk] == 'AND') { $pcmd = $pcmd . ' AND '; $boo = 1; $ope = 1;}
				if ($pbs[$kkk] == 'E') { $pcmd = $pcmd . ' aND '; $boo = 1; $ope = 1;}
				}
			}
		if (($ope == 0) and ($boo == 0) and ($kkk > 0)) 
			{ $pcmd = $pcmd . ' AND '; }
			
		if ($boo == 0) { $pcmd = $pcmd . "(".$cp_nome." like '%".$pbs[$kkk]."%') "; $ope = 0; }
		}
	$ss = "(".$pcmd.")";
	return $ss;
	}
	
function sisdoc_search($t,$cp)
	{
	$t = $t . ' ';
	$termo = array();
	$tta=0;
	$tt='';
	$descart = " {}[]()!#$%*\'";
	
	for ($kkt=0;$kkt < strlen($t); $kkt++)
		{
		$tch = substr($t,$kkt,1);
		if (strpos($descart,$tch) > 0) { $tch = ''; }
		if ($tch == '"')
			{ if ($tta == 0) { $tta = 1; } else { $tta = 0; } }
		else
			{
				if (($tch == ' ') or ($kkt == strlen($t)))
					{
					if (($tta == 0) or ($kkt == strlen($t)))
						{ if (strlen($tt) >0 ) 
							{ 
							array_push($termo,$tt); 
							$tt='';
							}
						} else { $tt = $tt . $tch; }
					} else {
						$tt=$tt.$tch;
					}
			}
		}
	for ($kkt=0;$kkt < count($termo);$kkt++)
		{
		$tt = strtoupper($termo[$kkt]);
		IF ($tt == 'AND') { $termo[$kkt] = '!AND'; }
		IF ($tt == 'OR')  { $termo[$kkt] = '!OR'; }
		IF ($tt == 'NOT') { $termo[$kkt] = '!NOT'; }
		}
	$whe = '';
	$tp = 0;
	for ($kkt=0;$kkt < count($termo);$kkt++)
		{
		$tt = strtoupper($termo[$kkt]);
		if (substr($tt,0,1) == '!')
			{
			/////////////////////// COMANDO BOOLEANOS
				if (($tt == "!NOT") and ($tp == 0)) { $whe = $whe .' AND '; }
				$whe = $whe .' '.substr($tt,1,strlen($tt)).' ';
				$tp = 1;
			} else {
				if (($tp == 0) and (strlen($whe) > 0)) { $whe = $whe . ' AND '; }
				$whe = $whe . "( ".$cp ." like '%".UpperCaseSQL($tt)."%') ";
				$tp = 0;
			/////////////////////// 
				
			}
		}
	return($whe);
	}	
	?>