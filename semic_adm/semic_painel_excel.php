<?php
$include = '../';
require($include."db.php");
require($include.'sisdoc_data.php');

header("Content-Type:   application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-type:   application/x-msexcel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=painel.xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

require("../_class/_class_semic_paineis.php");
$sm = new semic_paineis;

echo $sm->etiqueta($dd[0]);
?>
