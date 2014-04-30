<?php
require("cab.php");
require($include.'sisdoc_email.php');
require($include.'sisdoc_windows.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_ic.php");
$ic = new ic;

echo '<h1>Corre��o do Relat�rio Parcial n�o entregue</h1>';

echo $ic->form('ic_rpac_nao_entregue');

$ano = $pb->recupera_ano_ativo();
echo $pb->relatorio_parcial_nao_entregue($ano,'','RPAC');

require("../foot.php");	
?>