<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
?><head>
	<title>::CIP::</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="STYLESHEET" type="text/css" href="../css/letras.css">
	<script  type="text/javascript" src="../js/jquery.js"></script>
	<script  type="text/javascript" src="../js/jquery.corner.js"></script>
	<script  type="text/javascript" src="../js/jquery.example.js"></script>
</head><?
require('../security.php');
$user = new usuario;
$tela = $user->Security();

$sistema = "RE<SUP>2</SUP>ol";
$sistema_link = '<A HREF="http://www.sisdoc.com.br" class="lt1">';
$versao = "v2.10.37";
$cabnav = array();
$cab_bg="#505050";
$cab_sigla = "CIP";
$cab_nome = 'Centro Integrado de Pesquisa';
$cab_slogan = 'Pesquisa e Pesquisa';

$user_nome = $user->user_nome;
$user_nivel = $user->user_nivel;
$user_log = $user->user_login;
$cab_menu_bg = '#A0A0A0';
$tab_max = "95%";
?>