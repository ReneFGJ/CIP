<?php
require ("cab.php");
require ($include . "sisdoc_colunas.php");
require ($include . "sisdoc_data.php");
require ($include . "sisdoc_email.php");
require ($include . "sisdoc_windows.php");
require ($include . "sisdoc_debug.php");


$sql = "select  a_cnpq, a_descricao, pp_protocolo, pj_titulo, pj_professor, pp_nome, count(*) as total
		from pibic_parecer_".date('Y')."
		inner join  pibic_projetos on pj_codigo = pp_protocolo
		inner join ajax_areadoconhecimento on a_cnpq = pj_area
		inner join pibic_professor on pp_cracha = pj_professor
		where pp_status = '@' and pp_tipo = 'SUBMI' 
		group by a_cnpq, a_descricao, pp_protocolo, pj_titulo, pj_professor, pp_nome
		order by a_cnpq, a_descricao
		";

		$sx = '<h2>Avaliações em aberto por área</h2>';
		$sx .= '<table width="100%" class="tabela00">';
		$sx .= '<TR><TH width="10%"	 align=left>Área';
		$sx .=     '<TH width="20%"	 align=left   >Descrição';
		$sx .=     '<TH width="10%"	 align=left  >protocolo';
		$sx .=     '<TH width="30%"	 align=left  >Titulo';
		$sx .=     '<TH width="10%"	 align=left  >Crachá Prof.';
		$sx .=     '<TH width="15%"	 align=left  >Nome Prof.';
		$sx .=     '<TH width="5%"	 align=left  >Total';
		
		
		$rlt = db_query($sql);
		$total = 0;
		$tot = 0;
		
		while ($line = db_read($rlt)) 
		{
			
			$tot ++; 
			$total = $total + $line['total'];
					
			$area = 	 $line['a_cnpq'];
			$desc_area = $line['a_descricao'];
			
			$protocolo = $line['pp_protocolo'];
			$titulo    = ucwords(strtolower($line['pj_titulo']));
			$cracha    = $line['pj_professor'];
			$nome      = tratar_nome($line['pp_nome']);
			
			$totalcont = $line['total'];
			
			if ($area != $xarea)
			{	
			$sx .= '<TR><TD colspan=3><font color="blue" class="lt3">';
			$sx .= $area;
			$sx .= $desc_area;
			$xarea = $area;
			$sx .= '</font>';
			}
			

			
			
			$sx .= '<TR>';
			$sx .= '<TD class="tabela01">'.$area;
			$sx .= '<TD class="tabela01">'.$desc_area;
			
			$sx .= '<TD class="tabela01">'.$protocolo;
			$sx .= '<TD class="tabela01">'.$titulo;
			$sx .= '<TD class="tabela01">'.$cracha;
			$sx .= '<TD class="tabela01">'.$nome;
			
			$sx .= '<TD class="tabela01">'.$totalcont;
			
		}
		
		$sx .= '<TR><TD colspan=3> '.$tot.' avaliações';
		$sx .= '<TR><TD colspan=3>Total geral '.$total.' avaliação aguardando';
		
		$sx .= '</table>';
		
		echo($sx);

		
?>
