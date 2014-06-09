<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');

/* Seguranï¿½a do Login */
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
array_push($menu,array('Laboratórios','labs.php'));
array_push($menu,array('Equipamentos','equipamento.php'));


require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra('labs');
?>
<center>
