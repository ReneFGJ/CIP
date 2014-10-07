<?php 
require('db.php');
$google = 'UA-12712904-2';
$include_js='';
$include_meta='';

/* Messagens */
require("_class/_class_message.php");
$LANG = 'pt_BR';
$file = "messages/msg_".$LANG.".php";
if (file_exists($file)) { require($file); } else { echo 'Message not found. '.$file; exit; }

/* Publicação */
require("pb/_class/_class_publish.php");
$pb = new publish;
$pb->recupera_publish();
$jid = $pb->jid;

/* recupera LayOut */
if ($pb->layout != '2001') { $pb->layout = '2001'; }
require('pb/_class/_class_layout_'.$pb->layout.'.php');
$layout = new layout;

/* Opções */



/********************************************************
 * Mostra informações
 */
echo $pb->cab();
echo $layout->cab();

print_r($pb);
?>


