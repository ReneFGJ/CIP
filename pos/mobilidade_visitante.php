<?
$breadcrumbs=array();
require("cab_pos.php");

require("../_class/_class_mobilidade.php");
$mb = new mobilidade;

echo '<h3>Mobilidade Docente</H3>';
echo $mb->lista_visitante("V");
echo '<form method="get" action="mobilidade_visitante_ed.php">';
echo '<input type="submit" value="novo registro" class="botao-geral">';

require("../foot.php");	
?>