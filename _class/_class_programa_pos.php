<?php
class programa_pos
	{
		var $id;
		var $codigo;
		var $nome;
		var $descricao;
		var $ano_formacao;
		var $ano_encerramento;
		var $conceito;
		var $escola;
		var $mestrado;
		var $doutorado;
		var $centro;
		var $centro_codigo;
		var $area_avaliacao;
		var $area_avaliacao_codigo;
		var $coordenador;
		
		var $areas;
			
		var $tabela = 'programa_pos';
		var $tabela_nota = "programa_pos_capes";
		
		
		function programas_pos_notas_cronologico()
			{
				$sql = "select qa_descricao, count(*) as total from ".$this->tabela." 
							inner join qualis_area on qa_codigo = pos_avaliacao_1
							where (pos_mestado > 1950 or pos_mestrado_prof > 1950)
							and pos_ativo = 1
						group by qa_descricao
						order by total, qa_descricao
				";
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
				{
					echo '<HR>';
					print_r($line);
					$dados .= ', '.chr(13).chr(10).'[\''.$line['qa_descricao'].'\','.$line['total'].']';
				}
				
$sa = '
<script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load(\'visualization\', \'1\', {packages: [\'corechart\']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
          [\'�rea avalia��o\', \'Incid�nia\']
          '.$dados.'
        ]);
      
        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById(\'visualization\')).
            draw(data, {title:"�reas de Avalia��o"});
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
    <div id="visualization" style="width: 900px; height: 500px;"></div>
';				
				return($sa.$sx);
			}
		function programas_pos_entrada_discente()
			{
				$sql = "select count(*) as total, sum(orientacoes) as orientacoes, od_ano_ingresso
						, od_modalidade from (
						select count(*) as orientacoes, od_ano_ingresso, od_modalidade
							from docente_orientacao e
							where od_status <> 'X' 
							group by od_ano_ingresso, od_modalidade
							) as tabela
							group by od_ano_ingresso, od_modalidade
							order by od_ano_ingresso, od_modalidade
							";
				$rlt = db_query($sql);
				$id = 0;
				$ide = 0;
				
				$ano_start = 1900;
				$ori_ms = array();
				$ori_do = array();
				$ori_pr = array();
				$ori_po = array();
				
				for ($r=$ano_start;$r <= date("Y");$r++)
					{
						array_push($ori_ms,0);
						array_push($ori_do,0);
						array_push($ori_pr,0);
						array_push($ori_po,0);
					}
				$max  = 600;
				while ($line = db_read($rlt))
					{
						if ($line['orientacoes'] > $max) { $max = $line['orientacoes']; }
						$ano = round($line['od_ano_ingresso']);
						$modalidade = trim($line['od_modalidade']);
						if ($ano < 1990 or $ano > date("Y"))
							{
								
							} else {
							$id = $id + $line['total'];
							$ide = $ide + $line['orientacoes'];		
											
							$pos = $line['od_ano_ingresso'] - $ano_start;
							switch ($modalidade)
								{
									case 'M':
										$ori_ms[$pos] = $ori_ms[$pos] + $line['orientacoes']; 
										break;
									case 'D':
										$ori_do[$pos] = $ori_do[$pos] + $line['orientacoes'];
										break;
									case 'P':
										$ori_pr[$pos] = $ori_pr[$pos] + $line['orientacoes'];
										break;
									case 'O':
										$ori_po[$pos] = $ori_po[$pos] + $line['orientacoes'];
										break;
																		}
							}
					}
				$sx .= '<h2>Alunos de P�s-Gradua��o por Entrada nos Programas</h2>';
				$sx .= '<P>O registro � retirado das informa��es repassado pela secretaria dos programas</P>';
				$sx .= '<table width="100%">';
				for ($r = 0;$r < count($ori_ms);$r++)
					{
						$tot = $ori_ms[$r] + $ori_do[$r] + $ori_pr[$r] + $ori_po[$r];
						if ($tot > 0)
							{
								$cor1 = $this->cor($ori_ms[$r],$max);
								$cor2 = $this->cor($ori_do[$r],$max);
								$cor3 = $this->cor($ori_pr[$r],$max);
								$cor4 = $this->cor($ori_po[$r],$max);
								$sx1 .= '<TH align="center">'.($ano_start+$r);
								$sx2 .= '<Td align="center" '.$cor1.'><font color="black">'.$ori_ms[$r];
								$sx3 .= '<Td align="center" '.$cor2.'><font color="black">'.$ori_do[$r];
								$sx4 .= '<Td align="center" '.$cor3.'><font color="black">'.$ori_pr[$r];
								$sx5 .= '<Td align="center" '.$cor4.'><font color="black">'.$ori_po[$r];
								$sx6 .= '<Td align="center" ><font color="black"><B>'.$tot.'</B>';
								
							}
					}
				$sx .= '<TR><TH>Ano'.$sx1;
				$sx .= '<TR><TH align="left">Mestrado Acad�mico'.$sx2;
				$sx .= '<TR><TH align="left">Doutorado'.$sx3;
				$sx .= '<TR><TH align="left">P�s-Doutorado'.$sx4;
				$sx .= '<TR><TH align="left">Mestrado Profissional'.$sx5;
				$sx .= '<TR><TH align="left">Total geral'.$sx6;
				
				$sx .= '</table>';
				return($sx);
			}
		function cor($vlr2,$max)
			{
				$cor = ' bgcolor="#FFFFFF" ';
				if ($vlr2 > 0)
					{
						$vlr = (255-round(($vlr2 / $max) * 255));
						$vlr3 = dechex($vlr);
						$cor = ' bgcolor="#00'.$vlr3.'FF" ';
					}
				return($cor);
			}
		function programas_pos_fluxo_discente($anoi=0,$anof=0)
			{
				$sql = "select * from docente_orientacao ";
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						$ano = $line['od_ano_ingresso'];
						if ($ano > 10000)
							{
							$sql = "update docente_orientacao set od_ano_ingresso = '".substr($line['od_ano_ingresso'],0,4)."' where id_od = ".$line['id_od'];
							$rrr = db_query($sql);							
							}
					}
				$anoi = 2013;
				$anof = $anoi;
				
				/* Quadro geral */
				$sql = "select count(*) as total, sum(orientacoes) as orientacoes from (
						select count(*) as orientacoes, od_professor
							from docente_orientacao 
							where od_status <> 'X' 
							and 
								(
								(od_ano_ingresso >= ".($anoi-2)." and od_ano_ingresso <= $anof and od_modalidade = 'M')
								or
								(od_ano_ingresso >= ".($anoi-4)." and od_ano_ingresso <= $anof and od_modalidade = 'D')
								) and od_modalidade = 'D'
							group by od_professor
							) as tabela
							";
				$rlt = db_query($sql);	
				$sx .= '<table width="100%">';
				$sx .= '<TR><TH>Programa ('.$anoi.'-'.$anof.')<TH>Docentes<TH>Orienta��es';
								
				if ($line = db_read($rlt))
				{
						$sx .= '<TR bgcolor="#C0C0C0">';
						$sx .= '<TD class="tabela01"><B>Todos os programas';
						$sx .= '<TD align="center" class="tabela01"><B>'.$line['total'].'</B>';
						$sx .= '<TD align="center" class="tabela01"><B>'.$line['orientacoes'].'</B>';
				}				
				
				$sql = "select count(*) as total, sum(orientacoes) as orientacoes, od_programa, pos_nome from (
						select count(*) as orientacoes, od_professor, od_programa
							from docente_orientacao 
							where od_status <> 'X' 
							and 
								(
								(od_ano_ingresso >= ".($anoi-2)." and od_ano_ingresso <= $anof and od_modalidade = 'M')
								or
								(od_ano_ingresso >= ".($anoi-4)." and od_ano_ingresso <= $anof and od_modalidade = 'D')
								) 
							group by od_professor, od_programa
							) as tabela
							inner join programa_pos on od_programa = pos_codigo
							group by od_programa, pos_nome
							";
				$rlt = db_query($sql);

				$id = 0;
				$ide = 0;
				while ($line = db_read($rlt))
					{
						$id = $id + $line['total'];
						$ide = $ide + $line['orientacoes'];		
										
						$professor = $line['od_professor'];
						$programa = $line['pos_nome'];
						$sta = $line['od_status'];
						$ano_a1 = substr($line['od_ano_ingresso'],0,4);
						$ano_a2 = substr($line['od_ano_diplomaca'],0,4);
						
						$sx .= '<TR>';
						$sx .= '<TD class="tabela01">'.$line['pos_nome'];
						$sx .= '<TD align="center" class="tabela01">'.$line['total'];
						$sx .= '<TD align="center" class="tabela01">'.$line['orientacoes'];
					}
				$sx .= '<TR bgcolor="#C0C0C0"><TD>Total geral<TD align="center">'.$id.'<TD align="center">'.$ide;
				$sx .= '<TR><TD colspan=10 class="lt0">A diverg�ncia nos valores de todos os programas e a somat�rias dos programas, � derivada de alguns orientadores estarem vinculados a mais de um programa, registrando multiplas vezes o orientador.';
				$sx .= '</table>';
				return($sx);
			}
		
		function programas_pos_cronologico()
			{
				$sql = "select * from ".$this->tabela." 
							left join qualis_area on qa_codigo = pos_avaliacao_1
							where (pos_mestado > 1950 or pos_mestrado_prof > 1950)
							and pos_ativo = 1
						order by pos_nome
				";
				$rlt = db_query($sql);
				$msc = array();
				$dor = array();
				$pro = array();
				$ano = array();
				$ano_ini = 1990;
				for ($r=$ano_ini;$r <= date("Y");$r++)
					{
						array_push($msc,0);
						array_push($dor,0);
						array_push($pro,0);
						array_push($ano,$r);
					}
				$sx .= '<table width="100%">';
				$sx .= '<TR><TH>Programa<TH>�rea de avalia��o<TH>Mestrado Acad�mico<TH>Doutorado Acad�mico<TH>Mestrado Profissionalizante';
				$id = 0;
				$ide = 0;
				while ($line = db_read($rlt))
					{
						$id++;
						$anoi = $line['pos_abertura'];
						$anof = $line['pos_encerramento'];
						if ($anof < 1900) { $anof = date("Y"); }
						$ano_mes = $line['pos_mestado'];
						$ano_dou = $line['pos_doutorado'];
						$ano_mesp = $line['pos_mestrado_prof'];
						
						$idm = $ano_mes - $ano_ini;
						$idd = $ano_dou - $ano_ini;
						$idp = $ano_mesp - $ano_ini;
						
						$idf = $anof - $ano_ini;
						
						$sx .= '<TR><TD align="left" class="tabela01">'
								.$line['pos_nome'];
						if ($anof <> date("Y")) { $sx .= '<font color="red">(Encerrado)</font>'; $ide++; }
						$sx .= '<TD align="left" class="tabela01">'.$line['qa_descricao'];
						if ($ano_mes == 0) { $dsp = '-'; } else { $dsp = $ano_mes; }
						$sx .= '<TD align="center" class="tabela01">'.$dsp;
						if ($ano_dou == 0) { $dsp = '-'; } else { $dsp = $ano_dou; }
						$sx .= '<TD align="center" class="tabela01">'.$dsp;
						if ($ano_mesp == 0) { $dsp = '-'; } else { $dsp = $ano_mesp; }
						$sx .= '<TD align="center" class="tabela01">'.$dsp;
						$sx .= '</TR>';
						
						if ($idm > 0)
							{ for ($r=$idm; $r <= $idf;$r++) { $msc[$r] = $msc[$r] + 1; } }
						if ($idd > 0)
							{ for ($r=$idd; $r <= $idf;$r++) { $dor[$r] = $dor[$r] + 1; } }
						if ($idp > 0)
							{ for ($r=$idp; $r <= $idf;$r++) { $pro[$r] = $pro[$r] + 1; } }
					}
				$sx .= '<TR><TD colspan=10><B><I>Total de '.($id-$ide).' programas, '.$ide.' descontinuado.';
				$sx .= '</table>';
				$sx .= '<h2>Programa por ano</h2>';
				$sx .= '<table>';
				$sx .= $sa;
				$sx .= '</table>';					
				$sx .= '<table width="100%">';
				$sx .= '<TR><TH>Ano<TH>Mestrado Acad�mico<TH>Doutorado Acad�mico<TH>Mestrado Profissionalizante';
				$dados = '';
				for ($r=0;$r < count($msc);$r++)
					{
						$sx .= '<tr>';
						$sx .= '<TD align="center" class="tabela01">'.$ano[$r];
						$dsp = $msc[$r]; if ($dsp == 0) { $dsp = '-'; }
						$sx .= '<TD align="center" class="tabela01">'.$dsp;
						$dsp = $dor[$r]; if ($dsp == 0) { $dsp = '-'; }
						$sx .= '<TD align="center" class="tabela01">'.$dsp;
						$dsp = $pro[$r]; if ($dsp == 0) { $dsp = '-'; }
						$sx .= '<TD align="center" class="tabela01">'.$dsp;
						
						$dados .= ', '.chr(13).chr(10)."['".$ano[$r]."', ".$pro[$r].", ".$msc[$r].",".$dor[$r]."] ";
					}
				$sx .= '</table>';
				
$sg = '
 <script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load(\'visualization\', \'1\', {packages: [\'corechart\']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          [\'Ano\',  \'Mestrado Profissionalizante\', \'Mestrado\', \'Doutorado\']
          '.$dados.'
        ]);
      
        // Create and draw the visualization.
        var ac = new google.visualization.AreaChart(document.getElementById(\'visualization\'));
        ac.draw(data, {
          title : \'Programas de Mestrado e Doutorado (Stricto sensu)\',
          width: 900,
          height: 400,
          vAxis: {title: "Programas"},
          hAxis: {title: "Ano"}
        });
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="width: 900px; height: 400px;"></div>
  </body>
';
				
				
				
				return($sg.$sx);
			}
		
		function cp_avaliacao()
			{
				$opd = '0:N�o aplicado&1:Nota 1&2:Nota 2&3:Nota 3&4:Nota 4&5:Nota 5&6:Nota 6&7:Nota 7';
				$cp = array();
				array_push($cp,array('$H8','id_posc','',False,True));
				array_push($cp,array('$HV','',$this->tabela_nota,False,True));
				array_push($cp,array('$HV','','',False,True));
				array_push($cp,array('$Q pos_nome:pos_codigo:select * from '.$this->tabela.' where pos_corrente=\'1\' order by pos_nome','posc_programa','',False,True));
				array_push($cp,array('$[1970-'.date("Y").']','posc_ano','',False,True));
				array_push($cp,array('$HV','posc_doutorado','0',False,True));
				array_push($cp,array('$O '.$opd,'posc_mestrado','Nota do programa',False,True));
				array_push($cp,array('$H8','posc_area_avaliacao','�rea de avalia��o',False,True));
				array_push($cp,array('$O 1:Ativo&0:Exclu�do','posc_ativo','Ativo',False,True));
				
				return($cp);
			}		
		
		function situacao($tp)
			{
				$tp = trim($tp);
				switch ($tp)
					{
					case '1': $sx = 'Ativo'; break;
					case '0': $sx = 'Excluido'; break;
					case '2': $sx = 'Encerrado'; break;
					default: $sx = '??';
					}
				return($sx);
			}
		
		function rel_programas_pos_historico_notas($programa='')
			{
				global $http;
				$sql = "select * from ".$this->tabela." 
				left join qualis_area on pos_avaliacao_1 = qa_codigo
				left join ".$this->tabela_nota." on pos_codigo = posc_programa
						where pos_ativo <> 0 and pos_corrente = '1'
						order by pos_nome, posc_ano ";
				$rlt = db_query($sql);
				$sx .= '<table width="98%" class="tabela01">';
				$id = 0;
				$xpos = '';
				while ($line = db_read($rlt))
					{
						$pos = $line['pos_codigo'];
						if ($pos != $xpos)
						{
						$id++;
						$sx .= '<TR>
									<TD colspan=5>
									<h3>'.$line['pos_sigla'].' - '.trim($line['pos_nome']).'</h3>
								<TR>
									<TD>ABERTURA: '.$line['pos_abertura'].'
									<TD>SITUA��O: '.$this->situacao($line['pos_corrente']).'
									<TD colspan=3>�REA DE AVALIA��O: '.$line['qa_descricao'];
						$xpos = $pos;
						}
						
						$link = '<A HREF="programa_pos_capes_notas.php?dd0='.$line['id_posc'].'">x<img src="'.$http.'img/icone_editar.png" border=0></A>';
						$sx .= '<TR>';
						$sx .= '<TD>';
						$sx .= '<TD>';
						$sx .= '<TD class="tabela01" align="center">'.$line['posc_ano'];
						$sx .= '<TD class="tabela01" align="center">'.$line['posc_mestrado'];
						$sx .= '<TD class="tabela01" align="center">'.$link;
					}
				$sx .= '<TR><TD colspan=10><I>Total '.$id.' programas</i>';
				$sx .= '</table>';
				return($sx);
					
			}
		/*
		 * Lista os programas em uma lista e link com uma p�gina se enviada na vari�vel $link
		 */
		function lista_pos_programas($xlink='')
			{
				$sql = "select * from ".$this->tabela." 
					left join centro on pos_centro = centro_codigo
					left join qualis_area on pos_avaliacao_1 = qa_codigo
					left join pibic_professor on pp_cracha = pos_coordenador
					where pos_ativo = 1 and pos_corrente = '1'
					order by pos_nome
				";
				$rlt = db_query($sql);
				
				$sx .= '<table width="100%" class="tabela00">';
				$sx .= '<TR><TH>Programa<TH>Mestrado<TH>Nota';
				$sx .= '<TH>Doutorado<TH>Nota';
				$sx .= '<TH>�rea de avalia��o';
				$sx .= '<TH>Coordenador';
				
				while ($line = db_read($rlt))
					{
						$link = '<A href="'.$xlink.'?dd1='.$line['pos_codigo'].'&dd90='.checkpost($line['id_pos']).'" class="link">';
						$linkp = '<A href="docente.php?dd0='.$line['id_pp'].'&dd90='.checkpost($line['id_pp']).'" class="link">';
						
						$sx .= '<TR '.coluna().'>';
						$sx .= '<TD class="tabela01">'.$link.$line['pos_nome'].'</A>';
						$sx .= '<TD class="tabela01" align="center">'.$line['pos_mestado'];
						$sx .= '<TD class="tabela01" align="center"> '.$line['pos_conceito'];
						if ($line['pos_doutorado'] != 0)
							{
							$sx .= '<TD class="tabela01" align="center">'.$line['pos_doutorado'];
							$sx .= '<TD class="tabela01" align="center"> '.$line['pos_conceito'];
							} else {
								$sx .= '<TD class="tabela01"><center>- -';
								$sx .= '<TD class="tabela01"><center>- -';
							}
						$sx .= '<TD class="tabela01">'.$line['qa_descricao'];
						$sx .= '<TD class="tabela01">'.$linkp.$line['pp_nome'].'</A>';
						$ln = $line;
					}
				$sx .= '</table>';
				return($sx);				
			}

		function coordenador_do_professor($professor)
			{
			$sql = "
					select * from programa_pos_docentes
						inner join programa_pos on pdce_programa = pos_codigo
						inner join pibic_professor on pp_cracha = pos_coordenador
					where pp_cracha = '$professor'						
			 ";
			 $rlt = db_query($sql);
			 $email = array();
			 while ($line = db_read($rlt))
			 	{
			 		$email1 = trim($line['pp_email']);
					if (strlen($email1) > 0) { array_push($email,trim($email1)); }
					$email1 = trim($line['pp_email_1']);
					if (strlen($email1) > 0) { array_push($email,trim($email1)); }			 		
			 	}
			return($email);
			}
			
	function perfis_progamas()
		{
			global $perfil;
			$wh = '';
			return($wh);
		}
		
	function programas()
		{
			$sqlp = "
					select count(*) as professores, pdce_programa 
					from (
							select pdce_docente, pdce_programa 
							FROM programa_pos_docentes 
							WHERE pdce_ativo = 1 
							group by  pdce_docente, pdce_programa ) as tabela00
					group by pdce_programa
					";
					
			$sqll = "
						select posln_programa, count(*) as linhas 
						FROM programa_pos_linhas 
						WHERE posln_ativo = 1
						group by posln_programa
			";
			$sql = "select * from ".$this->tabela." 
					left join (".$sqlp.") as profs on pdce_programa = pos_codigo
					left join (".$sqll.") as linha on posln_programa = pos_codigo
					where pos_ativo = 1 and pos_corrente = 1
					order by pos_instituicao, pos_nome
					";
			$rlt = db_query($sql);
			$sx = '<table width="100%" class="tabela00">';
			$sx .= '<TR><TH>programa<TH>institui��o<TH>mestrado<TH>doutorado<TH>mestrado<BR>profissional';
			$sx .= '<TH>professores';
			$sx .= '<TH>linhas de<BR>pesquisa';
			$ID = 0;
			while ($line = db_read($rlt))
				{
				$ID++;
				$ano_mestrado = $line['pos_mestado'];
				$ano_mestrado_prof = $line['pos_mestrado_prof'];
				$ano_doutorado = $line['pos_doutorado'];
				$sx .= '<TR>';
				$sx .= '<TD class="tabela01">';
				$sx .= trim($line['pos_nome']);	

				$sx .= '<TD class="tabela01" align="center">';
				$sx .= trim($line['pos_instituicao']);

				$sx .= '<TD class="tabela01" align="center">';
				if ($ano_mestrado > 0)
					{ $sx .= $ano_mestrado; } else { $sx .= '-'; }
					
				$sx .= '<TD class="tabela01" align="center">';
				if ($ano_doutorado > 0)
					{ $sx .= $ano_doutorado; } else { $sx .= '-'; }
				$ln = $line;
				
				$sx .= '<TD class="tabela01" align="center">';
				if ($ano_mestrado_prof > 0)
					{ $sx .= $ano_mestrado_prof; } else { $sx .= '-'; }
					
				$sx .= '<TD class="tabela01" align="center">';
				$sx .= trim($line['professores']);				
								
				$sx .= '<TD class="tabela01" align="center">';
				$sx .= trim($line['linhas']);				
								
				}
			$sx .= '<TR><TD colspan=4>total '.$ID;
			$sx .= '</table>';
			return($sx);
		}

	function grafico_orientacoes($arr)
		{
			global $gr;
			$ai = array();
			array_push($ai,array(date("Y")  ,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-1,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-2,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-3,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-4,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-4,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-5,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-6,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-7,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-8,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-9,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-10,0,0,0,0,0,0,0));
			array_push($ai,array(date("Y")-11,0,0,0,0,0,0,0));
			
			$dr = 0;
			$ms = 0;
			$po = 0;	
			for ($r=0;$r < count($arr);$r++)
				{
					$line = $arr[$r];
					$edital = trim($line['od_modalidade']);
					$ano = round(substr($line['od_ano_diplomacao'],0,4));
					$ok = 0;
					$total = $line['total'];
					$status = trim($line['od_status']);

					//echo '<BR>===>'.$ano.'----'.$status;
					if ($status == 'T')
					{
						for ($y=0;$y < count($ai);$y++)
							{
								if ($ai[$y][0]==$ano)
									{
										if ($edital == 'M') { $ai[$y][1] = $ai[$y][1] +$total; }
										if ($edital == 'D') { $ai[$y][2] = $ai[$y][2] +$total; }
										if ($edital == 'P') { $ai[$y][3] = $ai[$y][3] +$total; }
									}
							}
					}
					
					/* */
					if (($status == 'C') or ($status == 'A'))
					{
						 
										if ($edital == 'M') { $ms++; }
										if ($edital == 'D') { $dr++; }
										if ($edital == 'P') { $po++; }															
					}
				}
					/* legenda */
					$hg = 12;
					$legend  = '<img src="'.http.'img/img_icone_boneco_01a.png" height="'.$hg.'" title="Mestrado">'.chr(13);
					$legend .= 'Mestrado, ';
					$legend .= '<img src="'.http.'img/img_icone_boneco_02a.png" height="'.$hg.'" title="Doutorado">'.chr(13);
					$legend .= 'Doutorado, ';
					$legend .= '<img src="'.http.'img/img_icone_boneco_03a.png" height="'.$hg.'" title="P�s-Doutorado">'.chr(13);
					$legend .= 'P�s-Doutorado';					
					
					$sx1 = '<h5>Orienta��es conclu�das</B></h5>'.$gr->grafico_bonecos($ai,'',$legend,'a');
					
					$ai = array('Em orienta��o',$ms,$dr,$po,0,0,0,0);
					array_push($ai,array('<h5>Em orienta��o</h5><TR>',$ms,$dr,$po,0,0,0,0));
					$sx2 = $gr->grafico_bonecos($ai,'orientacoes_pos','','a');
						
					return($sx2.'<HR>'.$sx1);
				}		
		
		function orientacoes_pos($cracha)
		{
			$sql = "select 1 as total, *
					from docente_orientacao
					left join programa_pos on pos_codigo =  od_programa
					where od_professor = '$cracha' and od_status <> 'X'
					";			
					//docente_orientacao
			$rlt = db_query($sql);
			$ar = array();
			while ($line = db_read($rlt))
			{
				array_push($ar,$line);
			}
			return($ar);
		}		

		function mostra_docentes_orientacoes($docente)		
			{
				$sql = "select od_programa, pos_nome  from docente_orientacao
					left join programa_pos on pos_codigo =  od_programa
					where od_professor = '$docente'
					group by od_programa, pos_nome
					";
				$rlt = db_query($sql);
				
				$sx = '<fieldset>';
				$SX .= '<H2>Orienta��es P�s-Gradua��o</h2>';
				$sx .= '<table width=740 cellpadding=2 cellspacing=4 border=0 class="tabela01">';
				$sx .= '<TR><TH colspan=9 class="lt2" align="center"><h3>'.msg('orientacoes_pos').'</h3>';
				$sx .= '<TR align="center">';
				
				$sx .= '   <TH rowspan=2>Programa de <nobr>P�s-Gradua��o</nobr>';
				$sx .= '   <TH colspan=2>Mestrado';
				$sx .= '   <TH colspan=2>Doutorado';
				$sx .= '   <TH colspan=2>P�s-Doutorado';
				
				$sx .= '   <TH colspan=2>Total de Orienta��es';
				$sx .= '<TR><TH colspan=1 class="lt0"><center>em orienta��o';
				$sx .= '    <TH colspan=1 class="lt0"><center>conclu�das';
				$sx .= '    <TH colspan=1 class="lt0"><center>em orienta��o';
				$sx .= '    <TH colspan=1 class="lt0"><center>conclu�das';
				$sx .= '    <TH colspan=1 class="lt0"><center>em orienta��o';
				$sx .= '    <TH colspan=1 class="lt0"><center>conclu�das';
				$sx .= '    <TH colspan=1 class="lt0"><center>em orienta��o';
				$sx .= '    <TH colspan=1 class="lt0"><center>conclu�das';
				$sx .= '<TR class="lt4">';				
				
				$ori=0;
				$dr = '';
				$ms = '';
				$po = '';
				
				while ($line = db_read($rlt))
					{
						$ori++;
						$programa = $line['od_programa'];
						$sx .= '<TR><TD class="tabela00" height="30"><B>'.trim($line['pos_nome']).'</B>';
						$sr = $this->mostra_docentes_orientacoes_detalhe($docente,$programa);
						$sx .= $sr[0];
						$sx .= chr(13).chr(10);
					}
				
				if ($ori == 0)
					{
						$sx .= '<TR><TD colspan=10><center>'.msg('not_found');
					}
				//$sx .= '<TR><TD colspan=10 class="lt0">Equival�ncia de orienta��es = ';
				//$sx .= '2x(n�mero de doutorados) + (n�mero de mestrados)'; 
				$sx .= '</table>';	
				$sx .= '</fieldset>';	
				return($sx);				
			}

		function mostra_docentes_orientacoes_detalhe($docente,$programa)
			{
				$sql = "select * from docente_orientacao 
					left join pibic_aluno on od_aluno = pa_cracha
					left join programa_pos on od_programa = pos_codigo
					where od_professor = '$docente' 
					";
				if (strlen($programa) > 0) { $sql .= " and od_programa = '$programa' "; }
				
				$sql .= " order by od_status, od_ano_ingresso desc, od_modalidade ";
				$rlt = db_query($sql);
				
				$sx1 .= '<FIELDSET>';
				$sx1 .= '<h2>Rela��o de Orientandos</h2>';
				$sx1 .= '<table width=100% border=0 class="tabela00">';
				$sx1 .= '<TR>';
				$sx1 .= '<TH width="10%">Modalidade';
				$sx1 .= '<TH width="70%">Estudante';				
				$sx1 .= '<TH width="5%">Ingresso';
				$sx1 .= '<TH width="5%">Egresso';
				$sx1 .= '<TH width="5%">Situa��o';
			
				$atm = 0;
				$atd = 0;
				$atp = 0;
				$atma = 0;
				$atda = 0;
				$atdp = 0;	
				
				$dr = '';
				$ms = '';
				$po = '';			
				while ($line = db_read($rlt))
					{
						$oda = $line['od_modalidade'];
						if ($oda == 'D') { $oda = 'Doutorado'; }
						if ($oda == 'M') { $oda = 'Mestrado'; }
						if ($oda == 'P') { $oda = 'P�s-Doutorado'; }
						
						
						$sxa = '<TR >';
						$sxa .= '<TD class="tabela01">'.$oda;
						$sxa .= '<TD class="tabela01">'.$line['pa_nome'];
						$sxa .= '('.trim($line['pa_cracha']).')';
						$sxa .= '<TD class="tabela01" class="center">'.substr($line['od_ano_ingresso'],0,4);
						$anof = trim(substr($line['od_ano_diplomacao'],0,4)); 
						
						$stx = trim($line['od_status']);
						if ($anof=='0') { $anof = '-'; }
						$sxa .= '<TD class="tabela01" align="center">'.$anof;
						//$sx1 .= '<TD class="tabela01">'.$line['od_modalidade'];
						//$sx1 .= '<TD class="tabela01">'.$line['od_status'];
						if ($stx == 'C') { $stx = 'Cursando'; }
						if ($stx == 'T') { $stx = 'T�tulado'; }
						if ($stx == 'R') { $stx = 'Trancado'; }
						$sxa .= '<TD>'.$stx;
						
						
						if ($line['od_status'] == 'C')
							{
								if (trim($line['od_modalidade'])=='D') { $atda++; }
								if (trim($line['od_modalidade'])=='M') { $atma++; }
								if (trim($line['od_modalidade'])=='P') { $atdp++; }
							}
						if ($line['od_status'] == 'T')
							{
								if (trim($line['od_modalidade'])=='D') { $atd++; }
								if (trim($line['od_modalidade'])=='M') { $atm++; }
								if (trim($line['od_modalidade'])=='P') { $atp++; }
							}
						if (trim($line['od_modalidade'])=='D') { $dr .= $sxa; }
						if (trim($line['od_modalidade'])=='M') { $ms .= $sxa; }
						if (trim($line['od_modalidade'])=='P') { $po .= $sxa; }
						
					}
				if (strlen($ms) > 0)
					{ $sx1 .= '<TR><TD colspan=6><B>Mestrado</B>'.$ms;}
				if (strlen($dr) > 0)
					{ $sx1 .= '<TR><TD colspan=6><B>Doutorado</B>'.$dr;}
				if (strlen($po) > 0)
					{ $sx1 .= '<TR><TD colspan=6><B>P�s-Doutorados</B>'.$po;}

				$sx1 .= '</table>';
				$sx1 .= '</fieldset>';
				/* Calculo de equivalencia de orienta��o */
				//$eqa = 2*$atdp + 2*$atda + $atma;
				//$eqc = 2*$atp  + 2*$atd  + $atm;
				$eqa = $atdp + $atda + $atma;
				$eqc = $atp  + $atd  + $atm;
				
 				if ($atdp == 0) { $atdp = '-'; }
				if ($atp == 0)  { $atp = '-'; }
				if ($atda == 0) { $atda = '-'; }
				if ($atd == 0)  { $atd = '-'; }
				if ($atma == 0) { $atma = '-'; }
				if ($atm == 0)  { $atm = '-'; }
				if ($eqa == 0)  { $eqa = '-'; }
				if ($eqc == 0)  { $eqc = '-'; }				
				
/*				$sx =  '	<TD align="center" width="10%"><center>'.$atdp;
				$sx .= '    <TD align="center" width="10%"><center>'.$atp;
				$sx .=  '	<TD align="center" width="10%"><center>'.$atda;
				$sx .= '    <TD align="center" width="10%"><center>'.$atd;
				$sx .= '    <TD align="center" width="10%"><center>'.$atma;
				$sx .= '    <TD align="center" width="10%"><center>'.$atm;				
				$sx .= '    <TD align="center" width="10%"><center>'.$eqa;
				$sx .= '    <TD align="center" width="10%"><center>'.$eqc;												
  
 */
				$sx = '';
				$sx .= '    <TD align="center" width="10%" class="tabela01"><center>'.$atma;
				$sx .= '    <TD align="center" width="10%" class="tabela01"><center>'.$atm;				
				$sx .= '	<TD align="center" width="10%" class="tabela01"><center>'.$atda;
				$sx .= '    <TD align="center" width="10%" class="tabela01"><center>'.$atd;
				$sx .= '	<TD align="center" width="10%" class="tabela01"><center>'.$atdp;
				$sx .= '    <TD align="center" width="10%" class="tabela01"><center>'.$atp;
				$sx .= '    <TD align="center" width="10%" class="tabela01"><center>'.$eqa;
				$sx .= '    <TD align="center" width="10%" class="tabela01"><center>'.$eqc;												
 				return(array($sx,$sx1));
			}		
		
		function mostra_row_orientandor_oritando($line)
			{
				$sx .= '<TR '.coluna().'>';
				$sx .= '<TD>'.$line['pp_nome'];
				$sx .= '('.trim($line['od_professor']).')';
				$sx .= '<TD>'.$line['pa_nome'];
				$sx .= '('.trim($line['pa_cracha']).')';
				$sx .= '<TD>'.$line['od_ano_ingresso'];
				if ($line['od_status'] == 'T')
					{
					$sx .= '<TD align="center">'.$line['od_ano_diplomacao'];
					} else {
					$sx .= '<TD align="center">-';
					}
				$sx .= '<TD>'.$line['od_modalidade'];
				
				if ($line['od_status'] == 'T')
					{
						$sx .= '<TD align="center">';
						$sx .= ($line['od_ano_diplomacao']-$line['od_ano_ingresso']);
					}
				return($sx);
			}

		function discentes_cpf($programa='',$professor='',$anoi=1999,$anof=2099)
			{
				if (strlen($professor))
					{ $wh = ''; }
					
				$anoi .= '0000';
				$anof .= '9999';
				$sql = "select * from docente_orientacao 
					left join pibic_aluno on od_aluno = pa_cracha
					left join pibic_professor on od_professor = pp_cracha
					where od_programa = '$programa'
					$wh
					and 
						(
							(od_ano_ingresso >= $anoi and od_ano_ingresso <= $anof)
							or
							(od_ano_diplomacao >= $anoi and od_ano_diplomacao <= $anof)
						)
					order by od_modalidade, od_ano_ingresso, pp_nome
					";
				
				$rlt = db_query($sql);
				$sx .= '<DIV style="text-align: left"><TT>';
				$tot = 0;
				while ($line = db_read($rlt))
					{
						$tot++;
						$sx .= '<BR>'.sonumero($line['pa_cpf']).' '.$line['pa_nome'];
						$sx .= ' '.$line['od_ano_ingresso'];
						$sx .= ' '.$line['od_ano_diplomacao'];
					}
				$sx .= '<BR>Total de '.$tot;
				$sx .= '</div>';
				return($sx);
				
			}
			
		function orientacoes_docente($programa='',$professor='',$ano_i=1999,$ano_f=2099)
			{
				
				$sql = "select * from docente_orientacao 
					left join pibic_aluno on od_aluno = pa_cracha
					left join pibic_professor on od_professor = pp_cracha
					where od_programa = '$programa'
					$wh
					and 
						(
							(od_ano_ingresso >= 2000)
							or
							(od_ano_diplomacao >= 2000)
						)
					order by od_professor, od_ano_ingresso, pp_nome
					";
				$rlt = db_query($sql);
				
				$totp = 0;
				$totda = 0;
				$totdc = 0;
				$totma = 0;
				$totmc = 0;
				
				while ($line = db_read($rlt))
					{
						$anoi = $line['od_ano_ingresso'];
						$anof = $line['od_ano_diplomacao'];						
						$mod = $line['od_modalidade'];
						$sta = $line['od_status'];
						echo '<BR>-->';
						echo $line['od_professor'].' '.$mod.' '.$sta;
						
						if ($sta == 'C')
							{
								if (($anoi >= $ano_i) and ($anoi <= $ano_f))
								{
									if ($mod == 'D') { $totda++; } 
									if ($mod == 'M') { $totma++; }
								}								
							}
							
						if ($sta == 'T')
							{
								if (($anof >= $ano_i) and ($anof <= $ano_f))
								{
									if ($mod == 'D') { $totdc++; } 
									if ($mod == 'M') { $totmc++; }
								}								
							}							
					}
					echo '<BR>==>'.$totda.'-'.$totdc;
					echo '<BR>==>'.$totma.'-'.$totmc;
				
			}
		
		function orientacoes($programa='',$professor='',$ano_i=1999,$ano_f=2099)
			{
				if (strlen($professor))
					{ $wh = ''; }
					
				$sql = "select * from docente_orientacao 
					left join pibic_aluno on od_aluno = pa_cracha
					left join pibic_professor on od_professor = pp_cracha
					where od_programa = '$programa'
					$wh
					and 
						(
							(od_ano_ingresso >= $ano_i)
							or
							(od_ano_diplomacao >= $ano_i)
						)
					order by od_modalidade, od_ano_ingresso, pp_nome
					";
				echo $sql;
				$rlt = db_query($sql);
				
				$a1 = array();
				$a2 = array();
				$a3 = array();
				$a4 = array();
				$a5 = array();
				$a6 = array();
				$a7 = array();
				$anoinicial = 1990;
				for ($r=$ano_i;$r <= (date("Y")+4);$r++)
					{
						array_push($a1,$r);
						array_push($a2,0);
						array_push($a3,0);
						array_push($a4,0);
						array_push($a5,0);
						array_push($a6,0);
						array_push($a7,0);							
					}
				$scur = '';
				$stit = '';
				
				while ($line = db_read($rlt))
					{
						$status = trim($line['od_status']);
						$anoi = $line['od_ano_ingresso'];
						$anof = $line['od_ano_diplomacao'];
						$modalidade = $line['od_modalidade'];
						$pos = $anoi-$ano_i;
						if ($modalidade=='M') { $pos2 = $anoi+2; }
						if ($modalidade=='M') { $pos2 = $anoi+4; }
						echo '<BR>'.$anoi.'-'.$anof.'-'.$status.'-'.$modalidade.'==>'.$pos;
						$ct = 0;
						if ($anof > $anoi) { $ct=1; }
						if ($status == '2') { $ct=1; }
						if ($ct==0) { $a2[$pos] = $a2[$pos] +1; } 
						if ($ct==1) { $a3[$pos] = $a3[$pos] +1; }
					}
				$sx = '<table width="790" class="lt1" align="center">';
				$sx .= '<TR><TH width="10%">Ano';
				$sx .= '<TH width="10%">Doutorado (entrada)';
				$sx .= '<TH width="10%">Doutorado (egresso)';
				$sx .= '<TH width="10%">Doutorado (desistente)';
				$sx .= '<TH width="10%">Mestrado (entrada)';
				$sx .= '<TH width="10%">Mestrado (egresso)';
				$sx .= '<TH width="10%">Mestrado (desistente)';
				
				for ($r=0;$r < count($a1);$r++)
					{
						if ((($a2[$r] + $a3[$r] + $a4[$r] + $a5[$r]) > 0) and ($a1[$r] >= $ano_i) and ($a1[$r] <= $ano_f))
						{
						$sx .= '<TR>';
						$sx .= '<TD>'.$a1[$r];
						$sx .= '<TD align="center">'.$a2[$r];
						$sx .= '<TD align="center">'.$a3[$r];
						$sx .= '<TD align="center">'.$a6[$r];
						$sx .= '<TD align="center">'.$a4[$r];
						$sx .= '<TD align="center">'.$a5[$r];
						$sx .= '<TD align="center">'.$a7[$r];
						//$sx .= '<TD align="center">'.$a6[$r];
						//$sx .= '<TD align="center">'.$a7[$r];
						}						
					}
				$sx .= '</table>';


				$sx .= '<table width="100%" class="lt0">';
				$sx .= '<TR><TD colspan=10 class="lt3"><center>Orienta��es em andamento';
				$sx .= '<TR><TH width="40%">Orientador<TH width="40%">Discente<TH width="7%">Entrada<TH width="7%">Sa�da<TH width="7%">Modalidade';
				$sx .= $scur;
				$sx .= '</table>';
				
				$sx .= '<BR><BR>';
				$sx .= '<BR><BR>';
				
				$sx .= '<table width="100%" class="lt0">';
				$sx .= '<TR><TD colspan=10 class="lt3"><center>Orienta��es conclu�das';
				$sx .= '<TR><TH width="40%">Orientador<TH width="40%">Discente<TH width="7%">Entrada<TH width="7%">Sa�da<TH width="7%">Modalidade';
				$sx .= $stit;
				$sx .= '</table>';
				
				return($sx);
			}
		
		function resume()
			{
				$sql = "select * from ".$this->tabela." 
					left join centro on pos_centro = centro_codigo
					left join qualis_area on pos_avaliacao_1 = qa_codigo
					left join pibic_professor on pp_cracha = pos_coordenador
					where pos_ativo = 1 and pos_corrente = '1'
					order by pos_nome
				";
				$rlt = db_query($sql);
				
				while ($line = db_read($rlt))
					{
						$link = '<A href="pos_graduacao_1_sel.php?dd0='.$line['id_pos'].'&dd90='.checkpost($line['id_pos']).'" class="link">';
						$linkp = '<A href="docente.php?dd0='.$line['id_pp'].'&dd90='.checkpost($line['id_pp']).'" class="link">';
						
						$sx .= '<TR '.coluna().'>';
						$sx .= '<TD>'.$link.$line['pos_nome'].'</A>';
						$sx .= '<TD align="center">'.$line['pos_mestado'];
						$sx .= '<TD align="center"> '.$line['pos_conceito'];
						if ($line['pos_doutorado'] != 0)
							{
							$sx .= '<TD align="center">'.$line['pos_doutorado'];
							$sx .= '<TD align="center"> '.$line['pos_conceito'];
							} else {
								$sx .= '<TD><center>- -';
								$sx .= '<TD><center>- -';
							}
						$sx .= '<TD>'.$line['qa_descricao'];
						$sx .= '<TD>'.$linkp.$line['pp_nome'].'</A>';
						$ln = $line;
					}
				
				if (strlen($sx) > 0)
					{
						$sa = '<table width="98%" class="lt1">';
						$sa .= '<TR><TH>Programa';
						$sa .= '<TH>Mestrado';
						$sa .= '<TH>Nota';
						$sa .= '<TH>Doutorado';
						$sa .= '<TH>Nota';
						$sa .= '<TH>�rea de avalia��o CAPES';
						$sa .= '<TH>Coordenador';
						$sa .= $sx;
						$sa .= '</table>';
					}
				return($sa);
					
			}
		
		function cp_docente()
			{			
				$sql = "select * from programa_pos_linhas
						 inner join programa_pos on pos_codigo = posln_programa
						order by pos_nome, posln_descricao ";
				$rlt = db_query($sql);
				$opl .= '';
				while ($line = db_read($rlt))
					{
						$opl .= '&'.trim($line['posln_codigo']).':'.trim($line['pos_nome']).'-'.trim($line['posln_descricao']);
					}
				
				$this->tabela = 'programa_pos_docentes';
				$cp = array();
				array_push($cp,array('$H8','id_pdce','id',False,true));
//				array_push($cp,array('$QA pp_nome:pp_cracha:select * from docentes where pp_ss = \'S\' and pp_ativo = 1 order by pp_nome','pdce_docente',msg('docente'),True,true));
				array_push($cp,array('$QA pp_nome:pp_cracha:select * from docentes where pp_ativo = 1 order by pp_nome','pdce_docente',msg('docente'),True,true));
				array_push($cp,array('$H8','pdce_programa','',true,true));
				array_push($cp,array('$O P:Permanente&V:Visitante&C:Colaborador','pdce_tipo',msg('pos_participacao'),true,true));
				array_push($cp,array('$O : '.$opl,'pdce_programa_linha',msg('programa_linha'),true,true));
				array_push($cp,array('$I8','pdce_ano_entrada',msg('ano_entrada'),true,true));
				array_push($cp,array('$I8','pdce_ano_saida',msg('ano_saida'),true,true));
				array_push($cp,array('$O 1:SIM&0:N�O&-1:Cancelado','pdce_ativo',msg('ativo'),true,true));
				array_push($cp,array('$[0-44]','pdce_c_hora',msg('carga_horaria_pos'),true,true));
				return($cp);
			}
		
		function cp()
			{
				//$sql = "ALTER TABLE ".$this->tabela." add column pos_sigla char(10)";
				//$rlt = db_query($sql);
				$cp = array();
				$opa = '&1:ano indefinido';
				for ($r=1950;$r<=date("Y");$r++)
					{$opa .= '&'.$r.':'.$r; }
				array_push($cp,array('$H8','id_pos','id',False,true));
				array_push($cp,array('$H5','pos_codigo',msg('codigo'),False,true));
				array_push($cp,array('$S100','pos_nome',msg('nome'),true,true));
				array_push($cp,array('$S10','pos_sigla',msg('sigla'),true,true));
				array_push($cp,array('$S10','pos_instituicao',msg('instituicao'),true,true));

				array_push($cp,array('$T80:6','pos_descricao',msg('descricao'),False,true));

				array_push($cp,array('$Q pp_nome:pp_cracha:select * from pibic_professor where pp_ss = \'S\' and pp_ativo = 1 order by pp_nome','pos_coordenador',msg('coordenador_programa'),true,true));


				array_push($cp,array('$O 1:SIM&0:N�O','pos_ativo',msg('ativo'),true,true));

				array_push($cp,array('$Q centro_nome:centro_codigo:select * from centro where centro_ativo=1 order by centro_nome','pos_centro',msg('escola'),False,true));
				array_push($cp,array('$Q campus_nome:campus_codigo:select * from campus where campus_ativo=1 order by campus_nome','pos_campus',msg('campus'),False,true));
				
				array_push($cp,array('$O 0:N�O'.$opa,'pos_mestado',msg('mestrado'),true,true));
				array_push($cp,array('$O 0:N�O'.$opa,'pos_mestrado_prof',msg('mestrado_profissional'),true,true));
				array_push($cp,array('$O 0:N�O'.$opa,'pos_doutorado',msg('doutorado'),true,true));
				
				array_push($cp,array('$O 0:N�O&1:SIM','pos_corrente',msg('corrente'),true,true));

				array_push($cp,array('$[1-7]','pos_conceito',msg('conceito_nota'),true,true));
				array_push($cp,array('$I8','pos_abertura',msg('abertura_ano'),true,true));
				array_push($cp,array('$I8','pos_encerramento',msg('encerramento_ano'),true,true));
				
				
				array_push($cp,array('${','',msg('area_avaliacao'),False,true));
				array_push($cp,array('$Q qa_descricao:qa_codigo:select * from qualis_area order by qa_descricao','pos_avaliacao_1',msg('avaliacao_capes'),true,true));
				array_push($cp,array('$Q qa_descricao:qa_codigo:select * from qualis_area order by qa_descricao','pos_avaliacao_2',msg('avaliacao_alternativa'),true,true));
				array_push($cp,array('$Q qa_descricao:qa_codigo:select * from qualis_area order by qa_descricao','pos_avaliacao_3',msg('avaliacao_alternativa'),true,true));
				
				array_push($cp,array('$}','','',False,true));
				
				$sql = "select * from usuario_perfil where usp_codigo like '#SP%'";
				array_push($cp,array('$Q usp_descricao:usp_codigo:'.$sql,'pos_secretaria_peril',msg('secretaria_gestora'),false,true));
				
				return($cp);
			}

		function row()
			{
				global $cdf,$cdm,$masc;
				$cdf = array('id_pos','pos_nome','pos_instituicao','pos_corrente','pos_codigo','pos_mestado','pos_doutorado','pos_campus','pos_ativo');
				$cdm = array('cod',msg('nome'),msg('instituicao'),msg('corrente'),msg('codigo'),msg('mestrado'),msg('doutorado'),msg('campus'),msg('ativo'));
				$masc = array('','','','SN','','','','','','');
				return(1);				
			}	

		function le($id='')
			{
				if (strlen($id) > 0) { $this->id = $id; }
				$sql = "select * from ".$this->tabela." 
					left join centro on pos_centro = centro_codigo
					left join pibic_professor on pp_cracha = pos_coordenador
					left join qualis_area on pos_avaliacao_1 = qa_codigo   
					where id_pos = ".sonumero($this->id);
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$this->id = $line['id_pos'];
						$this->codigo = $line['pos_codigo'];
						$this->nome = $line['pos_nome'];
						$this->escola = $line['pos_centro'];
						$this->ano_encerramento = $line['pos_encerramento'];
						$this->ano_formacao = $line['pos_abertura'];
						$this->conceito = $line['pos_conceito'];
						$this->mestrado = $line['pos_mestado'];
						$this->doutorado = $line['pos_doutorado'];
						$this->centro = $line['centro_nome'];
						$this->centro_codigo = $line['centro_codigo'];
						$this->area_avaliacao = $line['qa_descricao'];
						$this->area_avaliacao_codigo = $line['qa_codigo'];
						$this->coordenador = trim($line['pp_nome']).' ('.trim($line['pp_cracha']).')';
					}
				return(1);
			}	
		
		function mostra()
			{
				global $messa;

				$modalidade = '';
				$ano_formacao = $this->ano_formacao;
				$ano_encerramento = $this->ano_encerramento;
				$mestrado = $this->mestrado;
				$doutorado = $this->doutorado;
				$coornador_nome = $this->coordenador;
				
				if ($mestrado > 0) { $modalidade .= 'M'; $nts = 'MS'; }
				if ($doutorado > 0) { $modalidade .= '/D'; $nts = 'DR'; }
				
				$nts = trim($this->conceito).$nts;
				
				if ($mestrado == 0) { $mestrado = msg('not'); }
				if ($mestrado == 1) { $mestrado = msg('ativo'); }
				if ($mestrado > 1900) { $mestrado = msg('ativo').' '.msg('desde').' '.$mestrado; }
				
				if ($doutorado == 0) { $doutorado = msg('not'); }
				if ($doutorado == 1) { $doutorado = msg('ativo'); }
				if ($doutorado > 1900) { $doutorado = msg('ativo').' '.msg('desde').' '.$doutorado; }

				if ($ano_formacao == '0') { $ano_formacao = msg('not_definid'); }
				if ($ano_encerramento == '0') { $ano_encerramento = msg('active'); }
				
				$img_nota = '<img src="'.http.'img/icone_conceito_'.$nts.'.png" width="100">';
				
				$sx .= '<fieldset><legend>'.msg('programa_pos').'</legend>';
				$sx .= '<table width="100%" class=lt0 >';
				$sx .= '<TR class="lt0"><TD colspan=4 >'.msg('nome');
				$sx .= '<TD rowspan=10 width="40">'.$img_nota;
				$sx .= '<TR><TD class="lt2" colspan=4 ><B>'.$this->nome;
				
				$sx .= '<TR class="lt0">';
				$sx .= '<TD>'.msg('ano_formacao');
				$sx .= '<TD>'.msg('ano_encerramento');
				$sx .= '<TD>'.msg('conceito');
				$sx .= '<TD>'.msg('modalidade');
				
				$sx .= '<TR class="lt0">';
				$sx .= '<TD><B>'.$ano_formacao;
				$sx .= '<TD><B>'.$ano_encerramento;
				$sx .= '<TD><B>'.$this->conceito;
				$sx .= '<TD><B>'.$modalidade;
				
				$sx .= '<TR class="lt0">';
				$sx .= '<TD colspan=2>'.msg('mestrado');
				$sx .= '<TD colspan=2>'.msg('doutorado');
				
				$sx .= '<TR class="lt1">';
				$sx .= '<TD colspan=2><B>'.$mestrado;
				$sx .= '<TD colspan=2><B>'.$doutorado;
				
				$sx .= '<TR class="lt0"><TD colspan=2 >'.msg('centro');
				$sx .= '<TD colspan=2 >'.msg('area_avaliacao');
				$sx .= '<TR><TD class="lt1" colspan=2 ><B>'.$this->centro;
				$sx .= '<TD colspan=2 ><B>'.$this->area_avaliacao;
				
				$sx .= '<TR class="lt0">';
				$sx .= '<TD colspan=3>'.msg('coordenador');
				
				$sx .= '<TR class="lt1">';
				$sx .= '<TD colspan=3><B>'.$this->coordenador;


				$sx .= '</table>';
				$sx .= '</fieldset>';
				return($sx);
			}

		function participacao($tp)
			{
				if ($tp=='P') { return('Permanente'); }
				if ($tp=='V') { return('Visitante'); }
				if ($tp=='C') { return('Colaborador'); }
				return('??'.$tp);
			}
			
			
		function mostra_docente_programa($docente)
			{
			global $nivel,$include;
			$areas = array();
			
			$sql = "select * from ".$this->tabela."_docentes
				inner join ".$this->tabela." on pdce_programa = pos_codigo 
				inner join programa_pos_linhas on pdce_programa_linha = posln_codigo
				left join docentes on pdce_docente = pp_cracha  
				 where pdce_docente = '".$docente."'
				 and pdce_ativo = 1
				order by pdce_ano_saida, pp_nome ";
			$rlt = db_query($sql);

			$sx .= '<fieldset>';
			$sx .= '<h2>Linha de Pesquisa</h2>';
			$sx .= '<table width=100% cellpadding=2 cellspacing=2 border=0 class="tabela01" >';
			$sx .= '<TR>';
			$sx .= '<TH width="5%">Institui��o';
			$sx .= '<TH width="40%">Programa de P�s-Gradua��o';
			$sx .= '<TH width="40%">Linha de Pesquisa';
			$sx .= '<TH width="80%">Participa��o';
			$sx .= '<TH width="10%">Entrada';
			$sx .= '<TH width="10%">Sa�da';
			
			if ($nivel >= 5)
				{
					$sx .= '<TH>'.msg('acao');
					$site = "'programa_pos_ed_popup.php'";
					$link = '<A href="#" onclick="newxy2('.$site.',600,400);"><img src="'.$include.'img/icone_editar.gif" border=0></A>'; 
					$sx .= $link;
				}
			$idx = 0;
			while ($line = db_read($rlt))
				{
					array_push($areas,trim($line['pos_avaliacao_1']));
					$idx++;
					$sx .= '<TR '.coluna().'>';
					$sx .= '<TD class="tabela01"><B>'.$line['pos_instituicao'].'</B>';
					$sx .= '<TD class="tabela01" height="30"><B>'.$line['pos_nome'].'</B>';
					$sx .= '<TD class="tabela01">'.trim($line['posln_descricao']);
					$sx .= '<TD class="tabela01">'.$this->participacao($line['posln_participacao']);
					$ano_entrada = round($line['pdce_ano_entrada']);
					if ($ano_entrada == 0)
						{ $ano_entrada = 'N�o definido'; }
					$sx .= '<TD class="tabela01"><nobr>'.$ano_entrada;
					
					$ano_saida = round($line['pdce_ano_saida']);
					if ($ano_saida == 0)
						{ $ano_saida = 'Atual'; }
					$sx .= '<TD class="tabela01"><nobr>'.$ano_saida;
					if ($nivel >= 5) 
						{
						$site = "'programa_pos_ed_popup.php?dd0=".$line['id_pos'].'&dd90='.checkpost($line['id_pos'])."'";
						$link = '<A href="#" onclick="newxy2('.$site.',600,400);"><img src="'.$include.'img/icone_editar.gif" border=0></A>'; 
						$sx .= '<TD class="tabela01">'.$link;
						}
				}
			$sx .= '</table>';
			$sx .= '</fieldset>';
			$this->areas = $areas;
			if ($idx == 0) { $sx = ''; }
			return($sx);
			}

		function produtividade()
		{
			$pd = array(0 =>' ',
						1 => '--',
						2 => 'N�vel PQ 1A',
						3 => 'N�vel PQ 1B',
						4 => 'N�vel PQ 1C',
						5 => 'N�vel PQ 1D',
						6 => 'N�vel PQ 2',

						12 => 'N�vel DT 1A',
						13 => 'N�vel DT 1B',
						14 => 'N�vel DT 1C',
						15 => 'N�vel DT 1D',
						16 => 'N�vel DT 2'
						);
			return($pd);
			}

		function mostra_programa_docentes($programa_pos)
			{
			global $nivel,$include;
			$produtividade = $this->produtividade();
			$nivel = 5;
			$sql = "select * from ".$this->tabela."_docentes
				left join programa_pos_linhas on pdce_programa_linha = posln_codigo
				left join pibic_professor on pdce_docente = pp_cracha  
				 where pdce_programa = '".$programa_pos."'
				 and pdce_ativo = 1
				order by pp_nome ";
			$rlt = db_query($sql);
			
			$sx .= '<table width=98% cellpadding=2 cellspacing=0 border=0 class=lt0 align="center" >';
			
			$sx .= '<TR><TD colspan=5 align="center" class="lt2">'.msg('corpo docente');
			$sx .= '<TR>';
			$sx .= '<TH>id';
			$sx .= '<TH width="70%">'.msg('docente');
			$sx .= '<TH width="10%">'.msg('cpf');
			$sx .= '<TH width="10%">'.msg('produtividade');
			$sx .= '<TH width="10%">'.msg('participacao');
			$sx .= '<TH width="10%">'.msg('carga_horaria');
			//$sx .= '<TH width="5%">'.msg('ano_entrada');
			//$sx .= '<TH width="5%">'.msg('ano_saida');
			
			$idx = 0;
			$linha = '';
			$xprof = 'x';
			$totc = 0;
			$totp = 0;
			$totv = 0;
			while ($line = db_read($rlt))
				{
					$link = '<A HREF="'.http.'cip/docente.php?dd0='.$line['id_pp'].'&dd90='.checkpost($line['id_pp']).'" target="new'.checkpost($line['id_pp']).'">';
					$prof = trim($line['pp_cracha']);
					if ($xprof != $prof)
					{
						$idx++;
						$sx .= '<TR '.coluna().'>';
						$sx .= '<TD align=center width="1%" >'.$idx;
						$sx .= '<TD class="lt2">'.$link.$line['pp_nome'];
						
						$font = '<font color="black">';
						$xcpf = trim($line['pp_cpf']);
						$xcpf = strzero($xcpf,11);
						$cpf = cpf($xcpf);
						if ($cpf != 1) { $font = '<font color="red">'; }
						$sx .= '<TD class="lt2">'.$font.$xcpf.'</font>';
						$sx .= '<TD align="left">'.$produtividade[$line['pp_prod']];
						$sx .= '<TD>'.$this->participacao($line['pdce_tipo']);
						$sx .= '<TD align="center">'.round($line['pdce_c_hora']).'h';
						//$sx .= '<TD align="center">'.$line['pdce_ano_entrada'];
						//$sx .= '<TD align="center">'.$line['pdce_ano_saida'];
						switch (trim($line['pdce_tipo']))
							{
								case 'P': $totp++; break;
								case 'C': $totc++; break;
								case 'V': $totv++; break;

							}
					}
					$xprof = $prof;
				}
				$sx .= '<TR><TD colspan=6 class="lt0">Total de '.$totp.' professor(es) permanente(s) e '.$totc.' colaborador(s) e '.$totv.' visitante(s)';
				$sx .= '</table>';
			return($sx);
			}

		function mostra_docentes()
			{
			global $nivel,$include;
			//$sql = "ALTER TABLE programa_pos_linhas DROP COLUMN pdce_programa_linha";
			//$rlt = db_query($sql);
			$produtividade = $this->produtividade();
			$nivel = 5;
			$sql = "select * from ".$this->tabela."_docentes
				left join programa_pos_linhas on pdce_programa_linha = posln_codigo
				left join pibic_professor on pdce_docente = pp_cracha  
				 where pdce_programa = '".$this->codigo."'
				 and pdce_ativo = 1
				order by posln_descricao, pdce_ano_saida, pp_nome ";
				
			$rlt = db_query($sql);
			
			$sx .= '<fieldset>';
			$sx .= '<h2>Linhas de Pesquisa</h2>';
			$sx .= '<table width=100% cellpadding=2 cellspacing=0 border=0 class=lt0 >';
			$sx .= '<TR>';
			$sx .= '<TH>id';
			$sx .= '<TH width="80%">'.msg('docente');
			$sx .= '<TH width="80%">'.msg('produtividade');
			$sx .= '<TH width="10%">'.msg('ano_entrada');
			$sx .= '<TH width="10%">'.msg('ano_saida');
			$sx .= '<TH width="10%">'.msg('tipo');
			
			if ($nivel >= 5)
				{
					$sx .= '<TH>'.msg('acao');
					$site = "'programa_pos_ed_popup.php?dd2=".$this->codigo."'";
					$link = '<A href="#" onclick="newxy2('.$site.',600,400);"><img src="'.$include.'img/icone_editar.gif" border=0></A>'; 
					$sx .= $link;
				}
			$idx = 0;
			$linha = '';
			while ($line = db_read($rlt))
				{
					$lin = $line['posln_codigo'];
					if ($linha != $lin)
						{
							$sx .= '<TR class="lt3"><TD colspan=5 align="center">';
							$sx .= msg('linha').': <B>';
							$sx .= $line['posln_descricao'];
							$linha = $lin;
						}
					$idx++;
					$sx .= '<TR '.coluna().'>';
					$sx .= '<TD align=center width="1%" >'.$idx;
					$sx .= '<TD class="lt2">'.$line['pp_nome'];
					$sx .= '<TD align="left">'.$produtividade[$line['pp_prod']];
					$sx .= '<TD>'.$line['pdce_ano_entrada'];
					$sx .= '<TD>'.$line['pdce_ano_saida'];
					$sx .= '<TD>'.$line['pdce_tipo'];
					if ($nivel >= 5) 
						{
						$site = "'programa_pos_ed_popup.php?dd0=".$line['id_pdce'].'&dd90='.checkpost($line['id_pdce'])."'";
						$link = '<A href="#" onclick="newxy2('.$site.',700,400);"><img src="'.$include.'img/icone_editar.gif" border=0></A>'; 
						$sx .= '<TD>'.$link;
						}
				}
			$sx .= '</table>';
			$sx .= '</fieldset>';
			return($sx);
			}
			
		function structure()
			{
				$sql = "CREATE TABLE programa_pos_capes (
					id_posc SERIAL NOT NULL ,
					posc_programa CHAR( 5 ),
					posc_ano CHAR( 4 ),
					posc_mestrado CHAR( 1 ),
					posc_doutorado CHAR( 1 ),
					posc_area_avaliacao CHAR( 7 ),
					posc_ativo int default 1					
					)";
			$rlt = db_query($sql);
			exit;				
				$sql = "CREATE TABLE programa_pos (
					id_pos SERIAL NOT NULL ,
					pos_codigo CHAR( 5 ) NOT NULL ,
					pos_nome CHAR( 80 ) NOT NULL ,
					pos_ativo INT NOT NULL ,
					pos_centro CHAR( 5 ) NOT NULL ,
					pos_campus CHAR( 5 ) NOT NULL ,
					pos_descricao TEXT NOT NULL ,
					pos_abertura INT NOT NULL ,
					pos_encerramento INT NOT NULL ,
					pos_conceito INT NOT NULL ,
					pos_mestado INT NOT NULL ,
					pos_avaliacao_1 char (5) ,
					pos_avaliacao_2 char (5) ,
					pos_avaliacao_3 char (5) ,
					pos_doutorado INT NOT NULL,
					pos_coordenador char(8),
					pos_corrente CHAR( 1 )
					)";
			$rlt = db_query($sql);
			
			$sql = "CREATE TABLE programa_pos_docentes (
				id_pdce SERIAL NOT NULL ,
				pdce_docente CHAR( 8 ) NOT NULL ,
				pdce_programa CHAR( 5 ) NOT NULL ,
				pdce_ano_entrada INT NOT NULL ,
				pdce_tipo char (1),
				pdce_c_hora INT NOT NULL,
				pdce_ano_saida INT NOT NULL ,
				pdce_ativo INT NOT NULL )";
			$rlt = db_query($sql);
				
			return(1);
			}
		function updatex()
			{
					global $base;
				$c = 'pos';
				$c1 = 'id_'.$c;
				$c2 = $c.'_codigo';
				$c3 = 5;
				$sql = "update ".$this->tabela." set $c2 = lpad($c1,$c3,0) where $c2='' ";
				if ($base=='pgsql') { $sql = "update ".$this->tabela." set $c2 = trim(to_char(id_".$c.",'".strzero(0,$c3)."')) where $c2='' "; }
				$rlt = db_query($sql);
			}			
	}
