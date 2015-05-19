<?php
require("cab_csf.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
//array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
//array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
//echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_csf.php");
$csf = new csf;

echo $csf->estudantes_em_viagem();

require("../foot.php");	
?>