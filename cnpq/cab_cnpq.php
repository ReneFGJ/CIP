<?php
$include = '../';
require ("../db.php");
require ($include . 'sisdoc_data.php');
require ($include . 'sisdoc_colunas.php');
require ($include . 'sisdoc_windows.php');
require ($include . 'sisdoc_debug.php');
require ($include . 'sisdoc_breadcrumb.php');

//require ("_email.php");

/* Seguran�a do Login */
require ($include . 'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw -> Security();

require ("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require ($file);

require ("../_class/_class_user_perfil.php");
$perfil = new user_perfil;

require ("../cab_institucional.php");

/* Messages */
$file = '../messages/msg_pt_BR.php';
require ($file);

$menu = array();

//if (($perfil->valid('#ADM#SCR#COO')))
{
	array_push($menu, array(':: In�cio ::', 'index.php'));
}

require ('../_class/_class_header.php');
$hd = new header;
echo $hd -> mostra_novo('CNPq - Avalia��o');
?>
