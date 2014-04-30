<?php
require("cab.php");

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

$semic->section_limpar($jid);
echo '<center>Reordenado com sucesso !';
require("../foot.php");	
?>