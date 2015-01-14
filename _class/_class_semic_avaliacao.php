<?php
class avaliacao
	{
	var $tabela;
	
	function calcula_fator_correcao_avaliador()
		{
			$sql = "select count(*) as av, avg(pp_nota) as nota from semic_parecer_".date("Y")."
					where pp_nota > 40 ";			
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$fcm = round($line['nota']*100)/100;
			echo '<h1>FC Médio: '.$fcm.'</h1>';
				
			$sql = "select count(*) as av, pp_avaliador, avg(pp_nota) as nota from semic_parecer_".date("Y")."
					where pp_nota > 40
					group by pp_avaliador ";
					echo $sql;
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					$fc = $fcm - round($line['nota']*100)/100;
					$sql = "update pareceristas set pp_fc = $fc where us_codigo = '".$line['pp_avaliador']."'";
					$rrr = db_query($sql);
				}
			echo 'FIM';
		}
	
	function processa_notas()
		{
			$sql = "update semic_parecer_".date("Y")." set pp_trava = 0, pp_nota = 0 where pp_protocolo = 'COMUN22'";
			//$rlt = db_query($sql);
			//$wh = " and pp_protocolo = 'CCOMP39*' ";
			$sql = "select * from semic_parecer_".date("Y")." 
					where (pp_trava = 0 or pp_trava is null) 
					and pp_status = 'A' $wh limit 100";
			$rlt = db_query($sql);
			$id = 0;
			while ($line = db_read($rlt))
			{
				$id++;
				$med = $this->media($line);
				$sql = "update semic_parecer_".date("Y")." 
						set 
						pp_nota = '".$med[0]."',
						pp_best = '".$med[1]."',
						pp_trava = 1 
						where id_pp = ".$line['id_pp'];
				$xrlt = db_query($sql);						
			}
			if ($id > 0)
				{
					echo '<h2>Processado '.$id.'</h2>';
				}
		}
	
	function media($line)
		{
					$m = 0;
					$t = 0;
					$tipo = trim($line['pp_tipo']);
					echo $tipo;
					for ($r=1;$r < 10;$r++)
						{
							$id = "pp_p".strzero($r,2);
							$vl = $line[$id];
							$vl = troca($vl,',','.');
							$vl = $vl * 10;
							echo $vl;
							if (($vl > 30) and ($r != 7))
								{
									$m++;
									$t = $t + $vl;
								}
						}
					if ($m > 3)
						{
							$med = round(100*$t/$m)/100;						
						} else {
							$med = 0;
						}
					if (round($line['pp_p07'])==1) { $best = 1; }
					else { $best = 0; }
					echo '<BR>'.$id.'=[Total = '.$t.'], [Notas: '.$m.'] Média = '.$med;
					$media = (array($med,$best));
					return($media);			
		}
	
	function show_notas_final($filtro='E',$mod='O')
		{
			global $jid;
			$filtro = trim($filtro);
			//echo '====>'.$filtro;
			if ($filtro == 'Z')
				{
					$wh = " and pp_tipo = '$mod' and (article_3_keywords like 'MS%') ";
				}
			if ($filtro == 'Y')
				{
					$wh = " and pp_tipo = '$mod' and (pp_protocolo like 'PIBICjr%') ";
				}
			if ($filtro == 'E')
				{
					$wh = " and pp_tipo = '$mod' and not (pp_protocolo like 'JI%' or pp_protocolo like 'PEV%') "; 
					$wh .= " and (identify_type like '1%' or identify_type like '3%') ";
				}
			if ($filtro == 'V')
				{
					$wh = " and pp_tipo = '$mod' and not (pp_protocolo like 'JI%' or pp_protocolo like 'PEV%') "; 
					$wh .= " and (identify_type like '2%' or identify_type like '4%') ";
				}
			if ($filtro == 'A')
				{
					$wh = " and pp_tipo = '$mod' and not (pp_protocolo like 'JI%' or pp_protocolo like 'PEV%') "; 
					$wh .= " and (identify_type like '5%') ";
				}
			if ($filtro == 'S')
				{
					$wh = " and pp_tipo = '$mod' and not (pp_protocolo like 'JI%' or pp_protocolo like 'PEV%') "; 
					$wh .= " and (identify_type like '6%') ";
				}
			if ($filtro == 'H')
				{
					$wh = " and pp_tipo = '$mod' and not (pp_protocolo like 'JI%' or pp_protocolo like 'PEV%') "; 
					$wh .= " and (identify_type like '7%' or identify_type like '8%') ";
				}		 
			
			$sql = "select * from ( 
						select count(*) as avaliadores, avg(pp_nota + pp_fc) as nota, 
							avg(pp_nota) as nota2, pp_protocolo,
							pb_semic_nota as nota3, pb_semic_apresentacao,
							article_3_keywords 
						from semic_parecer_".date("Y")."
						inner join pareceristas on pp_avaliador = us_codigo
						left join articles on article_ref = pp_protocolo and journal_id = $jid 
						left join sections on article_section = section_id
						left join pibic_bolsa_contempladas on ('IC' || pb_protocolo) = article_3_keywords												
						where (pp_status = 'A') ".$wh."
						group by pp_protocolo, pb_semic_nota, pb_semic_apresentacao, article_3_keywords
						) as tabela
						order by nota desc
					";	
					
			$sql = "select * from ( 
						select count(*) as avaliadores, avg(pp_nota + pp_fc) as nota, 
							avg(pp_nota) as nota2, pp_protocolo,
							
							article_3_keywords 
						from semic_parecer_".date("Y")."
						inner join pareceristas on pp_avaliador = us_codigo
						left join articles on article_ref = pp_protocolo and journal_id = $jid 
						left join sections on article_section = section_id												
						where pp_status = 'A' ".$wh."
						group by pp_protocolo, article_3_keywords
						) as tabela
						order by nota desc
					";				
													
			$rlt = db_query($sql);
			$sx = '<table width="100%" class="tabela00">';
			$sx .= '<TR><TH>Trabalho<th>Somatória<TH>Nota<TH>Nota Original<TH>Nota Relatório<TH>Avaliação(ões)<TH>Protocolo<TH>Mod';
			while ($line = db_read($rlt))
				{
					$sx .= '<TR>';
					$sx .= '<TD align="center">'.troca($line['pp_protocolo'],'=','');
					$sx .= '<TD align="center">'.number_format($line['nota']+$line['nota3']/10,1);
					$sx .= '<TD align="center">'.number_format($line['nota'],1);
					$sx .= '<TD align="center">'.number_format($line['nota2'],1);
					$sx .= '<TD align="center">'.number_format($line['nota3']/10,1);
					$sx .= '<TD align="center">'.$line['avaliadores'];
					$sx .= '<TD align="center">'.$line['article_3_keywords'];
					$sx .= '<TD align="center">'.$this->mostra_tipo($line['pb_semic_apresentacao']);
				}
			$sx .= '</table>';
			return($sx);
		}
	function mostra_tipo($av)
		{
			switch($av)
				{
				case 'M': $tipo = 'Pibic'; break;
				case 'O': $tipo = 'CICPG'; break;
				default : $tipo = $av;
				}
			return($tipo);
		}
	function show_notas($filtro='')
		{
			global $jid;
			$this->processa_notas();
			$this->calcula_fator_correcao_avaliador();
			
			$wh = ""; 
			
			$sql = "select * from semic_parecer_".date("Y")." 
					left join articles on article_ref = pp_protocolo and journal_id = $jid 
					left join sections on article_section = section_id
					inner join pareceristas on pp_avaliador = us_codigo
					where pp_status = 'A' $wh
					order by pp_nota desc, pp_protocolo
					";
			$rlt = db_query($sql);
			$sx = '<table width="100%" class="tabela00">';
			while ($line = db_read($rlt))
				{
					$sx .= '<TR>';
					$sx .= '<TD>'.$line['pp_protocolo'];
					$sx .= '<TD>'.$line['pp_avaliador'];
					$sx .= '<TD>'.$line['pp_p01'];
					$sx .= '<TD>'.$line['pp_p02'];
					$sx .= '<TD>'.$line['pp_p03'];
					$sx .= '<TD>'.$line['pp_p04'];
					$sx .= '<TD>'.$line['pp_p05'];
					$sx .= '<TD>'.$line['pp_p06'];
					$sx .= '<TD>'.$line['pp_p07'];
					$sx .= '<TD>'.$line['pp_p08'];
					$sx .= '<TD>'.$line['pp_p09'];
					$sx .= '<TD>'.$line['pp_abe_01'];
					$sx .= '<TD>'.$line['pp_nota'];
					$sx .= '<TD>='.$line['pp_fc'];
					$sx .= '<TD>='.($line['pp_nota'] + $line['pp_fc']);
				}
			$sx .= '</table>';
			return($sx);
		}
	function show_trabalhos()	
		{
			//$sql = "alter table pibic_bolsa_contempladas add column pb_semic_apresentado char(1) ";
			//$rlt = db_query($sql);
			
			$sql = "select * from pibic_bolsa_contempladas
					left join articles on article_ref = pb_protocolo
					left join pibic_semic_avaliador_notas on article_ref = av_ref
					limit 10
			";
			$rlt = db_query($sql);
			
			while ($line = db_read($rlt))
				{
					$publicado = trim($line['article_publicado']);
					print_r($line);
					echo '<HR>';
				}
		}
	function show_avaliacoes()
		{
			return($this->show_trabalhos());
			exit;
			$sql = "select count(*) as total, av_area, av_numtrab, av_tipo_trabalho
		 		from pibic_semic_avaliador_notas 
				group by av_area, av_numtrab, av_tipo_trabalho
				order by av_area, av_numtrab, av_tipo_trabalho
			";
			$rlt = db_query($sql);
			$sx =  '<table class="tabela00">';		
			$tot = 0;
			$xtb = 'x';
			while ($line = db_read($rlt))
				{
					$trab = $line['av_area']. strzero($line['av_numtrab'],2);
					if ($trab != $xtb)
						{
						if (($tt > 0) and ($tt < 3))
							{ $sx .=  '<TD><====='; }
						$tt = 0;
						$xtb = $trab;
						$tot++;
						$sx .=  '<TR>';
						$sx .=  '<TD>';
						$sx .=  $trab; 
						}
						$sx .=  '<TD>';
						$sx .=  $line['total'];
						$sx .=  '('.$line['av_tipo_trabalho'].')';
						$tt=$tt+$line['total'];
				}
			$sx .=  'Total >>>'.$tot;
			$sx .=  '</table>';
			return($sx);
		}	
	}
?>