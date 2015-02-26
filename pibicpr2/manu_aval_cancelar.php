<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

require('../_class/_class_parecer_pibic.php');
$ava = new parecer_pibic;

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$A8','','Cancelamento das avaliações',False,True,''));
array_push($cp,array('$[2010-'.date("Y").']','','',True,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$O : &SIM:SIM','','Confirma cancelamento?',True,True,''));

	echo '<CENTER><font class=lt5>Cancelamento das avaliações</font></CENTER>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	if ($saved > 0)
		{
			$ava->tabela = "pibic_parecer_".$dd[2];
			echo $ava->cancel_avaliation();
		}
	require("foot.php");
?>