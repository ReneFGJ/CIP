<?
$include = '../';
require("../db.php");
require($include.'sisdoc_data_light.php');

$LANG = 'pt_BR';
$email_adm = 'cip@pucpr.br';
$admin_nome = 'Centro Integrado de Pesquisa (CIP)';

$form_no_js = 1;
require($include.'sisdoc_email.php');

require($include.'_class_form.php');
$form = new form;
/* AJAX MODE */
$form->ajax = 1;
$form->frame = $dd[89];

require("../_class/_class_pibic_historico.php");

require("../_class/_class_docentes.php");

require("../_class/_class_ic.php");

/* Segurança do Login */
require_once($include.'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw->Security();
require("_email.php");
require("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require($file);

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

					//if ($ac==$dd[1]) { $disp = ''; }
					$hist = msg('acao_'.$ac.'h');
					$sx .= $pb->actions($dd[1]);					

					echo $sx;
?>
