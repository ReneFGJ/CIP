<?php
require ("cab_cnpq.php");
require ($include . 'sisdoc_autor.php');
$jid = 85;
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs, array(http . 'admin/index.php', msg('principal')));
array_push($breadcrumbs, array(http . 'admin/index.php', msg('menu')));
echo '<div id="breadcrumbs">' . breadcrumbs() . '</div>';

require ("../editora/_class/_class_artigos.php");
$ar = new artigos;

require ("../_class/_class_semic.php");
$sm = new semic;
$sm -> tabela = "semic_ic_trabalho";
$sm -> tabela_autor = "semic_ic_trabalho_autor";

require ("../editora/_class/_class_secoes.php");
$sec = new secoes;

/* */
echo '<H1>Relação Trabalhos - Apresentação</h1>';
echo $sm->comparacao_semic_pibic();



require ("../foot.php");
?>