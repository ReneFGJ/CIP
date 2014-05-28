<?php
/*** Modelo ****/
require("cab_fomento.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_agencia_de_fomento.php');

	$clx = new agencia_fomento;
	$cp = $clx->cp();
	$tabela = $clx->tabela;
	
	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
	/* Não alterar - dados comuns */
	$label = msg($tabela);
	$http_edit = 'agencia_de_fomento_ed.php'; 
	$http_ver = 'agencia_de_fomento_detalhe.php'; 
	$editar = True;
	$http_redirect = $tabela.'.php';
	$clx->row();
	$busca = true;
	$offset = 20;
	
	if ($order == 0) { $order  = $cdf[1]; }
	$tab_max = '100%';
	echo '<TABLE width="98%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 