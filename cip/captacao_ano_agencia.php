<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab.php");
require("../_class/_class_captacao.php");
require("../_class/_class_docentes.php");

$doc = new docentes;
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
$cap = new captacao;
$cp = array();

/* Anos */
$opm = ' : ';
for ($r=2003; $r <= (date("Y")+4);$r++)
	{ $opm .= '&'.$r.'01'.':'.$r; }


array_push($cp,array('${','','Projetos',False,False));
array_push($cp,array('$O '.$opm,'','Iniciaram entre',True,True));
array_push($cp,array('$O '.$opm,'','e',True,True));
array_push($cp,array('$}','','',False,False));

echo '<center>';
echo '<table width="400" cellpadding=5 cellspacing=5><TR><TD>';
editar();
echo '</table>';

if ($saved > 0)
	{
	echo $cap->captacao_agencia_ano($dd[1],$dd[2]);
	}
	
require("../foot.php");	?>

