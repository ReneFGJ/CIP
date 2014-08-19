<?php
require('cab.php');

require($include.'_class_form.php');
$form = new form;

require('../_class/_class_pibic_projetos_v2.php');
$ca = new projetos;

	$tabela = $ca->tabela_planos;
	$cp = $ca->cp_plano();
	
	$http_edit = page();

	$tela = $form->editar($cp,$tabela);
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			redirecina('submissao_plano.php');
		} else {
			echo $tela;
		}
require("../foot.php");
?>

