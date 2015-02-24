<?
require("cab_fomento.php");
require('_class_comunicacao.php');

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$clx = new comunicacao;
	$tabela = $clx->tabela;
	
	$label = msg("chamadas");
	$http_edit = 'comunicacao.php';
	$http_ver = 'comunicacao_preview.php';  
	
	$http_redirect = page();
	$editar = True;
	
	$clx->row();
	$busca = true;
	$offset = 20;
	$order = 'id_cm desc';
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	//exit;
	$tab_max = "100%";
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 