<?php
require("cab_no.php");

require($include.'_class_form.php');
$form = new form;

require('../_class/_class_pibic_projetos_v2.php');
$pj = new projetos;
$cp = $pj->cp_plano();
$tabela = $pj->tabela_planos;
$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		require("../close.php");
	} else {
		echo $tela;
	}
?>