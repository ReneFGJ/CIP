<?php
require("cab.php");
require($include.'sisdoc_colunas.php');
require('../_class/_class_docentes.php');
$prof = new docentes;

if ($dd[2]=='1')
	{
		echo '<H2>Docentes Produtividade PQ e DT<h2>';
		$rlt = $prof->rel_prof_produtividade();
	} else {
		if ($dd[1]=='S')
		{
			echo '<H2>Docentes Stricto Sensu<h2>';
			$rlt = $prof->rel_prof_prod_ss('S');
		} else {
			if (strlen($dd[1])==0)
				{
					echo '<H2>Todos os Docentes<h2>';
					$rlt = $prof->rel_prof_prod_ss('');					
				} else {
					echo '<H2>Docentes de Graduação<h2>';
					$rlt = $prof->rel_prof_prod_ss('N');
				}
		}
	}

echo $prof->rel_prof_prod_mostra($rlt);
?>
