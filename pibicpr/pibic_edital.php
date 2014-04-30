<?php
require("cab.php");
require("realce.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_parecer_pibic.php");
$pp = new parecer_pibic;

echo $pp->calcular_edital();


require("../foot.php");	
?>