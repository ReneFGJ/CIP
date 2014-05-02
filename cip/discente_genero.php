<?php
require("cab_cip.php");
require("../_class/_class_discentes.php");
$dis = new discentes;

echo $dis->sem_genero();

require("../foot.php");
?>
