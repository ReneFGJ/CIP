<?php
$include = '../';
require("cab.php");

require($include.'_class_form.php');
$form = new form;

echo '<h1>Alunos IC com renovação</h1>';
$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$[2009-'.date("Y").']','','Ano Inicial',True,True));
array_push($cp,array('$[2009-'.date("Y").']','','Ano Final',True,True));

$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		require('../_class/_class_pibic_bolsa_contempladas.php');
		$pb = new pibic_bolsa_contempladas;
		
		echo $pb->renovacoes($dd[1],$dd[2]);
		
	} else {
		echo $tela;
	}



?>