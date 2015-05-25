<?php
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
	
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('iniciação científica')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu CIP')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Submissões</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';
	

	//pode requerir qualquer classe que precise do edital e data
	require("../_class/_class_pibic_projetos_v2.php");
	$pb = new projetos;
	
	//ano atual
	$ano = date("Y");
	
	//Array
	$cp = array();
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$A8','','Seleciona dado',False,True,''));
	array_push($cp,array('$[2010-'.date("Y").']','','Ano edital ',False,True,''));
	array_push($cp,array('$HV','',$ano,True,True,''));

	if ($dd[2] != null) {
		echo '<h1>Editais do ano base de '.$dd[2].'</h1>';
	} else {
		echo '<h1>Seleciona Ano do edital </h1>';
	}
	
	
	//monta tabela de seleciona dados
	?><TABLE width="<?=$tab_max?>"align="center"><TR><TD><?
		editar();
	?></TD></TR></TABLE><?	
	
	if ($saved == 0)
		{ exit; }
	
			
	//aqui pode chamar qualquer método destro da classe e passae como parametro o edital e a data ou mais dados que precisar			
	
	echo $pb->resumo_planos_escola($dd[2]);
	echo $pb->resumo_planos_campus($dd[2]);
	
	require("../foot.php");	
	
?>