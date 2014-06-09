<?php
require("cab_bi.php");
require($include.'sisdoc_debug.php');

require('_class/_class_banco_variaveis.php');
$bc = new banco_variavel;

require($include.'_class_form.php');
$form = new form;

$tabela = $bc->tabela;

$cp = $bc->cp();

$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		$bc->updatex();
		redirecina('var.php');
	} else {
		echo $tela;	
	}
?>
