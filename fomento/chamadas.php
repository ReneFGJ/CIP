<?
require("cab_fomento.php");
require('../_class/_class_fomento.php');

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$clx = new fomento;
	$tabela = $clx->tabela;
	
	$label = msg("chamadas");
	$http_edit = 'chamadas_ed.php';
	$http_ver = 'chamadas_ver.php';  
	
 	if ($perfil->valid('#RES')) { $editar = True; }
	$http_redirect = page();
	$editar = True;
	
	$clx->row();
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	//exit;
	$tab_max = "100%";
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 