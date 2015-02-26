<?php
require("cab.php");
require("../_class/_class_pibic_contrato.php");

$cnt = new pibic_contrato;
echo $cnt->lista_minutas();

require("foot.php");
?>
