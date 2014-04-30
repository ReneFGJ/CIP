<?
require("cab_cip.php");
require('../_class/_class_grupo_de_pesquisa.php');

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');

	$clx = new grupo_de_pesquisa;
	$cp = $clx->cp();
	
	echo $clx->grupos_resumo();
	echo $clx->grupos_areas_resumo();
	
	echo $clx->grupos_de_pesquisa_relacao();

require("../foot.php");		
?> 