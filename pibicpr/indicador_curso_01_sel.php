<?
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_curso.php');
	//$sql = "update pibic_mirror set mr_status = 'A' ";
	//$rlt = db_query($sql);
	
	$clx = new curso;
	$clx->le($dd[0]);
	print_r($clx);
	$_SESSION['curso_nome'] = $clx->curso_nome;
	$_SESSION['curso_codigo'] = $clx->$curso_codigo;
	redirecina('indicadores.php');
	

require("../foot.php");		
?> 