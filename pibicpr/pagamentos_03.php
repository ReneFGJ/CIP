<?php
require("cab.php");
require($include.'sisdoc_menus.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

$cp = array();
$sql = "select * from pibic_bolsa_tipo order by pbt_descricao";
$rlt = db_query($sql);
$op = '*:Todas modalidades de IC';
while ($line = db_read($rlt))
	{
		$op .= '&';
		$op .= trim($line['pbt_codigo']).':'.trim($line['pbt_descricao']);
	}
array_push($cp,array('$O '.$op,'','Tipo de bolsa',True,True));

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'pibicpr/pagamentos.php',msg('pagamentos')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

echo '<table>';
editar();
echo '</table>';

if ($saved > 0)
	{
	require('../_class/_class_pibic_pagamento.php');
	$pag = new pagamentos;

	require('../_class/_class_pibic_bolsa_contempladas.php');
	$pb = new pibic_bolsa_contempladas;

	$dd1 = $dd[0];
	echo $pb->ativos_por_bolsa($dd1);
	}	
require("../foot.php");	
?>