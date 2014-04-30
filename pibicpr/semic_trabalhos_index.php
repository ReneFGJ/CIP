<?php
require("cab.php");
require("../_class/_class_semic.php");
require("../_class/_class_article.php");
require($include.'sisdoc_data.php');
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();
echo $semic->create_index();
?>
