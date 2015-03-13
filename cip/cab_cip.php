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

//if (($perfil->valid('#ADM#SCR#COO')))
	{
	array_push($menu,array(':: Início ::','index.php'));
	}
//print_r($nw);
if (($perfil->valid('#ADM')) or ($perfil->valid('#SCR')) or ($perfil->valid('#COO')) or ($perfil->valid('#SPG')))
	{
	array_push($menu,array('Pós-graduação','../bi/pos_graduacao.php'));
	//array_push($menu,array('Grupos de pesquisa','grupo_pesquisa.php'));
	
	array_push($menu,array('Captação','captacao.php'));
	array_push($menu,array('Isenção','isencoes.php'));
	array_push($menu,array('Artigos','artigos.php'));
	array_push($menu,array('Discente','discente.php'));
	array_push($menu,array('Docente','docentes.php'));
	array_push($menu,array('Comunicação','comunicacao.php'));
	array_push($menu,array('Relatório','relatorio.php'));
	}

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra_novo('Gestão do CIP - Diretoria');

?>
