<?
require_once($include.'sisdoc_windows.php');
require_once($include.'_class_form.php');
$form = new form;

require("_class/_class_manuscript.php");
$clx = new manuscript;

$clx->author_id(0);
if (strlen($clx->author_codigo) > 0)
	{ $login = 1; }

$clx->le($dd[0]);
$_SESSION['protocol_submit'] = $clx->protocolo;

$link = http.'pb/index.php/'.$path.'?dd99=manuscript&pag=1';
redirecina($link);	


?>