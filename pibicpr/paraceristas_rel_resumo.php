<?
require("cab.php");

require('../_class/_class_pareceristas.php');
$par = new parecerista;
$jid = 20;
echo '<h2>Resumo dos Estatus dos Avaliadores</h2>';
echo $par->parecerista_resumo();

echo $par->parecerista_ultimos_aceites();

require("../foot.php");
?>