<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');

require("../_class/_class_ajax.php");
$email_adm = 'pibicpr@pucpr.br';
$admin_nome = 'Inicia��o Cient�fica PUCPR';

/* Seguran�a do Login */
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
//array_push($menu,array('Relat�rio Parcial','atividade_IC1.php'));
//array_push($menu,array('Indicadores','indicadores.php'));
//array_push($menu,array('pareceristas','parecerista.php'));
//array_push($menu,array('discentes','discentes.php'));
//array_push($menu,array('pagamentos','pagamentos.php'));

$menu = array();

//if (($perfil->valid('#ADM#SCR#COO')))
	{
	array_push($menu,array(':: In�cio ::','index.php'));
	}
//if (($perfil->valid('#ADM#SCR#COO#SPG')))
	{
	array_push($menu,array('P�s-gradua��o','../bi/pos_graduacao.php'));
	}
//if (($perfil->valid('#ADM#SCR#COO')))
	{
	//array_push($menu,array('Grupos de pesquisa','grupo_pesquisa.php'));
	array_push($menu,array('Capta��o','captacao.php'));
	array_push($menu,array('Isen��o','isencoes.php'));
	array_push($menu,array('Artigos','artigos.php'));
	array_push($menu,array('Discente','discente.php'));
	array_push($menu,array('Docente','docentes.php'));
	array_push($menu,array('Comunica��o','comunicacao.php'));
	array_push($menu,array('Relat�rio','relatorio.php'));
	}

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra_novo('Gest�o do CIP - Diretoria');

?>
