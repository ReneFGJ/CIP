<?
$cabnav = array();
array_push($cabnav,array('Comitê de Ética','main.php'));

function cabnavega()
{
	global $cabnav,$tab_max;
	if (count($cabnav) > 0)
	{
	echo '<TABLE width="'.$tab_max.'" border="0" class="menunav" align="center">';
	
	for ($km=0;$km < count($cabnav);$km++)
		{
		if ($km > 0) { echo '<TD>&gt;</TD>'; }
		echo '<TD><NOBR>';
		if (($km+1) < (count($cabnav))) { echo '<A HREF="'.$cabnav[$km][1].'" class="cabnav">'; }
		echo '<B>';
		echo $cabnav[$km][0];
		echo '</B>';
		echo '</A>';
		echo '</TD>';
		}
	echo '<TD width="90%">&nbsp;</TD>';
	echo '</TABLE>';
	}
}
?>