<?php
require("cab.php");

echo $hd->hr('Indicador de capta��o');
$tab_max = '100%';

$menu = array();
array_push($menu,array('Capta��o de Recursos','Capta��o de Recursos','indicador_captacao.php'));

array_push($menu,array('Corpo Docente','Corpo docente','indicador_docentes.php'));

array_push($menu,array('Flux Discente','Fluxo Discente','indicador_discentes_pos.php'));


array_push($menu,array('Panorama da Pesquisa','Inicia��o Cient�fica e Tecnol�gica','indicadores_ic.php'));
array_push($menu,array('Panorama da Pesquisa','P�s-Gradua��o','indicadores_pos.php'));
array_push($menu,array('Panorama da Pesquisa','P�s-Gradua��o (produ��o Q1/ExR)','indicadores_pos_q1.php'));

//array_push($menu,array('Grupo de Pesquisa','Grupo de pesquisa','indicador_grupo.php'));
echo menus($menu,3);

//require("foot.php");
?>
