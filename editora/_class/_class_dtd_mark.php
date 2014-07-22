<?php
class dtd_mark
	{
		var $file;
		var $filename;
		var $conteudo;
		var $file_id;
		var $article_id;
		
		var $paragrafo = '';
		var $phase = 0;
		
		
		/* Phase I */
		var $phase_i_ordem='1';
		var $phase_i_journal_name='';
		var $phase_i_vol='27';
		var $phase_i_num='1';
		var $phase_i_data='201303';
		var $phase_i_page_i='A01';
		var $phase_i_page_f='Fisioter. Mov., Curitiba';
		var $phase_i_issn='0103-5150';	
		
		
		function cp_01()
			{
				global $dd,$acao;
				$cp = array();
				array_push($cp,array('$HV','',$dd[0],False,True));
				array_push($cp,array('$S5','','Linha',False,False));
				array_push($cp,array('$HV','',$dd[2],False,True));
				array_push($cp,array('$HV','',$dd[3],False,True));
				array_push($cp,array('$HV','',$dd[4],False,True));
				array_push($cp,array('$HV','',$dd[5],False,True));
				array_push($cp,array('$HV','',$dd[6],False,True));
				array_push($cp,array('$HV','',$dd[7],False,True));
				array_push($cp,array('$HV','',$dd[8],False,True));
				array_push($cp,array('$HV','',$dd[9],False,True));
				array_push($cp,array('$O front:front&body:body&back:referências','','Tipo',True,True));
				return($cp);
			}
		function cp_02()
			{
				global $dd,$acao;
				$cp = array();
				array_push($cp,array('$HV','',$dd[0],False,True));
				array_push($cp,array('$S5','','Linha',False,False));
				array_push($cp,array('$HV','',$dd[2],False,True));
				array_push($cp,array('$HV','',$dd[3],False,True));
				array_push($cp,array('$HV','',$dd[4],False,True));
				array_push($cp,array('$HV','',$dd[5],False,True));
				array_push($cp,array('$HV','',$dd[6],False,True));
				array_push($cp,array('$HV','',$dd[7],False,True));
				array_push($cp,array('$HV','',$dd[8],False,True));
				array_push($cp,array('$HV','',$dd[9],False,True));
				array_push($cp,array('$O titlegrp:Titulo Grupo&authgrp:Autor Grupo&bibcom:Início de Resumo','','Tipo',True,True));
				return($cp);
			}
		function cp_03()
			{
				global $dd,$acao;
				$sec = 'P:Paragrafo&SEC:Título da Seção';
				$sec .= '&introducao:introducao';
				$sec .= '&metodologia:metodologia';
				$sec .= '&materiais:materiais';
				$sec .= '&materials|methods|materials|methods';
				$sec .= '&resultado:resultado';
				$sec .= '&discussao:discussao';
				$sec .= '&conclusao:conclusao';
				$sec .= '&outros:outros';
				$sec .= '&sec:##Fim da Seção';
				$sec .= '&rastreio:rastreio de citacao';
				
				$cp = array();
				array_push($cp,array('$HV','',$dd[0],False,True));
				array_push($cp,array('$S5','','Linha',False,False));
				array_push($cp,array('$HV','',$dd[2],False,True));
				array_push($cp,array('$HV','',$dd[3],False,True));
				array_push($cp,array('$HV','',$dd[4],False,True));
				array_push($cp,array('$HV','',$dd[5],False,True));
				array_push($cp,array('$HV','',$dd[6],False,True));
				array_push($cp,array('$HV','',$dd[7],False,True));
				array_push($cp,array('$HV','',$dd[8],False,True));
				array_push($cp,array('$HV','',$dd[9],False,True));
				array_push($cp,array('$O '.$sec,'','Tipo',True,True));
				return($cp);
			}
		
		
		function save_file()
			{
				$file = $this->file;
				$txt = $this->conteudo;

				$rlt = fopen($file,'w+');
				fwrite($rlt,$txt);
				fclose($rlt);
				return(1);
			}
		
		function phase_i_insere($paragrafo)
			{
				$txt = $this->conteudo;
				for ($r=0;$r < $paragrafo;$r++)
					{
						$pos = strpos($txt,chr(13));
						$txt = substr($txt,$pos+1,strlen($txt));
					}
				$txt = $this->dtd_01().$txt.chr(13).chr(10).'<back></back>'.chr(13).chr(10).'</article>';
				$this->conteudo = $txt;
				return(1); 
			}
		function dtd_mark_tipo($tipo='')
			{
				switch ($tipo)
					{
					case 'front':
						{
							return(chr(13).chr(10).'<front>');
							break;
						}
					case 'body':
						{
							return(chr(13).chr(10).'</bibcom>'.chr(13).chr(10).'</front>'.chr(13).chr(10).'<body>'.chr(13).chr(10));
							break;
						}
					case 'back':
						{
							return(chr(13).chr(10).'</body>'.chr(13).chr(10).'<back>'.chr(13).chr(10));
							break;
						}
					default:
						echo 'NOT FOUND - '.$tipo;
						exit;
					}
			}
		function phase_insere($paragrafo,$tipo)
			{
				$txt = $this->conteudo;
				
				$txt = ' '.troca($txt,chr(13),'£');
				
				//if ($this->phase == 1)
					{
						$par = 1;
						$id = $this->file_id;
						$txts = splitx('£',$txt);
						$ttr = '';
						switch ($tipo)
							{
							case 'P': $ttt = '[p]'; $ttr = '[/p]'; break;
							case 'introducao': $ttt = '[sec sec-type="intro"][title]'; $ttr = '[/title]'; break;
							case 'metodo': $ttt = '[sec sec-type="methods"][title][title]'; $ttr = '[/title]'; break;
							case 'resultado': $ttt = '[sec sec-type="results"][title]'; $ttr = '[/title]'; break;
							case 'discussao': $ttt = '[sec sec-type="discussion"][title]'; $ttr = '[/title]'; break;
							case 'materials|methods': $ttt = '[sec sec-type="materials|methods"][title]'; $ttr = '[/title]'; break;
							case 'conclusao': $ttt = '[sec sec-type="conclusions"][title]'; $ttr = '[/title]'; break;
							case 'outros': $ttt = '[sec][title]'; $ttr = '[/title]'; break;
							case 'materiais': $ttt = '[sec sec-type="materials"][title]'; $ttr = '[/title]'; break;
							case 'sec': $ttt = ''; $ttr = '[/sec]'; break;
							case 'metodologia': $ttt = '[sec sec-type="methods"][title]'; $ttr = '[/title]'; break;
							case 'rastreio': $ttt = ''; $ttr = ''; break;
							default:
								echo 'Não localizado '.$tipo;
								exit;
							}
						
						$txts[$paragrafo] = $ttt.$txts[$paragrafo].$ttr;
					}
				$txt = '';
				for ($r=0;$r < count($txts);$r++)
					{
						$txt .= $txts[$r].chr(13).chr(10);
					}
					
				if ($tipo = 'rastreio')
					{
						$txt = $this->rastreio_citacao($txt);
					}
				$this->conteudo = $txt;
				return(1); 
			}
		function rastreio_citacao($txt)
			{
				for ($r=1;$r < 200;$r ++)
					{
						$ref = '('.$r.')';
						$nref = '[xref ref-type="bibr" rid="B'.strzero($r,3).'"]';
						if (strpos($txt,$ref) > 0)
							{
								$pos = strpos($txt,$ref);
								$txt = troca($txt,$ref,'[sup]('.$nref.$r.'[/xref])[/sup]');
							}
						$ref = '('.$r.', '.($r+1).')';
						$nref = '[xref ref-type="bibr" rid="B'.strzero($r,3).'"]';
						$nref2 = '[xref ref-type="bibr" rid="B'.strzero($r+1,3).'"]';
						if (strpos($txt,$ref) > 0)
							{
								$pos = strpos($txt,$ref);
								$txt = troca($txt,$ref,'[sup]('.$nref.$r.'[/xref], '.$nref2.($r+1).'[/xref])[/sup]');
							}
							
						$ref = '('.$r.', '.($r+1).', '.($r+2).')';
						$nref = '[xref ref-type="bibr" rid="B'.strzero($r,3).'"]';
						$nref2 = '[xref ref-type="bibr" rid="B'.strzero($r+1,3).'"]';
						$nref3 = '[xref ref-type="bibr" rid="B'.strzero($r+2,3).'"]';
						if (strpos($txt,$ref) > 0)
							{
								$pos = strpos($txt,$ref);
								$txt = troca($txt,$ref,'[sup]('.$nref.$r.'[/xref], '.$nref2.($r+1).'[/xref], '.$nref3.($r+2).'[/xref])[/sup]');
							}							
					}
				return($txt);
			}
		function checa_phase_i()
			{
				$err = '';
				$ok = 0;
				$txt = '  '.$this->conteudo;
				$t1 = splitx('[sec',$txt);
				$t2 = splitx('/sec]',$txt);

				if (count($t1) != count($t2))
					{
						$ok = -1;
						$err = 'Número de sessões abertas não corresponde as fechadas';
					}
				$this->phase = 1;
				$this->erro = $err;
				return($ok);
			}
		function checa_phase_ii()
			{
				$txt = $this->conteudo;
				/* Checa FRONT */
				if (strpos($txt,'<front>') > 0)
					{
						/* ok */
					} else {
						$ok = $ok - 2;
						$err .= 'Falta elemeto [front] - Cover sheet<BR>';
					}
				/* Checa BODY */
				if (strpos($txt,'<body>') > 0)
					{
						/* ok */
					} else {
						$ok = $ok - 4;
						$err .= 'Falta elemeto [body] - Conteúdo<BR>';
					}
				/* Checa BODY */
				if (strpos($txt,'<back>') > 0)
					{
						/* ok */
					} else {
						$ok = $ok - 8;
						$err .= 'Falta elemeto [back] - Referências<BR>';
					}
				$this->erro = $err;
				return($ok);
			}
		function checa_phase_iii()
			{
				$txt = $this->conteudo;
				/* Checa FRONT */
				if (strpos($txt,'<titlegrp>') > 0)
					{
						/* ok */
					} else {
						$ok = $ok - 2;
						$err .= 'Falta elemeto [titlegrp] - Grupo dos Título<BR>';
					}
				/* Checa BODY */
				if (strpos($txt,'<authgrp>') > 0)
					{
						/* ok */
					} else {
						$ok = $ok - 4;
						$err .= 'Falta elemeto [authgrp] - Grupo dos autores<BR>';
					}
				/* Checa BODY */
				if (strpos($txt,'<bibcom>') > 0)
					{
						/* ok */
					} else {
						$ok = $ok - 8;
						$err .= 'Falta elemeto [bibcom] - Resumo<BR>';
					}
				$this->erro = $err;
				return($ok);
			}
		function checa_phase_iv()
			{
				$txt = $this->conteudo;
				/* Checa FRONT */
				if (strpos($txt,'<title language=') > 0)
					{
						/* ok */
					} else {
						$ok = $ok - 2;
						$err .= 'Falta elemeto [title language=] - Título do artigo<BR>';
					}
				/* Checa BODY */
				if (strpos($txt,'<author role="nd" rid=') > 0)
					{
						/* ok */
					} else {
						$ok = $ok - 4;
						$err .= 'Falta elemeto [author role=nd rid=] - Identificação dos autores<BR>';
					}
				/* Checa BODY */
				if (strpos($txt,'<bibcom>') > 0)
					{
						/* ok */
					} else {
						$ok = $ok - 8;
						$err .= 'Falta elemeto [bibcom] - Resumo<BR>';
					}
				$this->erro = $err;
				return($ok);
			}		
		function dtd_01()
			{
				$sx .= '<?xml version="1.0" encoding="ISO-8859-1"?>'.chr(13).chr(10);
				$sx .= '<';
				$sx .= 'article ';
				$sx .= 'pii="nd" ';
				$sx .= 'doctopic="oa" ';
				$sx .= 'language="pt" ';
				$sx .= 'ccode="br1.1" ';
				$sx .= 'status="1" ';
				$sx .= 'version="3.1" ';
				$sx .= 'type="tab" ';
				$sx .= 'order="'.$this->phase_i_ordem.'" ';
				$sx .= 'seccode="RESP020" ';
				$sx .= 'sponsor="nd" ';
				$sx .= 'stitle="'.$this->phase_i_journal_name.'" ';
				$sx .= 'volid="'.$this->phase_i_vol.'" ';
				$sx .= 'issueno="'.$this->phase_i_num.'" ';
				$sx .= 'dateiso="'.$this->phase_i_post.'" ';
				$sx .= 'fpage="'.$this->phase_i_page_i.'" ';
				$sx .= 'lpage="'.$this->phase_i_page_f.'" ';
				$sx .= 'issn="'.$this->phase_i_issn.'"';
				$sx .= '>'.chr(13).chr(10);	
				return($sx);			
			}
		
		function elemento_01_front()
			{
				
			}
		function elemento_02_body()
			{
				
			}
		function elemento_03_back()
			{
				
			}
		function mostra_marcacao($tipo='M0')
			{
				$txt = $this->conteudo;
				$cores = array(
							   '#006000','#FF8000','#FF8080',
							   '#FF0080','#FF80FF','#FF00FF',

							   '#0000FF','#8000FF','#8080FF',
							   '#0080FF','#80FFFF','#00FFFF',

							   '#00FF00','#80FF00','#80FF80',
							   '#0080FF','#80FFFF','#00FFFF'
							);
				$cor = 0;
				
				$txt = ' '.troca($txt,chr(13),'£');
				$txt = troca($txt,'<','[');
				$txt = troca($txt,'>',']');
				$ncor = 0;
				if ($this->phase == 1)
					{
						$par = 1;
						$id = $this->file_id;
						$txts = splitx('£',$txt);
						$txt = '<UL>';
						for ($r=0;$r < count($txts);$r++)
							{
								$link = '<BR><INPUT TYPE="button"  onclick="newxy2(\'dtd_mark.php?dd0='.$id.'&dd1='.$r.'&dd2='.$tipo.'&dd3='.$this->file_table.'&dd4='.$this->file_id.'\',200,200);" 
										value="'.($r+1).'">';
								
								$tx = trim($txts[$r]);
								$sec = trim(substr($tx,0,4));
								
								if ($sec == '[sec') 
									{
										$tx = '<font color="'.$cores[$ncor].'">'.$tx;
										$ncor++;																				
									}
								$t = splitx('[/sec]',$tx);
								$ncor = $ncor - (count($t)-1);
								$tx = troca($tx,'[/sec]','[/ sec]</font>');
								
								$txt .= $link.$tx.' ['.$ncor.']';
								if ($ncor==0) { $txt .= '<HR>'; }
								$txt .= chr(13).chr(10);
							}
						$txt .= '</UL>';
					}
				$txt = troca($txt,'[BR]','<BR>');
				$sx = $txt;
				return($sx);
			}
		
		function show_button_mark($id)
			{
				$sx = '<form method="get" action="producao_dtd_mark.php">';
				$sx .= '<input type="hidden" name="dd0" value="'.$id.'">';
				$sx .= '<input type="submit" value="DTD Mark" class="submit-geral">';
				$sx .= '</form>';
				return($sx);
			}

		function show_button_reprocessar($id)
			{
				$sx = '<form method="get" action="producao_dtd_process.php">';
				$sx .= '<input type="hidden" name="dd0" value="'.$id.'">';
				$sx .= '<input type="submit" value="DTD Clear/Process Cited" class="submit-geral">';
				$sx .= '</form>';
				return($sx);
			}

		function show_button_save($id)
			{
				$sx = '<form method="get" action="producao_dtd_save.php" target="new_'.date("His").'">';
				$sx .= '<input type="hidden" name="dd0" value="'.$id.'">';
				$sx .= '<input type="submit" value="DTD Save" class="submit-geral">';
				$sx .= '</form>';
				return($sx);
			}

		function load_file($file)
			{
						$rrr = fopen($file,'r+');
						$txt = '';
						while (!(feof($rrr)))
							{ $txt .= fread($rrr,1024); }
						fclose($rrr);
						return($txt);				
			}
		function recupera_file($tabela='', $id=0)
			{
				$sql = "select * from ".$tabela." where id_doc = ".round($id);
				$rlt = db_query($sql);
				
				if ($line = db_read($rlt))
					{
						$this->file = trim($line['doc_arquivo']);
						$this->filename = trim($line['doc_filename']);
						$this->file_id = $line['id_doc'];
						$this->file_table = $ged->tabela;						
						$txt = $this->load_file($this->file);												
						$this->conteudo = $txt;
						return(1);
					}
				return(0);
			}
		function exists_dtd_file_search($protocol)
			{
				$sql = "select * from submit_files
						where doc_tipo = 'DTD' and doc_dd0 = '$protocol'
						order by id_doc desc
						limit 1
				";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$this->file = trim($line['doc_arquivo']);
						$this->filename = trim($line['doc_filename']);
						$this->file_id = $line['id_doc'];
						$this->file_table = $ged->tabela;
						
						$txt = $this->load_file($this->file);
												
						$this->conteudo = $txt;
						return(1);
					} else {
						return(0);
					}
				return(0);
			}
						
		function exists_dtd_file($ged)
			{
				$protocol = $ged->protocol;
				$sql = "select * from ".$ged->tabela."
						where doc_tipo = 'DTD' and doc_dd0 = '$protocol'
						order by id_doc desc
						limit 1
				";
				echo $sql;
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$this->file = trim($line['doc_arquivo']);
						$this->filename = trim($line['doc_filename']);
						$this->file_id = $line['id_doc'];
						$this->file_table = $ged->tabela;
						
						$txt = $this->load_file($this->file);
												
						$this->conteudo = $txt;
						return(1);
					} else {
						return(0);
					}
				return(0);
			}
			
	}
?>
