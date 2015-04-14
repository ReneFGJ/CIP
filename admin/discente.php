<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Discentes','Limpar periodos dos cursos','discente_limpa_curso.php'));
array_push($menu,array('Discentes','Limpar alunos sem codigo','discente_limpa_sem_codigo.php'));
array_push($menu,array('Discentes','Discentes sem genero','discente_genero.php'));

array_push($menu,array('Discentes P�s-Gradua��o','Identificar nomes em branco','discente_codigo_buscar.php'));
array_push($menu,array('Discentes P�s-Gradua��o','Indentificar c�digos inv�lidos (p�s-gradua��o)','discente_codigo_invalido.php'));
array_push($menu,array('Discentes P�s-Gradua��o','Indentificar c�digos inv�lidos (IC/IT)','discente_codigo_invalido_2.php'));
array_push($menu,array('Discentes P�s-Gradua��o','Cadastro duplicados','discente_orientacoes_duplicadas.php'));

$tela = menus($menu,"3");

require("../foot.php");	
?>
