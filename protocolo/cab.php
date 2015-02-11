<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');
$email_adm = 'pibicpr@pucpr.br';
$admin_nome = 'Iniciação Científica PUCPR';
$jid = 20;
/* Segurança do Login */
require($include.'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw->Security();

require("../_class/_class_message.php");
require("../_class/_class_user_perfil.php");
$perfil = new user_perfil; 

require("../cab_institucional.php");

/* Messages */
$file = '../messages/msg_pt_BR.php';
require($file);



$menu = array();
array_push($menu,array(':: Início ::','index.php'));
array_push($menu,array('Bolsas','bolsas.php'));
array_push($menu,array('Protocolos','protocolos.php'));

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra('ic');

?>
