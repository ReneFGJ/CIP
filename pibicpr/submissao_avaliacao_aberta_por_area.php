<?php
require ("cab.php");
require ($include . "sisdoc_colunas.php");
require ($include . "sisdoc_data.php");
require ($include . "sisdoc_email.php");
require ($include . "sisdoc_windows.php");
require ($include . "sisdoc_debug.php");


$sql = "select  a_cnpq, a_descricao, count(*) as total
		from pibic_parecer_".date('Y')."
		inner join pibic_projetos on pj_codigo = pp_protocolo
		inner join ajax_areadoconhecimento on a_cnpq = pj_area
		where pp_status = '@' and pp_tipo = 'SUBMI' 
		group by a_cnpq, a_descricao
		order by a_cnpq, a_descricao
								";

		$sx  = '<table width="100%">';
		$sx .= '<TR><TH colspan=2 align="left"><H2>Trabalhos aprovados e pendentes.</h2>';
		$sx .= '<TR><TH width="5%"	>Área';
		$sx .= '<TH width="30%"	>Descrição';
		$sx .= '<TH width="30%"	>Descrição';
		
		$rlt = db_query($sql);
		$total = 0;
		$tot = 0;
		
		while ($line = db_read($rlt)) {
			
			$tot ++; 
			$total = $total + $line['total'];
					
			$area = 	 $line['a_cnpq'];
			$desc_area = $line['a_descricao'];
			$totalcont = $line['total'];
			
			$sx .= '<TR>';
			$sx .= '<TD>'.$area;
			$sx .= '<TD>'.$desc_area;
			$sx .= '<TD>'.$totalcont;
			
		}
		
		$sx .= '<TR><TD colspan=5>Total '.$tot.' Nome';
		$sx .= '</table>';
		
		echo($sx);

		echo '>>>>Total de ' . $tot . ' avaliações';
		echo '>>>>Total de ' . $total . ' avaliações';
		
		
?>
