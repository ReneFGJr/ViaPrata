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
if ($mostar_versao == True) {array_push($sis_versao,array("sisDOC (Html)","0.0a",20080520)); }

function HtmltoChar($dx)
	{
		$dx = troca($dx,'&aacute;','�'); 
		$dx = troca($dx,'&eacute;','�'); 
		$dx = troca($dx,'&iacute;','�'); 
		$dx = troca($dx,'&oacute;','�'); 
		$dx = troca($dx,'&uacute;','�'); 
		$dx = troca($dx,'&Aacute;','�'); 
		$dx = troca($dx,'&Eacute;','�'); 
		$dx = troca($dx,'&Iacute;','�'); 
		$dx = troca($dx,'&Oacute;','�'); 
		$dx = troca($dx,'&Uacute;','�'); 
		$dx = troca($dx,'&Atilde;','�');
		$dx = troca($dx,'&Otilde;','�');
		$dx = troca($dx,'&atilde;','�');
		$dx = troca($dx,'&otilde;','�');
		$dx = troca($dx,'&ccedil;','�');
		$dx = troca($dx,'&Ccedil;','�');

		$dx = troca($dx,'&acirc;','�');
		$dx = troca($dx,'&ecirc;','�');
		$dx = troca($dx,'&icirc;','�');
		$dx = troca($dx,'&ocirc;','�');
		$dx = troca($dx,'&ucirc;','�');

		$dx = troca($dx,'&Acirc;','�');
		$dx = troca($dx,'&Ecirc;','�');
		$dx = troca($dx,'&Icirc;','�');
		$dx = troca($dx,'&Ocirc;','�');
		$dx = troca($dx,'&Ucirc;','�');

		$dx = troca($dx,'&nbsp;',' ');
		$dx = troca($dx,'&agrave;','�');
		$dx = troca($dx,'&Agrave;','�');

		$dx = troca($dx,'  ',' ');
	return($dx);
	}
function HtmlToTxt($dx)
	{
	$dx = troca($dx,chr(13),'');
	$dx = troca($dx,chr(10),'');
	$dx = troca($dx,chr(9),' ');
	$dx = troca($dx,'<TR',chr(13).'<TR');
	$dx = troca($dx,'<tr',chr(13).'<TR');
	$ddb ='';
	$k = 0;
	for ($kk=0;$kk<strlen($dx);$kk++)
		{
//		echo $ch.'=';
		$ch = substr($dx,$kk,1);
		if (($ch=='<') or ($ch=='>'))
			{
			if ($ch =='<') { $k++; }
			if ($ch =='>') { $k--; }
			} else
			{	if ($k==0)
					{
					$ddb .= $ch;
					}
			}
		}
	return(HtmltoChar($ddb));
	}
?>