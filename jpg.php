<?php
//require("db.php");
require("_class/_class_graficos.php");

$ig = new graphics;
global $img;
//$image = $ig->circulo($image,100,100);
//$ig->circulo();
//imagepng($img);
//imagedestroy($img);

//$image = $ig->pie($image);
$tipo = $_GET['tp'];
if ($tipo == 'IC')
	{
		$image = $ig->create_image(512,100);
		$image= $ig->folha_texto($image,5,5,'Iniciação Científica',1,'gray');		
		
		$tt = round($_GET['anos']);;
		for ($r=0;$r < $tt;$r++)
			{
				$ano = $_GET['ano'.$r];
				$pibic = $_GET['PIBIC'.$ano];
				$pibice = $_GET['PIBICE'.$ano];
				$pibiti = $_GET['PIBITI'.$ano];
				$image= $ig->folha_texto($image,5,35+30*$r,$ano,1,'red');
				$x = 70; $y = 35+30*$r; $s = 6; $sp = ($s*2+$s);
				for ($z=0;$z < $pibic;$z++)
					{
						$cor = imagecolorallocate($image, 0x87, 0xAA, 0x05);
						$image = $ig->boneco($image,$x,$y,$s,$cor); $x = $x + $sp;						
					}
				for ($z=0;$z < $pibiti;$z++)
					{
						$cor = imagecolorallocate($image, 0xAA, 0x05,0x87);
						$image = $ig->boneco($image,$x,$y,$s,$cor); $x = $x + $sp;						
					}
				for ($z=0;$z < $pibice;$z++)
					{
						$cor = imagecolorallocate($image, 0x05,0x87, 0xAA);
						$image = $ig->boneco($image,$x,$y,$s,$cor); $x = $x + $sp;						
					}										
			}
	} else {
		$image = $ig->create_image(512,512);
		$image = $ig->folha($image,10,10,70,10);
		$image = $ig->folha($image,100,10,70,100);
		$image= $ig->folha_texto($image,40,20,'38',$size=1,'white');

		/* Doutor - #A7EA05 */
		$cor = imagecolorallocate($image, 0xA7, 0xEA, 0x05);
		$x = 20; $y = 100; $s = 17; $sp = ($s*2+$s);
		$image = $ig->boneco($image,$x,$y,$s,$cor); $x = $x + $sp;
		$image = $ig->boneco($image,$x,$y,$s,$cor); $x = $x + $sp;
		$image = $ig->boneco($image,$x,$y,$s,$cor); $x = $x + $sp;
		$image = $ig->boneco($image,$x,$y,$s,$cor); $x = $x + $sp;
		/* Mestrado - #F69400 */
		$cor = imagecolorallocate($image, 0xF6, 0x94, 0x00);
		$image = $ig->boneco($image,$x,$y,$s,$cor); $x = $x + 25;
	}

// flush image
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>