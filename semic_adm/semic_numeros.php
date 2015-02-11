<?php
require("cab_semic.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';


require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array(msg('SEMIC').' - Apresentações','Número de apresentações','semic_apresentacao_resumo.php'));

array_push($menu,array(msg('SEMIC').' - Jovens Ideias e Pesquisa é evoluir','Avaliações','semic_ji_pev_notas.php'));


$tela = menus($menu,"3");

require("../foot.php");	
?>