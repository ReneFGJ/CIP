<?
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_docentes.php');

	$clx = new docentes;
	$cp = $clx->cp();

	$clx->professores_sem_codigo();

require("../foot.php");		
?> 