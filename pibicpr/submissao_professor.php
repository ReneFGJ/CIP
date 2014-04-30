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
	require('../_class/_class_pibic_projetos.php');	
	
	$clx = new projetos;
	$cp = $clx->cp();
	$tabela = $clx->tabela;
	
	/* Não alterar - dados comuns */
	$http_edit = $tabela.'_ed.php'; 
	//$http_ver = 'pibic_bolsa_tipo_detalhe.php'; 
	$editar = True;
	$http_redirect = page();
	$http_ver = $tabela.'_detalhes.php';
	$clx->row();
	$busca = true;
	$offset = 20;
	
	//$pre_where = " doc_ano = '".date("Y")."' ";
	if ($order == 0) { $order  = $cdf[1]; }
	
	echo '<h1>Projetos submetidos</h1>';
	
	echo '<TABLE width="98%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';

require("../foot.php");	
?>