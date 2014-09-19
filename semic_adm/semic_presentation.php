<?php
require("cab_semic.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require($include.'_class_form.php');
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$Q centro_nome:centro_codigo:select * from centro order by centro_nome','','',False,False));

$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		echo $pb->mostra_projetos_escolas($dd[4]);
	} else {
		echo $tela;		
	}


echo $hd->foot();
?>
