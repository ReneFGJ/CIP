<?php
require("cab.php");
require($include.'sisdoc_menus.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_debug.php');
require("../_class/_class_hsbc.php");

echo '<H1>Processar pagamentos não efetivados</h1>';

$cp = array();
$sql = "select * from pibic_bolsa_tipo order by pbt_descricao";
$rlt = db_query($sql);
$op = '*:Todas modalidades de IC';
while ($line = db_read($rlt))
	{
		$op .= '&';
		$op .= trim($line['pbt_codigo']).':'.trim($line['pbt_descricao']);
	}
if (date("m") > 8)
	{
		$tp = '$['.((date("Y"))).'-'.(date("Y")).']';
	} else {
		$tp = '$['.((date("Y")-1)).'-'.(date("Y")).']';	
	}

array_push($cp,array('$O '.$op,'','Tipo de bolsa',True,True));
array_push($cp,array($tp,'','Ano do Edital',True,True));
array_push($cp,array('$D8','','Data para crédito',True,True));

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
	$dd2 = $dd[2];
	$dd3 = $dd[1];
	echo $pb->ativos_por_bolsa($dd1,$dd2,$dd3,'N');
	
	echo '<div id="screen01">';
	echo '<form action="pagamentos_06A.php">';
	echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
	echo '<input type="hidden" name="dd1" value="'.$dd[2].'">';
	echo '<input type="hidden" name="dd2" value="'.$dd[1].'">';
	echo '<input type="hidden" name="dd10" value="S">';
	echo '<input type="submit" value="gerar arquivo de pagamento >>>>" class="botao-geral">';
	echo '</form>';
	echo '</div>';
	
	//echo '<div id="screen01">';
	//echo '<form action="pagamentos_06B.php">';
	//echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
	//echo '<input type="hidden" name="dd1" value="'.$dd[2].'">';
	//echo '<input type="hidden" name="dd2" value="'.$dd[1].'">';
	//echo '<input type="hidden" name="dd2" value="'.$dd[1].'">';
	//echo '<input type="submit" value="gerar arquivo de pagamento (Outros Bancos) >>>>" class="botao-geral">';
	//echo '</form>';
	//echo '</div>';	
	//echo '<A HREF="pagamentos_06A.php?dd0='.$dd[0].'&dd1='.$dd[1].'">HSBC</A>';
	}	
require("../foot.php");	
?>