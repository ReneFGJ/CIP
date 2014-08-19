<?php
require("cab.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_ic_relatorio_final.php");
$rp = new ic_relatorio_final;

$rp->verificar_sem_avaliacao();
echo $rp->idicacao_avaliador();

require("../foot.php");	
?>