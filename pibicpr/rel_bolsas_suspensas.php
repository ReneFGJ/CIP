<?php
require("cab.php");
require($include.'sisdoc_email.php');
require($include.'sisdoc_debug.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$ano = $pb->recupera_ano_ativo();
echo $pb->relatorio_bolsas_suspensas($ano);

require("../foot.php");	
?>