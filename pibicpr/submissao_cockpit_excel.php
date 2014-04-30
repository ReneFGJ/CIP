<?php
$include = '../';
require("../db.php");
require("../_class/_class_pibic_projetos_v2.php");

$ano = date("Y");
$pj = new projetos;

header("Content-Type:   application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-type:   application/x-msexcel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=pibic_".$pj."_".$pj.".xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

$ano = $dd[2];
$modalidade = $dd[0];

echo ($pj->lista_submissoes_excel($ano,$modalidade));


?>