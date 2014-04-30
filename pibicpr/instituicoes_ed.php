<?php
require('cab.php');

global $acao,$dd,$cp,$tabela;
require($include.'_class_form.php');
require($include.'sisdoc_data.php');

$form = new form;

echo '<h1>Cadastro de Instituições</h1>';


	/* Dados da Classe */
	require("../_class/_class_instituicao.php");
	$cl = new instituicao;
	$cl->tabela = 'instituicao';
	
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

	require("../foot.php");	
?>

