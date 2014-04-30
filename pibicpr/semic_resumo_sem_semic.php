<?php
require("cab.php");
require($include.'sisdoc_colunas.php');
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

echo $semic->projetos_sem_semic(date("Y")-1);

require("../foot.php");	
?>