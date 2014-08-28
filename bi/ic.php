<?
$breadcrumbs=array();
require("cab_bi.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

array_push($menu,array('Orientadores','Professores stricto sensu','ic_professor_ss.php'));

array_push($menu,array('Avaliadores','Avaliadores de submissão','ic_avaliadores.php'));


$tela = menus($menu,"3");
echo $tela;

require("../foot.php");	
?>