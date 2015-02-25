<?
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_pareceristas_limbo.php');

	$clx = new avaliador_limbo;
	
	$clx->listar();

require("../foot.php");		
?> 