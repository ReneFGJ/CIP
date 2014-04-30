<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
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

require('../_class/_class_header.php');
$hd = new header;

echo $hd->head();
?>
