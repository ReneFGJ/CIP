<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Capta��o'));

require("cab.php");
require("../_class/_class_captacao.php");
require("../_class/_class_docentes.php");

$doc = new docentes;
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
$cap = new captacao;

$ano = 2000;
if (strlen($dd[1]) > 0) { $ano = $dd[1]; }
$programa = $dd[2];
echo $cap->captacao_ano_detalhe($ano,$programa);
	
require("../foot.php");	?>