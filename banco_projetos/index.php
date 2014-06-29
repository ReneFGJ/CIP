<?
$breadcrumbs=array();
require("cab_bp.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

array_push($menu,array('Banco de Projetos','Projetos Cadastrados','banco_projetos.php'));
array_push($menu,array('Banco de Projetos','__Formato Excel','banco_projetos_excel.php'));
array_push($menu,array('Banco de Projetos','__Pesquisadores Excel','banco_pesquisadores_excel.php'));

//lista_pesquisadores_excel

///////////////////////////////////////////////////// redirecionamento
?>

<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="index.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?php
	$tela = menus($menu,"3");

require("../foot.php");	
?>