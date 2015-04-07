<?php
require('cab.php');
require('../_class/_class_discentes.php');

global $acao,$dd,$cp,$tabela;
require($include.'_class_form.php');
$form = new form;

require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	$cl = new discentes;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	
	$http_edit = 'discentes_ed.php';
	$http_redirect = '';
	$tit = msg("titulo");

	/** Comandos de Edição */
	echo '<CENTER><font class=lt5>Cadastro de Discentes</font></CENTER>';
	$tela = $form->editar($cp,$tabela);
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			redirecina('discentes.php');
		} else {
			echo $tela;
		}
		
		
?>

