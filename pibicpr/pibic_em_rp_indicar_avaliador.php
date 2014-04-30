<?php
require("cab.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_ic_acompanhamento.php");
$rp = new ic_relatorio;
$rp->modalide = 'PIBIC_EM';
$rp->tipo = 'RPAJ';
$rp->tabela='pibic_parecer_'.date("Y");

echo '<img src="'.$http.'img/logo_ic_pibic_em.png">';
echo $rp->idicacao_avaliador('PIBIC_EM');

require("../foot.php");	
?>