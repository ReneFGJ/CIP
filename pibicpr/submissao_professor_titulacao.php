<?php
require("cab.php");
require($include.'sisdoc_menus.php');

echo '<h1>Submissões de planos</h1>';

		$cp = 'doc_status, pp_cracha, pp_nome , pp_titulacao, doc_edital, ap_tit_titulo ';
		//$cp = '*';
		$sql = "select count(*) as total, $cp from pibic_submit_documento 
						left join pibic_aluno on doc_aluno = pa_cracha
						left join pibic_professor on doc_autor_principal = pp_cracha
						inner join pibic_projetos on pj_codigo = doc_protocolo_mae
						inner join apoio_titulacao on pp_titulacao = ap_tit_codigo 
						where doc_status <> 'X' and pj_ano = '".date("Y")."'
						and (pj_status = 'B' or pj_status = 'C')
						group by $cp
						order by pp_nome, doc_edital
						";
		$rlt = db_query($sql);
		$tot = 0;
		$sx = '<table width="100%" class="tabela00">';
		$sx .= '<TR><TH>Professor</TH><TH>Cracha</TH><TH>Titulacao</TH><TH>Edital</TH><TH>Edital</TH><TH>Edital</TH><TH>Edital</TH>';
		$xprof = '';
		while ($line = db_read($rlt))
			{
				$titulo = trim($line['pp_titulacao']);
				$cor = '<font color="black">';
				$total = $line['total'];
				
				/* Regras */
				/* Mestre com mais de dois planos */
				if (($titulo=='001') and ($total > 2)) { $cor = '<font color="red">'; }

				/* Doutor com mais de quatro planos */
				if (($titulo=='002') and ($total > 4)) { $cor = '<font color="red">'; }
				
				/* Doutorando com mais de um planos */
				if (($titulo=='011') and ($total > 1)) { $cor = '<font color="red">'; }

				$prof = $line['pp_cracha'];
				if ($prof != $xprof)
					{
					$sx .= '<TR>';
					$sx .= '<TD class="tabela01">'.$cor.$line['pp_nome'];
					$sx .= '<TD class="tabela01">'.$cor.$line['pp_cracha'];
					$sx .= '<TD class="tabela01">'.$cor.$line['pp_titulacao'];
					$sx .= '-'.$line['ap_tit_titulo'];
					$xprof = $prof;
					}
				$sx .= '<TD class="tabela01">'.$cor.$line['total'];
				$sx .= ' ('.trim($line['doc_edital']).')'.'</font>';
				$tot = $tot + $line['total'];
			}
		$sx .= '</table>';
		$sx .= 'Total '.$tot;
		echo $sx;
require("../foot.php");	
?>