<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");
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
if (strlen($acao) == 0) { $dd[1] = date("Y").'01'; }

$opp = '001:Escolas';
$opp .= '&002:Programas de Pós';
$opt = ': &0:todos&1:Agencias de Fomento&2:Empresas';
array_push($cp,array('${','','Captação Vigêntes',False,False));
array_push($cp,array('$O '.$opm,'','Vigêntes em',True,True));
array_push($cp,array('$O '.$opp,'','Agrupados por',True,True));
array_push($cp,array('$O '.$opt,'','Tipos',True,True));
array_push($cp,array('$}','','',False,False));

echo '<center>';
echo '<table width="400" cellpadding=5 cellspacing=5><TR><TD>';
editar();
echo '</table>';

if ($saved > 0)
	{
	echo $cap->captacao_geral($dd[1],$dd[2],$dd[3]);
	}
	
require("../foot.php");	?>

