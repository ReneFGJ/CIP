<?
$breadcrumbs=array();
require("cab_semic.php");

require('../_class/_class_semic.php');
$sm = new semic;

echo $sm->pibic_semic_participacao($dd[1]);
require("../foot.php");	
?>