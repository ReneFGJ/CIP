<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

$tpo = '90:Substituições';
//$tpo .= '&91:Cancelamentos';
$cp = array();
array_push($cp,array('$D8','','de',True,True));
array_push($cp,array('$D8','','até',True,True));
array_push($cp,array('$O '.$tpo,'','Tipo',True,True));

?>
<TABLE width="<?=$tab_max;?>" align="center">
<TR><TD colspan=2></TD><h2>Parametros do relatório</h2></TR>
<TR><TD><?
editar();
?></TD></TR></TABLE><?	
	
if ($saved > 0)
{
	$dd0 = brtos($dd[0]);
	$dd1 = brtos($dd[1]);
	require("../_class/_class_pibic_historico.php");
	$his = new pibic_histotico;
	echo $his->historico($dd[2],$dd0,$dd1);
}

require("../foot.php");	
?>