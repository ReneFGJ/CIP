<?php
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

require("../_class/_class_discentes.php");
$dis = new discentes;

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$ano = date("Y");
if (date("m") < 8) { $ano--; }
echo $pb->alunos_ativos_ic($ano,$dd[1]);

require("../foot.php");	
?>