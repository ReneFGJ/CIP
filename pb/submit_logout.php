<?
require_once($include.'sisdoc_windows.php');
require("_class/_class_submit.php");
$clx = new submit;

$clx->autor_valida();

redirecina(http.'pb/index.php/'.$path);
?>