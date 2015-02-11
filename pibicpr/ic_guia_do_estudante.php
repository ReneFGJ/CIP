<?php
$include = '../';
require("cab.php");

require($include.'_class_form.php');
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$[2009-'.date("Y").']','','Ano Inicial',True,True));
array_push($cp,array('$[2009-'.date("Y").']','','Ano Final',True,True));

$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		redireciona('ic_guia_do_estudante_xml.php?dd1='.$dd[1].'&dd2='.$dd[2]);
		exit;
	} else {
		echo $tela;
	}



?>