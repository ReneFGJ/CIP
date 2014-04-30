<?php
require('cab.php');

require($include.'_class_form.php');
$form = new form;

require('../_class/_class_area_do_conhecimento.php');
$ca = new area_do_conhecimento;

	$tabela = $ca->tabela;
	$cp = $ca->cp();
	
	$http_edit = page();

	$tela = $form->editar($cp,$tabela);
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			redirecina('areadoconhecimento.php');
		} else {
			echo $tela;
		}
require("../foot.php");
?>

