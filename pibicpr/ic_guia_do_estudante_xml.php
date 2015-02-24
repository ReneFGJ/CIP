<?php
$include = '../';
require("../db.php");

header("Content-type: application/vnd.ms-excel; name='excel' ");
header("Content-Disposition: filename=guia_do_estudante_".date("Y").".xls");
header("Pragma: no-cache");
header("Expires: 0");

require('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

echo $pb->guia_estudante($dd[1],$dd[2]);		
?>