<?php
require("cab.php");

$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_parecer_pibic.php");
$pb = new parecer_pibic;

$pb->tabela = "pibic_parecer_".date("Y");
echo $pb->acompanhamento_indicados('RFNR');

require("../foot.php");	
?>