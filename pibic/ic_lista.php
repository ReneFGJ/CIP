<?php
/* $breadcrumbs */
$breadcrumbs = array();
array_push($breadcrumbs,array('main.php','principal'));
array_push($breadcrumbs,array($site.'main.php','menu'));
require("cab_pibic.php");

require($include.'sisdoc_data.php');

$professor = $ss->user_cracha;

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$pb->set($professor);
$ano = $dd[1];
$status = $dd[2];

echo $pb->lista_ic($professor,$ano,$status);


require("../foot.php");
?>