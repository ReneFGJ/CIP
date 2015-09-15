<?
//$include = '../';
//require($include.'db.php');
$day = round($layout);
if ($day > 3) { $day = 2; }

echo '
<style>
	#poster_01
		{
			background-image:url(\'img/layout_0'.$day.'.png\');
			background-color: #E0FFFF;
			width: 831px;
			height: 462px;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 10px;
			position:relative;
		}
</style>
';

/* P01 - P06 */
$yini = 114;
$ps = array();
$x = 100; $y = $yini;
array_push($ps,array($x,$y,'P01','')); $y=$y+35;
array_push($ps,array($x,$y,'P02','')); $y=$y+35;
array_push($ps,array($x,$y,'P03','')); $y=$y+35;
$x = $x + 38; $y = $yini;
array_push($ps,array($x,$y,'P04','')); $y=$y+35;
array_push($ps,array($x,$y,'P05','')); $y=$y+35;
array_push($ps,array($x,$y,'P06','')); $y=$y+35;

/* P07 - P18*/
$x = 204; $y = $yini;
array_push($ps,array($x,$y,'P07','')); $y=$y+35;
array_push($ps,array($x,$y,'P08','')); $y=$y+35;
array_push($ps,array($x,$y,'P09','')); $y=$y+35;
$x = $x + 38; $y = $yini;
array_push($ps,array($x,$y,'P10','')); $y=$y+35;
array_push($ps,array($x,$y,'P11','')); $y=$y+35;
array_push($ps,array($x,$y,'P12','')); $y=$y+35;
$x = $x + 38; $y = $yini;
array_push($ps,array($x,$y,'P13','')); $y=$y+35;
array_push($ps,array($x,$y,'P14','')); $y=$y+35;
array_push($ps,array($x,$y,'P15','')); $y=$y+35;
$x = $x + 38; $y = $yini;
array_push($ps,array($x,$y,'P16','')); $y=$y+35;
array_push($ps,array($x,$y,'P17','')); $y=$y+35;
array_push($ps,array($x,$y,'P18','')); $y=$y+35;

/* P20 - P59 */
$pp=20;
$xini = 186;
$yini = 248;
for ($q1=0;$q1 < 4;$q1++)
	{
		$x = $xini+(38*$q1);
		for ($q2=0;$q2 < 10;$q2++)
			{
				$y = $yini + ($q2*35);
				if ($day==3)
					{
					if (($pp >= 26) and ($pp <= 29)) { $y = $y + 34;}
					if (($pp >= 36) and ($pp <= 39)) { $y = $y + 34;}
					if (($pp >= 46) and ($pp <= 49)) { $y = $y + 34;}
					if (($pp >= 56) and ($pp <= 59)) { $y = $y + 34;}
					}				
				array_push($ps,array($x,$y,'P'.($pp),''));
				$pp++;				


			}
	}
	
/* P60 - P80 */
$pp=60;
$xini = 186;
$yini = 584;
for ($q1=0;$q1 < 4;$q1++)
	{
		$x = $xini+(38*$q1);
		for ($q2=0;$q2 < 4;$q2++)
			{
				$corr = 0;
				$y = $yini + ($q2*35+$m*35);
				if ($pp==64) { $y = $y - 10;}
				if ($pp >= 68) { $y = $y - 34;}
				array_push($ps,array($x,$y,'P'.($pp),''));
				$pp++;				
			}
	}
	
/* P80 - P90 */
$pp=80;
$xini = 92;
$yini = 720;
$ln = 0;
for ($q1=0;$q1 < 6;$q1++)
	{
		$ln = 0;
		if ($pp>=86) { $ln = 1; }
		$x = $xini+(38*($q1+$ln));
		for ($q2=0;$q2 < 3;$q2++)
			{
				$corr = 0;
				$y = $yini + ($q2*35);
				array_push($ps,array($x,$y,'P'.($pp),''));
				$pp++;				
			}
	}
		
echo '<center>';
echo '<div id="poster_01">';
if ($day <> 0)
{
	for ($r=0;$r < count($ps);$r++)
		{
			$style = 'style="position: absolute; top: '.$ps[$r][0].'; left: '.$ps[$r][1].'" ';
			echo '<div id="'.$ps[$r][2].'" '.$style.'>';
			echo $ps[$r][2];
			echo '</div>'.chr(13).chr(10);
		}
}
echo '</div>';


	if ($day == 1)
	{
		echo '
		<style>
		#P59, #P33, #P49 { display: none; }
		#P60, #P64, #P65 { display: none; }
		#P68, #P69, #P72 { display: none; }
		#P73, #P63, #P67 { display: none; }
		#P86 { display: none; }
		</style>
		';
	}
	if (($day == 2))
	{
		echo '
		<style>
		#P33, #P29, #P39, #P49, #P58 { display: none; }
		#P48, #P59, #P63, #P67, #P14 { display: none; }
		#P86 { display: none; }
		</style>
		';
	}
	if (($day == 3))
	{
		echo '
		<style>
		#P33, #P72, #P73, #P74, #P75, #P16, #P17 { display: none; }
		#P64, #P65, #P66, #P63, #P67 { display: none; }
		#P55, #P60, #P69, #P39 { display: none; }
		#P86, #P80, #P83, #P62, #P71, #P70, #P61, #P68 { display: none; }
		</style>
		';
	}	
?>