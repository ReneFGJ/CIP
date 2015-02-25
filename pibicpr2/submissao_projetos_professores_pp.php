<?
require("cab.php");
require($include."sisdoc_debug.php");
require("../_class/_class_pibic_projetos.php");
$ano = date("Y");
$cpi = "";
$pj = new pibic_projetos;

echo '<H2>Resumo da Submissão - GERAL</H2>';
echo $pj->resumo_professores();

require("foot.php");
?>