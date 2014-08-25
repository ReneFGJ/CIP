<?php
require('cab_pos.php');

global $acao,$dd,$cp,$tabela;
require($include.'_class_form.php');
$form = new form;
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	require("../_class/_class_mobilidade.php");
	$cl = new mobilidade;
	
	$cp = $cl->cp_estrangeiro();
	$http_edit = 'mobilidade_estrangeiro_ed.php';
	$http_redirect = '';
	$tabela = $cl->tabela;
	echo '<h3>Discente Estrangeiro - Editar</h3>';
	/** Comandos de Edição */
	echo $form->editar($cp,$tabela);	
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			echo 'Salvo';
			redirecina('mobilidade_estrangeiro.php');
		}
require("../foot.php");	
?>

