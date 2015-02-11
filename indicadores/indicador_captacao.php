<?php
require("cab.php");

echo $hd->hr('Indicador de captação');

$menu = array();
array_push($menu,array('Captação','Edital Universal - CNPq','captacao_cnpq_universal.php'));
echo menus($menu,3);

//require("foot.php");
?>
