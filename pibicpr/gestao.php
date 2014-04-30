<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
//require("../include/_class_menus.php");
//$mn = new menus;
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();

echo '<h1>Acompanhamento de IC</h1>';

/////////////////////////////////////////////////// MANAGERS
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Gestão','PIBIC / PIBITI','gestao_ic.php'));
	array_push($menu,array('Gestão','PIBIC_EM (Jr)','gestao_pibic_jr.php'));
	
	array_push($menu,array('Gestão Docentes','Demitidos com orientação','gestao_docentes_demitidos.php'));
	
	require("../pibic/__submit_SUBM.php");
	if ($open == 1) { $sx = '<IMG SRC="'.$http.'img/icone_switch_on.png" border=0 height="22">'; }
	else			{ $sx = '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0 height="22">'; }
	array_push($menu,array('Submissões (Abrir/Fechar)',$sx . ' Submissão de PIBIC/PIBITI','submissao_switch.php?dd1=SUBM'));	
	
	require("../pibic/__submit_RPAR.php");
	if ($open == 1) { $sx = '<IMG SRC="'.$http.'img/icone_switch_on.png" border=0 height="22">'; }
	else			{ $sx = '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0 height="22">'; }
	array_push($menu,array('Submissões (Abrir/Fechar)',$sx . ' Relatório Parcial','submissao_switch.php?dd1=RPAR'));


	require("../pibic/__submit_RPAC.php");
	if ($open == 1) { $sx = '<IMG SRC="'.$http.'img/icone_switch_on.png" border=0 height="22">'; }
	else			{ $sx = '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0 height="22">'; }
	array_push($menu,array('Submissões (Abrir/Fechar)',$sx . ' Relatório Parcial Correções','submissao_switch.php?dd1=RPAC'));


	require("../pibic/__submit_RFIN.php");
	if ($open == 1) { $sx = '<IMG SRC="'.$http.'img/icone_switch_on.png" border=0 height="22">'; }
	else			{ $sx = '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0 height="22">'; }
	array_push($menu,array('Submissões (Abrir/Fechar)',$sx . ' Relatório Final e Resumo','submissao_switch.php?dd1=RFIN'));
	} 

///////////////////////////////////////////////////// redirecionamento

	$tela = menus($menu,"3");
require("../foot.php");	
?>