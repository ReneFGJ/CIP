<?php
//require("db.php");
require("_class/_class_graficos.php");

$scale = $_GET['dd52'];
$sx = $_GET['dd50'];
$sy = $_GET['dd51'];
$tp = $_GET['dd0'];
$desc = $_GET['dd1'];
$total = $_GET['dd2'];

if (strlen($sx)==0) { $sx = 10; }
if (strlen($sy)==0) { $sy = 10; }

$ig = new graphics;
global $img;
$image = $ig->create_image($sx,$sy);

/* Doutor - #A7EA05 */
$cor = imagecolorallocate($image, 0xA7, 0xEA, 0x05);
$x = 10; $y = 5; $s = $scale; $sp = ($s*2+$s);
/* Mestrado - #F69400 */
$cor = imagecolorallocate($image, 0xF6, 0x94, 0x00);
for ($r=0;$r < $total;$r++)
	{
	$image = $ig->boneco($image,$x,$y,$s,$cor); $x = $x + $scale*2.5;
	}

// flush image
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>