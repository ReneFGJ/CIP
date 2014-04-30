<?php
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_autor.php');
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_autor.php");
$autor = new autor;

require("../_class/_class_article.php");
$art = new article;

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$art->le($dd[0]);
//echo '<A HREF="http://www2.pucpr.br/reol/pibicpr2/ed_edit.php?dd0='.$pb->id_pb.'&dd99=pibic_bolsas_contempladas" target="new">';
//echo '{editar}';
//echo '</A>';

echo $art->mostrar();


require("../foot.php");	
?>