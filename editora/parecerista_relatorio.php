<?
require("cab.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");

/////////////////////////////////////////////////// MANAGERS 
echo $hd->menu();
echo '<div id="conteudo">';
	echo $hd->main_content('Pareceristas');

$menu = array();
//if ($user_nivel >= 9)
	{
	array_push($menu,array('Pareceristas','Lista de Avaliadores','parecerista_todos.php'));
	array_push($menu,array('Pareceristas','Lista de Avaliadores (�reas indicadas)','parecerista_lista.php'));
	
	array_push($menu,array('Avalia��es','Avalia��es em aberto','pareceres_gestao_av1.php'));
	array_push($menu,array('Avalia��es','Avalia��es por per�odo','parecerista_periodo.php'));
	
	}
	
echo menus($menu,'3');
echo '</div>';

require("foot.php");	?>