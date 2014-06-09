<?php
require("secretaria_cab.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
require("_class/_class_proceeding.php");
$ev = new proceeding;

require("_class/_class_form.php");
$form = new form;

$id = sonumero($dd[0]);
if ($id > 0)
	{
		$cp = $ev->cp_todos();

		$tela = $form->editar($cp,'evento_enprop');
		echo '<table width="800" align="center">';
		echo '<TR><TD>';
		if ($form->saved > 0)
			{
				redirecina('secretaria_inscritos.php');
				exit;
			}
		echo $tela;
		echo '</table>';
	}


function msg($x) { return($x); }

echo $sc->foot();
?>
