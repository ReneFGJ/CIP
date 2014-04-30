<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_debug.php');
require("../_class/_class_hsbc.php");

$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'pibicpr/pagamentos.php',msg('pagamentos')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require('../_class/_class_pibic_pagamento.php');

$pag = new pagamentos;

$sql = "pg_nrdoc:pg_nrdoc:select * from pibic_pagamentos where pg_vencimento > ".date("Ymd").' order by pg_nrdoc';
$cp = array();
array_push($cp,array('$Q '.$sql,'','Número do documento (BO)',True,True));
array_push($cp,array('$O : &S:SIM','Confirmar exclusão?',True,True));

/*
 * $breadcrumbs
 */

echo '<table>';
editar();
echo '</table>';

if ($saved > 0)
	{
		$doc = $dd[0];
		$pag->cancelar_lancar_manual($doc);
		echo '<H2>BO Cancelado!</h2>';
	}	
require("../foot.php");	
?>