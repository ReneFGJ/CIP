<?php
require("cab.php");
require($include.'sisdoc_menus.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

$cp = array();
array_push($cp,array('$D8','','Dt.Inicial',True,True));
array_push($cp,array('$D8','','até',True,True));

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'pibicpr/pagamentos.php',msg('pagamentos')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

echo '<table>';
editar();
echo '</table>';

if ($saved > 0)
	{
	require('../_class/_class_pibic_pagamento.php');
	$pag = new pagamentos;
	$dd1 = brtos($dd[0]);
	$dd2 = brtos($dd[1]);
	echo $pag->pagamentos_por_data($dd1,$dd2);
	}	
require("../foot.php");	
?>