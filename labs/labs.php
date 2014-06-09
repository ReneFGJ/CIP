<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
echo '</center>';
require("../_class/_class_laboratorio.php");
$lab = new laboratorio;
echo '<h1>Laboratório para pesquisa</h1>';

echo $lab->lista_laboratorios();
echo $lab->botao_novo();

require("../foot.php");	
?>