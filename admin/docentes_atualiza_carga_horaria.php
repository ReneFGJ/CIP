<?
require("cab.php");
require("../_class/_class_importar_docente.php");
$in = new importa_docente;


echo '<h1>Atualizando novos professores</h1>';
$in->atualiza_novos_professores();

echo '<h1>Atualizando carga hor�ria e titula��o</h1>';
echo $in->atualiza_carga_horaria();

?>
