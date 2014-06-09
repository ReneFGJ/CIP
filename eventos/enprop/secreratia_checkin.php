<?php
require("secretaria_cab.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
require("_class/_class_proceeding.php");
$ev = new proceeding;

$http = $_SERVER['HTTP_REFERER'];

$ev->checkin($dd[0]);

redirecina($http);

?>
