<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Capta��o'));

require("cab_cip.php");
require("../_class/_class_captacao.php");
$cap = new captacao;

echo '<H2>Projetos de capta��o</h2>';
$cap->docente = $ss->user_cracha;
echo $cap->mostra_captacao();	

require("../foot.php");	
?>