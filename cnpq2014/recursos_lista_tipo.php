<?
$breadcrumbs=array();
require("cab_cnpq.php");

require("../_class/_class_pibic_recurso.php");
$rec = new recurso;

echo '<H1>Recusos / Reconsidera��es '.$dd[1].' ' .$dd[2].'</h1>';

echo $rec->lista_recursos($dd[1],$dd[2]);

require("../foot.php");	
?>