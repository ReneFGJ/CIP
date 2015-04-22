<?php
require("cab.php");

$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_docentes.php");
$pb = new docentes;

echo $pb->docentes_com_penalidades();

require("../foot.php");	
?>