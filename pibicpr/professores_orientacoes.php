<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;
$ano = '2013';
echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>'.chr(13);
echo '<h1>Orientações IC</h1>';
$bolsa = 'PIBIC';
echo $pb->indicador_professor_orientador($ano,$bolsa);

require("../foot.php");	
?>