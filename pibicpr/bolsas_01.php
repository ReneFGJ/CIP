<?php
require("cab.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

echo $pb->resumo('PIBIC');
echo $pb->resumo('PIBITI');
echo $pb->resumo('PIBIC_EM');
echo $pb->resumo('CSF');

echo $hd->foot();
?>
