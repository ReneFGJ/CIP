<?php
require("cab_semic.php");
require("../_class/_class_semic_avaliacao.php");
$sa = new avaliacao;

require($include.'_class_form.php');
$form = new form;

$op1 = ' : &P:P�ster&O:Oral';
$op2 = ' : ';
$op2 .= '&E:Ci�ncias Exatas';
$op2 .= '&A:Ci�ncias Agr�rias';
$op2 .= '&V:Ci�ncias da Vida';
$op2 .= '&H:Ci�ncias Humanas e Letras';
$op2 .= '&S:Ci�ncias Sociais Aplicadas';
$op2 .= '&Z:Pos-Graduacao';
$op2 .= '&Y:PIBICJr';

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$O '.$op1,'','Modalidade',False,False));
array_push($cp,array('$O '.$op2,'','�rea',False,False));
$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		echo '<HR>'.$sa->show_notas_final($dd[2],$dd[1]);
	} else {
		echo $tela;		
	}
require("../foot.php");
?>
