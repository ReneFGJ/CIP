<?
for ($k=0;$k<99;$k++)
	{
	if (isset($cp[$k]))
		{
		echo "<TR>";
	    echo gets($cp[$k][0],$cp[$k][1],$cp[$k][2],CharE($cp[$k][3]),$cp[$k][4],$cp[$k][5]);
		echo "</TD>";
		}
	}
?>