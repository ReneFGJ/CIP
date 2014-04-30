<?php
/*** Modelo ****/
require("cab.php");
ini_set('max_execution_time','2360');
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_pibic_mirror.php');

	$clx = new mirror;
	$cp = $clx->cp();
	
	//$clx->structure();
	
	$ano = '2009';
	$nano = round($ano);
	
	//$clx->espelho($nano,8,$ano);
	//$clx->espelho($nano,9,$ano);
	//$clx->espelho($nano,10,$ano);

	//$clx->espelho($nano,11,$ano);
	//$clx->espelho($nano,12,$ano);
	//$clx->espelho($nano+1,1,$ano);

	//$clx->espelho($nano+1,2,$ano);
	//$clx->espelho($nano+1,3,$ano);
	//$clx->espelho($nano+1,4,$ano);

	//$clx->espelho($nano+1,5,$ano);
	//$clx->espelho($nano+1,6,$ano);
	//$clx->espelho($nano+1,7,$ano);
	
	

require("../foot.php");		
?> 
