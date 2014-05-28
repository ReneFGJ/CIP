<?php
require('cab_fomento.php');
require('../_class/_class_fomento.php');

$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'_class_form.php');
$form = new form;

require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	$cl = new fomento;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	
	$http_edit = page();
	$http_redirect = '';

	/** Comandos de Edição */
	$tela = $form->editar($cp,$tabela);

	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			redirecina('chamadas.php');
		} else {
			echo $tela;
		}
require("../foot.php");	
?>

