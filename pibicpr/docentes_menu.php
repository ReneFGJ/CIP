<?php
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
$path = "cadastro.php";
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('iniciação científica')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu CIP')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Docentes</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';

//////////////////// MANAGERS ///////////////////////////////

$menu = array();

	array_push($menu,array('Docentes','Cadastro de docentes','docentes.php'));
	array_push($menu,array('Orientadores','Docentes Dr. sem email cadastrado ','pibic_docentes_email.php'));
	
	if ($perfil->valid('#PIB'))
	{
		array_push($menu,array('Docentes (impedimentos)','Docentes com impedimento','docentes_penalidades.php'));
	}  
	

	menus($menu,'3');

	require("../foot.php");	
?>