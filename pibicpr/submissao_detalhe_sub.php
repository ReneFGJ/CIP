<?php
require("cab.php");
require("../_class/_class_pibic_projetos.php");
$ano = date("Y");
$meta = 1100;

echo '<H3>Projetos em Submissão</h3>';
$pj = new projetos;
echo $pj->razao_submissao_planos(date("Y"),'','@');
?>
