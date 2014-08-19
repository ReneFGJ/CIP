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

echo '<H3>Artigos cadastrados para Bonificação</h3>';

/* Resumo */
require("../_class/_class_artigo.php");
$art = new artigo;

$tela = $art->busca();
echo $tela;

echo $art->resumo('');

echo '<A HREF="artigos_professores_q1.php">Professores com Q1</A>';

echo '<BR><BR>';
echo '<A HREF="artigos_excel.php" target="new" title="Exportar para o excel" >';
echo '<img src="../img/icone_excel.png" height="32">';
echo '</A>';
echo '<BR><BR>';

echo $art->resumo_issn('');

	//$tela = menus($menu,"3");
require("../foot.php");
?>
