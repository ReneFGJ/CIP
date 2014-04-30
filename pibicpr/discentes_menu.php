<?php
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('Discentes','Cadastro de discentes','discentes.php'));
	array_push($menu,array('Discentes','Consultar dados do SIGA','discente_consulta.php'));
	if ($perfil->valid('#PIB'))
	{
		array_push($menu,array('Discentes (seguro)','Relatório de discentes ativos IC Capital (Seguro)','discentes_seguro.php?dd1=1'));
		array_push($menu,array('Discentes (seguro)','Relatório de discentes ativos IC Interior (Seguro)','discentes_seguro.php?dd1=2'));
	}  
	

	menus($menu,'3');

	require("../foot.php");	
?>