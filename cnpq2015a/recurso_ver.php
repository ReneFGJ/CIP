<?
$breadcrumbs=array();
require("cab_cnpq.php");

require("../_class/_class_pibic_recurso.php");
$rec = new recurso;

echo '<H1>Recusos / Reconsideração '.$dd[1].'</h1>';
$rec->le($dd[0]);
echo $rec->mostra();

require("../foot.php");	
?>