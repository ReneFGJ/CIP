<?
require("cab.php");

require('../_class/_class_pareceristas.php');
$par = new parecerista;

echo '<h2>Resumo dos Estatus dos Avaliadores</h2>';
echo $par->parecerista_resumo();

require("foot.php");
?>