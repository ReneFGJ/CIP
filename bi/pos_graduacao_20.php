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
	echo $clx->le($programa_pos);
	echo $clx->mostra();
	
	//echo '<BR>';
	//echo $clx->orientacoes($programa_pos,'',$programa_pos_anoi,$programa_pos_anof);
	
	//echo $clx->orientacoes_docente($programa_pos,'',$programa_pos_anoi,$programa_pos_anof);
	//resumo_qualis_ss
	echo '<HR>CPF - Discentes</HR>';
	echo $clx->discentes_cpf($programa_pos,'',$programa_pos_anoi,$programa_pos_anof);

require("../foot.php");		
?> 