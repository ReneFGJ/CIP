<?php
$include = '../';

require($include."cab_root.php");
require("../cab_institucional.php");

$email_adm = 'cip@pucpr.br';
$admin_nome = 'Centro Integrado de Pesquisa (CIP)';

/* Segurança do Login */
require_once($include.'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw->Security();
require("_email.php");
require("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require($file);

/* Messages */
$LANG="pt_BR";
$file = '../messages/msg_pt_BR.php';
require($file);

$menu = array();

//if (($perfil->valid('#ADM#SCR#COO')))
	{
	array_push($menu,array(':: Início ::','index.php'));
	array_push($menu,array('Eventos','eventos.php'));
	array_push($menu,array('Pesq. Básica','basica.php'));
	array_push($menu,array('Internacioanis','internacionais.php'));
	}

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra_novo('Observatório de Pesquisa');

require($include.'sisdoc_data.php');

//if ($xcab != 1)
//{ require("cab_top_menu.php"); }
?>
