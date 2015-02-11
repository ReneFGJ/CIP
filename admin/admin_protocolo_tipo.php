<?
require("cab.php");

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
	
	require("../_class/_class_protocolo.php");
	$clx = new protocolo;
	$tabela = $clx->tabela;
	
	$http_edit = 'admin_protocolo_tipo_ed.php'; 
	$editar = True;
	
	//$http_ver = 'admin_perfil_ver.php';
	
	$http_redirect = page();
	
	$clx->row();
	
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	//exit;
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 