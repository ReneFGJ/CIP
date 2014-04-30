<?
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_curso.php');
	
	require('../_class/_class_pibic_bolsa_contempladas.php');
	$pb = new pibic_bolsa_contempladas;


	$curso = $_SESSION['curso_nome'];
	$cursoc = $_SESSION['curso_codigo'];

	$clx = new curso;
	$tabela = $clx->tabela;
	echo $pb->indicador_bolsa_completadas($curso,'P');
	echo '<BR><BR><BR>';

require("../foot.php");		
?> 