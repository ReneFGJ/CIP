<?php
$include = '../';

require($include."cab_root.php");
require("../cab_institucional.php");
require($include.'sisdoc_breadcrumb.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');

$email_adm = 'cip@pucpr.br';
$admin_nome = 'Centro Integrado de Pesquisa (CIP)';

/* Segurança do Login */
require_once($include.'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw->Security();
require("_email.php");
require("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require($file);

/* Messages */
$LANG="pt_BR";
$file = '../messages/msg_pt_BR.php';
require($file);

$menu = array();

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
echo $hd->mostra('ic');

if (!($perfil->valid('#ADM#CPI#SPI')))
	{
		redirecina("../pibic/");
		echo 'Acesso Bloqueado!';
		exit;
	}

?>
