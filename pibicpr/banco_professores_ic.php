<?php
require("cab.php");
require($include.'sisdoc_email.php');
require("../_class/_class_pibic_bolsa_contempladas.php");
require("../_class/_class_pareceristas.php");
require("../_class/_class_docentes.php");

//$par = new parecerista;
$doc = new docentes;

echo $doc->banco_professores_avaliadores();

require("../foot.php");	

?>