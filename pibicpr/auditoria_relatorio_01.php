<?php
/*** Modelo ****/
require("cab.php");
ini_set('max_execution_time','2360');
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_pibic_mirror.php');

	$clx = new mirror;
	
	echo $clx->auditoria_01('2012');
?>