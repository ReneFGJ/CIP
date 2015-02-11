<?php
$include = '../';
//require("../db.php");
require($include."cab_root.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');
require($include.'sisdoc_colunas.php');
require("../cab_institucional.php");
$jid = 85; 

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
	array_push($menu,array(':: Início ::','index.php'));
	array_push($menu,array('Mostra de Pesquisa','index.php'));
	}
if (($perfil->valid('#ADM#SCR#COO')))
	{
	array_push($menu,array('SEMIC','semic.php'));
	array_push($menu,array('SEMIC em números','semic_numeros.php'));
	array_push($menu,array('Avaliadores','semic_avaliadores.php'));
	}

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra('sm'); 
//if ($xcab != 1)
//{ require("cab_top_menu.php"); }
?>
<style>
	.semic_bloco { border: 1px solid #303030; padding: 10px; display: table; }
	.semic_bloco_data { float: left; color: #004790; font-size: 15px; }
	.semic_bloco_hora { float: left; color: #004790; font-size: 15px; margin-left: 10px; }
	.semic_bloco_titulo { float: clear; font-size: 20px; color: #652781; }
	.semic_bloco_local { float: left; }
</style>