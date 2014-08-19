<?
require("_class/_class_manuscript.php");
$clx = new manuscript;
$clx->author_id(0);
$clx->manuscript_cancel($dd[0]);

redirecina($http.'index.php/'.$path.'?dd99=submit');
?>