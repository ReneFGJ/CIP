<?php
require("cab.php");

require("../editora/_class/_class_declaracao.php");
$dec = new declaracao;

echo 'DECLARA��ES DE AVALIA��O';

$dec->ano = date("Y");

$avaliador = $par->id;
echo $dec->listar_declaracoes_disponiveis($avaliador);

?>
