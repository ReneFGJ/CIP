<?php
require("cab_db.php");
require($include.'sisdoc_debug.php');
require($include.'_class_form.php');
$form = new form;

require('../_class/_class_pucpr_formulario.php');
$ff = new formulario;

$cp = $ff->cp();

$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		
	} else {
		echo $tela;
	}

?>
