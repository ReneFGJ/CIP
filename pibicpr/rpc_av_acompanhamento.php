<?php
require("cab.php");

$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_ic_relatorio_parcial.php");
$rp = new ic_relatorio_parcial;

echo $pb->acompanhamento_avaliacao_relatorio_parcial_correcao();

echo $pb->acompanhamento_avaliacao_relatorio_aprovacao_correcao();

echo $rp->acompanhamento_avaliacao_estatistica_correcao();

require("../foot.php");	
?>