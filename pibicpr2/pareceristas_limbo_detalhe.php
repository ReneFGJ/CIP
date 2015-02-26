<?
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_email.php');

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
	/* Dados da Classe */
	require('../_class/_class_pareceristas_limbo.php');
	$clx = new avaliador_limbo;
	$clx->le($dd[0]);
	
	$clx->mostra_dados();

require("../foot.php");		
?> 