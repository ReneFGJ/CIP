<?php
require("cab.php");
require("../_class/_class_pibic_bolsa_contempladas.php");
$ic = new pibic_bolsa_contempladas;

echo $ic->rel_curso_bolsas(2011);
?>
