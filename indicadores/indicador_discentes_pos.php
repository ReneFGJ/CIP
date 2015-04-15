<?php
require("cab.php");

require("../_class/_class_indicadores.php");
$doc = new indicador;

echo "<h1>Indicadores do Fluxo Discente</h1>";

echo $doc->resumo_orientacoes_discentes();

echo "<h1>Indicadores de discentes Mestrado / Doutorado</h1>";
echo $doc->resumo_programas_discentes();
require("foot.php");
?>
