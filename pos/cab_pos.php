<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');

require("../_class/_class_ajax.php");
$email_adm = 'cip@pucpr.br';
$admin_nome = 'Centre Integrado de Pesquisa';

/* Segurança do Login */
require($include.'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw->Security();

require("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require($file);

require("../_class/_class_user_perfil.php");
$perfil = new user_perfil; 

require("../cab_institucional.php");

/* Messages */
$file = '../messages/msg_pt_BR.php';
require($file);

/* CSS */
$css = array();
array_push($css,'css/style_programa_pos.css');

$menu = array();
array_push($menu,array('Inicial','main.php'));
array_push($menu,array('discentes','discentes.php'));
//array_push($menu,array('Indicadores','indicadores.php'));
//array_push($menu,array('pareceristas','parecerista.php'));
//array_push($menu,array('discentes','discentes.php'));
//array_push($menu,array('voltar','../main.php'));

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra('ps');
?>
