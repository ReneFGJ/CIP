<?php
require("db.php");

	require($include.'_class_form.php');
	$form = new form;
	$form->ajax = 1;

require("_class/_class_message.php");
$file = 'messages/msg_pt_BR.php';
require($file);

$idf = 1;
$sx .= '<img src="../img/icone_close.png" align="right"  
			id="box'.$idf.'a" border=0 height="15" 
			onclick="hidden_div(\'box'.$idf.'\');" >';
echo $sx;

echo '<B>FORM</B><HR>';
switch ($dd[1])
	{
	case 'programa_pos_capes':
		require('_class/_class_programa_pos.php');
		$pos = new programa_pos;
		$cp = $pos->cp_avaliacao();
		$sx = $form->editar($cp,'');
		echo $sx;
		break;
	}
?>
