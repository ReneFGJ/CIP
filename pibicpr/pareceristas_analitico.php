<?php
require("cab.php");
require($include.'sisdoc_menus.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
require("../_class/_class_pibic_bolsa_contempladas.php");
$bolsa = new pibic_bolsa_contempladas;

/* Le dados da Indicação */
require("../_class/_class_pibic_projetos_v2.php");
$pp = new projetos;

echo $pp->gerar_relatorio_analitico_avaliador_projetos();



?>
