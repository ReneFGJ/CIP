<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatуrios'));

require("cab_cip.php");
require($include."_class_form.php");
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$[2010-'.date("Y").']','','Ano inical de apuraзгo',true,true));
array_push($cp,array('$[2010-'.date("Y").']D','','Ano final de apuraзгo',true,true));

$tela = $form->editar($cp,'');
if ($form->saved > 0)
	{
		require("../_class/_class_artigo.php");
		$ar = new artigo;
		echo $ar->lista_q1($dd[1],$dd[2]);
	} else {
		echo $tela;
	}
require("../foot.php");	?>