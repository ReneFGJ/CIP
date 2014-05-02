<?
require("cab.php");
require($include.'sisdoc_debug.php');

if (strlen($user->cracha)==0)
	{ redirecina('index.php'); }

/*
 * Submissão aberta
 */
require("../_class/_class_pibic_bolsa_contempladas.php");
require("../_class/_class_pibic_submit_documento.php");


	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
	$tab_max = '100%';
	$pb = new pibic_bolsa_contempladas;
	$pb->pb_professor = $user->cracha;
	$tela = $pb->bolsa_ativas();
	
	if (strlen($tela) ==0)
		{
			echo '<center>';
			echo msg('no_projects_found');
		}

require("foot.php");
?>
