<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_debug.php');
?>
<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<link rel="stylesheet" type="text/css" href="../css/fieldset.css" />
	<script language="JavaScript" type="text/javascript" src="../js/jquery-1.7.1.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/jquery.corner.js"></script>		
	<title>:: CIP :: Portal do Pesquisador</title>
</head>
<style>
body
	{
	font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 130%;
	}
</style>
<?php
	$link_msg = '../messages/msg_ged_upload.php';
	if (file_exists($link_msg)) { require($link_msg); } else { echo 'erro:msg';}

	/* Mensagens */
	$tabela = 'ged_upload';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }
	
$tipo = $dd[3];
require("../pibic/_ged_config.php");
echo $ged->file_attach_form();
?>
