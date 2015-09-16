<?php
require("cab.php");
require($include.'sisdoc_debug.php');

//$sql = "alter table pibic_semic_avaliador_notas add column av_final int8 default 0";
//$rlt = db_query($sql);

require("_class/_class_avaliador_relatorio.php");
$avc = new avaliador_relatorio;

		echo '<div id="cab_top">Melhores Trabalhos</div>';
		
		$sql = "select *
				from pibic_semic_avaliador_notas				 
				where av_status=1
				order by av_area, av_numtrab
		";
		$rlt = db_query($sql);
		
		echo '<table width="400">';
		$a = 0;
		$d = 0;
		$b = 0;
		while ($line = db_read($rlt))
			{
				
				$p1 = $line['av_clareza'];
				$p2 = $line['av_sintese'];
				$p3 = $line['av_contribuicao'];
				$p4 = $line['av_conteudo'];
				$p5 = $line['av_qualidade'];
				$p6 = $line['av_desempenho'];
				$p7 = $line['av_nota'];
				$p8 = $line['av_indicado'];
				$p9 = $line['av_prof_presente'];
				if (trim($line['av_tipo_trabalho'])=='P')
					{ $p1 = 10; $p9 = 1; }
				echo '<TR>';
				echo '<TD>'.$line['av_tipo_trabalho'];
				echo '<TD>'.$line['av_area'];
				echo strzero($line['av_numtrab'],2);
				echo '<TD>'.$p1;
				echo '<TD>'.$p2;
				echo '<TD>'.$p3;
				echo '<TD>'.$p4;
				echo '<TD>'.$p6;
				echo '<TD>'.$p7;
				echo '<TD>'.$p8;
				echo '<TD>'.$p9;	
				$nota = $p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8;
				if ($line['av_final']==0)
					{
						echo ' <TD>Calculado';
						
						$sql = "update pibic_semic_avaliador_notas set av_final = ".round($nota)."
								where id_av = ".$line['id_av'];
						
						$rrr = db_query($sql);
					}
				echo '<TD>'.$nota;								
			}
		echo '</table>';

require("foot.php");
?>


