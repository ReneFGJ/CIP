<?
$breadcrumbs=array();
array_push($breadcrumbs, array('/fonzaghi/finan/index.php','Financeiro'));

require("cab.php");
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

require("../_class/_class_docentes.php");

	$clx = new docentes;
	$cp = $clx->cp();
	$tabela = 'docente_orientacao';
	
	$label = msg("docentes");
	$http_edit = 'discente_orientacao_ed.php'; 
	$http_ver = 'discente_orientacao_detalhe.php'; 
	
	$editar = false;
 	if ($perfil->valid('#RES')) { $editar = True; }
	$editar = True;
	
	$http_redirect = page();
	
	$clx->row_docente_orientacoes();	
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	//exit;
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 
?>