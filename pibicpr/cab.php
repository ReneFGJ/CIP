<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');

require("../_class/_class_ajax.php");

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

$menu = array();
array_push($menu,array(':: Início ::','index.php'));
array_push($menu,array('Bolsas','bolsas.php'));
array_push($menu,array('Submissões','submissoes.php'));
array_push($menu,array('Avaliadores','parecerista.php'));
array_push($menu,array('Docentes','docentes.php'));
array_push($menu,array('Discentes','discentes_menu.php'));
array_push($menu,array('Acompanhamento','gestao.php'));
array_push($menu,array('Pagamentos','pagamentos.php'));
array_push($menu,array('Comunicação','comunicacao.php'));
array_push($menu,array('Indicadores','indicadores.php'));

require('../_class/_class_header.php');
$hd = new header;
//echo $hd->mostra_novo('Gestão Iniciação Científica');
echo $hd->mostra_novo('Gestão Iniciação Científica');

if (!($perfil->valid('#ADM#CPI#SPI')))
	{
		redirecina("../pibic/");
		echo 'Acesso Bloqueado!';
		exit;
	} 
?>