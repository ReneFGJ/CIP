<?
/*** Modelo ****/
require("cab.php");
require($include."sisdoc_menus.php");

	/* Dados da Classe */
	require('../_class/_class_curso.php');

   $cp = new curso;

	echo $cp -> relatorio_cursos_areas();

require("../foot.php");		
?> 