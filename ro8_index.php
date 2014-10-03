<?
require("db.php");
require($include."sisdoc_debug.php");
$include = '';
require($include."sisdoc_ro8.php");
$encode = "UTF-8";
echo ro8();
?>