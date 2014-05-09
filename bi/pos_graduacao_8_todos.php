<?php
/*** Modelo ****/
require("cab_bi.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$programa_nome = '';
	$programa_pos = '';

	require('../_class/_class_docentes.php');
	$prof = new docentes;
	
	$areas = array($clx->area_avaliacao_codigo);
	echo '<BR>';
	echo $prof->resumo_teses_dissertacoes($programa_pos,$areas);
	//resumo_qualis_ss
	echo $prof->docentes_orientacoes($programa_pos,'');
require("../foot.php");		
?> 