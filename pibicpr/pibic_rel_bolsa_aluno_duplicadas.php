<?
require("cab.php");
require ('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

echo $pb-> rel_aluno_com_bolsa_duplicada();

require("foot.php");

?>