<?php
class semic_nota {
	var $ano = '2014';

	function apresentacao_tipo($tipo = '1') {
		$ano = $this -> ano;

		$wh = "where st_ano = '$ano' ";
		if ($tipo == '1') { $wh .= " and st_oral = 'S' ";
		}
		if ($tipo == '2') { $wh .= " and st_poster = 'S' ";
		}
		if ($tipo == '3') { $wh .= " and st_eng = 'N' ";
		}
		if ($tipo == '4') { $wh .= " and st_eng = 'S' ";
		}

		$sql = "select * from semic_nota_trabalhos 
								left join pibic_bolsa_contempladas on st_codigo = pb_protocolo
								left join pibic_professor on pb_professor = pp_cracha
								left join pibic_aluno on pb_aluno = pa_cracha 
								left join pibic_bolsa_tipo on pb_tipo = pbt_codigo
								$wh and (pb_status = 'A' or pb_status = 'F')
								order by st_edital, pbt_codigo, pp_nome, pa_nome
					";

		$rlt = db_query($sql);
		$sx = '<table width="100%" class="tabela00">';
		$to1 = 0;
		$to2 = 0;
		$to3 = 0;
		$to4 = 0;
		$sx .= '<tr>
					<th>Orientador</th>
					<th>Estudante</th>
					<th>Campus</th>
					<th>Modalidade</th>
					<th>Trabalho</th>
					<th>Bolsa</th>
					</tr>';
		$xsec = '';
		$xed = '';
		$tt1 = 0;
		$tt2 = 0;
		$tt3 = 0;
		$tt4 = 0;
		$xbolsa = '';
		while ($line = db_read($rlt)) {
			$bolsa = $line['pbt_descricao'];
			$sec = $line['st_section'];
			$sec = '';
			$ed = $line['st_edital'];
			
			if ($bolsa != $xbolsa) {
				$xbolsa = $bolsa;
				if ($tt2 > 0) {
					$sx .= '<TR><Td colspan=10 align="right" >Sub total de trabalhos: ' . $tt2;
					$tt2 = 0;
				}
				$sx .= '<TR><Td colspan=10 class="lt3">' . $bolsa;
				$xsec = $sec;
			}			

			if ($sec != $xsec) {
				if ($to2 > 0) {
					$sx .= '<TR><Td colspan=10 align="right" >Sub total de trabalhos: ' . $tt2;
					$tt2 = 0;
				}
				$sx .= '<TR><Td colspan=10 class="lt3">' . $sec;
				$xsec = $sec;
			}
			$sx .= '<tr>';
			$sx .= '<td class="tabela01">';
			$sx .= UpperCase($line['pp_nome'], 7);
			$sx .= '</td>';

			$sx .= '<td class="tabela01">';
			$sx .= trim($line['pa_nome']);
			$sx .= $line['st_cnpq'];
			$sx .= '</td>';

			$sx .= '<td class="tabela01">';
			$sx .= $line['pp_centro'];
			$sx .= '</td>';

			$sx .= '<td class="tabela01" align="center">';
			$oral = $line['st_oral'];
			$post = $line['st_poster'];
			if ($oral == 'S') { $mod = 'Oral';
				$to1++;
			}
			if ($post == 'S') { $mod = 'Poster';
				$to2++;
			}
			if (($oral == 'S') and ($post == 'S')) { $mod = 'Oral/Poster';
				$to4++;
				$to1--;
				$to2--;
			}
			$to3++;
			$tt2++;
			$sx .= $mod;
			$sx .= '</td>';

			/* PIBITI */
			if (trim($line['st_edital']) == 'PIBITI') {
				$pos = '<B>T</B>';
			} else {
				$pos = '';
			}

			/* Internaciona */
			if ($line['st_eng'] == 'S') { $pre = '<B>i</B>';
			} else {
				$pre = '';
			}
			$sx .= '<td align="center" width="80" class="tabela01">';
			$sx .= $pre . trim($line['st_section']) . trim($line['st_nr']) . $pos;
		}
		if ($tt2 > 0) {
			$sx .= '<TR><Td colspan=10 align="right" >Sub total de trabalhos: ' . $tt2;
			$tt2 = 0;
		}
		$sx .= '<tr><td colspan=6>* Bolsista CNPq/';
		$sx .= '<tr><td colspan=6><B>';
		$sx .= 'Total de apresentações: ' . $to3 . ' (Oral: ' . $to1 . ', Postêr: ' . $to2 . ', Oral/Postêr:' . $to4 . ') ';
		$sx .= '</table>';
		return ($sx);

	}

	function apresentacao_area($tipo = '1') {
		$ano = $this -> ano;

		$wh = "where st_ano = '$ano' ";
		if ($tipo == '1') { $wh .= " and st_oral = 'S' ";
		}
		if ($tipo == '2') { $wh .= " and st_poster = 'S' ";
		}
		if ($tipo == '3') { $wh .= " and st_eng = 'N' ";
		}
		if ($tipo == '4') { $wh .= " and st_eng = 'S' ";
		}

		$sql = "select * from semic_nota_trabalhos 
								left join pibic_bolsa_contempladas on st_codigo = pb_protocolo
								left join pibic_professor on pb_professor = pp_cracha
								left join pibic_aluno on pb_aluno = pa_cracha 
								$wh and (pb_status = 'A' or pb_status = 'F')
								order by st_edital, st_section, pp_nome, pa_nome
					";

		$rlt = db_query($sql);
		$sx = '<table width="100%" class="tabela00">';
		$to1 = 0;
		$to2 = 0;
		$to3 = 0;
		$to4 = 0;
		$sx .= '<tr>
					<th>Orientador</th>
					<th>Estudante</th>
					<th>Campus</th>
					<th>Modalidade</th>
					<th>Trabalho</th>
					</tr>';
		$xsec = '';
		$xed = '';
		$tt1 = 0;
		$tt2 = 0;
		$tt3 = 0;
		$tt4 = 0;

		while ($line = db_read($rlt)) {
			$sec = $line['st_section'];
			$ed = $line['st_edital'];

			if ($sec != $xsec) {
				if ($to2 > 0) {
					$sx .= '<TR><Td colspan=10 align="right" >Sub total de trabalhos: ' . $tt2;
					$tt2 = 0;
				}
				$sx .= '<TR><Td colspan=10 class="lt3">' . $sec;
				$xsec = $sec;
			}
			$sx .= '<tr>';
			$sx .= '<td class="tabela01">';
			$sx .= UpperCase($line['pp_nome'], 7);
			$sx .= '</td>';

			$sx .= '<td class="tabela01">';
			$sx .= trim($line['pa_nome']);
			$sx .= $line['st_cnpq'];
			$sx .= '</td>';

			$sx .= '<td class="tabela01">';
			$sx .= $line['pp_centro'];
			$sx .= '</td>';

			$sx .= '<td class="tabela01" align="center">';
			$oral = $line['st_oral'];
			$post = $line['st_poster'];
			if ($oral == 'S') { $mod = 'Oral';
				$to1++;
			}
			if ($post == 'S') { $mod = 'Poster';
				$to2++;
			}
			if (($oral == 'S') and ($post == 'S')) { $mod = 'Oral/Poster';
				$to4++;
				$to1--;
				$to2--;
			}
			$to3++;
			$tt2++;
			$sx .= $mod;
			$sx .= '</td>';

			/* PIBITI */
			if (trim($line['st_edital']) == 'PIBITI') {
				$pos = '<B>T</B>';
			} else {
				$pos = '';
			}

			/* Internaciona */
			if ($line['st_eng'] == 'S') { $pre = '<B>i</B>';
			} else {
				$pre = '';
			}
			$sx .= '<td align="center" width="80" class="tabela01">';
			$sx .= $pre . trim($line['st_section']) . trim($line['st_nr']) . $pos;
		}
		if ($tt2 > 0) {
			$sx .= '<TR><Td colspan=10 align="right" >Sub total de trabalhos: ' . $tt2;
			$tt2 = 0;
		}
		$sx .= '<tr><td colspan=6>* Bolsista CNPq/';
		$sx .= '<tr><td colspan=6><B>';
		$sx .= 'Total de apresentações: ' . $to3 . ' (Oral: ' . $to1 . ', Postêr: ' . $to2 . ', Oral/Postêr:' . $to4 . ') ';
		$sx .= '</table>';
		return ($sx);

	}

	function nao_indicados_apresentacao() {
		$ano = $this -> ano;

		$wh = " where st_ano = '$ano' and (pb_status = 'A' or pb_status = 'F') ";
		$sql = "select * from semic_nota_trabalhos 
								left join pibic_bolsa_contempladas on st_codigo = pb_protocolo
								left join pibic_professor on pb_professor = pp_cracha
								left join pibic_aluno on pb_aluno = pa_cracha
								$wh
								order by pp_nome, pa_nome
					";
		$rlt = db_query($sql);

		$sx = '<table width="100%" class="tabela00">';
		$to1 = 0;
		$to2 = 0;
		$to3 = 0;
		$to4 = 0;
		$sx .= '<tr>
					<th>Orientador</th>
					<th>Estudante</th>
					<th>Campus</th>
					<th>Modalidade</th>
					<th>Trabalho</th>
					</tr>';
		$xsec = '';
		$email_p = array();
		$email_ = '';
		while ($line = db_read($rlt)) {
			$ora = trim($line['st_oral']);
			$pst = trim($line['st_poster']);

			if ((strlen($ora) == 0) and (strlen($pst) == 0)) {
				$tot1++;

				$email = trim($line['pp_email']);
				if (strlen($email) > 0) { array_push($email_p, $email);
					$email_ .= $email . '; ';
				}
				$email = trim($line['pp_email_1']);
				if (strlen($email) > 0) { array_push($email_p, $email);
					$email_ .= $email . '; ';
				}

				$sx .= '<tr>';
				$sx .= '<td class="tabela01">';
				$sx .= UpperCase($line['pp_nome'], 7);
				$sx .= '</td>';

				$sx .= '<td class="tabela01">';
				$sx .= trim($line['pa_nome']);
				$sx .= $line['st_cnpq'];
				$sx .= '</td>';

				$sx .= '<td class="tabela01">';
				$sx .= $line['pp_centro'];
				$sx .= '</td>';

				$sx .= '<td class="tabela01" align="center">';
				$oral = $line['st_oral'];
				$post = $line['st_poster'];
				if ($oral == 'S') { $mod = 'Oral';
					$to1++;
				}
				if ($post == 'S') { $mod = 'Poster';
					$to2++;
				}
				if (($oral == 'S') and ($post == 'S')) { $mod = 'Oral/Poster';
					$to4++;
					$to1--;
					$to2--;
				}
				$to3++;
				$sx .= $mod;
				$sx .= '</td>';

				/* PIBITI */
				if (trim($line['st_edital']) == 'PIBITI') {
					$pos = '<B>T</B>';
				} else {
					$pos = '';
				}

				/* Internaciona */
				if ($line['st_eng'] == 'S') { $pre = '<B>i</B>';
				} else {
					$pre = '';
				}
				$sx .= '<td align="center" width="80" class="tabela01">';
				$sx .= $pre . trim($line['st_section']) . trim($line['st_nr']) . $pos;
			}

		}
		$sx .= '<tr><td colspan=6>* Bolsista CNPq/';
		$sx .= '<tr><td colspan=6><B>';
		$sx .= 'Total de apresentações: ' . $to3 . ' (Oral: ' . $to1 . ', Postêr: ' . $to2 . ', Oral/Postêr:' . $to4 . ') ';
		$sx .= '</table>';
		$sx .= '<h1>E-mail dos orientadores</h1>';
		$sx .= $email_;
		return ($sx);

	}

	function edital_quartil($tipo = '1') {
		$ano = $this -> ano;

		$wh = "where st_ano = '$ano' and (st_oral = 'S' or st_poster = 'S' )";
		if ($tipo == '1') { $wh .= " and st_eng = 'N' ";
		}
		if ($tipo == '2') { $wh .= " and st_eng = 'S' ";
		}

		$sql = "select * from semic_nota_trabalhos 
								left join pibic_bolsa_contempladas on st_codigo = pb_protocolo
								left join pibic_professor on pb_professor = pp_cracha
								left join pibic_aluno on pb_aluno = pa_cracha
								$wh
								order by pp_nome, pa_nome
					";
		$rlt = db_query($sql);
		$sx = '<table width="100%" class="tabela00">';
		$to1 = 0;
		$to2 = 0;
		$to3 = 0;
		$to4 = 0;
		$sx .= '<tr>
					<th>Orientador</th>
					<th>Estudante</th>
					<th>Campus</th>
					<th>Modalidade</th>
					<th>Trabalho</th>
					</tr>';

		while ($line = db_read($rlt)) {
			$sc = trim($line['st_section']);
			$cor = '';
			if (strlen($sc) == 0) {
				$cor = '<font color="red">';
			}
			$sx .= '<tr>';
			$sx .= '<td class="tabela01">';
			$sx .= $cor . UpperCase($line['pp_nome'], 7);
			$sx .= '</td>';

			$sx .= '<td class="tabela01">';
			$sx .= $cor . trim($line['pa_nome']);
			$sx .= $line['st_cnpq'];
			$sx .= '</td>';

			$sx .= '<td class="tabela01">';
			$sx .= $cor . $line['pp_centro'];
			$sx .= '</td>';

			$sx .= '<td class="tabela01" align="center">';
			$oral = $cor . $line['st_oral'];
			$post = $line['st_poster'];
			if ($oral == 'S') { $mod = 'Oral';
				$to1++;
			}
			if ($post == 'S') { $mod = 'Poster';
				$to2++;
			}
			if (($oral == 'S') and ($post == 'S')) { $mod = 'Oral/Poster';
				$to4++;
				$to1--;
				$to2--;
			}
			$to3++;
			$sx .= $mod;
			$sx .= '</td>';

			/* PIBITI */
			if (trim($line['st_edital']) == 'PIBITI') {
				$pos = '<B>T</B>';
			} else {
				$pos = '';
			}

			/* Internaciona */
			if ($line['st_eng'] == 'S') { $pre = '<B>i</B>';
			} else {
				$pre = '';
			}
			$sx .= '<td align="center" width="80" class="tabela01">';
			$sx .= $pre . trim($line['st_section']) . trim($line['st_nr']) . $pos;
		}
		$sx .= '<tr><td colspan=6>* Bolsista CNPq';
		$sx .= '<tr><td colspan=6><B>';
		$sx .= 'Total de apresentações: ' . $to3 . ' (Oral: ' . $to1 . ', Postêr: ' . $to2 . ', Oral/Postêr:' . $to4 . ') ';
		$sx .= '</table>';
		return ($sx);
	}

	function resumo_apresentacao() {
		$ano = $this -> ano;
		$sql = "select count(*) as total from semic_nota_trabalhos 
						where st_ano = '$ano' and st_oral = 'S' 
						group by st_oral
			";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		echo '<TT>';
		echo 'Total de apresentação Oral:' . $line['total'];

		$sql = "select count(*) as total from semic_nota_trabalhos 
						where st_ano = '$ano' and st_poster = 'S' 
						group by st_poster
			";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		echo '<br>';
		echo 'Total de Poster:' . $line['total'];

		$sql = "select count(*) as total from semic_nota_trabalhos 
						where st_ano = '$ano' and st_cnpq = '*' 
						group by st_cnpq
			";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		echo '<br>';
		echo 'Total de CNPq:' . $line['total'];

		$sql = "select count(*) as total from semic_nota_trabalhos 
						where st_ano = '$ano' and st_oral = 'S' or st_poster = 'S' 
			";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		echo '<br>';
		echo 'Total de Apresentações:' . $line['total'];
	}

	function resumo_fora_de_sede($tipo = 'A') {
		$ano = $this -> ano;
		$wh = "
					where pb_ano = '$ano' 
						and (pb_status = 'A' or pb_status = 'F')
						and (pp_centro <> 'Curitiba' and pp_centro <> 'DOUTORANDO' and pp_centro <> 'São José dos Pinhais'
						and pp_centro <> 'POSDOUTORANDO')
		";

		if ($tipo == 'A') {
			$sql = "select * from semic_nota_trabalhos 
								left join pibic_bolsa_contempladas on st_codigo = pb_protocolo
								left join pibic_professor on pb_professor = pp_cracha
								left join pibic_aluno on pb_aluno = pa_cracha
								$wh
								order by pp_centro, pa_nome
					";
		}
		if ($tipo == 'P') {
			$sql = "select count(*) as estudantes, pp_nome, pp_cracha, pp_centro,
						pp_email, pp_email_1			 
						from (
							select * from semic_nota_trabalhos 
								left join pibic_bolsa_contempladas on st_codigo = pb_protocolo
								left join pibic_professor on pb_professor = pp_cracha
								left join pibic_aluno on pb_aluno = pa_cracha
								$wh
							) as tabela
					group by pp_nome, pp_cracha, pp_centro, pp_email, pp_email_1
					order by pp_centro, pp_nome
					";
		}
		$rlt = db_query($sql);
		$sx = '<table width="100%" class="tabela00">';
		$tot = 0;
		$tot1 = 0;
		$xcidade = '';
		$email_p = array();
		$email_a = array();
		if ($tipo == 'A') {
			$sh = '<tr>
						<th>Protocolo</th>
						<th>Estudante</th>
						<th>Orientador</th>
						<th>Transporte</th>
						<th>Hotel</th>
						';
		}
		if ($tipo == 'P') {
			$sh = '<tr>
						<th>Cracha</th>
						<th>Orientador</th>
						<th>Total de orientações</th>
						<th>Transporte</th>
						<th>Hotel</th>
						';
		}
		while ($line = db_read($rlt)) {
			$cidade = $line['pp_centro'];

			if ($cidade != $xcidade) {
				if ($tot1 > 0) {
					$sx .= '<tr><td colspan=10 align="right">subtotal:' . $tot1;
				}
				$sx .= '<tr><td colspan=10 align="left" class="lt4">' . $line['pp_centro'];
				$sx .= $sh;
				$tot1 = 0;
				$xcidade = $cidade;
			}
			if ($tipo == 'A') {
				$sx .= '<tr>';
				$sx .= '<td class="tabela01" align="center">' . $line['pb_protocolo'];
				$sx .= '<td class="tabela01">' . $line['pa_nome'];
				$sx .= '<td class="tabela01">' . $line['pp_nome'];
				$sx .= '<td width="120" class="tabela01">';
				$sx .= '<td width="120" class="tabela01">';

				$email = trim($line['pa_email']);
				if (strlen($email) > 0) { array_push($email_a, $email);
				}
				$email = trim($line['pa_email_1']);
				if (strlen($email) > 0) { array_push($email_a, $email);
				}
			}

			if ($tipo == 'P') {
				$sx .= '<tr>';
				$sx .= '<td class="tabela01" align="center">' . $line['pp_cracha'];
				$sx .= '<td class="tabela01">' . $line['pp_nome'];
				$sx .= '<td class="tabela01" align="center" width="50">' . $line['estudantes'];
				$sx .= '<td width="120" class="tabela01">';
				$sx .= '<td width="120" class="tabela01">';

				$email = trim($line['pp_email']);
				if (strlen($email) > 0) { array_push($email_p, $email);
				}
				$email = trim($line['pp_email_1']);
				if (strlen($email) > 0) { array_push($email_p, $email);
				}
			}

			$tot++;
			$tot1++;
		}
		$sx .= '<tr><td colspan=10 align="right">subtotal:' . $tot1;
		$sx .= '<tr><td colspan=10 align="right">Total:' . $tot;
		$tot1 = 1;
		$sx .= '</table>';
		if ($tipo == 'P') {
			$sx .= '<h1>E-mail dos professores</h1>';
			for ($r = 0; $r < count($email_p); $r++) {
				$sx .= $email_p[$r] . '; ';
			}
		}
		if ($tipo == 'A') {
			$sx .= '<h1>E-mail dos alunos</h1>';
			for ($r = 0; $r < count($email_a); $r++) {
				$sx .= $email_a[$r] . '; ';
			}
		}
		return ($sx);
	}

	function resumo() {
		$sql = "select * from semic_nota_trabalhos
					left join pibic_bolsa_contempladas on st_codigo = pb_protocolo
					left join ajax_areadoconhecimento on st_area_geral =  a_cnpq  
					where (st_status = 'A' or st_status = 'F') 
					order by st_eng, st_edital, st_area_geral, st_nota_media desc
				";
		$rlt = db_query($sql);

		$sx = '<table width="100%">';
		$sh = '<tr>
				<th width="50">P.Geral</th>
				<th width="50">P.Área</th>
				<th width="100">Protocolo</th>
				<th width="20">CNPq</th>
				<th width="100">Trabalho ID</th>
				<th width="50">Status</th>
				<th width="100">Edital</th>
				<th width="30">Oral</th>
				<th width="30">Postêr</th>
				<th>Nota Submissão</th>
				<th>Nota R.Parc</th>
				<th>Nota R.Final</th>
				<th>Média</th>
				<th>Nota Oral</th>
				<th>Nota Postêr</th>
				</tr>
		';
		$id = 0;
		$id2 = 0;
		$xarea = '';
		while ($line = db_read($rlt)) {
			$id++;
			$id2++;
			$area = $line['st_area_geral'];
			$edital = $line['st_edital'];
			$area_descricao = $line['a_descricao'];

			if ($area != $xarea) {
				$sx .= '<tr><td class="lt3" colspan=20>';
				$sx .= $edital . ' - ' . $area . ' - ' . $area_descricao . ' - ' . $line['st_eng'];
				$xarea = $area;
				$id2 = 1;
				$sx .= $sh;
			}

			$i = $line['st_eng'];
			if ($i == 'S') {
				$en = '<B>i</B>';
			} else {
				$en = '';
			}

			if (trim($line['st_edital']) == 'PIBITI') {
				$pos = '<B>T</B>';
			} else {
				$pos = '';
			}

			$sx .= '<tr>';
			$sx .= '<td>' . $id . '</td>';
			$sx .= '<td>' . $id2 . '</td>';
			$sx .= '<td>' . $line['st_codigo'] . '</td>';
			$sx .= '<td>' . $line['st_cnpq'] . '</td>';
			$sx .= '<td>' . $en . trim($line['st_section']) . trim($line['st_nr']) . $pos . '</td>';
			$sx .= '<td width="10" align="center" class="tabela01">' . $line['st_status'] . '</td>';
			//$sx .= '<td>' . $line['st_cod_trabalho'] . '</td>';
			$sx .= '<td>' . $line['st_edital'] . '</td>';
			//$sx .= '<td>' . $line['st_modalidade'] . '</td>';
			//$sx .= '<td>' . $line['st_id'] . '</td>';
			//$sx .= '<td>' . $line['st_area_geral'] . '</td>';
			//$sx .= '<td>' . $line['st_area_geral'] . '</td>';
			$sx .= '<td align="center" class="tabela01">' . $line['st_oral'] . '</td>';
			$sx .= '<td align="center" class="tabela01">' . $line['st_poster'] . '</td>';

			$sx .= '<td width="50" align="center" class="tabela01">' . round($line['st_nota_submint'] / 100) . '</td>';
			$sx .= '<td width="50" align="center" class="tabela01">' . round($line['st_nota_rel_parcial'] / 10) . '</td>';
			if ($line['st_nota_rel_final'] == -1) {
				$sx .= '<td width="50" align="center" class="tabela01"><font color="red">Não indicado</A></td>';
			} else {
				$sx .= '<td width="50" align="center" class="tabela01">' . round($line['st_nota_rel_final'] / 10) . '</td>';
			}

			$sx .= '<td width="50" align="center" class="tabela01"><b>' . $line['st_nota_media'] . '</b></td>';
			$sx .= '<td width="50" align="center" class="tabela01">' . $line['st_nota_semic_oral'] . '</td>';
			$sx .= '<td width="50" align="center" class="tabela01">' . $line['st_nota_semic_poster'] . '</td>';
		}
		$sx .= '</table>';
		return ($sx);
	}

	function dropall() {
		$sql = "delete from semic_nota_trabalhos where 1=1 ";
		$rlt = db_query($sql);
	}

	function salva_nota($protocolo, $nota, $tipo) {
		$sql = "select * from semic_nota_trabalhos where st_codigo = '$protocolo' ";
		$rlt = db_query($sql);
		$nota1 = 0;
		$nota2 = 0;
		$nota3 = 0;

		switch($tipo) {
			case 'SUBMI' :
				$nota1 = $nota;
				break;
			case 'RPAR' :
				$nota2 = $nota;
				break;
			case 'RFIN' :
				$nota3 = $nota;
				break;
			default :
				echo 'Não localizado:' . $tipo;
				exit ;
		}
		if ($line = db_read($rlt)) {
			$sql = "update semic_nota_trabalhos set ";
			switch($tipo) {
				case 'SUBMI' :
					$sql .= " st_nota_submint = '$nota1' ";
					break;
				case 'RPAR' :
					$sql .= " st_nota_rel_parcial = '$nota2' ";
					break;
				case 'RFIN' :
					$sql .= " st_nota_rel_final = '$nota3' ";
					break;
			}
			$sql .= " where st_codigo = '$protocolo' ";

			$rrr = db_query($sql);
			return ('<font color="blue"> (Atualizado)');
		} else {
			$sql = "insert into semic_nota_trabalhos 
								(
								st_codigo, st_cod_trabalho, st_edital,
								st_modalidade, st_id, st_area,
								st_nota_submint, st_nota_rel_parcial, st_nota_rel_final,
								st_nota_media, st_nota_semic_oral, st_nota_semic_poster
								) values (
								'$protocolo','','',
								'','','',
								'$nota1','$nota2','$nota3',
								'0','0','0'
								)
						";
			$rrr = db_query($sql);
			return ('<font color="green"> (Incluído)');
		}
	}

	function phase_i() {
		$ano = $this -> ano;

		$sql = "select * from pibic_parecer_" . $ano . " 
							where (pp_tipo = 'SUBMP' or pp_tipo = 'SUBMI')
							and pp_status = 'B' 
							order by pp_protocolo
							";
		$rlt = db_query($sql);

		$notas = array();
		$notas2 = array();

		while ($line = db_read($rlt)) {
			$tipo = $line['pp_tipo'];
			$proto = $line['pp_protocolo'];
			$proto_mae = $line['pp_protocolo_mae'];
			$nota = $line['pp_abe_15'];

			$nota = round($line['pp_p01']) + round($line['pp_p02']) + round($line['pp_p03']);
			$nota = $nota + round($line['pp_p04']) + round($line['pp_p05']) + round($line['pp_p06']);
			$nota = $nota + round($line['pp_p07']) + round($line['pp_p08']) + round($line['pp_p09']);

			if (isset($notas[$proto])) {
				$notas[$proto] = $notas[$proto] + $nota;
				$notas2[$proto] = $notas2[$proto] + 1;
			} else {
				$notas[$proto] = $nota;
				$notas2[$proto] = 1;
			}
		}
		$sx .= '<table width="100%">';
		$id = 99;
		foreach ($notas as $key => $value) {
			if ($id > 5) {
				$sx .= '<tr>';
				$id = 0;
			}
			$sx .= '<td>' . $key . '=' . $value;
			$nr = $notas2[$key];

			$nota = round($value / $nr * 100);
			$sx .= $this -> salva_nota($key, $nota, 'SUBMI');
			$sx .= '</td>';
			$id++;
		}
		$sx .= '</table>';
		return ($sx);
	}

	function phase_ii() {
		$ano = $this -> ano;

		$sql = "select * from pibic_parecer_" . ($ano + 1) . " 
							where (pp_tipo = 'RPAR')
							and pp_status = 'B' 
							order by pp_protocolo
							";
		$rlt = db_query($sql);

		$notas = array();
		$notas2 = array();

		while ($line = db_read($rlt)) {
			$tipo = $line['pp_tipo'];
			$proto = $line['pp_protocolo'];
			$proto_mae = $line['pp_protocolo_mae'];
			$nota = round($line['pp_abe_15']);

			if (isset($notas[$proto])) {
				$notas[$proto] = $notas[$proto] + $nota;
				$notas2[$proto] = $notas2[$proto] + 1;
			} else {
				$notas[$proto] = $nota;
				$notas2[$proto] = 1;
			}
		}
		$sx .= '<table width="100%">';
		$id = 99;
		foreach ($notas as $key => $value) {
			if ($id > 5) {
				$sx .= '<tr>';
				$id = 0;
			}
			$sx .= '<td>' . $key . '=' . $value;
			$nr = $notas2[$key];

			$nota = round($value / $nr * 100);
			$sx .= $this -> salva_nota($key, $nota, 'RPAR');
			$sx .= '</td>';
			$id++;
		}
		$sx .= '</table>';
		return ($sx);
	}

	function phase_iii() {
		$ano = $this -> ano;

		$sql = "select * from pibic_parecer_" . ($ano + 1) . " 
							where (pp_tipo = 'RFIN')
							and pp_status = 'B' 
							order by pp_protocolo
							";
		$rlt = db_query($sql);

		$notas = array();
		$notas2 = array();

		while ($line = db_read($rlt)) {
			$tipo = $line['pp_tipo'];
			$proto = $line['pp_protocolo'];
			$proto_mae = $line['pp_protocolo_mae'];
			$nota = $line['pp_abe_11'];

			if (isset($notas[$proto])) {
				$notas[$proto] = $notas[$proto] + $nota;
				$notas2[$proto] = $notas2[$proto] + 1;
			} else {
				$notas[$proto] = $nota;
				$notas2[$proto] = 1;
			}
		}
		$sx .= '<table width="100%">';
		$id = 99;
		foreach ($notas as $key => $value) {
			if ($id > 5) {
				$sx .= '<tr>';
				$id = 0;
			}
			$sx .= '<td>' . $key . '=' . $value;
			$nr = $notas2[$key];

			$nota = round($value / $nr * 100);
			if ($nota == 0) { $nota = -1;
			}
			$sx .= $this -> salva_nota($key, $nota, 'RFIN');
			$sx .= '</td>';
			$id++;
		}
		$sx .= '</table>';
		return ($sx);
	}

	function phase_iv() {
		$sql = "alter table semic_nota_trabalhos add column st_ano char(4)";
		//$rlt = db_query($sql);
		$sql = "alter table semic_nota_trabalhos add column st_aluno char(8)";
		//$rlt = db_query($sql);

		$ano = $this -> ano;
		$sql = "select * from semic_nota_trabalhos 
					left join pibic_bolsa_contempladas on st_codigo = pb_protocolo
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					and pb_ano = '$ano' 
		";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$cnpq = '';
			$eng = 'N';
			$protocolo = $line['st_codigo'];
			$area = $line['pb_semic_area'];
			$areag = substr($line['pb_semic_area'], 0, 4) . '.00.00';
			if (substr($area, 0, 4) == '6.01') {
				$area = substr($line['pb_semic_area'], 0, 7) . '.00';
			}
			$status = $line['pb_status'];
			$prof = $line['pb_professor'];
			$alun = $line['pb_aluno'];
			$edital = $line['pbt_edital'];
			$idioma = $line['pb_semic_idioma'];
			$ano = $line['pb_ano'];

			if ($idioma == 'en_US') {
				$eng = 'S';
			}
			$bolsa = $line['pb_tipo'];
			if (($bolsa == 'C') or ($bolsa == 'E') or ($bolsa == 'H') or ($bolsa == 'B') or ($bolsa == '2')) {
				$cnpq = '*';
			}

			$sql = "update semic_nota_trabalhos set
							st_edital = '$edital',
							st_area = '$area',
							st_cnpq = '$cnpq',
							st_status = '$status',
							st_professor = '$prof',
							st_aluno = '$alun',
							st_ano = '$ano',
							st_eng = '$eng'
						where st_codigo = '$protocolo'
				";
			$rrr = db_query($sql);
		}
	}

	function phase_v() {
		$ano = $this -> ano;
		$sql = "select max(st_nota_submint) as n1,
						max(st_nota_rel_parcial) as n2,
						max(st_nota_rel_final) as n3 
				 from semic_nota_trabalhos 
					where st_status = 'A' or st_status = 'F' 
		";
		$rlt = db_query($sql);
		$line = db_read($rlt);

		$max_n1 = $line['n1'] * 0.5;
		$max_n2 = $line['n2'] * 0.7;
		$max_n3 = $line['n3'] * 1.0;

		$sql = "select * from semic_nota_trabalhos 
					where st_status = 'A' or st_status = 'F' 
		";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$nota1 = $line['st_nota_submint'];
			$nota2 = $line['st_nota_rel_parcial'];
			$nota3 = $line['st_nota_rel_final'];
			$protocolo = $line['st_codigo'];

			$nota1 = round(100 * ($nota1 / $max_n1));
			$nota2 = round(100 * ($nota2 / $max_n2));
			$nota3 = round(100 * ($nota3 / $max_n3));

			$med = 0;
			if ($nota1 > 0) { $nota1 = $nota1 * 0.5;
				$med++;
			}
			if ($nota2 > 0) { $nota2 = $nota2 * 0.7;
				$med++;
			}
			if ($nota3 > 0) { $nota3 = $nota3 * 1;
			}
			$med++;

			$nota = ($nota1 + $nota2 + $nota3);
			$media = round($nota / $med);

			$sql = "update semic_nota_trabalhos set
							st_nota_media = '$media'
						where st_codigo = '$protocolo'
				";
			$rrr = db_query($sql);
		}
	}

	function phase_vi() {
		$sql = "select st_area from semic_nota_trabalhos group by st_area";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$xarea = substr(trim($line['st_area']), 0, 4);

			if ($xarea == '6.01') {
				$area = substr($line['st_area'], 0, 7) . '.00%';
				$arean = trim($line['st_area']);
			} else {
				$area = substr($line['st_area'], 0, 4) . '.00.00%';
				$arean = trim($line['st_area']);
			}
			echo '<BR>' . $area;
			$sql = "select * from ajax_areadoconhecimento where a_cnpq like '$area' ";
			$rrr = db_query($sql);
			$lll = db_read($rrr);
			$areag = $lll['a_cnpq'];
			$sql = "update semic_nota_trabalhos
					set st_area_geral = '$areag'
					where st_area = '$arean'
					";
			echo '<BR>' . $sql;
			$qqq = db_query($sql);
		}
	}

	function phase_vii() {
		$sql = "alter table semic_nota_trabalhos add column st_nr char(3)";
		//$rlt = db_query($sql);

		$sec = array();
		$sql = "select * from sections where journal_id = 76";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$area = trim($line['identify_type']);
			if (strlen($area) > 0) {
				$sec[$area] = $line['abbrev'];
			}
		}
		$sql = "select * from semic_nota_trabalhos ";
		$rlt = db_query($sql);

		while ($line = db_read($rlt)) {
			$area = substr($line['st_area'], 0, 4);
			if ($area == '6.01') {
				$area = substr($line['st_area'], 0, 7);
			}
			$area = $sec[$area];
			$proto = $line['st_codigo'];

			$sql = "update semic_nota_trabalhos
					set st_section = '$area'
					where st_codigo = '$proto'
					";
			$qqq = db_query($sql);
		}

		/* Numeracao */
		$sql = "select * from semic_nota_trabalhos where st_nr = '' or st_nr is null
				order by st_section, st_professor
		";
		$rlt = db_query($sql);
		$id = 0;
		$xsec = '';
		while ($line = db_read($rlt)) {
			$id++;
			$sec = $line['st_section'];
			if ($xsec != $sec) {
				$xsec = $sec;
				$id = 1;
			}
			$sql = "update semic_nota_trabalhos set st_nr = '" . $id . "' where id_st = " . $line['id_st'];
			echo '<BR>' . $sec . '==' . $sql;
			$rrr = db_query($sql);
		}

	}

	function phase_viii() {
		$ano = $this -> ano;

		$sql = "select count(*) as total, st_section, st_ano
					from semic_nota_trabalhos
					where (st_status = 'A' or st_status ='F') and st_ano = '$ano'
					and st_eng <> 'S'
					group by st_section, st_ano
		";
		$rlt = db_query($sql);

		$sect = array();
		$tot = 0;
		$toq = 0;
		$sx = '<tt>';
		while ($line = db_read($rlt)) {
			$tot = $tot + $line['total'];
			$key = trim($line['st_section']);
			$total = $line['total'];
			$sect[$key] = $total;
			$sx .= '<HR>' . $key . '<BR>';
			$sx .= 'Total de trabalhos:' . $total;
			$q1 = round($total / 4);
			if ($q1 == 0) { $q1 = 1;
			}
			$sx .= ', quartil:' . $q1;
			$toq = $toq + $q1;

			/* Distribui */
			$sql = "select * from semic_nota_trabalhos
					left join pibic_bolsa_contempladas on st_codigo = pb_protocolo
					left join ajax_areadoconhecimento on st_area_geral =  a_cnpq  
					where (st_status = 'A' or st_status = 'F')
					and st_nota_rel_final > 10 and st_section = '$key'
					order by st_eng, st_edital, st_area_geral, st_nota_media desc
					limit " . $q1;
			$rrr = db_query($sql);
			while ($lll = db_read($rrr)) {
				$sql = "update semic_nota_trabalhos set st_oral = 'S' where st_codigo = '" . $lll['st_codigo'] . "'";
				$rr2 = db_query($sql);
			}
		}
		$sx .= '<BR>Total de trabalhos (Portugues):' . $tot;
		$sx .= '<BR>Total de trabalhos Oral (Portugues):' . $toq;

		/* Indicacao Oral Internacional */
		$sql = "update semic_nota_trabalhos set st_oral = 'S', st_poster = 'N' where (st_eng = 'S') and st_ano = '$ano' and st_nota_rel_final > 10 ";
		$rlt = db_query($sql);

		/* Indicacao CNPQ */
		$sql = "update semic_nota_trabalhos set st_oral = 'S', st_poster = 'S' where st_cnpq = '*' and st_ano = '$ano' ";
		$rlt = db_query($sql);

		/* Indicacao Poster */
		$sql = "update semic_nota_trabalhos set st_poster = 'S' where (st_oral <> 'S' or st_oral is null) and st_ano = '$ano' and st_nota_rel_final > 10 ";
		$rlt = db_query($sql);

		echo $sx;
		exit ;
	}

}
?>
