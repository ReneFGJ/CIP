<?php
require("cab.php");
require($include.'sisdoc_debug.php');
echo '
<div id="conteudo" style="margin:0 auto -330px;">
';

require("_class/_class_avaliador_relatorio.php");
$avc = new avaliador_relatorio;

		$sql = "select count(*) as total, av_area, av_numtrab, av_tipo_trabalho
		 		from pibic_semic_avaliador_notas 
				group by av_area, av_numtrab, av_tipo_trabalho
				order by av_area, av_numtrab, av_tipo_trabalho
		";
		$rlt = db_query($sql);
		echo '<table>';		
		$tot = 0;
		$xtb = 'x';
		while ($line = db_read($rlt))
			{
				$trab = $line['av_area']. strzero($line['av_numtrab'],2);
				if ($trab != $xtb)
					{
					if (($tt > 0) and ($tt < 3))
						{ echo '<TD><====='; }
					$tt = 0;
					$xtb = $trab;
					$tot++;
					echo '<TR>';
					echo '<TD>';
					echo $trab; 
					}
					echo '<TD>';
					echo $line['total'];
					echo '('.$line['av_tipo_trabalho'].')';
					$tt=$tt+$line['total'];
			}
		echo 'Total >>>'.$tot;
		echo '</table>';
		
require("foot.php");
?>


