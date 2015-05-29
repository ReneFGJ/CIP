<?php
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
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

//////////////////// MANAGERS ///////////////////////////////
echo '</BR></BR></BR></BR>';
$cp = array();
if (strlen($dd[1])==0) { $dd[1] = '01/01/2012'; }
if (strlen($dd[2])==0) { $dd[2] = date("d/m/Y"); }
array_push($cp,array('$M8','','Escolha um intervalo de datas para a busca',False,False));
array_push($cp,array('$D8','','Indicados entre',True,True));
array_push($cp,array('$D8','','até',True,True));

editar();

if ($saved > 0)
	{
	require("../_class/_class_parecer_pibic.php");
	$pa = new parecer_pibic;
	$pa->tabela = "pibic_parecer_".date("Y");
		
	$dd1=brtos($dd[1]);
	$dd2=brtos($dd[2]);
	echo $pa->parecer_abertos_submissao($dd1,$dd2,'SUBMP','B');
	}

?>
