<?php
require("cab.php");
require("realce.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_protocolo.php");
$pr = new protocolo;

echo '<h1>Protocolos abertos</h1>';

echo $pr->lista_protocolos_abertos('IC','@');
	
require("../foot.php");	
?>