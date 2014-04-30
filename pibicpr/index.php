<?php
require("cab.php");
require("realce.php");
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_calender.php");
$cal = new calendar;

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

if (strlen($dd[10]) == 0)
	{ echo $hd->search(); }
else
	{
		echo '<h1>Resultado da busca</h1>';
		echo $pb->search($dd[10]);
		require("../foot.php");
		exit;
	}

$menu = array();
/////////////////////////////////////////////////// MANAGERS
//if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('PIBIC/PIBITI','Panorama da Pesquisa','pibic_panorama.php'));
	} 

///////////////////////////////////////////////////// redirecionamento

	$tela = menus($menu,"3");
	
	$mes = date("Ym01");
	$cals = $cal->actions($mes);
	array_push($cals,array(date("Ymd"),'Hoje','Hoje','teste','#E0E0E0'));
	
	echo '<table class="tabela00" width="98%" border=1>';
	echo '<TR><TD class="tabela00" align="center" width="200">';
	echo '<font class="lt3"><B>'.$date->month_name(round(substr($mes,4,2))).'/'.substr($mes,0,4).'</b></font>';
	echo '<TR><TD class="tabela01" align="center">';
	echo $cal->calendar($mes,$cals,'#888');
	echo '<TD>'.$cal->actions_list($cals);
	
	echo '<TR><TD class="tabela00" align="center">';
	
	$mes = DateAdd('m',1,$mes);
	$cals = $cal->actions($mes);
	echo '<font class="lt3"><B>'.$date->month_name(round(substr($mes,4,2))).'/'.substr($mes,0,4).'</b></font>';
	echo '<TR><TD class="tabela01" align="center">';
	echo $cal->calendar($mes,$cals,'#888');
	echo '<TD>'.$cal->actions_list($cals);
	
	echo '<TR><TD class="tabela00" align="center">';
	
	$mes = DateAdd('m',1,$mes);
	$cals = $cal->actions($mes);
	echo '<TR><TD class="tabela01" align="center">';
	echo '<font class="lt3"><B>'.$date->month_name(round(substr($mes,4,2))).'/'.substr($mes,0,4).'</b></font>';
	echo $cal->calendar($mes,$cals,'#888');
	echo '<TD>'.$cal->actions_list($cals);	
	
	echo '</table>';
		
require("../foot.php");	
?>