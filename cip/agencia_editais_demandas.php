<?php
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_agencia_editais.php');

	$clx = new agencia_editais;
	$cp = $clx->cp_captacao();
	$tabela = $clx->tabela. "_captacao";
	
	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
	/* Não alterar - dados comuns */
	$label = msg($tabela);
	$http_edit = 'agencia_editais_demandas_ed.php'; 
	$http_ver = 'agencia_editais_demandas.php'; 
	$editar = True;
	$http_redirect = $tabela.'.php';
	$clx->row_demanda();
	$busca = true;
	$offset = 20;
	
	if ($order == 0) { $order  = $cdf[3] . ' desc '; }
	
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 