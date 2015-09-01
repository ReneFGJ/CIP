<?php
require("cab.php");


require($include.'/_class_form.php');
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$T80:5','','lista de e-mail',True,True));
echo '<h1>Ferramenta de e-mail</h1>';
$tela = $form->editar($cp,'');
echo $tela;
echo '<HR>';
if ($form->saved > 0)
	{
		$t = $dd[1];
		$t = troca($t,chr(13),'; ');
		echo $t;
	}

?>
