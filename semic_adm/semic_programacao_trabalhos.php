<?php
require("cab_semic.php");
require($include.'_class_form.php');
$form = new form;
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

$blck = ' : ';
$blck .= '&001:10h30 as 12h30';
$blck .= '&002:13h30 as 15h15';
$blck .= '&003:15h30 as 18h00';
$blck .= '&004:18h30 as 20h30';
$blck .= '&000:09h00 as 10h30';
$blck .= '&005:09h30 as 12h00';
$blck .= '&006:08h00 as 09h15';
$blck .= '&xxx:Cancelado';
$sala = ' : ';
$sala .= '&S21001:Sala 1';
$sala .= '&S21002:Sala 2';
$sala .= '&S21003:Sala 3';
$sala .= '&S21004:Sala 4';
$sala .= '&S21005:Sala 5';
$sala .= '&S21006:Sala 6';
$sala .= '&S21007:Sala 7';
$sala .= '&S21008:Sala 8';
$sala .= '&S21009:Sala 9';
$sala .= '&S21010:Sala 10';
$sala .= '&S21011:Sala 11';
$sala .= '&S21012:Sala 12';
$sala .= '&S21013:Sala 13';

$cp = array();
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$D8','','Data',True,True));
array_push($cp,array('$O '.$blck,'','Bloco',True,True));
array_push($cp,array('$T20:7','','Trabalho',True,True));
array_push($cp,array('$O '.$sala,'','Sala',True,True));

echo $form->editar($cp,'');

if ($form->saved > 0)
	{
		require("../_class/_class_semic_programacao.php");
		$progm = new semic_programacao;
		$date = brtos($dd[1]);
		$block = $dd[2];
		$room = $dd[4];
		$dd[3] .= chr(13).chr(10).'##';
		
		$trabs = splitx(chr(13),$dd[3]);
		
		for ($r=0;$r < count($trabs);$r++)
			{
				$trab = trim($trabs[$r]);
				$trab = troca($trab,'##','');
				if (strlen($trabs) > 0)
					{
					$progm->schedule_insert($trab,$date,$block,$room);
					echo '<BR> SAVED: '.$trab;	
					}	
			}
		
		



	}

?>