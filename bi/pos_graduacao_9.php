<?php
/*** Modelo ****/
require("cab_bi.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$programa_nome = $_SESSION['pos_nome'];
	$programa_pos = $_SESSION['pos_codigo'];

	require('../_class/_class_docentes.php');
	$prof = new docentes;

	/* Dados da Classe */
	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;
	echo $clx->le($programa_pos);
	echo $clx->mostra();
	
	$areas = array($clx->area_avaliacao_codigo);
	echo '<BR>';
	echo $prof->resumo_teses_dissertacoes($programa_pos,$areas);
	//resumo_qualis_ss

require("../foot.php");		
?> 