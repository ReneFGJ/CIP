<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require("../_class/_class_hsbc.php");

	require('../_class/_class_pibic_pagamento.php');
	$pag = new pagamentos;

$arquivo = substr(date("Y"),2,2).date("md").$dd[0].'_BCO.seq';


//mkdir('hsbc');

 	$total = 0;
	$dd1 = $dd[0];
	$dd2 = brtos($dd[1]);
	$dd3 = $dd[2];
	$sx = $pag->gerar_pagamentos($dd1,$dd2,$dd3,'BCO',$dd[10]);
	
	$out = fopen('hsbc/'.$arquivo, "w");
	fwrite($out, $sx);
	fclose($out);
	
	echo '<A HREF="hsbc/'.$arquivo.'" target="new">Download do Arquivo</A><BR><BR>';
	
	echo 'SALVO';
		
//header('Content-type: application/text');
//header('Content-Disposition: attachment; filename="'.$arquivo.'"');
//readfile('hsbc/'.$arquivo);
	
?>