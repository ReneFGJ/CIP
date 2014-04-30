<?php
require("cab.php");
require($include.'sisdoc_menus.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'pibicpr/pagamentos.php',msg('pagamentos')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require('../_class/_class_pibic_pagamento.php');
$pag = new pagamentos;


echo $pag->pagamentos_lotes($dd[1]);
echo $pag->detalhe_pagamentos($dd[1],0,$dd[2]);

/*
 * 
 */

/* echo $pag->excluir_pagamentos_lotes($dd[1]); */
 
require("../foot.php");	
?>