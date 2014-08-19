<?php
$include = '../';
//require("../db.php");

require($include."cab_root.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');
require($include.'sisdoc_colunas.php');
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
	}

if (($perfil->valid('#ADM#SCR#COO')))
	{
	}

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra('cp'); 
//if ($xcab != 1)
//{ require("cab_top_menu.php"); }
?>
