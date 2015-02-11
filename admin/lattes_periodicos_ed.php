<?php
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'_class_form.php');
$form = new form;

require($include.'sisdoc_debug.php');
	echo 'oi';
	/* Dados da Classe */
	require('../_class/_class_lattes.php');
	$clx = new lattes;
	
	$cp = $clx->cp_journal();
	$tabela = $clx->tabela_journal;
	$tela = $form->editar($cp,$tabela);
	
	if ($form->saved > 0)
		{
			$clx->updatex_journal();
			redirecina('lattes_periodicos.php');
			echo 'saved';
		} else {
			echo $tela;
		}

require("../foot.php");		
?> 