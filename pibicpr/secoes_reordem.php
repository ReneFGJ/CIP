<?php
require("cab.php");

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

require("../_class/_class_journal_sections.php");
$sec = new sections;
$sec->section_reordem($jid);
echo '<center>Reordenado com sucesso !';
require("../foot.php");	
?>