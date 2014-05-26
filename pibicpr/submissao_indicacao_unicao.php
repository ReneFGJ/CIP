<?php
require("cab.php");
require("../_class/_class_pibic_projetos.php");
$ano = date("Y");

echo '<H3>Projetos para avaliação</h3>';
$pj = new projetos;

echo $pj->mostra_planos_com_uma_indicacao(date("Y"));
?>
