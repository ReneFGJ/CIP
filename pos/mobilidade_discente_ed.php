<?php
require('cab_pos.php');

global $acao,$dd,$cp,$tabela;
require($include.'_class_form.php');
$form = new form;
require($include.'sisdoc_data.php');

	require("../_class/_class_mobilidade.php");
	$cl = new mobilidade;
	
	$cp = $cl->cp_discente();
	$http_edit = 'mobilidade_discente_ed.php';
	$http_redirect = '';
	$tabela = $cl->tabela;
	/** Comandos de Edi��o */
	echo $form->editar($cp,$tabela);
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			echo 'Salvo';
			redirecina('mobilidade_discente.php');
		}
require("../foot.php");	
?>
