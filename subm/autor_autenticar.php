<?php
require("db.php");
require("../editora/_class/_class_submit_article.php");
$clx = new submit;

$author = $clx->recuperar_autor($dd[0]);
if (strlen($clx->author_codigo) > 0)
	{ $clx->autor_valida(); }

if ($dd[2]=='messa')
{
	redirecina('autor_mensagem_replay.php?dd0='.$dd[0]);
}

?>
