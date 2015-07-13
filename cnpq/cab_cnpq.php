<?php
$include = '../';
require ("../db.php");
require ($include . 'sisdoc_data.php');
require ($include . 'sisdoc_colunas.php');
require ($include . 'sisdoc_windows.php');
require ($include . 'sisdoc_debug.php');
require ($include . 'sisdoc_breadcrumb.php');

//require ("_email.php");

/* Segurança do Login */
require ($include . 'sisdoc_security_pucpr.php');
$nw = new usuario;

$xnome = $_SESSION['user_login'];
if (strlen($xnome)==0)
	{
		require($include.'sisdoc_email.php');
		echo "Acesso CNPQ";
		$nw->user_erro = 1;
		$nw->user_login = 'CNPq';
		$nw->user_nome = 'Avaliador CNPq';
		$nw->user_nivel = 1;
		$nw->user_id = 0;
		$nw->user_perfil = '#CNQ';
		$nw->user_cracha = '90000000';
		$nw->ss = '';
		$nw->LiberarUsuario();
		enviaremail('renefgj@gmail.com','','Acesso CNPQ',$ip);
		redirecina(page());
	}
$sec = $nw -> Security();

require ("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require ($file);

require ("../_class/_class_user_perfil.php");
$perfil = new user_perfil;

require ("../cab_institucional.php");

/* Messages */
$file = '../messages/msg_pt_BR.php';
require ($file);

$menu = array();

//if (($perfil->valid('#ADM#SCR#COO')))
{
	array_push($menu, array(':: Início ::', 'index.php'));
}

require ('../_class/_class_header.php');
$hd = new header;
echo $hd -> mostra_novo('CNPq - Avaliação');
?>
