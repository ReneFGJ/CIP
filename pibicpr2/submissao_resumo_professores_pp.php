<?
require("cab.php");
require($include."sisdoc_debug.php");
//require("../_class/_class_pibic_projetos.php");
require("../_class/_class_pibic_projetos_v2.php");

$ano = date("Y");
$cpi = "";
$pj = new projetos;

echo '<H2>Resumo da Submissão - Projetos do Professor - GERAL</H2>';
echo $pj->resumo_projeto_centro();

echo '<H2>Resumo da Submissão - Projetos do Professor Stricto sensu</H2>';
echo $pj->resumo_projeto_centro('SS');

echo '<H2>Resumo da Submissão - Projetos do Professor Graduação</H2>';
echo $pj->resumo_projeto_centro('NS');

require("foot.php");
?>