<?php
require("cab_fomento.php");

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


require("../_class/_class_fomento.php");
$fmt = new fomento;
echo $fmt->resumo();


array_push($menu,array('Editais de Chamadas','Editais de chamadas','chamadas.php'));
array_push($menu,array('Editais de Chamadas','__Categorias das chamadas','chamadas_categorias.php'));

array_push($menu,array('Envio de e-mail','Disparar e-mail na lista','chamadas_enviar_email.php'));
array_push($menu,array('Envio de e-mail','Cancelar lista de envio','chamadas_enviar_cancelar.php')); 

array_push($menu,array('Cadastros','Cadastro de Agências de Fomento','agencia_de_fomento.php'));

$tela = menus($menu,"3");

require("../foot.php");	
?>