<?
require("cab.php");
require('../_class/_class_docentes.php');

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$clx = new docentes;
	$cp = $clx->cp();
	$tabela = $clx->tabela;
	
	$label = msg("docentes");
	$http_edit = 'docentes_ed.php'; 
	$http_ver = 'docentes_detalhe.php'; 
	$editar = True;
	
	$http_redirect = 'docentes.php';
	
	
	$clx->row();
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	$order  = "pp_nome";
	//exit;
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 