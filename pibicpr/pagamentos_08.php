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

if (strlen($dd[2])==0) { $dd[2] = 'REPROCESSAR PAGAMENTO'; }
$cp = array();
$sql = "select * from (select sum(pg_valor) as pg_valor, pg_nrdoc from pibic_pagamentos group by pg_nrdoc) as tabela where pg_valor = 0 order by pg_nrdoc ";
array_push($cp,array('$Q pg_nrdoc:pg_nrdoc:'.$sql,'','Nr Documento',True,True));
array_push($cp,array('$D8','','Programar vencimento para',True,True));
array_push($cp,array('$S30','','Descrição do motivo',True,True));

/*
 * $breadcrumbs
 */

echo '<table>';
editar();
echo '</table>';

if ($saved > 0)
	{
		$pag->lancar_titulo($dd[0],$dd[2],brtos($dd[1]));
		echo '<h2>Reprocessamento lançado com sucesso</h2>';
		echo '<form action="pagamentos_08.php">';
		echo '<input type="submit" class="botao-geral" value=" voltar ">';
		echo '</form>';
	}	
require("../foot.php");	
?>