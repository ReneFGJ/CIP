<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab.php");
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

echo '<H1>Isenção Discente de Bonificação<H1>';
$cp = array();

if (strlen($dd[1]) == 0) { $dd[1] = '01/06/2012'; }
if (strlen($dd[2]) == 0) { $dd[2] = date("d/m/Y"); }
$mod = '001:Início de Vigência';
$mod .= '&002:Projetos Vigêntes'; 

$sta = '0:Todos';
array_push($cp,array('${','','Projetos Vigêntes',False,False));
array_push($cp,array('$D8','','Data Inicial',True,True));
array_push($cp,array('$D8','','Data Final',True,True));
array_push($cp,array('$O '.$mod,'','Modelo do relatório',True,True));
array_push($cp,array('$O '.$sta,'','Status',True,True));
array_push($cp,array('$}','','',False,False));

echo '<table width="400" cellpadding=5 cellspacing=5><TR><TD>';
editar();
echo '</table>';

if ($saved > 0)
	{
		$dd1 = brtos($dd[1]);
		$dd2 = brtos($dd[2]);
		if ($dd[3] == '001') { echo $bon->isencao_inicio($dd1,$dd2); }
		if ($dd[3] == '002') { echo $bon->isencao_vigentes($dd1,$dd2); }
	}
require("../foot.php");
?>
