<?php
$include = '../';
require('../db.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'cp2_gravar.php');

	require('../_class/_class_pibic_projetos.php');	
	$prj = new projetos;
	$tabela = 'pibic_submit_documento';    
	$cp = $prj->cp_ti();
	
	echo '<table><TR><TD>';
	editar();
	echo '</table>';
if ($saved > 0)
	{
		require('../close.php');
	}
?>

