<?
$breadcrumbs=array();
require("cab_lattes.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
$_SESSION['ano_ini'] = '2009';
$_SESSION['ano_fim'] = date("Y");

array_push($menu,array('Lattes','Professores e CPF','programas_professores.php'));

array_push($menu,array('Produ��o Cient�fica - Discente e Docente','Produ��o institucional em artigos cient�ficos','lattes_producao.php'));
array_push($menu,array('Produ��o Cient�fica P�s-Gradua��o','Artigos x Qualis','producao_revistas.php'));
array_push($menu,array('Produ��o Cient�fica P�s-Gradua��o','__Produ��o Programa x Pesquisador','producao_revistas_programa_professor.php'));
array_push($menu,array('Produ��o Cient�fica P�s-Gradua��o','__Produ��o Programa x Pesquisador (Baixa produ��o)','producao_revistas_programa_professor_baixa_producao.php'));

array_push($menu,array('Produ��o Cient�fica P�s-Gradua��o','Livros publicados','producao_livros.php'));
array_push($menu,array('Produ��o Cient�fica P�s-Gradua��o','Livros organizados','producao_livros_organizados.php'));
array_push($menu,array('Produ��o Cient�fica P�s-Gradua��o','Cap�tulos de livros','producao_capitulos.php'));

array_push($menu,array('Eventos','Trabalhos publicados em eventos','producao_eventos.php'));

array_push($menu,array('Producao','Producao Escola','producao_escola.php'));

$tela = menus($menu,"3");

require("../foot.php");	
?>