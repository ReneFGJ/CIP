<?php
$include = '../';
require("../db.php");

header("Content-Type:   application/vnd.ms-excel;");
header("Content-type:   application/x-msexcel;");
header("Content-Disposition: attachment; filename=bonificacao_de_artigos.xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

require("../_class/_class_artigo.php");
$ar = new artigo;

echo $ar->export_to_excel();

?>
