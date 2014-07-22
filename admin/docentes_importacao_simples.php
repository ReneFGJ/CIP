<?php
require("cab.php");
require($include."sisdoc_debug.php");
require("../_class/_class_docentes.php");
$doc = new docentes;

/* Recupera Centros */

		echo '<H2>Importacao de Professores Simplificada</H2>';
		echo '<table width="900" align="center"><TR><TD>';

for ($r=0; $r < 1000; $r++)
	{
		$file = 'tmp/doc_'.strzero($r,4);
		if (file_exists($file))
			{
				echo '<HR>';
				echo $file;
				echo '<HR>';
				$s = '';
				$rlt = fopen($file,'r+');
				while (!(feof($rlt)))
					{
						$s .= fread($rlt,1024);
					}
				fclose($rlt);
				
				
				/* Converte em Linhas */
				//$s = troca($s,chr(13),'##');
				echo '<PRE>'.$s.'</pre>';
				$ln = splitx(chr(13),$s);
				echo '==>'.count($ln);
				exit;
			}
	}
require("../foot.php");	?>