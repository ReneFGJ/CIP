<?php
$include = '../';
require("../db.php");

require("../_class/_class_banco_projetos.php");
$bp = new projetos;

$arquivo = 'planilha.xls';
// Configurações header para forçar o download

// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

echo $bp->lista_pesquisadores_excel(0,0,2);
exit;

?>
