<?
require("cab.php");
require($include."sisdoc_debug.php");
//require("../_class/_class_pibic_projetos.php");
require("../_class/_class_pibic_projetos_v2.php");
$ano = date("Y");
$cpi = "";
$pj = new projetos;

echo '<H2>Resumo da Submiss�o - GERAL</H2>';
echo $pj->resumo_planos_centro();

echo '<H2>Resumo da Submiss�o - Professor Stricto sensu</H2>';
echo $pj->resumo_planos_centro('SS');

echo '<H2>Resumo da Submiss�o - Professor Gradua��o</H2>';
echo $pj->resumo_planos_centro('NS');

require("foot.php");
?>