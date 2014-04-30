<?php
$include = '../';
require("../db.php");
require("../_class/_class_semic.php");
require($include.'sisdoc_data.php');
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();
echo $semic->lista_de_trabalhos_to_word($dd[1]);
?>
