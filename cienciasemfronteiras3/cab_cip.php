<?php
$include = '../';
//require("../db.php");
require($include."cab_root.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');
require($include.'sisdoc_colunas.php');
require("../cab_institucional.php");

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

if (($perfil->valid('#ADM#SCR#COO')))
	{
	array_push($menu,array('Pós-graduação','pos_graduacao.php'));
	array_push($menu,array('Grupos de pesquisa','grupo_pesquisa.php'));
	array_push($menu,array('Captação','captacao.php'));
	array_push($menu,array('Isenção','isencoes.php'));
	array_push($menu,array('Artigos','artigos.php'));
	array_push($menu,array('Discente','discente.php'));
	array_push($menu,array('Docente','docentes.php'));
	array_push($menu,array('Relatório','relatorio.php'));
	}

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra('cp'); 
//if ($xcab != 1)
//{ require("cab_top_menu.php"); }
?>
