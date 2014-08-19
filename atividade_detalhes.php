<?php
/* $breadcrumbs */
$breadcrumbs = array();
array_push($breadcrumbs,array('main.php','principal'));
array_push($breadcrumbs,array($site.'main.php','menu'));

require('main_cab.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');

$codigo = $dd[5];
$chk = checkpost($dd[5].$dd[2].$dd[1]);

$filex = '';
if ($chk == $dd[90])
	{
		$ac = UpperCaseSQL(substr($dd[1],0,3));
		if (substr($ac,0,2) == 'IC')
			{ $file = 'pibic/atividade_'.$ac.'.php'; }
		if (substr($ac,0,2) == 'RR')
			{ $file = 'pibic/atividade_'.$ac.'.php'; }		
		if (substr($ac,0,2) == 'IS')
			{
				$sql = "select * from bonificacao  
						where id_bn = ".round($dd[2])." ";
				//$sql .= " and bn_original_tipo = 'IPR' ";
				$rlt = db_query($sql);
				echo $sql;
				if ($line = db_read($rlt))
					{
						print_r($line);
						$file = 'cip/atividade_'.$ac.'.php?dd0='.$line['id_bn'];
					}
				
				
			}
							
		if (strlen($file) > 0) { redirecina($file); }
		if (strlen($file) > 0) { redirecina($file); }
	} else {
		echo '<h2>Seção expirada</h2>';
	}

require("foot.php");
