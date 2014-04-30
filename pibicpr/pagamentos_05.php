<?php
require("cab.php");
require($include.'sisdoc_menus.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_debug.php');

$cp = array();
$sql = "select * from pibic_bolsa_tipo order by pbt_descricao";
$rlt = db_query($sql);
$op = '*:Todas modalidades de IC';
while ($line = db_read($rlt))
	{
		$op .= '&';
		$op .= trim($line['pbt_codigo']).':'.trim($line['pbt_descricao']);
	}
array_push($cp,array('$D8','','Pagamentos',True,True));
array_push($cp,array('$D8','','até',True,True));


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

	$dd1 = brtos($dd[0]);
	$dd2 = brtos($dd[1]);
	
	echo $pag->pagamentos_por_data($dd1,$dd2);
	}	
require("../foot.php");	
?>