<?php
/* $breadcrumbs */
$breadcrumbs = array();
array_push($breadcrumbs,array('main.php','principal'));
array_push($breadcrumbs,array($site.'main.php','menu'));
require("cab_atividades.php");

require($include.'sisdoc_data.php');
require("_class/_class_atividades.php");
$act = new atividades;
$codigo = $nw->user_cracha;
echo $act->lista_atividades($codigo);

echo $hd->foot();

?>