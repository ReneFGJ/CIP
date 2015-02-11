<?
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');

/* Segurança do Login */
require($include.'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw->Security();

require("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require($file);

require("../_class/_class_user_perfil.php");
$perfil = new user_perfil;


require("../_class/_class_grupo_de_pesquisa.php");
$gp = new grupo_de_pesquisa;

require($include.'_class_form.php');
$form = new form;

$cp = $gp->cp();

$tela = $form->editar($cp,$gp->tabela);
if ($form->saved > 0)
	{
		require("../close.php");
	}
echo $tela;
?> 