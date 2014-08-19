<?
require_once($include.'sisdoc_windows.php');
require_once($include.'_class_form.php');
$form = new form;

require("_class/_class_submit.php");
$clx = new submit;

$clx->author_id(0);
if (strlen($clx->author_codigo) > 0)
	{ $login = 1; }


$_SESSION['protocol_submit'] = strzero($dd[0],7); 
$link = http.'pb/index.php/'.$path.'?dd99=submit2&pag=1';
redirecina($link);	


?>