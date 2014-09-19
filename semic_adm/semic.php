<?php
require("cab_semic.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';


$file = '../messages/msg_index.php';
if (file_exists($file)) { require($file); }

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array(msg('SEMIC'),'Melhores Trabalhos','semic_works.php'));
array_push($menu,array(msg('SEMIC'),'Trabalhos aprovados','semic_works_aproved.php'));

array_push($menu,array(msg('SEMIC'),'Trabalhos para o SEMIC',''));
array_push($menu,array(msg('SEMIC'),'__Lista por escolas/professores','semic_presentation.php?dd2=1'));
array_push($menu,array(msg('SEMIC'),'__Áreas do conhecimento','semic_presentation_areas.php'));

array_push($menu,array(msg('SEMIC').' published','__Trabalhos (Códigos)','semic_site_01.php'));
array_push($menu,array(msg('SEMIC').' published','__Trabalhos Campi (Códigos)','semic_site_01a.php'));
array_push($menu,array(msg('SEMIC').' published','__Trabalhos (Geral)','semic_site_02.php'));

array_push($menu,array(msg('SEMIC').' programacao','__Programação','semic_programacao_trabalhos.php'));
array_push($menu,array(msg('SEMIC').' programacao','__Programação','semic_programacao_mostrar.php'));

array_push($menu,array(msg('SEMIC').' programacao','__Programação','semic_busca_codigo.php'));

array_push($menu,array(msg('SEMIC').' pos-evento','__Trabalhos não apresentados','semic_nao_apresentados.php'));

array_push($menu,array(msg('SEMIC').' evento','Publicar trabalhos no site','semic_trabalhos_semic.php'));


$tela = menus($menu,"3");

require("../foot.php");	
?>