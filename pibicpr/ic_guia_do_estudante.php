<?php
require("cab.php");

require('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

echo $pb->guia_estudante($dd[1],$dd[2]);

require("../foot.php");	
?>