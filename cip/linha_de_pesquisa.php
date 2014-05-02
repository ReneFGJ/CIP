<?
require("cab.php");
require('../_class/_class_linha_de_pesquisa.php');
	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); } else { echo 'message not found '.$link_msg; }

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$clx = new linha_de_pesquisa;
	$cp = $clx->cp();
	$tabela = $clx->tabela;
	$clx->structure();
	
	$label = msg("mensagens");
	$http_edit = 'linha_de_pesquisa_ed.php'; 
	$http_ver = 'linha_de_pesquisa_detalhe.php'; 
	$editar = True;
	
	$http_redirect = 'linha_de_pesquisa.php';
	
	$cdf = array('id_lp','lp_nome','lp_area_1');
	$cdm = array('cod',msg('nome'),msg('area'));
	$masc = array('','','','','','','');
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	$order  = "lp_nome";
	//exit;
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 