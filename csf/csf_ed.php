<?php
require("cab_csf.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
//array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
//array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
//echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_discentes.php");

require("../_class/_class_csf.php");
$csf = new csf;

$csf->le($dd[0]);

$dis = new discentes;
$discente = $csf->line['pb_aluno'];
$dis->le('',$discente);
echo $dis->mostra_dados_pessoais();
				
echo $csf->mostra_dados();
require("../foot.php");	
?>