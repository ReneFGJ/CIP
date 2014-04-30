<?php
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_autor.php');

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();
echo $semic->reorganizar_trabalhos((date("Y") - 1));

require("../foot.php");	
?>