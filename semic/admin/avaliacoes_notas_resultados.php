<?php
require("cab.php");
require($include.'sisdoc_debug.php');

//$sql = "alter table pibic_semic_avaliador_notas add column av_final int8 default 0";
//$rlt = db_query($sql);

require("_class/_class_avaliador_relatorio.php");
$avc = new avaliador_relatorio;

		echo '<div id="cab_top">Melhores Trabalhos</div>';
		
		$sql = "select * from (
				select count(*) as avaliacoes, round(avg(av_final)*100)/100 as media, av_area, av_numtrab
				from pibic_semic_avaliador_notas				 
				where av_status=1 
				group by av_area, av_numtrab
				) as tabela where media > 00 and avaliacoes > 0
				order by media desc, av_area, av_numtrab
				
		";
		$rlt = db_query($sql);
		
		echo '<table width="400">';
		$a = 0;
		$d = 0;
		$b = 0;
		while ($line = db_read($rlt))
			{
				echo '<TR>';
				echo '<TD>'.$line['av_area'];
				echo strzero($line['av_numtrab'],2);
				
				echo '<TD>'.number_format($line['media'],3);
				echo '<TD>'.$line['avaliacoes'];				
			}
		echo '</table>';

require("foot.php");
?>


