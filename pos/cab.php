<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');

require("../_class/_class_ajax.php");

/* Seguran�a do Login */
require($include.'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw->Security();

require("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require($file);

require("../_class/_class_user_perfil.php");
$perfil = new user_perfil; 

require("../cab_institucional.php");

/* Messages */
$file = '../messages/msg_pt_BR.php';
require($file);


$menu = array();

array_push($menu,array(':: In�cio ::','index.php'));

//if (($perfil->valid('#ADM#SCR#COO#SPG')))
	{
	array_push($menu,array('P�s-gradua��o','pos_graduacao_resume.php'));
	}

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra_novo('P�s-Gradua��o <I>Stricto Sensu</I>');

?>
