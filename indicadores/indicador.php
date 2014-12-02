<?php
require("cab.php");

echo $hd->hr('Indicador de captação');
$tab_max = '100%';

$menu = array();
array_push($menu,array('Captação de Recursos','Captação de Recursos','indicador_captacao.php'));


array_push($menu,array('Panorama da Pesquisa','Iniciação Científica e Tecnológica','indicadores_ic.php'));
array_push($menu,array('Panorama da Pesquisa','Pós-Graduação','indicadores_pos.php'));
//array_push($menu,array('Grupo de Pesquisa','Grupo de pesquisa','indicador_grupo.php'));
echo menus($menu,3);

//require("foot.php");
?>
