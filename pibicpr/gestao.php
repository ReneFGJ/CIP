<?php
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('iniciação científica')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu CIP')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Acompanhamento</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';

//////////////////// MANAGERS ///////////////////////////////
$menu = array();

if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Gestão','PIBIC / PIBITI','gestao_ic.php'));
	array_push($menu,array('Gestão','PIBIC_EM (Jr)','gestao_pibic_jr.php'));
	
	array_push($menu,array('Gestão Docentes','Demitidos com orientação','gestao_docentes_demitidos.php'));
	
	array_push($menu,array('Certificados','Central de Certificados','central_certificados.php'));
	
	
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
	array_push($menu,array('Submissões (Abrir/Fechar)','__'.$sx . ' Correções','submissao_switch.php?dd1=RPAC'));

	require("../pibic/__submit_RFIN.php");
	if ($open == 1) { $sx = '<IMG SRC="'.$http.'img/icone_switch_on.png" border=0 height="22">'; }
	else			{ $sx = '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0 height="22">'; }
	array_push($menu,array('Submissões (Abrir/Fechar)',$sx . ' Relatório Final e Resumo','submissao_switch.php?dd1=RFIN'));

	require("../pibic/__submit_RFIC.php");
	if ($open == 1) { $sx = '<IMG SRC="'.$http.'img/icone_switch_on.png" border=0 height="22">'; }
	else			{ $sx = '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0 height="22">'; }
	array_push($menu,array('Submissões (Abrir/Fechar)','__'.$sx . ' Correções','submissao_switch.php?dd1=RFIC'));

	require("../pibic/__submit_INPL.php");
	if ($open == 1) { $sx = '<IMG SRC="'.$http.'img/icone_switch_on.png" border=0 height="22">'; }
	else			{ $sx = '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0 height="22">'; }
	array_push($menu,array('Submissões (Abrir/Fechar)',$sx . ' Implementação de Bolsa','submissao_switch.php?dd1=INPL'));


	require("../pibic/__submit_MOSTRA.php");
	if ($open == 1) { $sx = '<IMG SRC="'.$http.'img/icone_switch_on.png" border=0 height="22">'; }
	else			{ $sx = '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0 height="22">'; }
	array_push($menu,array('SEMIC',$sx . ' Resumo para Mostra de Pesquisa','submissao_switch.php?dd1=MOSTRA'));

	require("../pibic/__submit_RESUMO.php");
	if ($open == 1) { $sx = '<IMG SRC="'.$http.'img/icone_switch_on.png" border=0 height="22">'; }
	else			{ $sx = '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0 height="22">'; }
	array_push($menu,array('SEMIC',$sx . ' Correção de Resumos','submissao_switch.php?dd1=RESUMO'));
	} 

///////////////////////////////////////////////////// redirecionamento

	$tela = menus($menu,"3");
require("../foot.php");	
?>