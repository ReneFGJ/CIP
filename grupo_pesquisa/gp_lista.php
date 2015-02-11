<?
$breadcrumbs=array();
require("cab.php");

require("../_class/_class_grupo_de_pesquisa.php");
$gp = new grupo_de_pesquisa;

echo $gp->lista_grupos($dd[1]);

require("../foot.php");
?>