<?
session_start();
ob_start();

$include = '../';
require("../db.php");
require($include.'sisdoc_debug.php');

$cracha = $dd[0];

require("../_class/_class_pareceristas.php");

$par = new parecerista;
$par->login_set($cracha);

$par->security();

if ((strlen($par->nome) == 0) and (strlen($dd[0])==0))
	{
		echo '<CENTER>';
		echo '<H1>Sess�o expirada</h1>';
		echo '<h2>Sua sess�o expirou, acesse novamente pelo link recebido no e-mail</h2>';
		exit;	
	}
?>