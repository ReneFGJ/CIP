<?php
require("cab_semic.php");
require("../_class/_class_parecer_pibic.php");
$pp = new parecer_pibic;

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

echo $pb->best_work();

require("../foot.php");	
?>