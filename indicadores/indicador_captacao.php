<?php
require("cab.php");

echo $hd->hr('Indicador de capta��o');

$menu = array();
array_push($menu,array('Capta��o','Edital Universal - CNPq','captacao_cnpq_universal.php'));
echo menus($menu,3);

//require("foot.php");
?>
