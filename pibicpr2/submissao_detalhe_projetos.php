<?
///////////////// Versao 0.0.1f de 02/08/2008
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_autor.php');

require("../_class/_class_pibic_projetos.php");
$pj = new pibic_projetos;

$sx = $pj->projetos_sumetidos_campus('PUC PR CAMPUS TOLEDO','2012','PIBIC');

echo $sx;

require("foot.php");	
?>