<?php
require("secretaria_cab.php");
require($include.'sisdoc_data.php');
require("_class/_class_proceeding.php");
$ev = new proceeding;

echo '<h1>Inscritos</h1>';
echo $ev->resumo_inscritos();

echo $sc->foot();
?>
