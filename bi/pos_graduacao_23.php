<?php
/*** Modelo ****/
require("cab_bi.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$programa_nome = $_SESSION['pos_nome'];
	$programa_pos = $_SESSION['pos_codigo'];
	$programa_pos_anoi = $_SESSION['pos_anoi'];
	$programa_pos_anof = $_SESSION['pos_anof'];
	if (strlen($programa_pos_anoi)==0) { $dd[2] = 1996; }
	if (strlen($programa_pos_anof)==0) { $dd[3] = date("Y"); }		

	require('../_class/_class_docentes.php');
	$prof = new docentes;

	/* Dados da Classe */
	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;
	
	/* Dados da Classe */
	require('../_class/_class_captacao.php');
	$cap = new captacao;
		
	$clx->le($programa_pos);
	echo $clx->mostra();
	echo '<h3>Captação Vigente '.$programa_pos_anoi.' - '.$programa_pos_anof.'</h3>';
	echo $cap->mostra_captacao_programas_vigentes($clx->codigo,$programa_pos_anoi,$programa_pos_anof);	

require("../foot.php");		
?> 