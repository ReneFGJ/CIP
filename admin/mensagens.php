<?php
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('Comunica��o','Submiss�o','')); 
	array_push($menu,array('Comunica��o','__mensagens do portal do professor (site IC)','mensagens_portal_ver.php')); 
	array_push($menu,array('Comunica��o','__mensagens (Todas)','mensagens_ver.php')); 
///////////////////////////////////////////////////// redirecionamento
$tab_max = "98%";
?>
<TABLE width="98%" align="center" border="0">
<TR>
<?
menus($menu,'3');
?>
</TABLE>
<? require("../foot.php");	?>