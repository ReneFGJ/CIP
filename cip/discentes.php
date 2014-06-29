<?
require("cab.php");
require('../_class/_class_discentes.php');

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$clx = new discentes;
	$tabela = $clx->tabela;
	
	$label = ("discente");
	$http_edit = 'discentes_ed.php'; 
	$http_ver = 'discentes_detalhe.php'; 

	$editar = false;
 	if ($perfil->valid('#RES')) { $editar = True; }
	$http_redirect = 'discentes.php';
	$editar = True;
	
	$clx->row();
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	$order  = "pa_nome";
	//exit;
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 