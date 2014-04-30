<?php
require("cab.php");
require("../_class/_class_pibic_projetos_v2.php");
$ano = date("Y");
$meta = 1100;

echo '<H3>Indicados para correção do professor</h3>';
$pj = new projetos;
echo $pj->projetos_validar(date("Y"),'@');
?>
