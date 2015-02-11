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
array_push($menu,array(msg('SEMIC').' - Programa��o','Salas de apresenta��o','semic_salas.php'));
array_push($menu,array(msg('SEMIC').' - Programa��o','Apresenta��o P�ster','semic_salas_poster.php'));
array_push($menu,array(msg('SEMIC').' - Programa��o','Blocos de apresenta��o','semic_blocos.php'));

array_push($menu,array(msg('SEMIC').' - Programa��o','Avaliadores P�ster','semic_poster.php'));
array_push($menu,array(msg('SEMIC').' - Programa��o','Localizar avaliador de P�ster','semic_poster_localizar.php'));

//array_push($menu,array(msg('SEMIC'),'Melhores Trabalhos','semic_works.php'));
//array_push($menu,array(msg('SEMIC'),'Trabalhos aprovados','semic_works_aproved.php'));

//array_push($menu,array(msg('SEMIC'),'Trabalhos para o SEMIC',''));
//array_push($menu,array(msg('SEMIC'),'__Lista por escolas/professores','semic_presentation.php?dd2=1'));
//array_push($menu,array(msg('SEMIC'),'__�reas do conhecimento','semic_presentation_areas.php'));

array_push($menu,array(msg('SEMIC').' published','__Trabalhos (C�digos)','semic_site_01.php'));
array_push($menu,array(msg('SEMIC').' published','__Trabalhos Campi (C�digos)','semic_site_01a.php'));
array_push($menu,array(msg('SEMIC').' published','__Trabalhos (Geral)','semic_site_02.php'));

//array_push($menu,array(msg('SEMIC').' programacao','__Programa��o','semic_programacao_trabalhos.php'));
array_push($menu,array(msg('SEMIC').' SEMIC','Publicar','semic_exportar_anais.php'));

//array_push($menu,array(msg('SEMIC').' programacao','__Programa��o','semic_busca_codigo.php'));

//array_push($menu,array(msg('SEMIC').' pos-evento','__Trabalhos n�o apresentados','semic_nao_apresentados.php'));

array_push($menu,array(msg('SEMIC').' evento','Publicar trabalhos no site','semic_trabalhos_semic.php'));

array_push($menu,array(msg('SEMIC').' avaliadores','Busca avaliador da PUCPR','semic_avaliador_import.php'));

array_push($menu,array(msg('SEMIC').' paineis','Listar Paineis','semic_paineis_listar.php'));

array_push($menu,array(msg('SEMIC').' avaliadores','Lista de avaliadores ativos','semic_avaliadores_ativos.php'));


array_push($menu,array(msg('SEMIC').' ouvintes','Cadastro de Ouvintes','semic_ouvintes.php'));

$tela = menus($menu,"3");

require("../foot.php");	
?>