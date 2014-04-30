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

require("../_class/_class_ic_relatorio_final.php");
$rf = new ic_relatorio_final;

require("../_class/_class_parecer_pibic.php");
$pb = new parecer_pibic;

echo $rf->idicacao_avaliador_reprovados();

require("../foot.php");	
?>