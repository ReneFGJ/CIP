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
$rel .= '&7:Produção por Escola / (Lattes)';
$rel .= '&8:Produção Total (Lattes)';
$rel .= '&9:Projetos / Cursos';

$cp = array();
array_push($cp,array('$[2009-'.date('Y').']','','Ano',True,True));
array_push($cp,array('$O '.$rel,'','Relatório',True,True));
array_push($cp,array('$H1','','',False,True));

$tela = $form->editar($cp,'');


if ($form->saved > 0)
	{
	$indi->ano = $dd[0];
	//$indi->indicador_001(3);
	switch ($dd[1])
		{
		case '3': Echo '<h1>Iniciação Científica - Escola / Pesquisador</h1>'; break;
		case '11': Echo '<h1>Iniciação Científica - Campus / Pesquisador</h1>'; break;
		}
	echo $indi->indicador_001($dd[1]);
	
	echo '<BR>Legenda:';
	echo '<BR>CSF - Ciência sem fronteira';
	echo '<BR>PIBIC - Iniciação Científica';
	echo '<BR>PIBITI - Iniciação Tecnológica e Inovação';
	echo '<BR>PIBIC_EM - Iniciação Científica Júnior (ensino médio)';
	echo '<BR>MOBI - Mobilidade Nacional';
	
	} else {
		echo $tela;
	}
require("../foot.php");	
?>