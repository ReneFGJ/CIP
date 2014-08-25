<?php
require("cab.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

$cp = array();
if (strlen($dd[1])==0) { $dd[1] = '01/01/2012'; }
if (strlen($dd[2])==0) { $dd[2] = date("d/m/Y"); }
array_push($cp,array('$M8','','Avalições não completadas',False,False));
array_push($cp,array('$D8','','Indicados entre',True,True));
array_push($cp,array('$D8','','até',True,True));

echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Indicações em aberto');

editar();

if ($saved > 0)
	{
	require("_class/_class_parecer.php");
	$pa = new parecer;
	$pa->tabela = 'reol_parecer_enviado';
	
	$dd1=brtos($dd[1]);
	$dd2=brtos($dd[2]);
	echo $pa->parecer_abertos($dd1,$dd2);
	}
echo '</div>';
require("foot.php");
?>
