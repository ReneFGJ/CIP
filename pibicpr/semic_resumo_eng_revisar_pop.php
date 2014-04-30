<?
$include = '../';
require("../db.php");

/* Mensagens do sistema */
require("../_class/_class_message.php");
$file = '../messages/msg_'.$LANG.'.php';
$LANG = $lg->language_read();

/** Rotina de Segurança */
require('../security.php');
$user = new usuario;
$tela = $user->Security();
require('../_class/_class_user_perfil.php');
$perfil = new user_perfil;
$ss = $user;
$tabela = $art->tabela;

/* */
?><head>
	<title>::CIP::</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="STYLESHEET" type="text/css" href="../css/letras.css">	
</head><?

require("../_class/_class_article.php");
$art = new article;

require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');

$cp = $art->cp_article($dd[91]);
$tabela = $art->tabela;
$redirect = page().'?dd90='.$dd[90].'&dd91='.$dd[91];
$redireciona = page().'?dd90='.$dd[90].'&dd91='.$dd[91];

echo '<table>';
editar();
echo '</table>';
if ($saved > 0) { require("../close.php"); }
?>