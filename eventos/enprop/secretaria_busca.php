<?php
require("secretaria_cab.php");
require($include.'sisdoc_data.php');

require("_class/_class_proceeding.php");
$ev = new proceeding;

echo '<h1>Inscritos</h1>';
$filtro = UpperCaseSql($dd[1]);
echo $ev->lista_inscritos('',$filtro);

echo $sc->foot();
?>
