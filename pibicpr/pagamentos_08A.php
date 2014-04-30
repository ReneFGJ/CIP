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
$sql = "select trim(to_char(pg_vencimento,'00000000')) || '-' || pg_complemento as pg_v, pg_vencimento, pg_complemento from pibic_pagamentos where pg_complemento <> '' group by pg_vencimento, pg_complemento order by pg_vencimento desc";
array_push($cp,array('$Q pg_v:pg_v:'.$sql,'','Gerar arquivos de ',True,True));

/*
 * $breadcrumbs
 */

echo '<table>';
editar();
echo '</table>';

if ($saved > 0)
	{
//		$sql = "select * from pibic_pagamentos where pg_nome = 'RAFFAELA SILVESTRE PORCOTE'";
//		$rlt = db_query($sql);
//		$line = db_read($rlt);
//		$pag->troca_cpf('007041992977','07041992977');
						
									
		$venc = substr($dd[0],0,8);
		$comp = substr($dd[0],9,1);
		$hsbc = new hsbc;
		echo $venc.'-'.$comp;
		
		$arquivo = $dd[0].'.seq';


		//mkdir('hsbc');

		 	$total = 0;
			$dd1 = $venc;
			$sx = $hsbc->gerar_arquivo($dd1,$comp);
					
			$out = fopen('hsbc/'.$arquivo, "w");
			fwrite($out, $sx);
			fclose($out);
		
			echo '<A HREF="hsbc/'.$arquivo.'" target="new">Download do Arquivo</A><BR><BR>';
			
			echo 'SALVO';	
	}	
require("../foot.php");	
?>