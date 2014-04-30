<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');

require('../_class/_class_semic.php');
$sm = new semic;

echo $sm->programacao_agenda();

require("../foot.php");	
?>