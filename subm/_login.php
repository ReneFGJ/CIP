<?php
require("cab.php");
require_once($include.'sisdoc_windows.php');
require("../_class/_class_body.php");
$clx = new submit;

echo $clx->autor_login_form();

require("foot.php");
?>
