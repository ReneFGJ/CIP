<?php
class lattes
	{
		var $link;
		var $nome;
		var $cracha;
		
		var $docentes = "pibic_professor";
		var $discentes = "pibic_aluno";
		var $tabela_journal = 'lattes_journals';
		
		var $erros = '';
		
		function cp_journal()
			{
				//$sql = "delete from ".$this->tabela_journal." where j_issn like '%--%' ";
				//$rlt = db_query($sql);
				
				$cp = array();
				array_push($cp,array('$H8','id_j','',False,True));
				array_push($cp,array('$S80','j_name','Journal',True,True));
				array_push($cp,array('$S9','j_issn','ISSN',True,True));
				return($cp);
			}
		
		function row_journal()
			{
			global $cdf, $cdm, $masc;
			
			$cdf = array('id_j','j_name','j_issn','j_codigo');
			$cdm = array('Código','Nome','ISSN','Codigo');
			$masc = array('','','','');
			return('');
			}
		
		function busca_professor_cpf($cpf)
			{
				$sql = "select * from ".$this->docentes." where pp_cpf = '".$cpf."' and pp_ativo = 1";
				$rlt = db_query($sql);
				
				if ($line = db_read($rlt))
					{
						//print_r($line);
						return($line['pp_cracha']);
					}
			}
		
		function delete_records_from($ano=9999)
			{
				$sql = "delete from lattes_artigos where la_ano >= '".$ano."' "; 
				$rlt = db_query($sql);
				$line = db_read($rlt);
				return(1);			
			}
		
		function delete_file($arq)
			{
				$arq = 'tmp/'.$arq;
				echo $arq;
				if (file_exists($arq))
					{
					unlink($arq);
					echo '<BR>Arquivo excluido: '.$arq;
					return(1);
					}
				echo '<BR>ERRO!';
				return(0);
			}
		
		function next_file()
			{
				$tps = array();
				array_push($tps,'LIVRO');
				array_push($tps,'EVENT');
				array_push($tps,'LVORG');
				array_push($tps,'CAPIT');
				array_push($tps,'ARTIG');
				array_push($tps,'PROJE');
				
				$file = '';
				for ($r=0;$r < count($tps);$r++)
					{
						for ($y=0;$y < 500;$y++)
							{
								$arq = $tps[$r].'_'.strzero($y,4);
								if (file_exists('tmp/'.$arq))
									{ return($arq); } 
							}
					}
					
			}
		
		function arquivos_salva_quebrado($ln,$tipo)
			{
				$lnh = $ln[0];
				$arq = 0;
				$pos = 0; $open = 0;
				$cr = chr(13);
				
				for ($r=1;$r < count($ln);$r++)
					{
						if (($pos==0) or ($pos > 49))
							{
							if ($open==1) { fclose($farq); }
							$farq = fopen('tmp/'.$tipo.'_'.strzero($arq++,4),'w');
							echo '<BR>Salvando... '.$tipo.'_'.strzero($arq,4);
							fwrite($farq,$lnh.$cr);
							$open = 1;
							$pos = 0;
							}
						$pos++;
						fwrite($farq,$ln[$r].$cr);
					}
				if ($open==1) { fclose($farq); }
			}
		
		function tipo_obra($ln)
			{
				$tp = '';
				if (strpos($ln,'"Título do Livro";"ISBN";"Ano Publicação";') > 0) { $tp = 'LIVRO'; }
				if (strpos($ln,'"Título da Obra Publicada";"ISBN";"Ano Publicação";"') > 0) { $tp = 'LVORG'; }
				if (strpos($ln,'"Título do Trabalho";"Evento";"ISBN"') > 0) { $tp = 'EVENT'; }
				if (strpos($ln,'"Título";"ISBN";"Ano Publicação";"DSC_IDIOMA";') > 0) { $tp = 'CAPIT'; }
				
				if (strpos($ln,'"Título do Projeto";') > 0) { $tp = 'PROJE'; }
				
				if (strpos($ln,'"Tipo da Produção";"Idioma";"Ano";"Título do Artigo";') > 0) { $tp = 'ARTIG'; }
				return($tp);
			}
		
		function recupera_lattes($link)
			{
				$link = troca($link,'.jsp','.do');
				
				echo '-'.$link.'-';
				echo '<BR>Mapeando';
				echo '<UL>';
				if (substr($link,0,5) == 'http:')
					{
						echo '<LI>link ok</LI>';
						/* Valida método 1 */
						$mt = 'http://lattes.cnpq.br/';
						if (substr($mt,0,strlen($mt))==$mt)
							{
								$this->recupera_lattes_metodo_1($link);
							}
					}
				
				/* Metodo 1 */
				echo '</UL>';
			}
	function salva_foto($link,$destino='')
		{
			$sr = $this->read_link_fopen($link);
		}
	function recupera_link_foto($cnt)
		{
			$sf = 'http://servicosweb.cnpq.br/wspessoa/servletrecuperafoto';
			$pos = strpos($cnt,$sf);
			if ($pos > 0)
				{
					$link_foto = substr($cnt,$pos,200);
					$link_foto = substr($link_foto,0,strpos($link_foto,'"'));
					echo '<LI>Salvando foto '.($this->salva_foto($link_foto,''));
				} else {
					echo 'Erro no link';
				}
			return($link_foto);
		}
	function recupera_lattes_metodo_1($link)
		{
			echo '<LI>Metodo 1 - lendo com CURL '.$link.'</Li>';
			$cnt = $this->read_link_curl($link);
			/* recupera novo link */
			$sf = '<p>The document has moved <a href="';
			$link = substr($cnt,strpos($cnt,$sf)+strlen($sf),200);
			$link = substr($link,0,strpos($link,'"'));
			echo '<LI>Metodo 1 - novo link '.$link.'</Li>';
			echo '<LI>Metodo 1 - lendo com fopen '.$link.'</Li>';
			$cnt = $this->read_link_fopen($link);
			/* Curriculo */
			
			/* Link da foto */
			$foto = $this->recupera_link_foto($cnt);
			echo '<LI>Link da foto '.$foto.'</LI>';
			exit;
		}
	function read_link_curl($url)
		{
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			$contents = curl_exec($ch);
			if (curl_errno($ch)) {
  				echo curl_error($ch);
	 				echo "\n<br />";
  				$contents = '';
			} else {
	 				curl_close($ch);
			}
			if (!is_string($contents) || !strlen($contents)) {
				echo "Failed to get contents.";
				$contents = '';
			}
			if (strpos($contents,'encoding="UTF-8"') > 0)
				{
					$contents = troca($contents,'encoding="UTF-8"','encoding="ISO-8859-1"');
					$contents = utf8_decode($contents);
				}
			return($contents);				
		}		
		
	function read_link_fopen($url)
		{
			$flt = fopen($url,'r') or die("erro de link");
			$contents = '';
			while (!(feof($flt)))
				{
					$contents .= fread($flt,1024);
				}
			fclose($flt);
			return($contents);				
		}		


		function grafico_mostra($mx=array(),$div='div00',$size=300,$titulo='',$xarc='',$yarc='')
			{
				$sx = '
    				<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    				';
				$sx .= '
				<script type="text/javascript">
      				google.load("visualization", "1", {packages:["corechart"]});
      				google.setOnLoadCallback(drawChart);
      				function drawChart() {
        				var data = google.visualization.arrayToDataTable([
          				[\'Ano\', \'Quant.\'],
          			';
					for ($r=0;$r < count($mx)-1; $r++)
						{
							if ($r > 0) { $sx .= ', '.chr(13); }
							$sx .= "['".$mx[$r][0]."' , ".round($mx[$r][1])."]";
						}
          		$sx .= '
          				]);

        			var options = {		
          				title: \''.$titulo.'\',
          				hAxis: {title: \'Ano\', titleTextStyle: {color: \'red\'}}
        				};

        			var chart = new google.visualization.ColumnChart(document.getElementById(\''.$div.'\'));
        			chart.draw(data, options);
      				}
    			</script>
    			<div id="'.$div.'" style="width: '.$size.'px; height: '.round($size*.65).'px;"></div>
    			';
				return($sx);
			}		
		
		function grafico_qualis($mx=array(),$div='div00',$size=300)
			{
				$qual = array('A1','A2','B1','B2','B3','B4','B5','C');
				$sx = '
    				<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    				';
				$sx .= '
				<script type="text/javascript">
      				google.load("visualization", "1", {packages:["corechart"]});
      				google.setOnLoadCallback(drawChart);
      				function drawChart() {
        				var data = google.visualization.arrayToDataTable([
          				[\'Ano\', \'Qualis\'],
          			';
					for ($r=0;$r < count($mx)-1; $r++)
						{
							if ($r > 0) { $sx .= ', '.chr(13); }
							$sx .= "['".$qual[$r]."' , ".round($mx[$r])."]";
						}
          		$sx .= '
          				]);

        			var options = {		
          				title: \'Artigos por qualis\',
          				hAxis: {title: \'Ano\', titleTextStyle: {color: \'red\'}}
        				};

        			var chart = new google.visualization.ColumnChart(document.getElementById(\''.$div.'\'));
        			chart.draw(data, options);
      				}
    			</script>
    			<div id="'.$div.'" style="width: '.$size.'px; height: '.round($size*.65).'px;"></div>
    			';
				return($sx);
			}
		
		function indice_h($docente)
			{
				$tott = 57;
				$totc = 537;
				$idh = '15';
				if ($docente != '88888951')
					{
						$tott = 0;
						$totc = 0;
						$idh = '-';
					}
				$datac = '01/07/2012';
				$sx .= '<table class="tabela00">';
				$sx .= '<TR><TD align="center" width="40">';
				$sx .= '<font class="link">Fator H</font><BR>';
				$sx .= '<font class="lt4">';
				$sx .= $idh;
				$sx .= '<TD>';
				$sx .= 'Total trabalhos: '.($tott);
				$sx .= '<BR>Total citações: '.($totc);
				$sx .= '<BR>Atualizado: '.($datac);
				$sx .= '</table>';
				return($sx);						
			}
		
		function qualis($docente,$area)
			{
				
			}
		
		function jcr($docente)
			{
				$sql = "select 1, la_jcr as jcr from lattes_artigos 
						where la_professor = '$docente'
						and la_tipo = 'A' and la_jcr <> ''
				";
				$rlt = db_query($sql);
				$tot = 0;
				$jcr = 0;
				$min = 1000;
				$max = 0;
				while ($line = db_read($rlt))
					{
						$tot++;
						
						$jcra = round(troca('0'.$line['jcr'],',','.')*1000)/1000;
						if ($jcra < $min) { $min = $jcra; }
						if ($jcra > $max) { $max = $jcra; }
						$jcr = $jcr + $jcra;
					}
				if ($min == 1000) { $min = 0; }
				$sx = '';
				if ($tot > 0)
					{
					$jcr = $jcr / $tot;
					$sx = '<TABLE border=0 width="100%" class="tabela00">';
					$sx .= '<TR align="center">';
					$sx .= '<TD width="15%" ><font class="link">JCR (médio)</font><BR>';
					$sx .= '<font class="lt4">'.number_format($jcr,3);
					$sx .= '<TD width="15%" align="left"><NOBR>
							Artigos com JCR: ';
					$sx .= ''.number_format($tot,0);
					$sx .= '<NOBR><BR>JCR (mín): ';
					$sx .= ''.number_format($min,3);					
					$sx .= '<BR>JCR (máx):';
					$sx .= ''.number_format($max,3);	
					$sx .= '</table>';
					}
				return($sx);
			}
		
		function recupera_producao($docente,$tipo='A',$dd1=1900,$dd2=2099)
			{
				$sql = "select count(*) as total, la_ano, la_tipo from lattes_artigos 
						where la_professor = '$docente'
						and la_tipo = '$tipo'
						group by la_ano, la_tipo
						order by la_ano, la_tipo
				";
				$ar = array();
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						array_push($ar,array($line['la_ano'],$line['total']));
					}
				return($ar);
			}
		
		function row()
			{
				global $cdf,$cdm,$masc;
				$cdf = array('id_la','la_professor','la_titulo','la_tipo','la_ano');
				$cdm = array('cod',msg('nome'),msg('titulo'),msg('tipo'),msg('ano'));
				$masc = array('','','','','','','');
				return(1);				
			}		
		
		function http_lattes_site($site)
			{
				$rlt = fopen($site,'r');
				$sx = '';
				while (!(eof($rlt)))
					{
						echo '.';
						$s = fread($rlt,1024);
						echo $s;
					}
				fclose($rlt);
				echo 'FUN';
				return($sx);
			}
		function formula_equivalencia()
			{
				$ar = array('A1','A2','B1','B2','B3','B4','B5','C','NC');
				$eq = $this->equivalencia();
				$sx = 'Equiv. = ';
				for ($r=0;$r < count($eq);$r++)
					{
						if ($r > 0) { $sx .= ' + ';}
						$sx .= $ar[$r].'x'.$eq[$r]; 
					}
				return($sx);
			}
			
		function equivalencia()
			{
				return(array(1,0.85,0.7,0.5,0.2,0.1,0.05,0));
			}

		function resumo_best_productions($programa,$areas,$anoi=19000101,$anof=20990101)
			{
				$sx = '<table width="94%" class="lt0">';
				$sx .= '<TR><TH>ISSN<TH>Journal<TH>Estr.<TH>FI';
				$sql = "select *						
							from lattes_artigos
							inner join programa_pos_docentes on pdce_docente = la_professor
							inner join programa_pos on pdce_programa = pos_codigo
							inner join pibic_professor on la_professor = pp_cracha
							left join lattes_journals on j_codigo = la_periodico
							left join qualis_estrato on (j_issn = eq_issn) and (pos_avaliacao_1 = eq_area)
							
							where (((eq_estrato like 'A%')) and (la_pag <> '1'))
							and (la_ano >= '$anoi' and la_ano <= '$anof')
							and pdce_programa = '$programa'
							and la_tipo = 'A'
							order by la_ano desc, eq_estrato, la_jcr desc, la_periodico, la_vol, la_pag";
					
					$rlt = db_query($sql);
					$at = array(0, 0,0, 0,0,0,0,0, 0);
					$ar = array($at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at);
					$xissn = 'x';
					$xvol = 'x';
					$xpag = 'x';
					$xano = 'x';
					
					$ano = "X";
					while ($line = db_read($rlt))
					{
						$ref = $this->abnt_referencia($line);

						$ok = 1;
						$issn = trim($line['j_issn']);
						$vol = trim($line['la_vol']);
						$pag = round(sonumero(trim($line['la_pag'])));
						$ano = trim($line['la_ano']);
						
						if ($ano != $xano)
							{
								$sx .= '<TR><TD class="lt3" colspan=5>'.$ano;
								$xano = $ano;
							}
						
						if (($issn == $xissn) and ($vol == $xvol)
							and ($ano == $xano) and ($xpag == $pag))
							{ $ok = 0; }
						
						$xissn = trim($line['j_issn']);
						$xvol = trim($line['la_vol']);
						$xpag = round(sonumero(trim($line['la_pag'])));
						$xano = trim($line['la_ano']);
													
							
						$estrato = trim($line['eq_estrato']);
						$id = 8;
						
						$cor = '';
						if ($ok==0) { $cor = '<font color="red">'; }
						
						if ($estrato == 'A1') { $id = 0; }
						if ($estrato == 'A2') { $id = 1; }	
						
						/** Elimina duplicados */
						if ($ok==1)
							{					
								if ((round($xano) >= 2007) and (strlen($estrato) > 0))
								{
								$fi = $line['la_jcr'];
								$sx .= '<TR >';
								$sx .= '<TD><nobr>'.$cor.$line['j_issn'];
								$sx .= '<TD>'.$ref;
								$sx .= '<TD align="center">'.$line['eq_estrato'];
								$sx .= '<TD align="right">'.$line['la_jcr'];
								}
							}
					}
					$sx .= '<TR><TD colspan=7><center>';
				$sx .= '</table>';
				return($sa.$sx);				
	
			}	
					
		function abnt_referencia($line)
			{
				$ref = trim($line['ja_autores_nomes']);
				$jor = trim($line['j_name']);
				$ano = trim($line['la_ano']);
				$tit = trim($line['la_titulo']);
				$vol = trim($line['la_vol']);
				$pag = 'p. '.trim($line['la_pag']);
				if (strlen($vol) > 0) { $vol = 'v. '.$vol; }
				$referencia = $ref.'. '.$tit.'. <B>'.$jor.'</B>, '.$vol.' '.$pag.', '.$ano;
				return($referencia);
			}
		function resumo_qualis_ss_geral($tp=0,$areas='',$anoi=1900,$anof=2099)
			{
				$anos = 40;
				$sx = '<table width="94%" class="tabela00">';
				$sx .= '<TR><TH>ISSN<TH>Journal<TH><TH>Estr.<TH>Ano<TH>Vol.<TH>Pag.<TH>Autor';
				$sql = "select pp_nome, pdce_programa, j_name, eq_estrato, eq_ano, j_issn, la_ano, 
							la_periodico, la_vol, la_pag, la_professor 
							
							from lattes_artigos
							inner join programa_pos_docentes on pdce_docente = la_professor and pdce_ativo = 1
							inner join programa_pos on pdce_programa = pos_codigo
							inner join pibic_professor on la_professor = pp_cracha
							left join lattes_journals on j_codigo = la_periodico
							left join qualis_estrato on (j_issn = eq_issn) and (pos_avaliacao_1 = eq_area)
												
							group by pp_nome, pdce_programa, j_name, eq_estrato, eq_ano, j_issn, la_ano, la_periodico, la_vol, la_pag, la_professor
							order by la_ano desc, eq_estrato, la_periodico, la_vol, la_pag";
					
					$rlt = db_query($sql);
					$at = array(0, 0,0, 0,0,0,0,0, 0);
					$ar = array();
					for ($y=0;$y < 100;$y++)
						{
							array_push($ar,$at);
						}
					$xissn = 'x';
					$xvol = 'x';
					$xpag = 'x';
					$xano = 'x';
					
					while ($line = db_read($rlt))
					{
						$ano = round($line['la_ano']);
						if (($ano >= $anoi) and ($ano <= $anof))
						{
						$ref = $line['la_autores'];
						$ok = 1;
						$issn = trim($line['j_issn']);
						$vol = trim($line['la_vol']);
						$pag = round(sonumero(trim($line['la_pag'])));
						$ano = trim($line['la_ano']);
						
						if (($issn == $xissn) and ($vol == $xvol)
							and ($ano == $xano) and ($xpag == $pag))
							{ $ok = 0; }
						
						$xissn = trim($line['j_issn']);
						$xvol = trim($line['la_vol']);
						$xpag = round(sonumero(trim($line['la_pag'])));
						$xano = trim($line['la_ano']);
													
							
						$estrato = trim($line['eq_estrato']);
						$id = 8;
						
						$cor = '';
						if ($ok==0) { $cor = '<font color="red">'; }
						
						if ($estrato == 'A1') { $id = 0; }
						if ($estrato == 'A2') { $id = 1; }
						
						if ($estrato == 'B1') { $id = 2; }
						if ($estrato == 'B2') { $id = 3; }
						if ($estrato == 'B3') { $id = 4; }
						if ($estrato == 'B4') { $id = 5; }
						if ($estrato == 'B5') { $id = 6; }
						
						if ($estrato == 'C') { $id = 7; }
						
						
						/** Elimina duplicados */
						if ($ok==1)
							{
							$ano = round($line['la_ano']);
							$ano = ($ano-(date("Y"))+$anos);
							if ($ano >=0)
								{ $ar[$ano][$id] = $ar[$ano][$id] + 1; }
							}
						
						if ((round($xano) >= 1970) and (strlen($estrato) > 0))
						{
						$fi = $line['la_jcr'];
						$sx .= '<TR >';
						$sx .= '<TD class="tabela01"><NOBR>'.$cor.$line['j_issn'];
						$sx .= '<TD class="tabela01">'.$cor.$line['j_name'];
						$sx .= '<B>'.$line['j_titulo'];
						$sx .= '<TD class="tabela01">'.$cor.$line['pp_nome'];
						//$sx .= '<TD>'.$line['la_titulo'];
						$sx .= '<TD class="tabela01">'.$cor.$line['qa_descricao'];
						$sx .= '<TD class="tabela01">'.$cor.$line['eq_estrato'];
						$sx .= '<TD class="tabela01">'.$cor.$line['la_ano'];
						$sx .= '<TD class="tabela01">v. '.$line['la_vol'];
						$sx .= '<TD class="tabela01"><nobr>p. '.$line['la_pag'];
						$sx .= '<TD class="tabela01">'.$cor.$line['la_professor'];
						$sx .= '<TD class="tabela01">'.$cor.$line['pdce_programa'];
						$ln = $line;
						}
						}
					}
					$sx .= '<TR><TD colspan=7><center>';
					//print_r($ln);
					
					$sa = '<table width="100%" class="tabela00">';
					$sa .= '<TR align="center"><TH>ano<TH>A1<TH>A2<TH>B1<TH>B2<TH>B3<TH>B4<TH>B5<TH>C<TH>s.q<TH>Total';
					for ($rq=($anos + 1);$rq >= 0;$rq--)
						{
							if (count($ar[$rq]) > 0)
							{
								$tt = 0;
								$tte= 0;
								$multe = $this->equivalencia();
								$sc = '<TR><TD align="center" class="tabela01">'.(date('Y')+$rq-$anos);
								for ($y=0;$y < count($ar[$rq]);$y++)
								{
									$sc .= '<TD width="8%" align="center" class="tabela01">';
									$mt = $ar[$rq][$y];
									$tt = $tt + $mt;
									$tte = $tte + $multe[$y] * $mt;
									if ($mt == 0) { $mt = '&nbsp;'; }
									$sc .= $mt;
								}
								
								$sc .= '<TD width="8%" align="center" class="tabela01"><B>'.$tt;
								$sc .= '<TD width="8%" align="center" class="tabela01"><B>'.$tte;
								
								if ($tt > 0)
									{ $sa .= $sc; }
							}
						}
					$sa .= '</table>';
				$sx .= '</table>';
				$this->matrix = $ar;
				if ($tp==0) { return($sa.$sx); }
				if ($tp==1) { return($sa); }				
			}

		function resumo_qualis_ss_tipo_geral($tp=0,$areas='',$anoi=1900,$anof=2099,$tipo='')
			{
				$anos = 40;
				$sx = '<table width="94%" class="tabela00">';
				$sx .= '<TR><TH>Referencia';
				
				$sql = "select *
							
							from lattes_artigos
							inner join programa_pos_docentes on pdce_docente = la_professor
							inner join programa_pos on pdce_programa = pos_codigo
							inner join pibic_professor on la_professor = pp_cracha
							where la_tipo = '$tipo'							
							order by la_ano desc, la_titulo ";
					
					$rlt = db_query($sql);
					$at = 0;
					$ar = array();
					for ($y=0;$y < 100;$y++)
						{
							array_push($ar,$at);
						}
					$xref = 'x';
					
					while ($line = db_read($rlt))
					{
						$ano = round($line['la_ano']);
						if (($ano >= $anoi) and ($ano <= $anof))
							{
							$ref = $line['la_titulo'];
							$idioma = trim($line['la_idioma']);
							$ano = trim($line['la_ano']);
							$autores = trim($line['ja_autores_nomes']);
							$pag = round(sonumero(trim($line['la_pag'])));
							
							if ($ref != $xref)
								{
								$sx .= '<TR>';
								$sx .= '<TD>';
								$sx .= $autores.'. ';
								$sx .= '<B>'.$ref;
								$sx .= ', '.$ano;
							
								$xano = ($ano-(date("Y"))+$anos);
								$ar[$xano] = $ar[$xano] + 1;
								$xref = $ref;
								} 
							}
						}
	
					$sx .= '<TR><TD colspan=7><center>';
	
				$sx .= '</table>';
				$this->matrix = $ar;
				
				$st .= '<table class="tabela00" width="400">';
				$st .= '<TR><TH>Ano<TH>Quat.';
				$tot = 0;
				for ($r=0;$r < count($ar);$r++)
					{
						if ($ar[$r] > 0)
							{
							
							$st .= '<TR>';
							$st .= '<TD class="tabela01" align="center">';
							$st .= date("Y")+$r-$anos;
							$st .= '<TD class="tabela01" align="center">';
							$st .= $ar[$r];
							$tot = $tot + $ar[$r];
							}
							
					}
					$st .= '<TR><TD align="right"><B>Total';
					$st .= '<TD align="center" class="tabela01" ><B>'.$tot;
					$st .= '</table>';
					
				$this->st = $st;				

				if ($tp==0) { return($sa.$sx); }
				if ($tp==1) { return($sa); }				
			}


		function grafico_publicacao($programa='',$areas='',$anoi=1970,$anof=2999)
			{
				if ($anof < 1900) { $anof = date("Y"); }
				$sql = "select la_ano, count(*) as total from
						( select la_ano from lattes_artigos 
							inner join lattes_journals on j_codigo = la_periodico
							group by la_ano, la_periodico, la_vol, la_pag
						) as tabela01
						
						group by la_ano
						order by la_ano
				";
				$rlt = db_query($sql);
				$sa = '';
				$st = '<table class="tabela00" width="100">';
				$st .= '<TR><TH>Ano<TH>Total';
				while ($line = db_read($rlt))
					{
						$ano = round($line['la_ano']);
						if (($ano >= $anoi) and ($ano <= $anof))
							{
							$st .= '<TR><TD class="tabela01" align="center">'.$ano;
							$st .= '<TD class="tabela01" align="center">'.$line['total'];
							if (strlen($sa) > 0) { $sa .= ', '.chr(13); }
							$sa .= '["'.$line['la_ano'].'", '.$line['total'].']';
							}
					}
				$st .= '</table>';
				
				$sx = '
				    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    					<script type="text/javascript">
      						google.load("visualization", "1", {packages:["corechart"]});
      						google.setOnLoadCallback(drawChart);
      						function drawChart() {
        					var data = google.visualization.arrayToDataTable([
          					["Ano", "Artigos"],
          					'.$sa.'
        					]);
			        var options = {
          				title: \'Produção Científica na Instituição\'
        				};
		
			        var chart = new google.visualization.ColumnChart(document.getElementById(\'chart_div\'));
        			                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                nof=2999,$tp=0,$producao='A')
			{
				$ano = date("Y");
				$sx = '<table width="100%" class="tabela00">';
				$sx .= '<TR><TH>ISSN<TH>Journal<TH><TH>Estr.<TH>Ano<TH>Vol.<TH>Pag.<TH>Autor';
				for ($r=0;$r < count($areas);$r++)
				{
					$area = $areas[$r];
					$wh_areas = " and (eq_area = '".$area."' ) ";
								
					$sql = "select j_name, eq_estrato, eq_ano, j_issn, la_ano, 
							la_periodico, la_vol, la_pag, la_professor, la_tipo,
							pp_nome, la_titulo, la_nul
							
							from lattes_artigos
							inner join programa_pos_docentes on pdce_docente = la_professor
							inner join pibic_professor on pdce_docente = pp_cracha
							left join lattes_journals on j_codigo = la_periodico
							left join qualis_estrato on (j_issn = eq_issn) $wh_areas and (eq_ano = '".$ano."')";
					$wh = "	where pdce_programa = '$programa'
							and (la_ano >= '$anoi' and la_ano <= '$anof')
							and (la_tipo = '".$producao."') "; 
					$sql .= $wh . "
							group by j_name, eq_estrato, eq_ano, j_issn, la_ano, la_periodico, la_vol, la_pag, la_professor, la_tipo, pp_nome, la_titulo, la_nul
							order by la_ano desc, eq_estrato, la_periodico, la_vol, la_pag, la_professor ";
					
					$rlt = db_query($sql);
					
					$at = array(0,0,0,0,0,0,0,0,0);
					$ar = array($at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at,$at);
					$xissn = 'x';
					$xvol = 'x';
					$xpag = 'x';
					$xano = 'x';
					
					$xano = 0;
					$xest = 'x';
					
					while ($line = db_read($rlt))
					{
						$ok = 1;
						$issn = trim($line['j_issn']);
						$vol = trim($line['la_vol']);
						$pag = round(sonumero(trim($line['la_pag'])));
						$ano = trim($line['la_ano']);
						
						if (($issn == $xissn) and ($vol == $xvol)
							and ($ano == $xano) and ($xpag == $pag))
							{ $ok = 0; }
						
						$xissn = trim($line['j_issn']);
						$xvol = trim($line['la_vol']);
						$xpag = round(sonumero(trim($line['la_pag'])));
						$xano = trim($line['la_ano']);
													
							
						$estrato = trim($line['eq_estrato']);
						$id = 8;
						
						$cor = '';
						if ($ok==0) { $cor = '<font color="red">'; }
						
						if ($estrato == 'A1') { $id = 0; }
						if ($estrato == 'A2') { $id = 1; }
						
						if ($estrato == 'B1') { $id = 2; }
						if ($estrato == 'B2') { $id = 3; }
						if ($estrato == 'B3') { $id = 4; }
						if ($estrato == 'B4') { $id = 5; }
						if ($estrato == 'B5') { $id = 6; }
						
						if ($estrato == 'C') { $id = 7; }
						
						
						/** Elimina duplicados */
						if ($ok==1)
							{
							$ano = round($line['la_ano']);
							$ano = ($ano-(date("Y"))+35);
							if ($ano >=0)
								{ $ar[$ano][$id] = $ar[$ano][$id] + 1; }
							}
						
						//if (substr($line['eq_estrato'],0,1)=='A')
						{						
						if ($xano != $line['la_ano'])
							{ $sx .= '<TR><TD class="lt3" colspan=2><B>'.$line['la_ano']; $xano = $line['la_ano'].'</B>'; }

						if ($xest != $line['eq_estrato'])
							{ $sx 