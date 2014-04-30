<?php
require("cab.php");
require($include.'sisdoc_colunas.php');
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_semic.php");
$semic = new semic;

echo $semic->relatorio_aprovados_para_publicacao((date("Y") - 1));

require("../foot.php");	
?>