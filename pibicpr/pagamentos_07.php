<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_debug.php');
require("../_class/_class_hsbc.php");

$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'pibicpr/pagamentos.php',msg('pagamentos')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require('../_class/_class_pibic_pagamento.php');

$pag = new pagamentos;


$cp = array();
array_push($cp,array('$S16','','Nr Documento',True,True));
array_push($cp,array('$D8','','Vencimento',True,True));
array_push($cp,array('$S30','','Descrição do motivo',True,True));


/*
 * $breadcrumbs
 */

echo '<table>';
editar();
echo '</table>';

if ($saved > 0)
	{
		$pag->extornar_titulo($dd[0],$dd[2],brtos($dd[1]));
	}	
require("../foot.php");	
?>