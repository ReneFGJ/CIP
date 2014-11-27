<?
$breadcrumbs=array();
require("cab_semic.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

require('../_class/_class_semic.php');
$semic = new semic;

echo $semic->lista_declaracoes(date("Y"));

require("../foot.php");	
?>