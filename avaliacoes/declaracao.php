<?php
require("cab.php");

require("../editora/_class/_class_declaracao.php");
$dec = new declaracao;

echo 'DECLARA��ES DE AVALIA��O';

$dec->ano = date("Y");

$avaliador = $par->id;
echo $dec->listar_declaracoes_disponiveis($avaliador);

require($include.'sisdoc_debug.php');

echo '<h2>Declara��o de Avaliador Inicia��o Cient�fica</h2>';
require("../_class/_class_declaracao_ic.php");
$ic = new declaracao_ic;
echo $ic->listar_declaracoes_disponiveis($avaliador);
?>
