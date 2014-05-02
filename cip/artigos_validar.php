<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captaчуo'));
require("../_class/_class_artigo.php");
$art = new artigo;

require("cab_cip.php");

require($include.'sisdoc_debug.php');
require_once($include.'sisdoc_data.php');

//echo $cap->atualiza_vigencias();
echo $art->total_artigos_validar($ss->user_cracha);
$art->docente = $ss->user_cracha;

require("../foot.php");
?>