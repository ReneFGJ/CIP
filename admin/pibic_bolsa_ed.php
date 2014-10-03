<?php
require('cab.php');
require('../_class/_class_pibic_bolsa_contempladas.php');
//require('../messages/msg_pibic_bolsa_tipo_ed.php');
$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'_class_form.php');
$form = new form;

	$cl = new pibic_bolsa_contempladas;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	echo '<HR>'.$tabela.'<HR>';
	
	$http_edit = page();
	$http_redirect = '';
	$tit = msg("titulo");

	/** Comandos de Edição */
	$tela = $form->editar($cp,$tabela);
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			redirecina('pibic_bolsas.php');
		} else {
			echo $tela;
		}
require("../foot.php");		
?>

