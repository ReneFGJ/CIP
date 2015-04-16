<?php
require("cab.php");

echo '<h1>Gestão de avaliação do Comitê de Ética</h1>';
require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$ano = $pb->recupera_ano_ativo();

echo $pb->parecer_nao_entregues($ano);

?>