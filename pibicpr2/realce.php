<?
function realce($txt,$term)
	{
	$txt = ' '.$txt;
	$txta = uppercasesql($txt);
	for ($rx=0;$rx < count($term); $rx++)
		{
		$txt = $txt;
		$termx = uppercasesql($term[$rx]);
		$terms = trim($term[$rx]);
		$mark_on = '<font style="background-color : Yellow;"><B>';
		$mark_off = '</B></font>';
		while (strpos($txta,$termx) > 0)
			{
			$xpos = strpos($txta,$termx);
			$txt  = substr($txt ,0,$xpos).$mark_on. substr($txt,$xpos,strlen($termx)).                 $mark_off.substr($txt ,$xpos+strlen($termx)  ,strlen($txt));
			$txta = substr($txta,0,$xpos).$mark_on. strzero('0',strlen($termx)).                       $mark_off.substr($txta,$xpos+strlen($termx)  ,strlen($txt));
			}
		}
//		echo '<HR>'.$txt.'<HR>'.$txta.'<HR>';
		return($txt);
	}
?>