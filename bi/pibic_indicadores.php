<?
$breadcrumbs=array();
require("cab_bi.php");
require("../_class/_class_indicadores.php");
$indi = new indicador;

require($include.'_class_form.php');
$form = new form;

$rel = ' : ';
$rel .= '&3:Escola / Pesquisadores';
$rel .= '&4:Escola / Projetos de Pesquisa';
$rel .= '&5:Tipo de Bolsa / Escola';
$rel .= '&10:Escola / Tipo de Bolsa';
$rel .= '&11:Campus / Tipo de Bolsa';
$rel .= '&6:Tipo de Bolsa';
$rel .= '&7:Produ��o por Escola / (Lattes)';
$rel .= '&8:Produ��o Total (Lattes)';
$rel .= '&9:Projetos / Cursos';

$cp = array();
array_push($cp,array('$[2009-'.date('Y').']','','Ano',True,True));
array_push($cp,array('$O '.$rel,'','Relat�rio',True,True));
array_push($cp,array('$H1','','',False,True));

$tela = $form->editar($cp,'');


if ($form->saved > 0)
	{
	$indi->ano = $dd[0];
	//$indi->indicador_001(3);
	switch ($dd[1])
		{
		case '3': Echo '<h1>Inicia��o Cient�fica - Escola / Pesquisador</h1>'; break;
		case '11': Echo '<h1>Inicia��o Cient�fica - Campus / Pesquisador</h1>'; break;
		}
	echo $indi->indicador_001($dd[1]);
	
	echo '<BR>Legenda:';
	echo '<BR>CSF - Ci�ncia sem fronteira';
	echo '<BR>PIBIC - Inicia��o Cient�fica';
	echo '<BR>PIBITI - Inicia��o Tecnol�gica e Inova��o';
	echo '<BR>PIBIC_EM - Inicia��o Cient�fica J�nior (ensino m�dio)';
	echo '<BR>MOBI - Mobilidade Nacional';
	
	} else {
		echo $tela;
	}
require("../foot.php");	
?>