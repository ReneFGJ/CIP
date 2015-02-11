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
	array_push($menu,array('Bolsas / Recursos Humanos','editais_mostra.php?dd0=1'));
	array_push($menu,array('Auxílio Pesquisa','editais_mostra.php?dd0=2'));
	array_push($menu,array('Cooperação Internacional','editais_mostra.php?dd0=3'));
	array_push($menu,array('Prêmios','editais_mostra.php?dd0=4'));
	array_push($menu,array('Eventos','editais_mostra.php?dd0=5'));
	}

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra_novo('Observatório de Pesquisa');
echo '<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_observatorio.css">'.chr(13).chr(10);

require($include.'sisdoc_data.php');

//if ($xcab != 1)
//{ require("cab_top_menu.php"); }
?>
