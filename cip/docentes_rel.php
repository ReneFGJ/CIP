<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));
array_push($breadcrumbs, array('docentes_rel.php','docentes'));

require("cab_cip.php");
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
			$rlt = $prof->rel_prof_ss('S');
		} 
		if ($dd[1]=='P')
		{
			echo '<H2>Docentes Stricto Sensu X Programas Stricto Sensu<h2>';
			$rlt = $prof->rel_prof_ss_prog('S');
		} 
		
		if (!(isset($rlt)))
		{
			if (strlen($dd[1])==0)
				{
					echo '<H2>Todos os Docentes<h2>';
					$rlt = $prof->rel_prof_ss('');					
				} else {
					echo '<H2>Docentes de Graduação<h2>';
					$rlt = $prof->rel_prof_ss('N');
				}
		}
	}

echo $prof->rel_prof_mostra($rlt);

require("../foot.php");	?>