<?php
require("cab.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_ic_relatorio_parcial.php");
$rp = new ic_relatorio_parcial;

$rp->tabela_atual();
echo $rp->idicacao_avaliador_correcao($dd[80]);

require("../foot.php");	
?>