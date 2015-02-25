<?php
require("cab.php");
require("../_class/_class_pibic_projetos.php");
$pp = new pibic_projetos;

echo $pp->edital_perfil();

require("foot.php")
?>
