<?php
require("cab.php");
require('../_class/_class_pareceristas.php');
$par = new parecerista;

echo $par->pareceristas_lista($dd[0]);

require("../foot.php");
?>
