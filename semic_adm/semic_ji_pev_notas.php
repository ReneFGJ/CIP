<?php
require("cab_semic.php");
require($include.'sisdoc_autor.php');
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../semic_avaliacao/_class/_class_avaliacao.php");
$av = new avaliacao;

echo $av->mostra_notas('JI');
echo '<HR>';
echo $av->mostra_notas('PEV');

require("../foot.php");	
?>