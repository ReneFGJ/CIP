<?php
require("cab_cip.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
//array_push($menu,array('Isenção','Gerar Bonificações','artigos_gerar.php'));

echo '<H3>Lista de artigos</h3>';

/* Resumo */
require("../_class/_class_artigo.php");
$art = new artigo;
if ($perfil->valid('#CPS#ADM#COO'))
	{
		echo $art->lista_artigos($dd[0],'');
	} else {
		echo $art->lista_artigos($dd[0],$ss->user_cracha);		
	}

	//$tela = menus($menu,"3");
require("../foot.php");
?>
