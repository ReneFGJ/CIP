<?php
require("cab_semic.php");
require("../_class/_class_semic.php");
require($include.'sisdoc_data.php');
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();
echo '-->'.$jid;
echo $semic->page_index_create();
echo $semic->lista_de_trabalhos_to_site();
?>
