<?php
require("cab.php");
require($include.'sisdoc_menus.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'pibicpr/pagamentos.php',msg('pagamentos')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

	require('../_class/_class_pibic_bolsa_contempladas.php');
	$pb = new pibic_bolsa_contempladas;

	$dd1 = $dd[0];
	echo $pb->bolsa_duplicatas(2012);

require("../foot.php");	
?>