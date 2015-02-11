<?php
require("cab.php");

require("../_class/_class_docentes.php");
$doc = new docentes;

echo "<h1>Indicadores dos Docentes</h1>";

echo $doc->resumo_professores();

echo "<h1>Indicadores das Escolas</h1>";
echo $doc->resumo_escolas();
require("foot.php");
?>
