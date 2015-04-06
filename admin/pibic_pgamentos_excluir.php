<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_pagamento.php");
$clx = new pagamentos;

require($include.'_class_form.php');
$form = new form;

$data = $dd[1];

if (strlen($data) > 0)
	{
		$clx->cancelar_lancar_data($data);
	}
require("../foot.php");	
?>