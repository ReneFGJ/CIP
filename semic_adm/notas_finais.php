<?php
require("cab_semic.php");
require("../_class/_class_semic_avaliacao.php");
$sa = new avaliacao;

require($include.'_class_form.php');
$form = new form;

$op1 = ' : &P:Pôster&O:Oral';
$op2 = ' : ';
$op2 .= '&E:Ciências Exatas';
$op2 .= '&A:Ciências Agrárias';
$op2 .= '&V:Ciências da Vida';
$op2 .= '&H:Ciências Humanas e Letras';
$op2 .= '&S:Ciências Sociais Aplicadas';
$op2 .= '&Z:Pos-Graduacao';
$op2 .= '&Y:PIBICJr';

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$O '.$op1,'','Modalidade',False,False));
array_push($cp,array('$O '.$op2,'','Área',False,False));
$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		echo '<HR>'.$sa->show_notas_final($dd[2],$dd[1]);
	} else {
		echo $tela;		
	}
require("../foot.php");
?>
