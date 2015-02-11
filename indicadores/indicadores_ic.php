<?php
require("cab.php");
echo '<H1>Panorama da Pesquisa na Instituição</h1>';
$ano = '2014';

for ($r=0;$r<40;$r++)
	{
		$img = "img/IC-2014-".strzero($r,2).".JPG";

		if (file_exists($img))
			{
				echo '<img src="'.$img.'" width="100%">';
				echo '<BR><BR>';
			}
	}
require("foot.php");
?>
