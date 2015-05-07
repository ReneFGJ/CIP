<?php
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
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