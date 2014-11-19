<?
function codean($xcod)
	{
	$rcod = 'xx';
	if ((strlen($xcod) == 8) and (substr($xcod,0,1) == '5'))
	{
		$rcod = substr($xcod,0,7);
	}

	if (strlen($xcod) == 8)
		{
		if (substr($xcod,0,1) == '0')
			{
				if ((substr($xcod,0,3) == '010') or
					(substr($xcod,0,3) == '020') or
					(substr($xcod,0,3) == '030') or
					(substr($xcod,0,3) == '040') or
					(substr($xcod,0,3) == '050') or
					(substr($xcod,0,3) == '060') or
					(substr($xcod,0,3) == '070') or
					(substr($xcod,0,3) == '080') or
					(substr($xcod,0,3) == '090') )
						{ $rcod = substr($xcod,0,7); }
			}
		if (substr($xcod,0,1) == '1')
			{
				if ((substr($xcod,0,3) == '110') or
					(substr($xcod,0,3) == '120') or
					(substr($xcod,0,3) == '130') or
					(substr($xcod,0,3) == '140') or
					(substr($xcod,0,3) == '150') or
					(substr($xcod,0,3) == '160') or
					(substr($xcod,0,3) == '170') or
					(substr($xcod,0,3) == '180') or
					(substr($xcod,0,3) == '190') )
						{ $rcod = substr($xcod,0,7); }
					else
						{ $rcod = substr($xcod,1,7);}
			}
		if (substr($xcod,0,1) == '2')
			{
				if ((substr($xcod,0,3) == '210') or
					(substr($xcod,0,3) == '220') or
					(substr($xcod,0,3) == '230') or
					(substr($xcod,0,3) == '240') or
					(substr($xcod,0,3) == '250') or
					(substr($xcod,0,3) == '260') or
					(substr($xcod,0,3) == '270') or
					(substr($xcod,0,3) == '280') or
					(substr($xcod,0,3) == '290') )
						{ $rcod = substr($xcod,0,7); }
					else
						{ $rcod = substr($xcod,1,7);}
			}
		if (substr($xcod,0,1) == '7')
			{
				if ((substr($xcod,0,3) == '710') or
					(substr($xcod,0,3) == '720') or
					(substr($xcod,0,3) == '730') or
					(substr($xcod,0,3) == '740') or
					(substr($xcod,0,3) == '750') or
					(substr($xcod,0,3) == '760') or
					(substr($xcod,0,3) == '70') or
					(substr($xcod,0,3) == '7280') or
					(substr($xcod,0,3) == '790') )
						{ $rcod = substr($xcod,0,7); }
					else
						{ $rcod = substr($xcod,1,7);}
			}
		if (substr($xcod,0,1) == '8')
			{
				if ((substr($xcod,0,3) == '810') or
					(substr($xcod,0,3) == '820') or
					(substr($xcod,0,3) == '830') or
					(substr($xcod,0,3) == '840') or
					(substr($xcod,0,3) == '50') or
					(substr($xcod,0,3) == '260') or
					(substr($xcod,0,3) == '270') or
					(substr($xcod,0,3) == '280') or
					(substr($xcod,0,3) == '890') )
						{ $rcod = substr($xcod,0,7); }
					else
						{ $rcod = substr($xcod,1,7);}
			}
		if (substr($xcod,0,1) == '9')
			{
				if ((substr($xcod,0,3) == '910') or
					(substr($xcod,0,3) == '920') or
					(substr($xcod,0,3) == '930') or
					(substr($xcod,0,3) == '940') or
					(substr($xcod,0,3) == '950') or
					(substr($xcod,0,3) == '960') or
					(substr($xcod,0,3) == '970') or
					(substr($xcod,0,3) == '980') or
					(substr($xcod,0,3) == '990') )
						{ $rcod = substr($xcod,0,7); }
					else
						{ $rcod = substr($xcod,1,7);}
			}						
		} else {
			$rcod = substr($xcod,0,7);
		}
		return($rcod);
	}
?>