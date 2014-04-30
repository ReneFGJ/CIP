<?php
require("cab.php");

/*
 * $breadcrumbs
 */
require('../_class/_class_area_do_conhecimento.php');
$are = new area_do_conhecimento;

$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

$tabela = "ajax_areadoconhecimento";
	$http_edit = 'areadoconhecimento_ed.php';
	$editar = true;
	$http_redirect = page();

	$are->row();

	$busca = true;
	$offset = 40;
	$order  = " a_cnpq";
	
	require($include."sisdoc_row.php");

	require("../foot.php");	
?>