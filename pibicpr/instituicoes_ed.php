<?php
require('cab.php');

global $acao,$dd,$cp,$tabela;
require($include.'_class_form.php');
require($include.'sisdoc_data.php');

$form = new form;
$label = msg('dados_da_publicacao');


	/* Dados da Classe */
	require("_class/_class_instituicoes.php");
	$cl = new instituicoes;
	$tabela = $cl->tabela;
	$cp = $cl->cp();
	
	$http_edit = page();
	$http_redirect = '';

	/** Comandos de Edicao */
	$tela = $form->editar($cp,$tabela);
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			redirecina('instituicoes.php');
		} else {
			echo $tela;
		}

	require("foot.php");	
?>

