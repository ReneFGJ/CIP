<?php
require("cab.php");
require("../_class/_class_pibic_projetos_v2.php");
$ano = date("Y");
$meta = 1100;

echo '<H3>Projetos em Submiss�o</h3>';
$pj = new projetos;
echo $pj->projetos_validar(date("Y"),'!');
echo '<h3>Enviadas para corre��o e n�o finaliadas</h3>';
echo $pj->projetos_validar(date("Y"),'@');
?>
