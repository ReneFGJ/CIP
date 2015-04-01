<?php
require("cab_cip.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Isenção','Gerar Isenções','isencoes_gerar.php'));
array_push($menu,array('Isenção','Isenções expiradas (sem utilização)','isencoes_expiradas.php'));
//array_push($menu,array('Isenção','Acompanhamento',''));
//array_push($menu,array('Isenção','__Encaminhados e não indicados pelo professor','bolsa_isencao_projetos.php?dd0=!'));
//array_push($menu,array('Isenção','__Aguardando liberação da Diretoria de Pesquisa','bolsa_isencao_projetos.php?dd0=A'));
//array_push($menu,array('Isenção','__Isentar indicação do professor','bolsa_isencao_projetos.php?dd0=A'));

/* Resumo */
require("../_class/_class_bonificacao.php");
$bon = new bonificacao;
$bon->resumo();
?>

<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
require("../foot.php");
?>
