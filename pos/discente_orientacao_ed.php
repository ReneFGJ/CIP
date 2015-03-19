<?php
require ('cab_pos.php');
require ($include . 'sisdoc_data.php');
global $acao, $dd, $cp, $tabela;
require ($include . '_class_form.php');
$form = new form;
require ($include . 'sisdoc_debug.php');
require ("../_class/_class_docentes.php");
$cl = new docentes;
$cp = $cl -> cp_docente_orientacoes();
$tabela = 'docente_orientacao';

$http_edit = page();
$http_redirect = '';
$tit = msg("titulo");

/** Comandos de Ediçãoo */
echo '<h1>Fluxo Discente</H1>';
$tela = $form -> editar($cp, $tabela);

/** Caso o registro seja validado */
if ($form -> saved > 0) {
	redirecina('discente_orientacao.php');
} else {
	echo $tela;
}
?>