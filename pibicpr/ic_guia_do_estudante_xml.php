<?php
$include = '../';
require("../db.php");

header("Content-type: application/vnd.ms-excel; name='excel' ");
header("Content-Disposition: filename=guia_do_estudante_".date("Y").".xls");
header("Pragma: no-cache");
header("Expires: 0");

require('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

require($include.'_class_form.php');
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$[2009-'.date("Y").']','','Ano Inicial',True,True));
array_push($cp,array('$[2009-'.date("Y").']','','Ano Final',True,True));

$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		echo $pb->guia_estudante($dd[1],$dd[2]);		
	} else {
		echo $tela;
	}



?>