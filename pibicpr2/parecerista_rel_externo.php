<?
require("cab.php");
require("../_class/_class_pareceristas.php");
$pa = new parecerista;

echo $pa->parecerista_externo('2011');

require("foot.php");
?>
