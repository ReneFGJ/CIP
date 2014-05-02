<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captaчуo'));

require("../_class/_class_captacao.php");
$cap = new captacao;

require("cab_cip.php");
require($include.'sisdoc_debug.php');
require_once($include.'sisdoc_data.php');

//echo $cap->atualiza_vigencias();
echo $cap->total_captacoes_validar($ss->user_cracha);
$cap->docente = $ss->user_cracha;

require("../foot.php");
?>