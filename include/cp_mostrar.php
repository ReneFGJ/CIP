<?
for ($k=0;$k<99;$k++)
	{
	if (isset($cp[$k]))
		{
		echo "<TR>";
	    echo '<TD align="right">';
		echo CharE($cp[$k][3]);
	    echo "<TD><B>";
		if (substr($cp[$k][2],0,2) == '$P')
			{ 
				if ($sge >=1) { echo  $cp[$k][1]; } 
				else { echo "*******************"; } 
			} else
			{ echo $cp[$k][1]; }
		echo "</TD>";
		}
	}
?>