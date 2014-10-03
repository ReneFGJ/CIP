<?php
require("portal_cab.php");
echo $hd->header_info();

require("_class/_class_journals.php");
$jnl = new journals;

echo $hd->body();

echo $hd->box_gray('INFORMAÇÕES E SERVIÇOS','22');

echo $jnl->mostra_journals_row();

require("foot_portal.php");
?>
