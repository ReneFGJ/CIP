<?php
require("cab.php");

require($include.'sisdoc_debug.php');
require($include.'_class_io.php');
$io = new io;

echo '<H1>Inporta arquivo de ouvintes semic</h1>';
$txt = $io->loadfile('xml/pucpr/semic2014.csv');

require("_class/_class_semic.php");
$sm = new semic;
//$sm->structure();
$sm->inport_file($txt);

require("foot.php");
?>
