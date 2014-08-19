<?php
require("cab.php");
require($include.'sisdoc_menus.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

	$tab_max = "98%";

	/* Dados da Classe */
	require ("../_class/_class_pibic_recurso.php");
	$recurso = new recurso;

	$tabela = $recurso->tabela;
	
	//$http_ver = 'pibic_bolsa_tipo_detalhe.php'; 
	$editar = False;
	$http_redirect = page();
	$http_ver = 'recurso_detalhes.php';
	$recurso->row();
	$busca = true;
	$offset = 20;
	
	//$pre_where = " doc_ano = '".date("Y")."' ";
	if ($order == 0) { $order  = $cdf[1]; }
	
	echo '<h1>Recursos Abertos</h1>';
	
	echo '<TABLE width="98%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';


require("../foot.php");	
?>