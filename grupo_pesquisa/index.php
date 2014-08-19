<?
$breadcrumbs=array();
require("cab.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

array_push($menu,array('Grupo de Pesquisa','Grupos de Pesquisa (lista)','grupo_de_pesquisa_validados.php'));

?>
<TABLE width="710" align="center" border="0">
<TR>
<?php
	$tela = menus($menu,"3");

require("../foot.php");	
?>