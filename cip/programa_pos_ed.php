<?php
require('cab_cip.php');
require('../_class/_class_programa_pos.php');

$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'_class_form.php');
$form = new form;

require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	$cl = new programa_pos;
	$cp = $cl->cp();
	$tabela = $cl->tabela;
	
	/* Mensagens */
	$link_msg = '../messages/msg_'.$tabela.'_ed.php';
	if (file_exists($link_msg)) { require($link_msg); }	
	
	$http_edit = $tabela.'_ed.php';
	$http_redirect = '';
	$tit = msg("titulo");

	/** Comandos de Edição */
	$tela = $form->editar($cp,$tabela);
	
	/** Caso o registro seja validado */
	if ($form->saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			redirecina($tabela.'.php');
		} else {
			echo $tela;
		}
require("../foot.php");	
?>

