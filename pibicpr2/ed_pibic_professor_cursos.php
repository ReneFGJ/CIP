<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');
$label = "Cadastro de rotinas do sistema";

require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

require("../_class/_class_curso.php");
$cs = new curso;

require("../_class/_class_docentes.php");
$dc = new docentes;

$dc->processar_cursos();

require("foot.php");	
?>