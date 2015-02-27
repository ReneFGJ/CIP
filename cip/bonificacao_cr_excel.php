<?php
$include = '../';
require ("../db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

header("Content-type: application/vnd.ms-excel; name='excel' ");
header("Content-Disposition: filename=pagamentos_".date("Y-m-d").".xls");
header("Pragma: no-cache");
header("Expires: 0");

	$tipo = $dd[3];

	require ("../_class/_class_bonificacao.php");
	$cl = new bonificacao;
	$datai = brtos($dd[1]);
	$dataf = brtos($dd[2]);
	echo $cl -> relatorio_pagamento_cr($datai, $dataf);
?>