<?php
require("cab.php");

require("../_class/_class_pareceristas.php");
require($include.'sisdoc_windows.php');
require($include.'sisdoc_email.php');

	/* Mensagens */
	$link_msg = '../messages/msg_pareceristas_limbo_detalhe.php';
	if (file_exists($link_msg)) { require($link_msg); } else { exit; }
	
	
$par = new parecerista;

$par->le($dd[0]);

echo $par->mostra_dados();

echo $par->parecerista_acao();
?>

