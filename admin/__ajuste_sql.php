<?php
require('cab.php');

require($include.'../_class_form.php');
$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$T80:6','','',TRUE,True));

$form = new form;
$tela = $form->editar($cp,'');
echo $tela;

if ($form->saved > 0)
	{
		$rlt = db_query($sql);
	}
?>