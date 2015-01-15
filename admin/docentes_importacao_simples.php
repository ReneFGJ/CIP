<?php
require("cab.php");
require($include."sisdoc_debug.php");
require("../_class/_class_docentes.php");
$doc = new docentes;

require("../_class/_class_importar_docente.php");
$in = new importa_docente;
$in-> tabela_de_cursos();

require ($include . '_class_io.php');
$io = new io;

//$in->structure();

echo '<h1>Importar</h1>';

/* Recupera Centros */

		echo '<H2>Importacao de Professores Simplificada</H2>';
		echo '<table width="900" align="center"><TR><TD>';

for ($r=0; $r < 1000; $r++)
	{
		$file = 'tmp/doc_'.strzero($r,4);
		
		if (file_exists($file))
			{
				$isql = '';
				/* exclu registro anteriores se for primeiro arquivo */
				if ($r==0) { $in->deleta_registros(); }
				echo '<BR>'.$file.' - ';
				$ln = $io->loadfile($file);
				$ln = $io -> a_loadfile($file);
				echo 'Total de '.count($ln).' linhas';
				for ($x=1;$x < count($ln);$x++)
					{
						$isql .= $in->salva_registro($ln[$x]).chr(13).chr(10);
						echo '<HR>';
					}
				if (strlen($isql) > 0) 
					{
						$rlt = db_query($isql); 
					}
				unlink($file);
			$r = 9999;
			}
			
	}
require("../foot.php");	?>