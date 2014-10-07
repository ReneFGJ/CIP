<?php
require("cab_root.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');
require("cab_institucional.php");

/* Segurança do Login */
require_once($include.'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw->Security();

require('_class/_class_message.php');
$file = 'messages/msg_pt_BR.php';
require($file);
$LANG="pt_BR";

require('_class/_class_header.php');
$hd = new header;
echo $hd->mostra('pf');

/* $breadcrumbs */
//echo '<div style="width: 100%; background-color:#FFFFF; text-align: left; padding: 6px 6px 4px 0px; font-family: verdana, arial, tahoma; font-size: 11px; text-decoration: none; color: black;">'.breadcrumbs().'</div>';

?>
