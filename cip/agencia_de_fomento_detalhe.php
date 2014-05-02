<?php
require("cab_cip.php");
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	/* Mensagens */
	$link_msg = '../messages/msg_'.$tabela.'_ed.php';
	if (file_exists($link_msg)) { require($link_msg); }	

	/* Dados da Classe */
	require('../_class/_class_agencia_de_fomento.php');
	$age = new agencia_fomento;
	//$age->structure();
	
	$id = $dd[0];
	$age->le($id);
	
	echo $age->mostra_dados();
	
	require('../_class/_class_agencia_editais.php');
	$clx = new agencia_editais;
	//$clx->structure();
	$cp = $clx->cp();
	$clx->agencia = $age->codigo;
	echo $clx->mostra_editais();
	
print_r($clx);

require("../foot.php");			
?>
