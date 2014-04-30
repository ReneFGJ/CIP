<?php
require("cab.php");
require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

echo '<h3>Bolsas Implementadas / Finalizadas</h3>';

echo $pb->resumo_bolsas();

echo $hd->foot();
?>
