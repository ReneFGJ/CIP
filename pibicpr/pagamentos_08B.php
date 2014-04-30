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

$cp = array();
array_push($cp,array('$S12','','Número do documento (BO)',True,True));
array_push($cp,array('$CPF','','CPF',True,True));
array_push($cp,array('$N8','','Valor a ser pago',True,True));
array_push($cp,array('$D8','','Vencimento',True,True));
array_push($cp,array('$S40','','Descrição',True,True));
array_push($cp,array('$O : &H:HSBC&O:Ordem de pagamento','','Tipo',True,True));

/*
 * $breadcrumbs
 */

echo '<table>';
editar();
echo '</table>';

if ($saved > 0)
	{
		$venc = brtos($dd[3]);
		$cpf = sonumero($dd[1]);
		$valor = $dd[2];
		$doc = $dd[0];
		$des = $dd[4];
		$tipo = $dd[5];
		$pag->lancar_manual($doc,$valor,$venc,$cpf,$tipo,$des);
	}	
require("../foot.php");	
?>