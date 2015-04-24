<?

class importa_docente {
	var $curso;
	
	
	function atualiza_novos_professores()
		{
			$sql = "select ch_cracha, pp_cracha, ch_nome
				    from docente_ch 
						left join pibic_professor on pp_cracha = ch_cracha
					where pp_cracha is null	
					group by ch_cracha, pp_cracha, ch_nome						
					";
			$rlt = db_query($sql);
			$id = 0;
			while ($line = db_read($rlt))
				{
					
					$nome = trim($line['ch_nome']);
					$nome_asc = trim(UpperCaseSql($line['ch_nome']));
					$cracha = trim($line['ch_cracha']);

					$sql = "select * from pibic_professor where pp_cracha = '$cracha' ";
					$xrlt = db_query($sql);
					
					if ($xline = db_read($xrlt))
						{
							echo '<BR>Já cadastrado '.$nome;
						} else {
							$sql = "insert into pibic_professor 
									(
									pp_nome, pp_nome_asc, pp_cracha
									) values (
									'$nome','$nome_asc','$cracha'
									)							
							";
							echo '<BR>Cadastrado '.$nome;
							$qrlt = db_query($sql);							
						}
					$id++;
				}
			echo 'Total de '.$id.' novos professores cadastrados';
		}
	function atualiza_carga_horaria()
		{
			$sql = "update pibic_professor set pp_carga_semanal = 0 where 1=1 ";
			$rlt = db_query($sql);
			
			$sql = "select sum(ch_hr_total) as total, ch_cracha,
						curso_codigo, curso_nome, ch_titulacao,
						sum(ch_hr_pos) as pos, ch_escola, ch_campus 
						from docente_ch 
						inner join curso on curso_codigo = ch_curso
						group by ch_cracha, curso_codigo, curso_nome, 
						ch_titulacao, ch_escola, ch_campus
						";
			$rlt = db_query($sql);
			
			$sqli = '';
			$id = 0;
			while ($line = db_read($rlt))
			{
				$id++;
				$pos = $line['ch_hr_pos'];
				$cq = '';
				if ($pos > 0) { $cq = " , pp_pos = 'S' ";}
				
				$sqli .= "update pibic_professor set 
								pp_carga_semanal = ".$line['total'].",
								pp_curso = '".$line['curso_nome']."',
								pp_curso_cod = '".$line['curso_codigo']."',
								
								pp_centro = '".$line['ch_campus']."',
								pp_escola = '".$line['ch_escola']."',
								
								pp_titulacao = '".$line['ch_titulacao']."',
								pp_update = '".date("Y")."' 
								$cq
							where pp_cracha = '".$line['ch_cracha']."'; "
							.chr(13).chr(10);
			}
			echo '<font class="lt3">Atualizado '.$id.' registros</font>';
			
			if (strlen($sqli) > 0)
				{
					$rlt = db_query($sqli);
				}
			return('');
		}

	function deleta_registros() {
		echo '<BR>Excluíndo registro';
		$sql = "delete from docente_ch where 1=1 ";
		$rlt = db_query($sql);
	}

	function salva_registro($t) {

		//$this->structure();
		//exit;
		$t = troca($t, chr(15), '');
		while (strpos($t, '  ')) { $t = troca($t, '  ', ' ');
		}
		$t = troca($t, '; ;', ';;');
		$t = troca($t, '; ;', ';;');
		while (strpos($t, ';;')) { $t = troca($t, ';;', ';0;');
		}
		/* Linha para processamento */
		//echo '<HR>' . $t . '<HR>';
		$d = splitx(';', $t);

		/* dados */
		$data = date("Ymd");
		$nome = $d[0];
		$nome = troca($nome,"'","´");
		$cracha_lng = $d[1];
		$cracha = substr($d[1], 3, 8);
		$titulacao = $this -> busca_codigo_titulacao($d[7]);
		$regime = $this -> busca_codigo_regime_de_trabalho($d[8]);
		$campus = $this -> busca_codigo_campus($d[5]);
		//$curso = $this -> busca_codigo_curso($d[8]);
		$escola = $this -> busca_codigo_escola($d[6]);
		$nivel = substr($d[13], 0, 1);
		
		$id = 10;
		$h1 = round($d[$id]);
		$h2 = round($d[$id+1]);
		$h3 = round($d[$id+2]);
		$h4 = round($d[$id+3]);
		$h5 = round($d[$id+4]);
		$h6 = round($d[$id+5]);
		$h7 = round($d[$id+6]);
		$h8 = round($d[$id+7]);
		$h9 = round($d[$id+8]);
		$h10 = round($d[$id+9]);
		$h11 = round($d[$id+10]);
		$h12 = round($d[$id+11]);

		$sqli .= "insert into docente_ch 
		(
		ch_cracha_long, ch_cracha, ch_titulacao,
		ch_regime, ch_escola, ch_curso, 
		ch_nivel, ch_campus, ch_nome,
		
		ch_hr_adm, ch_hr_compl, ch_hr_matice, 
		ch_hr_direcao, ch_hr_exe_jud, ch_hr_letiva, 
		ch_hr_licenca, ch_hr_pos, ch_hr_otcc, 
		ch_hr_perman, ch_hr_perman_de, ch_hr_total, 
		ch_ativo, ch_update
		) values (
		'$cracha_lng','$cracha','$titulacao',
		'$regime','$escola','$curso',
		'$nivel', '$campus', '$nome',	
			
		$h1, $h2, $h3,
		$h4, $h5, $h6,
		$h7, $h8, $h9,
		$h10,$h11,$h12,
		1,$data
		);
	";
	return ($sqli);
	}

	function arquivos_salva_quebrado($ln, $tipo) {
		$lnh = $ln[0];
		$arq = 0;
		$pos = 0;
		$open = 0;
		$cr = chr(13) . chr(10);

		for ($r = 1; $r < count($ln); $r++) {
			if (($pos == 0) or ($pos > 499)) {
				if ($open == 1) { fclose($farq);
				}
				$farq = fopen('tmp/' . $tipo . '_' . strzero($arq++, 4), 'w');
				echo '<BR>Salvando... ' . $tipo . '_' . strzero($arq, 4);
				fwrite($farq, $lnh . $cr);
				$open = 1;
				$pos = 0;
			}
			$pos++;
			fwrite($farq, $ln[$r] . $cr);
		}
		if ($open == 1) { fclose($farq);
		}
	}

	function structure() {
		$sql = "drop table  docente_ch";
		$rlt = db_query($sql);
		
		$sql = "create table docente_ch
				(
				id_ch serial NOT NULL,
				ch_nome char(90),
				ch_cracha_long char(12),
				ch_cracha char(8),
				ch_titulacao char(3),
				ch_regime char(2),
				ch_escola char(5),
				ch_campus char(20),
				ch_curso char(5),
				ch_nivel char(1),
				ch_hr_adm int2,
				ch_hr_compl int2,
				ch_hr_matice int2,
				ch_hr_direcao int2,
				ch_hr_exe_jud int2,
				ch_hr_letiva int2,
				ch_hr_licenca int2,
				ch_hr_pos int2,
				ch_hr_otcc int2,
				ch_hr_perman int2,
				ch_hr_perman_de int2,
				ch_hr_total int2,
				ch_update int8,
				ch_ativo int2
				)
				";
		$rlt = db_query($sql);
		return (1);
	}

	function tabela_de_cursos() {
		$sql = "select * from curso where curso_ativo = 1 order by curso_nome ";
		$rlt = db_query($sql);
		$curso = array();
		while ($line = db_read($rlt)) {
			$key = trim($line['curso_nome']);
			$rem = trim($line['curso_codigo_use']);
			$val = trim($line['curso_codigo']);
			if (strlen($rem) > 0) { $val = $rem;
			}

			if (strlen($key) > 0) {
				$curso[$key] = $val;
			}
		}
		$this -> curso = $curso;
	}

	function busca_codigo_curso($t) {
		$t = UpperCaseSql($t);
		if (strpos($t, '(')) {$t = trim(substr($t, 0, strpos($t, '(')));
		}

		$curso = $this -> curso;
		$cod = $curso[$t];
		if (strlen($cod) == 0) {
			echo "Ops, Curso não localizado " . $t;
			exit ;
		}
		echo $t . '-' . $cod . '<BR>';
		return ($cod);
	}

	function busca_codigo_campus($t) {
		$t = trim($t);
		switch ($t) {
			case 'Londrina' :
				$r = 'PUC LONDRINA';
				break;
			case 'Curitiba' :
				$r = 'PUC CURITIBA';
				break;
			case 'São José dos Pinhais' :
				$r = 'PUC SJP';
				break;
			case 'Toledo' :
				$r = 'PUC TOLEDO';
				break;
			case 'Maringá' :
				$r = 'PUC MARINGA';
				break;
		}
		return ($t);
	}

	function busca_codigo_escola($t) {
		$t = trim($t);
		switch ($t) {
			case 'Nutrição' :
				$r = '00010';
				break;			
			case 'Saúde e Biociências' :
				$r = '00010';
				break;
			case 'Ciências Agrárias e Medicina Veterinária' :
				$r = '00002';
				break;
			case 'Ciências Agrárias e Med. Veterinária' :
				$r = '00002';
				break;
			case 'Arquitetura e Design' :
				$r = '00001';
				break;
			case 'Comunicação e Artes' :
				$r = '00004';
				break;
			case 'Direito' :
				$r = '00005';
				break;
			case 'Educação e Humanidades' :
				$r = '00006';
				break;
			case 'Medicina' :
				$r = '00007';
				break;
			case 'Negócios' :
				$r = '00008';
				break;
			case 'Politécnica' :
				$r = '00009';
				break;
			default :
				echo 'OPs, Escola não localizada: ' . $t;
				exit ;
		}
		return ($r);
	}

	function busca_codigo_regime_de_trabalho($t) {
		$t = trim($t);
		switch($t) {
			case 'Horista' :
				$r = 'HR';
				break;
			case 'TI' :
				$r = 'TI';
				break;
			case 'TP' :
				$r = 'TP';
				break;
			default :
				echo 'OPs, (regime de trabalho) não localizado ' . $t;
				exit ;
		}
		return ($r);
	}

	function busca_codigo_titulacao($t) {
		$t = trim($t);
		switch ($t) {
			case 'Mestre' :
				$r = '001';
				break;
			case 'Especialista' :
				$r = '005';
				break;
			case 'Doutor' :
				$r = '002';
				break;
			case 'Residência Médica' :
				$r = '010';
				break;
			case 'Graduado' :
				$r = '009';
				break;
			default :
				echo 'OPs, não localizado titulacao' . $t;
				exit ;
		}
		return ($r);
	}

}
?>