<?php
/*** Modelo ****/
require("cab_bi.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	$programa_nome = $_SESSION['pos_nome'];
	$programa_pos = $_SESSION['pos_codigo'];

	/* Dados da Classe */
	echo '<h3>Corpo docente do programa</h3>';
	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;
	echo $clx->mostra_programa_docentes($programa_pos);

require("../foot.php");		
?> 