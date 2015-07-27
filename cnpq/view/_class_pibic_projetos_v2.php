<?php
class projetos {
	var $protocolo;
	var $protocolo_aluno;
	var $status;
	var $titulo = '';
	var $line;

	var $plano_pibic = 0;
	var $plano_pibiti = 0;
	var $plano_pibic_em = 0;
	var $plano_ici = 0;

	var $plano_submissao = 0;

	var $erros;
	var $tabela = "pibic_projetos";
	var $tabela_planos = "pibic_submit_documento";

	var $internacional = 0;
	var $status = '@';

	var $ano;

	function valida_limite_submissao($orientador) {
		global $ttt;
		$sql = "select * from pibic_professor where pp_cracha = '" . $orientador . "' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			$ok = 0;
			$titu = trim($line['pp_titulacao']);

			/* Limites */

			if ($titu == '002') { $ok = 4;
			}/* Doutor */
			if ($titu == '001') { $ok = 2;
			}/* Mestre */
			//if ($titu == '008') { $ok = 1 ; } /* Pós-Graduação */
			if ($titu == '003') { $ok = 4;
			}/* Doutora */
			if ($titu == '006') { $ok = 4;
			}/* PhD */
			// if ($titu == '011') { $ok = 1 ; } /* Doutorando */
			if (trim($line['pp_centro']) == 'DOUTORANDO') { $ok = 2;
			}
			if (trim($line['pp_centro']) == 'POSDOUTORANDO') { $ok = 2;
			}
		}

		/* Soma total de planos submetidos */
		$sql = "select doc_edital, count(*) as total from " . $this -> tabela_planos . " 
				where doc_autor_principal = '$orientador' and doc_ano = '" . date("Y") . "'
				and (doc_status = '@' or doc_status = 'B') 
				group by doc_edital";
		$rlt = db_query($sql);
		$line = db_read($rlt);

	}

	function areas_mostra($c) {
		if ($c == 'E') { $sx = '<font style="color: #006b9f; font-size: 30px;">Ciências Exatas</font>';
		}
		if ($c == 'H') { $sx = '<font style="color: #ff0000; font-size: 30px;">Ciências Humanas</font>';
		}
		if ($c == 'S') { $sx = '<font style="color: #ff0000; font-size: 30px;">Ciências Sociais Aplicadas</font>';
		}
		if ($c == 'V') { $sx = '<font style="color: #00A000; font-size: 30px;">Ciências da Vida</font>';
		}
		if ($c == 'A') { $sx = '<font style="color: #009000; font-size: 30px;">Ciências Agrárias</font>';
		}
		return ($sx);
	}

	function mostra_edital($ano, $bolsa, $modalidade, $tipo = '') {
		$sql = "select * from pibic_submit_documento where doc_edital = 'PIBICE' ";
		//			$rlt = db_query($sql);
		//			while ($line = db_read($rlt))
		//				{
		//					print_r($line);
		//					exit;
		//				}

		$cps = 'doc_1_titulo, doc_ava_estrategico, id_pj, pj_codigo, doc_doutorando, doc_area, ap_tit_titulo, pp_nome, pp_centro, pp_ss, doc_icv, doc_estrategica, doc_nota, doc_protocolo_mae, doc_protocolo ';
		$cps .= ', pp_prod, pp_cracha, doc_aluno, doc_avaliacoes, pb_vies, doc_protocolo ';
		if ($modalidade != 'PIBICE') { $cps .= ', pb1.pb_tipo as pb_tipo, pa_nome ';
		}
		//$cps = '*';
		$sql = "select " . $cps . " from pibic_submit_documento ";
		$sql .= " inner join pibic_professor on pp_cracha = doc_autor_principal ";
		$sql .= " inner join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
		if ($modalidade != 'PIBICE') {
			$sql .= " inner join pibic_aluno on pa_cracha = doc_aluno ";
			$sql .= " left join pibic_bolsa as pb1 on (doc_protocolo = pb1.pb_protocolo) ";

		}
		$sql .= " left join pibic_projetos on pj_codigo = doc_protocolo_mae ";
		$sql .= " where doc_ano = '" . $ano . "' ";
		$sql .= " and (doc_edital = '" . $modalidade . "' ";
		if ($modalidade == 'PIBITI') {
			$sql .= " or (pb_vies = '1' and pb_tipo = 'I') ";
		}
		$sql .= ") and (doc_protocolo <> doc_protocolo_mae) ";
		if (strlen($area) > 0) { $sql .= " and doc_area = '" . $area . "' ";
		}
		$sql .= " and (doc_status <> 'X' and doc_status <> '@' ) ";
		$sql .= " and pb_tipo <> 'X' ";
		if (strlen($tipo) > 0) { $sql .= " and pb_tipo = '$tipo' ";
		}
		//$sql .= " and (doc_aluno <> '') ";
		//$sql .= " and doc_nota > 10 ";
		$sql .= " order by doc_area, pp_nome ";
		$rlt = db_query($sql);

		$sx .= '<table class="lt0">';
		$tot = 0;
		$sh .= '<TR><TH>bolsa';
		$sh .= '<TH>tit';
		$sh .= '<TH>professor';
		$sh .= '<TH>aluno';
		$sh .= '<TH>título do plano de trabalho';

		$xarea = '-';
		$id = 0;
		while ($line = db_read($rlt)) {
			$idr = $line['id_pj'];
			$nota = round($line['doc_nota']);
			//$link = '<A HREF="pibic_projetos_detalhes.php?dd0='.$idr.'&dd90='.checkpost($idr).'" class="lt1a" target="new'.$id.'">';
			$cp = 'ap_tit_titulo, pp_nome, pa_nome, doc_1_titulo';
			$area = $line['doc_area'];
			if ($area != $xarea) {
				$edital = trim($line['doc_edital']);
				if ($edital == 'PIBICE') { $edital = 'PIBIC_EM';
				}
				$sx .= '<TR><TD class="lt4" colspan=6><center>' . $this -> areas_mostra($area);
				$sx .= '<BR>' . $edital;
				$sx .= $sh . chr(13);
				$xarea = $area;
			}
			$tot++;
			$bolsa = trim($line['pb_tipo']);
			if ($nota < 60) { $bolsa = 'D';
			}
			if ($bolsa == 'R') { $bolsa = 'D';
			}
			if ($bolsa != 'D') {
				$id++;
				$tipo = trim($line['pb_tipo']);
				$vies = trim($line['pb_vies']);
				$sx .= '<TR ' . coluna() . ' class="lt1a">';
				$sx .= '<TD><img src="img/logo_bolsa_' . $bolsa . '.png">';
				if ($vies == '1' and $tipo == 'I') { $sx .= '*';
				}
				$sx .= '<TD>';
				$sx .= $link;
				$sx .= $line['ap_tit_titulo'];
				$sx .= '<TD width="20%">';
				$sx .= $link;
				$sx .= nbr_autor($line['pp_nome'], 7);
				$sx .= '<TD width="20%">';
				$sx .= $link;
				$aluno = trim($line['pa_nome']);
				if (strlen($aluno) == 0) { $aluno = ':: Sem Definição de Aluno ::';
				} else { $aluno = trim(nbr_autor($line['pa_nome'], 7));
				}
				if (strlen($aluno) == 0) { $aluno = ':: Sem Definiçâo de Aluno ::';
				}
				$sx .= $aluno;
				$sx .= '<TD>';
				$sx .= $link;
				$sx .= nbr_autor($line['doc_1_titulo'], 7);
				$sx .= '</tr>' . chr(13) . chr(10);
				$sx .= '<tr><td colspan="6"><img src="img/nada_black.gif" alt="" width="100%" border="0" height="1"></td></tr>' . chr(13) . chr(10);
			}

		}
		$sx .= '<TR><TD colspan=5>Total de ' . $tot . ' projetos nesta modalidade';
		$sx .= '</table>';
		return ($sx);
	}

	function demandas($ano = '') {
		$sx = '<table class="tabela00 lt3" width="100%">';
		$sx .= '<TR><TD>Projetos de Professor';
		$sx .= '<TD>' . $this -> demandas_projetos_submetidos($ano);

		$sx .= '<TR><TD>Professor com projetos submetidos';
		$sx .= '<TD>' . $this -> demandas_projetos_professor($ano);

		$sx .= '<TR valign="top"><TD>Total de Planos Submetidos';
		$sx .= '<TD>' . $this -> demandas_planos_submetidos($ano);

		$sx .= '<TR valign="top"><TD>Total de Avaliações (planos/projetos)';
		$sx .= '<TD>' . $this -> planos_submetidos_avaliados($ano);

		$sx .= '<TR valign="top"><TD>Projetos PIBIC com viés PIBITI';
		$sx .= '<TD>' . $this -> planos_com_vies_pibiti($ano);

		$sx .= '</table>';
		$sx .= $this -> planos_notas($ano);
		//$sx .= $this->planos_notas_mostra($ano);
		return ($sx);
	}

	function planos_com_vies_pibiti($ano) {
		$tabela = "pibic_parecer_" . $ano;
		$sql = "select count(*) as total, pp_protocolo from " . $tabela . "  
			inner join pibic_submit_documento on doc_protocolo = pp_protocolo
			where pp_tipo = 'SUBMP' 
			and pp_status <> 'D'
			and pp_p08 = '1'
			and doc_edital = 'PIBIC'
			group by pp_protocolo
			order by pp_protocolo
			";
		$rlt = db_query($sql);
		$t1 = 0;
		$t2 = 0;
		while ($line = db_read($rlt)) {
			$t = $line['total'];
			if ($t == 2) {
				$t2++;
			} else {
				$t1++;
			}
		}
		$sx .= '<table class="tabela00 lt3">
				<TR><TD>Apontado por <B>um</B> avaliador <TD>' . $t1 . '</td></tr>
				<TR><TD>Apontado por <B>dois</B> avaliador <TD>' . $t2 . '</td></tr>
				</table>
		';
		return ($sx);
	}

	function demandas_projetos_submetidos($ano) {
		$sql = "select count(*) as total 
						from " . $this -> tabela . " 
						where pj_ano = '$ano' 
								and pj_status <> 'X' 
								and pj_status <> '!'
						";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		return ($line['total']);
	}

	function planos_notas_mostra($ano) {
		$sql = "select * from pibic_submit_documento 
							where doc_ano = '$ano'
								and (doc_status <> '@' and doc_status <> 'X' and doc_status <> '!')
								and doc_edital = 'PIBICE'
						order by doc_protocolo_mae, doc_protocolo";
		$rlt = db_query($sql);
		$id = 0;
		$sx .= '<table width="100%" class="tabela00">';
		while ($line = db_read($rlt)) {
			$id++;
			$sx .= '<TR>';
			$sx .= '<TD>' . $line['doc_protocolo_mae'];
			$sx .= '<TD>' . $line['doc_protocolo'];
			$sx .= '<TD>' . $line['doc_status'];
			$sx .= '<TD>' . $line['doc_nota'];
			$sx .= '<TD>' . $line['doc_edital'];
		}
		$sx .= '<TR><TD colspam=10>' . $id;
		$sx .= '</table>';
		return ($sx);
	}

	function planos_notas($ano) {
		$sql = "select * from pibic_submit_documento 
							where doc_ano = '$ano'
							and (doc_status <> '@' and doc_status <> 'X' and doc_status <> '!')			
				";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		$ar = array('PIBIC', 'PIBITI', 'PIBICE', 'ICI');
		$ar1 = array(0, 0, 0, 0);
		$ar2 = array(0, 0, 0, 0);
		$ar3 = array(0, 0, 0, 0);
		$ar4 = array(0, 0, 0, 0);

		while ($line = db_read($rlt)) {
			$nota = round('0' . trim($line['doc_nota']));
			$t1 = 0;
			$t2 = 0;
			$t3 = 0;
			/* Notas */
			if ($nota < 65) { $t3 = 1;
			}
			if (($nota >= 65) and ($nota < 90)) { $t2 = 1;
			}
			if ($nota >= 90) { $t1 = 1;
			}
			$ed = trim($line['doc_edital']);

			switch ($ed) {

				case 'PIBIC' :
					$ar1[0] = 