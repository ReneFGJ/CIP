<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
$LANG = 'pt_BR';
$file = '../messages/msg_'.$LANG.'.php';
$jid = 0;
if (file_exists($file)) { require($file); } else { echo 'message not found '.$file; }

require('../_class/_class_pucpr_formulario.php');
$fm = new formulario;

echo $fm->form_solicitacao_pagamento();

?>
