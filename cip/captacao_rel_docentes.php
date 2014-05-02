<?php
require("cab.php");
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

	
	require('../_class/_class_agencia_editais.php');
	$clx = new agencia_editais;
	$tabela = $clx->tabela.'_captacao';	
	
	echo $clx->dados_exportar();

require("../foot.php");			
?>
