<?
session_start();
ob_start();

$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require('../_class/_class_language.php');
require("../_class/_class_pareceristas.php");

require($include.'sisdoc_colunas.php');

$par = new parecerista;


?>
<style>
body
	{
		font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 12px;
		background: url(img/bg.png);
		background-position-y: center;		
	}
	
#fields
	{
	width: 100%;
	background: #E0E0E0;
	border: solid 2px #303030;
	background: url(img/header-blue-plain.jpg);"
	}
	
#menu_left
	{
	width: 100%;
	background: #E0E0E0;
	border: solid 2px #303030;
	background: url(img/bg-menu.gif);
	float: left;
	}
	
#content
	{
	width: 100%;
	background: #F8F8F8;
	border: solid 2px #303030;
	float: left;
	}
		
#corpo
	{
		width: 98%;
		margin: 10px 10px 10px 10px;
		border: solid 2px #303030;
	}
.lt_filelist th
	{
		font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 12px;
		background-color:#D8D6FF;		
	}
.lt_filelist a
	{
		font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 14px;
		text-decoration: none;
		color: #202020;			
	}
.lt_filelist a:hover
	{
		text-decoration: underline;
		color: #000000;
	}
.dul a
	{
		font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 14px;
		text-decoration: none;
		color: #202020;	
		text-align: center;		
	}
	
.dul a:hover
	{
		background-color:#CECECE;
		text-decoration: underline;
	}
</style>
<header>
	<title>:: Portal do Avaliador Acadêmico</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script language="JavaScript" src="../js/jquery-1.7.1.js"></script>
	<script language="JavaScript" src="../js/jquery.corner.js"></script>
</header>

<?
require($include.'_class_form.php');
$form = new form;

$cp = $par->cp_myaccount();
$tabela = $par->tabela;

$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		require('../close.php');
	} else {
		echo $tela;
	}
?>