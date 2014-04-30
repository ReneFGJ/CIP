<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$file = "../pibic/__submit_".$dd[1].'.php';
/*
 * 
 */

//if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	if (strlen($dd[2]) > 0)
		{
			$flt = fopen($file,'w+');
			fwrite($flt,'<?php'.chr(13).chr(10));
			fwrite($flt,' $open = '.round($dd[2]).chr(13).chr(10));
			fwrite($flt,'?>'.chr(13).chr(10));
			fclose($flt);
		}
	
	if (!(file_exists($file)))
		{
			$open = 0;
		} else {
			require($file);
		}
	
	switch ($dd[1])
	{
			case 'RPAR': $caption = 'Relatório Parcial'; break; 
		}
		
	echo '<h1>'.$caption.'</h1>';	
	if ($open == 0)
		{
			$sx .= '<h2><font color="red">FECHADO!</font></h2>';
			$sx .= '<A HREF="'.page().'?dd1='.$dd[1].'&dd2=1">';
			$sx .= '<IMG SRC="'.$http.'img/icone_switch_off.png" border=0>';
			$sx .= '</A>';
			
		} else {
			$sx .= '<h2><font color="green">ABERTO!</font></h2>';
			$sx .= '<A HREF="'.page().'?dd1='.$dd[1].'&dd2=0">';
			$sx .= '<IMG SRC="'.$http.'img/icone_switch_on.png">';
			$sx .= '</A>';		
		}
	
	echo $sx;
	}
//	} else {
//		echo '<h3>Acesso negado!</h3>';
//	}	
require("../foot.php");	
?>