<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Capta��o'));

require("cab_cip.php");
require("../_class/_class_artigo.php");
$art = new artigo;

echo '<H2>Artigos cadastrado para bonifica��o</h2>';
$art->docente = $ss->user_cracha;
echo $art->mostra_artigo();	

require("../foot.php");	
?>