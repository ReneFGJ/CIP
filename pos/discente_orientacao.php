<?
$breadcrumbs=array();
array_push($breadcrumbs, array('/fonzaghi/finan/index.php','Financeiro'));

require("cab_pos.php");
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

require("../_class/_class_docentes_os2.php");

	$clx = new docentes;
	$cp = $clx->cp();
	$tabela = 'docente_orientacao';
	
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

	
	echo '<h1>Fluxo discentes</h1>';
	echo '<h3>Orientações</h3>';	
	//exit;
	$tab_max = '98%';
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 
?>