<?
require("cab.php");
require ('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

echo $pb-> mostrar_resumo_de_bolsas();

require("foot.php");

?>