<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require("_class/_class_semic_blocos.php");
$blc = new blocos;

echo '<HR>';

require($include.'sisdoc_data.php');
require($include.'_class_form.php');
$form = new form;
echo '<BR><BR><BR><BR><BR><BR><BR><BR>';
$cp = $blc->cp();

$tela = $form->editar($cp,$blc->tabela);

echo $tela;

if ($form->saved > 0)
	{
		$blc->updatex();
		redirecina("semic_blocos.php");			
	}
?>
