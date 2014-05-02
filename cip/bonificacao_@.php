<?php
/*** Modelo ****/
require("cab_cip.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_bonificacao.php');

	$clx = new bonificacao;
	$tabela = $clx->tabela;
	
	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
	/* Não alterar - dados comuns */
	$label = msg($tabela);
	$http_edit = 'bonificacao_ed.php'; 
	$http_ver = 'bonificacao_detalhe.php'; 
	$editar = False;
	$http_redirect = page();
	$clx->row();
	$busca = true;
	$offset = 40;
	$pre_where = " bn_status = '@' ";
	$order = " bn_codigo ";
	
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 