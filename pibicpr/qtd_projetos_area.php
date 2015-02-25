<?php
require("cab.php");
require($include.'sisdoc_email.php');
require("../_class/_class_pibic_bolsa_contempladas.php");

require("../_class/_class_pareceristas.php");
$par = new parecerista;

require("../_class/_class_docentes.php");
$doc = new docentes;

echo $par->qtd_projetos_por_area();
//echo "Em desenvolvimemto";

require("../foot.php");	

?>