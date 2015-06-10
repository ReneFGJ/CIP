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
echo '<h1>Discentes</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';

//////////////////// MANAGERS ///////////////////////////////

$menu = array();

	array_push($menu,array('Discentes','Cadastro de discentes','discentes.php'));
	array_push($menu,array('Discentes','Consultar dados do SIGA','discente_consulta.php'));
	if ($perfil->valid('#PIB'))
	{
		array_push($menu,array('Discentes (seguro)','Relatório de discentes ativos IC Capital (Seguro)','discentes_seguro.php?dd1=1'));
		array_push($menu,array('Discentes (seguro)','Relatório de discentes ativos IC Interior (Seguro)','discentes_seguro.php?dd1=2'));
	} 
	if ($perfil->valid('#TST')) 
	{
		array_push($menu,array('Csf','Relatório de alunos que já retornaram','estudantes_csf_retorno.php'));
		array_push($menu,array('SWB','Alunos inscritos no SWB Experience '. date("Y"),'estudantes_inscritos_swb.php'));
	}  
		

	menus($menu,'3');

	require("../foot.php");	
?>