<?php
require('cab.php');

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'_class_form.php');
require($include.'sisdoc_data.php');

$form = new form;
$label = 'Submiss�o';

echo $hd->menu();
echo '<div id="conteudo">';
	echo $hd->main_content($label);	

	/* Dados da Classe */
	require("_class/_class_submit_article.php");
	$cl = new submit;
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
			redirecina('submit_works_detalhes.php?dd0='.$dd[0]);
		} else {
			echo $tela;
		}
echo '</div>';		
require("foot.php");	
?>

