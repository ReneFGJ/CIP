<?php
class manuscript
	{
	var $tabela = "submit_documento";
	var $tabela_autor = 'submit_autor';
	var $tabela_autor_trabalho = 'submit_documento_autor';

	var $protocolo;
	
	var $journal;
	var $author_codigo;
	
	var $line;
	
		var $author_nome;
		var $author_email;
		var $author_email_alt;
		var $author_codigo;
		
		function enviar_para_avaliacao()
			{
				global $pb;
				$this->le($this->protocolo);
				$this->comunicar_editor();
				$this->comunicar_author();
				$this->status_alterar($this->protocolo,'A');
				$_SESSION['protocol_submit'] = '';
				echo '<BR><BR><BR><CENTER><font style="font-size:30px; color: green">'.msg('submissao_finalizada').'</font>';
				echo '<BR><BR><BR><BR><BR>';
				echo '</div>';
				echo $pb->foot();
				exit;
			}
			
		function cab_email()
			{
				global $pb,$admin_nome,$email_adm,$ic,$http;
				$admin_nome = $pb->title;
				$email_adm = $pb->email;
								
				$img = $http.'../public/'.$pb->jid.'/images/homeHeaderLogoImage.jpg';
				$img = '<img src="'.$img.'"><BR>'.$texto;
				return($img);
				
			}
		function comunicar_author()
			{
				global $pb,$admin_nome,$email_adm,$ic,$http;
				
				$email = $pb->line['sa_email'].';'.$pb->line['sa_email_alt'].';';
				$emails = splitx(';',$email);
				array_push($emails,'renefgj@gmail.com');
				
				$titulo = 'Comprovante de submissão - '.$this->protocolo;
				$tit = $this->line['doc_titulo'];
				$res = $this->line['doc_resumo'];
				
				$texto = 'Protocolo:'.$this->protocolo.'<BR><BR>';
				$texto .= '<B><font style="font-size: 18px">'.$tit.'</font></B><BR><BR><I>Resumo:</I><BR>'.$res;
				$texto .= '<BR><BR>Para acessar o sistema, entre em '.$http.'editora';
				$texto .= '<BR><BR><BR>';
				
				/* */
				$texto = $this->cab_email().$texto;
				
				for ($r=0;$r < count($emails);$r++)
					{
						$email = $emails[$r];
						enviaremail($email,'',$titulo,$texto);	
					}
				return(1);
			}
		function comunicar_editor()
			{	
				global $pb,$admin_nome,$email_adm,$ic,$http;
				$email = $pb->email.';';
				$emails = splitx(';',$email);
				array_push($emails,'renefgj@gmail.com');
				
				$titulo = 'Submissão de trabalho - '.$this->protocolo;
				$tit = $this->line['doc_titulo'];
				$res = $this->line['doc_resumo'];
				
				$texto = 'Protocolo:'.$this->protocolo.'<BR><BR>';
				$texto .= '<B><font style="font-size: 18px">'.$tit.'</font></B><BR><BR><I>Resumo:</I><BR>'.$res;
				$texto .= '<BR><BR>Para acessar o sistema, entre em '.$http.'editora';
				$texto .= '<BR><BR><BR>';
				
				/* */
				$texto = $this->cab_email().$texto;
				
				for ($r=0;$r < count($emails);$r++)
					{
						$email = $emails[$r];
						enviaremail($email,'',$titulo,$texto);		
					}
				return(1);
			}
		function status_alterar($protocolo,$status)
			{
				$sql = "update ".$this->tabela." set doc_status = 'A'
						where doc_protocolo = '".$protocolo."' or id_doc = ".round($protocolo);
				$rlt = db_query($sql);
				return(1);
				
			}
		function manuscript_cancel($id)
			{
				$sql = "update ".$this->tabela." set doc_status = 'X' 
						where id_doc = ".round($id)." 
						and doc_autor_principal = '".$this->author_codigo."' ";
				$rlt = db_query($sql);
				return(1);
			}
		
		function resume()
			{
				global $link,$jid;
				$jidr = strzero($jid,7);
				$sql = "select count(*) as total, doc_status from ".$this->tabela." 
					where doc_autor_principal = '".$this->author_codigo."' 
					and doc_journal_id = '$jidr'
					group by doc_status ";
				
				$rlt = db_query($sql);
				$res = array(0,0,0,0,0,0,0,0,0,0);
				$linkx = array('','','','','','','','','','','');
				
				if (strlen($link) > 0)
					{
						$page = $link.'&dd99=manuscript_resume';
					} else {
						$page = 'submit_resume.php?SUB=1';
					}
				
				while ($line = db_read($rlt))
					{
						$total = $line['total'];
						$sta = trim($line['doc_status']);
						if ($sta == '@') { $res[0] = $res[0] + $total; $linkx[0] = '<A href="'.$page.'&dd1=@" class="linkG">'; }
						if ($sta == 'A') { $res[1] = $res[1] + $total; $linkx[1] = '<A href="'.$page.'&dd1=A" class="linkG">';  }
						if ($sta == 'N') { $res[4] = $res[4] + $total; $linkx[4] = '<A href="'.$page.'&dd1=N" class="linkG">';  }
						if ($sta == 'X') { $res[6] = $res[6] + $total; $linkx[6] = '<A href="'.$page.'&dd1=X" class="linkG">';  }
						if ($sta == 'L') { $res[3] = $res[3] + $total; $linkx[3] = '<A href="'.$page.'&dd1=L" class="linkG">';  }
						if ($sta == 'A') { $res[1] = $res[1] + $total; $linkx[1] = '<A href="'.$page.'&dd1=A" class="linkG">';  }
						if ($sta == 'B') { $res[2] = $res[2] + $total; $linkx[2] = '<A href="'.$page.'&dd1=B" class="linkG">';  }
						if ($sta == 'Z') { $res[5] = $res[5] + $total; $linkx[5] = '<A href="'.$page.'&dd1=Z" class="linkG">';  }
					}
				
				$cols = 5;
				if ($res[3] > 0)
					{ $cols++; }
				$size = round(100/$cols);
				$sx .= '<table class="subm_resume" width="100%" cellpadding=2 cellspacing=4 border=0>';
				$sx .= '<TR class="subm_resume_th">';
				$sx .= '<TH width="'.$size.'" align="center">'.msg('in_submission');
				$sx .= '<TH width="'.$size.'" align="center">'.msg('submitted');
				$sx .= '<TH width="'.$size.'" align="center">'.msg('in_analysis');
				if ($res[3] > 0) { $sx .= '<TH width="'.$size.'" align="center">'.msg('need_corrections'); }
				$sx .= '<TH width="'.$size.'" align="center">'.msg('not_approved');
				$sx .= '<TH width="'.$size.'" align="center">'.msg('approved');
				if ($res[6] > 0) { $sx .= '<TH width="'.$size.'" align="center">'.msg('canceled'); }				
				
				$sx .= '<TR align="center" class="lt6">';
				$sx .= '<TD>'.$linkx[0].$this->mostra_total($res[0]).'</A>';
				$sx .= '<TD>'.$linkx[1].$this->mostra_total($res[1]).'</A>';
				$sx .= '<TD>'.$linkx[2].$this->mostra_total($res[2]).'</A>';
				if ($res[3] > 0) { $sx .= '<TD>'.$linkx[3].$this->mostra_total($res[3]).'</A>'; }
				$sx .= '<TD>'.$linkx[4].$this->mostra_total($res[4]).'</A>';
				$sx .= '<TD>'.$linkx[5].$this->mostra_total($res[5]).'</A>';
				if ($res[6] > 0) { $sx .= '<TD>'.$link[6].$this->mostra_total($res[6]).'</A>'; }
				
				$tot = $res[0]+$res[1]+$res[2]+$res[3]+$res[4]+$res[5]+$res[6];
				if ($tot > 0) { $sx .= '<TR><TD colspan=8 class="lt0">'.msg('click_to_view'); }
				
				$sx .= '</table>';
				return($sx);
			}
		
		function resume_list($status = '')
			{
				global $jid;
				$jidr = strzero($jid,7);
				$sql = "select * from ".$this->tabela." 
					inner join journals on doc_journal_id = jnl_codigo
					where doc_autor_principal = '".$this->author_codigo."'
					and doc_journal_id = '$jidr'
					and doc_status = '$status' order by doc_data desc ";
					$rlt = db_query($sql);
					
					$sx = '<table width="100%" cellspacing=0 cellpadding=3 class="subm_table">';
					while ($line = db_read($rlt))
						{
							$sx .= $this->submit_detalhe($line);
						}
					$sx .= '</table>';
					return($sx);
			}

		function submit_detalhe($line)
			{
				global $path;
				$sta = $this->status();
				if (strlen($path) > 0)
					{
						$link = http.'pb/index.php/'.$path;
						$link = '<A HREF="'.$link.'?dd0='.$line['id_doc'].'&dd99=manuscript_detalhes&dd90='.checkpost($line['id_doc']).'">';
					} else {
						$link = page();
						$link = troca($link,'.php','_detalhes.').'php';
						$link = '<A HREF="'.$link.'?dd0='.$line['id_doc'].'&dd90='.checkpost($line['id_doc']).'">';
					}
				
				$sx .= '<TR>';
				$sx .= '<TD rowspan=2 width="60" >';
				$path = trim($line['path']);
				$file = http."editora/img_edicao/capa_$path.png";
				$title = trim($line['doc_1_titulo']);
				if (strlen($title)==0) { $title = msg('no_title'); }
				
				
				$sx .= '<img src="'.$file.'" height="50">';				
				$sx .= '<TD colspan=5 class="lt2" class="tabela01"><B>'.$link.$title.'</A>';
				
				$sx .= '<TR class="lt0">';
				$sx .= '<TD width="3%"><nobr>'.$line['doc_protocolo'];
				$sx .= '<TD>'.trim($line['title']);
				$sx .= '<TD>'.msg($sta[trim($line['doc_status'])]);
				$sx .= '<TD align="right">'.stodbr($line['doc_data']);
				$sx .= ' '.$line['doc_hora'];
								
				
				$sx .= '<TR class="lt2">';
				$sx .= '<TD colspan=5>&nbsp;';
				
				return($sx);				
			}

		function status()
			{
				$sta = array('@'=>'in_submission', 'N'=>'not_approved','X'=>'canceled');
				return($sta);				
			}

		
		function mostra_total($vlr=0)
			{
				$sx = number_format($vlr,0,',','.');
				if ($sx == '0') { $sx = '-'; }
				return($sx);
			}
		
		function le($id)
			{
				$sql = "select * from ".$this->tabela."
							left join submit_autor on doc_autor_principal = sa_codigo
				 
						where doc_protocolo = '".$id."' or id_doc = ".round($id);
				$rlt = db_query($sql);
				
				if ($line = db_read($rlt))
					{
					$this->protocolo = $line['doc_protocolo'];
					$this->line = $line;
					}
				return(1);
			}
			
		function author_id()
			{
				$this->author_nome = $_SESSION['autor_n'];
				$this->author_email = $_SESSION['autor_e1'];
				$this->author_email_alt = $_SESSION['autor_e2'];
				$this->author_codigo = $_SESSION['autor_cod'];
				$page = trim(page());
				if (substr($page,0,6) != '_login')
				if ($redireciona==1)
					{
						if (strlen($this->author_nome) == 0) { redirecina('_login.php'); }
					}
				return(1);	
			}
			
		function le_submit($id)
			{
				$sql = "select * from ".$this->tabela." 
						inner join ".$this->tabela_autor." on doc_autor_principal = sa_codigo
						left join journals on doc_journal_id = jnl_codigo
						where id_doc = ".round($id);
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$this->line = $line;
						$this->journal = $line['doc_journal_id'];
						$this->author_codigo = $line['doc_autor_principal'];
						$this->protocolo = $line['doc_protocolo'];
						$this->admin_email = $line['jn_email'];
						$this->admin_email_nome = $line['title'];
						return(1);
					}
				return(0);
			}
			
		function mostra()
			{
				$line = $this->line;
				$sx = '';
				$sx .= '<table class="lt1" width="100%" border=0 cellpadding=0 cellspacing=0>';
				$sx .= '<TR valign="top">';
				$sx .= '<TD colspan=1 class="lt0">'.msg('journal');
				$sx .= '<TD colspan=3 class="lt0">'.msg('journal_title');
				$sx .= '<TD colspan=1 width="6%" class="lt0">'.msg('subm_protocol');
				
				
				$sx .= '<TR valign="top">';
				$sx .= '<TD rowspan=16 width="100">';
				$path = trim($line['path']);
				$file = http."editora/img_edicao/capa_$path.png";
				$sx .= '<nobr><IMG SRC="'.$file.'" width="70">&nbsp;&nbsp;&nbsp;&nbsp;</nobr>';
				$sx .= '<TD colspan=3 class="subm_table" ><B><font class="lt1">'.$line['title'].'</font></B>';							
				$sx .= '<TD colspan=1 class="subm_table" align="center" height="12px">'.$line['doc_protocolo'].'';
				
				$sx .= '<TR>';								
				$sx .= '<TD colspan=3 class="lt0">'.msg('subm_title');
				

				$sx .= '<TR valign="top">';
				$sx .= '<TD colspan=3 class="subm_table" rowspan=3 ><B><font class="lt4">'.$line['doc_1_titulo'].'</font></B>';
				
				$sx .= '<TR><TD colspan=1 width="6%" class="lt0">'.msg('subm_posted');
				$sx .= '<TR><TD colspan=1 class="subm_table" align="center">'.stodbr($line['doc_data']).'';
				
				$sx .= '<TR>';
				$sx .= '<TD colspan=3 width="70%" class="lt0">'.msg('subm_author');
				$sx .= '<TD colspan=1 width="6%" class="lt0"><NOBR>'.msg('subm_language').'</nobr>';
				
				$sx .= '<TR>';
				$sx .= '<TD colspan=3 class="subm_table">'.$line['sa_nome'].'';
				$sx .= '<TD colspan=1 class="subm_table" align="center">'.msg($line['doc_1_idioma']).'';
				
				$sx .= '<TR>';
				$sx .= '<TD colspan=2 width="50%" class="lt0">'.msg('email');
				$sx .= '<TD colspan=2 width="50%" class="lt0">'.msg('email_alt');

				$sx .= '<TR>';
				$sx .= '<TD colspan=2 class="subm_table">'.$line['sa_email'].'';
				$sx .= '<TD colspan=2 class="subm_table">'.$line['sa_email_alt'].'';

				

				$sx .= '</table>';
				return($sx);
			}

	function submit_autor_acoes()
		{
			global $path,$dd,$acao;
			$status = trim($this->line['doc_status']);
			$sx = '<table>';
			$sx .= '<TR>';
			$sx .= '<TD>';
			$sx .= '<form method="post" action="'.http.'pb/index.php/'.$path.'">';
			$sx .= '<input type="hidden" name="dd0" value="'.$dd[0].'">';
			$sx .= '<input type="hidden" name="dd90" value="'.$dd[90].'">';
			switch ($status)
				{
					case '@': 
						$sx .= '<input type="hidden" name="dd99" value="manuscript_edit">';
						$sx .= '<input type="submit" value="'.msg('submit_edit').'" class="botao-geral">';
						break;
				}
			$sx .= '</form>';
			$sx .= '<TD>';			
			$sx .= '<form method="post" action="'.http.'pb/index.php/'.$path.'">';
			$sx .= '<input type="hidden" name="dd0" value="'.$dd[0].'">';
			$sx .= '<input type="hidden" name="dd90" value="'.$dd[90].'">';
			switch ($status)
				{
					case '@': 
						$sx .= '<input type="hidden" name="dd99" value="manuscript_cancel">';
						$sx .= '<input type="submit" value="'.msg('submit_cancel').'" class="botao-geral">';
						break;
				}
			$sx .= '</form>';
			$sx .= '</table>';
			echo $sx;
		}

	
		function top_menu($tp = '0')
			{
				global $http, $path;
				
				$sx = '';
				
				$linko = ' onclick="location.href=\''.$http.'\index.php/'.$path.'?dd99=logout\';" ';
				$sx .= '<div class="bt_black" style="float: right;  margin-left: 10px;" '.$linko.'>'.msg("log_out").'</div>';
		
				if ($tp == '0')
					{
					$linko = ' onclick="location.href=\''.$http.'\index.php/'.$path.'?pag=1&dd99=manuscript\';" ';
					$sx .= '<div class="bt_black" style="float: right; width: 200px; margin-left: 10px;" '.$linko.'>'.msg('subm_new_project').'</div>';
					}
		
				$linko = ' onclick="location.href=\''.$http.'\index.php/'.$path.'?dd99=submit\';" ';
				$sx .= '<div class="bt_black" style="float: right;  margin-left: 10px;" '.$linko.'>'.msg("home").'</div>';
				
				return($sx);				
			}
	
		function form_new_project($link)
			{
				$sx = '<BR>
						<form method="get" action="'.$link.'">
						<input type="hidden" name="pag" value="1">
						<input type="hidden" name="dd99" value="manuscript">
						<input type="submit" value="'.msg('subm_new_project').'" class="bt_black" style="width: 200px;">
						</form>';
				
				return($sx);
			}
	
	
		function set_protocolo($id)
			{
				$this->protocolo = $id;
				return(1);
			}
		function set_journal($id)
			{
				$this->journal = $id;
				return(1);
			}	
		function set_autor($id)
			{
				$this->author_codigo = $id;
			}		
	
	
	/*
	 * Página inicial da submissão
	 */
	function cp_01()
		{
			global $jid, $dd, $acao;
			
			$cp = array();
			$sqla = "title:section_id:select * from sections where journal_id = ".round($jid)." and hide_title = 0 order by seq";
			array_push($cp,array('$H8','id_doc','',False,True));
			array_push($cp,array('$Q '.$sqla,'doc_sessao',msg('manuscript_type'),True,True));
			array_push($cp,array('$T80:3','doc_titulo',msg('manuscript_title'),True,True));
			
			array_push($cp,array('$T80:8','doc_resumo',msg('smanuscript_abstract'),True,True));
			
			array_push($cp,array('$S250','doc_palavra_chave',msg('manuscript_keyword'),True,True));
			array_push($cp,array('$HV','doc_update',date("Ymd"),False,True));
			
			array_push($cp,array('$HV','doc_autor_principal',$this->author_codigo,True,True));
			array_push($cp,array('$HV','doc_journal_id',strzero($jid,7),True,True));
			return($cp);		
		}

	function cp_02()
		{
			global $jid;
			$cp = array();
			array_push($cp,array('$H8','id_doc','',False,True));
			array_push($cp,array('$FC001','',msg('manuscript_author'),False,True));
			array_push($cp,array('$HV','doc_update',date("Ymd"),False,True));
			return($cp);		
		}
	function cp_03()
		{
			global $jid;
			$cp = array();
			array_push($cp,array('$H8','id_doc','',False,True));
			array_push($cp,array('$FC003','',msg('manuscript_files'),False,True));
			array_push($cp,array('$FC002','',msg('manuscript_files'),False,True));
			array_push($cp,array('$HV','doc_update',date("Ymd"),False,True));
			return($cp);					
		}
	function cp_04()
		{
			global $jid;
			$cp = array();
			array_push($cp,array('$H8','id_doc','',False,True));
			array_push($cp,array('$T80:20','doc_referencias',msg('manuscript_reference'),False,True));
			array_push($cp,array('$HV','doc_update',date("Ymd"),False,True));
			array_push($cp,array('$HV','doc_dt_atualizado',date("Ymd"),False,True));			
			return($cp);					
		}
	function cp_05()
		{
			global $jid, $valid;
			$t = function_004();
			$cp = array();
			array_push($cp,array('$H8','id_doc','',False,True));
			array_push($cp,array('$H8','',msg('dados_incompletos'),False,True));
			array_push($cp,array('$FC004','',msg('manuscript_files'),False,True));
			array_push($cp,array('$HV','doc_update',date("Ymd"),False,True));			
			array_push($cp,array('$HV','doc_dt_atualizado',date("Ymd"),False,True));
			if ($valid == 1)
				{
					array_push($cp,array('$M1','',msg('man_condicao'),False,True));
					array_push($cp,array('$C1','',msg('man_condicao_01'),True,True));
					array_push($cp,array('$C1','',msg('man_condicao_02'),True,True));
					array_push($cp,array('$C1','',msg('man_condicao_03'),True,True));
				} else {
					array_push($cp,array('$M','',msg('man_erro'),True,True));
				}
			
			return($cp);					
		}
	function submit_01($pag)
		{
		global $form,$dd,$path,$cp,$acao,$ged;
		
		/* recupera a página inicial */
		if (strlen($pag) == 0) { $pag = 1; }
		if ($pag == 0) { $pag = 1; }
		
		/* recupera campos da página */
		$form->required_message = 0;
		$form->required_message_post = 0;
		
		switch ($pag)
			{
			case '1': 
				$cp = $this->cp_01(); 
				break;
			case '2': 
				$cp = $this->cp_02(); 
				break;
			case '3': 
				/* Arquivos */
				$cp = $this->cp_03(); 
				break;
			case '4': 
				/* Referencias */
				$proto = $this->protocolo;
				require("../editora/_class/_class_submit_cp4.php");
				$sm = new campo_04;
				$cp = $sm->show_parecer($proto);
				if (count($cp) == 1)
					{
						array_push($cp,array('$T60:10','doc_field_1','Referências do trabalho',True, True));
					}	
				break;			
			case '5': 
				/* Checklist */
				$cp = $this->cp_05(); 
				break;			
			case '6': 
				/* Save */
				$this->enviar_para_avaliacao(); 
				break;			
			}
				
		/* recupera link para post */
		$post = http.'pb/'.page().'/'.$path.'?dd99='.$dd[99].'&pag='.$pag;
		$tabela = 'submit_documento';
		$proto = $_SESSION['protocol_submit'];
		
		$form = new form;		
		echo $form->editar($cp,'submit_documento',$post);
		
		if ($form->saved > 0)
			{
				/* Documento salvo */
				$this->submit_save();
				$page = http.'pb/index.php/'.$path.'?dd99=manuscript&pag='.($pag+1);
				redirecina($page);
				
			}
		return($sx);	
		}	

	function submit_save()
		{
			global $acao,$dd,$cp,$jid,$pag;
			$acao = trim($_POST['acao']);
			
			$protocolo = $_SESSION['protocol_submit'];
			//$acao = $_POST['acao'].$_GET['acao'];
			
			$autor = $this->author_codigo;
			/*
			 * 
			 */
			if ($pag == 1)
				{
					 $titulo = $dd[2];
					 $resumo = $dd[3];
					 $keyword = $dd[4];
					 $tipo = $dd[1]; 
				}			
			
			if (strlen($acao) > 0)
				{
					if (strlen($protocolo)==0)
						{
							if (strlen($titulo) > 0)
								{
								$protocolo = $this->submit_next_protocolo();
								$status = '@';
								$this->submit_update_protocolo($protocolo, $autor, $titulo, $resumo, $keyword, $status, $tipo, $jid);
								}
						} else {
							$this->submit_update_protocolo($protocolo, $autor, $titulo, $resumo, $keyword, $status, $tipo, $jid);							
						}
				} else {
					
				}
			$_SESSION['protocol_submit'] = $protocolo;
			echo 'Protocolo:'.$protocolo.'<BR>';
		}
		
		function submit_next_protocolo()
			{
				global $jid;
				
				$this->updatex();
				
				$autor = $this->author_codigo;
				$journal = strzero($jid,7);
				$sql = "select * from ".$this->tabela." where doc_autor_principal = '".$autor."' 
							and doc_status = '@' 
							and doc_journal_id = '".$journal."' ";
				echo $sql;
				$rlt = db_query($sql);
				
				if ($line = db_read($rlt))
					{
						echo 'Recupera '.$line['doc_protocolo'];
						$protocolo = $line['doc_protocolo'];
					} else {
						echo 'NOVO';
						$sqlx = "insert into ".$this->tabela." 
							(
							doc_protocolo, doc_autor_principal, doc_status,
							doc_journal_id, doc_1_titulo
							) values (
							'','$autor','@',
							'$journal','sem titulo'
							);
						";
						$rlt = db_query($sqlx);
						$this->updatex();
						$rlt = db_query($sql);
						$line = db_read($rlt);
						$protocolo = trim($line['doc_protocolo']);
					}
				return($protocolo);
			}
	function updatex()
			{
				global $base;
				$c = 'doc';
				$c1 = 'id_'.$c;
				$c2 = $c.'_protocolo';
				$c3 = 7;
				$sql = "update ".$this->tabela." set $c2 = '1'||lpad($c1,$c3,0) 
						where $c2='' or 1=1";
				if ($base=='pgsql') { $sql = "update ".$this->tabela." set $c2 = trim(to_char(id_".$c.",'".strzero(0,$c3)."')) where $c2='' "; }
				$rlt = db_query($sql);				
			}
			
		function submit_update_protocolo($protocolo, $autor='', $titulo='', $resumo='', $keyword='', $status='', $tipo='', $jid=0)
			{
				$sql = "select * from ".$this->tabela." where doc_protocolo = '$protocolo' limit 1";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$sql = "alter table ".$this->tabela." add column doc_referencias text ";
						//$rlt = db_query($sql);
						
						$sql = "update ".$this->tabela." set ";
						$sql .= " doc_update = ".date("Ymd");
						$sql .= ", doc_dt_atualizado = ".date("Ymd");
						if (strlen($titulo) > 0) { $sql .= ", doc_1_titulo = '".substr($titulo,0,200)."' ";}
						if (strlen($titulo) > 0) { $sql .= ", doc_titulo = '".$titulo."' ";}
						if (strlen($keyword) > 0) { $sql .= ", doc_palavra_chave = '".$keyword."' ";}
						if (strlen($resumo) > 0) { $sql .= ", doc_resumo = '".$resumo."' ";}
						$sql .= " where doc_protocolo = '$protocolo' ";
						$rlt = db_query($sql);
					}				
			}
	function documents_requeried()
		{
			global $jid,$http;
			$protocolo = $this->protocolo;
			$sql = "select * from submit_documentos_obrigatorio 
						left join submit_files on doc_tipo = sdo_ged_tipo and doc_dd0 = '$protocolo' and doc_ativo = 1
						where sdo_journal_id = $jid
						and sdo_ativo = 1
						order by sdo_ordem
			";
			$rlt = db_query($sql);
			$sx = '<table width="100%" border=0 >';	
			$xtipo = '';		
			while ($line = db_read($rlt))
				{
					$tipo = $line['sdo_codigo'];
					if ($tipo != $xtipo)
					{
						$xtipo = $tipo;
						$fl = ($line['doc_filename']);
						$modelo = trim($line['sdo_modelo']);
						$obrigatorio = $line['sdo_obrigatorio'];
						$info = $line['sdo_info'];
						$sx .= '<TR>';
						$sx .= '<TD width="150" class="tabela01" align="center" >';
						$sx .= '<B>'.$line['sdo_descricao'].'</B>';
						if ($obrigatorio==1)
							{
								if (strlen($fl) > 0)
									{
										$sx .= '<TD width="120" class="tabela01" align="center" bgcolor="#D0FFD0" >';
										$sx .= ' (<font color="greem">';
										$sx .= msg('posted');
										$sx .= '</font>)';									
									} else {
										$sx .= '<TD width="120" class="tabela01" align="center" bgcolor="#ffd0d0" >';		
										$sx .= ' (<font color="red">';
										$sx .= msg('required');
										$sx .= '</font>)';									
									}
								

							} else {
								$sx .= '<TD width="120" class="tabela01" align="center" >';	
								$sx .= ' (<font color="green">'.msg('optional').'</font>)';
							}
						$sx .= '<TD class="tabela01" align="center">';
						$sx .= $line['sdo_content'];
					
						if (strlen($modelo) > 0)
							{
								$sx .= '<TD align="center" class="bt_green" width="70">';
								$link = '<A HREF="'.trim($modelo).'" target="_balnk" class="link_white">';
								$sx .= $link;
								$sx .= msg('modelo_temp');
								$sx .= '</A>';
							} else {
								$sx .= '<TD class="tabela01" align="center" width="70">';
								$sx .= '&nbsp;';
							}
						$sx .= '<TD class="bt_blue" align="center">';
						$tipo = trim($line['sdo_ged_tipo']);
						$dd50 = 'submit_files';
						$link = 'onclick="newxy2(\''.$http.'ged_upload.php?dd1='.$this->protocolo.'&dd2='.$tipo.'&dd50='.$dd50.'\',700,350);" ';
						$sx .= '<span class="link_white" '.$link.'>'.msg('post_file').'</span>';
					}					
					/* mostra arquivo */
					$sx .= '<TR><TD colspan=10>';
					$sx .= '<table width="100%" class="tabela00" cellpadding=0 cellspacing=1>';
					$sx .= show_file($line);
					$sx .= '</table>';
				}
			$sx .= '</table>';
			return($sx);
		}			
	}
function show_file($line)	
	{
		global $http;
		$sss = 'reol';
		$link = 'onclick="javascript:newxy3(\''.$http.'ged_download.php?dd0='.$line['id_doc'].'&dd50=submit_files&dd90='.checkpost($line['id_doc'].$sss).'&dd91=reol\',300,150);"';
		$sx .= '<tr><td width="70%">';
		$sx .= '<a href="#" class="link" '.$link.'>';
		$sx .= $line['doc_filename'];
		$sx .= '</a>';
		$sx .= '<TD>';
		$sx .= number_format($line['doc_size']/1024,1).'kB';
		$sx .= '<TD>';
		$sx .= stodbr($line['doc_data']).' ';
		$sx .= $line['doc_hora'];
		$sx .= '<TD>'.$line['doc_ativo'];
		return($sx);
	}
/* Submissão */
/* Como realizar a chamada */
function function_001()
	{
		global $dd,$acao,$clx;
		$sx .= '<tr><td colspan=2>';
		$sx .= '<fieldset>';
		$sx .= '<legend>Autores</legend>';
		$sx .= '<div id="autores" style="width: 100%">';
		$sx .= '</div>';
		$sx .= '</fieldset>';
		$sx .= '</td></tr>
		
		<script>
		var url_link = "'.http.'pb/submit_ajax.php";
		var $tela = $.ajax({ url: url_link, type: "POST", 
			data: { dd0: "'.$_SESSION['protocol_submit'].'", dd1: "autor"  }
			})
			.fail(function() { alert("error"); })
 			.success(function(data) { $("#autores").html(data); });
			;		
		</script>
		';		
		return($sx);
	}
function function_002()
	{
		global $dd,$acao,$sb;
		
		$sx = $sb->documents_requeried();
		$sx = '<TD colspan=2>'.$sx.'</td>';
		return($sx);
	}
function function_003()
	{
		global $http,$secu;
		
		$protocolo = $_SESSION['protocol_submit'];
		$sx = '<TR><TD colspan=2 class="tabela01"><B>'.msg("file_list").'</B>';
					
		require("../_ged_submit_files.php");
		$ged->protocol = $protocolo;
		$sx .= $ged->file_list();
		return($sx);
	}		
function mst_check($id)
	{
		global $http;
		if ($id > 0)
			{
				$img = '<img src="'.$http.'/img/icone_check.jpg" height="20">';
			} else { 
				$img = '<img src="'.$http.'/img/icone_alert.png" height="20">';
				}
		return($img);
	}

/* Regra 1 - Número de autores */
function regra01()
	{
		$protocolo = $_SESSION['protocol_submit'];
		$sql = "select count(*) as total from submit_documento_autor where sma_protocolo = '".$protocolo."'";
		$rlt = db_query($sql);
		$total = 0;
		if ($line = db_read($rlt))
			{
				$total = $line['total'];
			}
		return($total);
	}
/* Regra 1 - Arquivos postados */
function regra02()
	{
		/*8888888888888888888888888888888888888888888888*/
		$protocolo = $_SESSION['protocol_submit'];
		$sql = "select count(*) as total from submit_documento_autor where sma_protocolo = '".$protocolo."'";
		$rlt = db_query($sql);
		$total = 0;
		if ($line = db_read($rlt))
			{
				$total = $line['total'];
			}
		return($total);
	}
function regra03($line,$tp=0)
	{
		global $d1,$d2,$d3,$d4,$d5,$d6,$d7;
		$tipo = '';
		switch ($tp)
			{
				case 0: $tipo = $line['doc_sessao']; 
						if ($tipo > 0) { return(1); }
						else {
							return(0);
						}
						break;		
				case 1: $tipo = $line['doc_1_titulo']; break;
				case 2: 
							$tipo = $line['doc_resumo'];
							$tipo = troca($tipo,' ',';');
							$words = splitx(';',$tipo);
							$tw = count($words);
							if (($tw < 50) or ($tw > 600)) 
								{
									$d3 = msg('manuscript_erro_02');
									return(0); 
								} else {
									return(1); 
								}
							
							break;
				case 3: 
							$tipo = $line['doc_palavra_chave']; 
							$tipo = troca($tipo,'.',';');
							$tipo = troca($tipo,',',';');
							$words = splitx(';',$tipo);
							$tw = count($words);
							if (($tw < 2) or ($tw > 6)) 
								{
									$d4 = msg('manuscript_erro_03');
									return(0); 
								} else {
									return(1); 
								}
							
							break;					
				case 4: 
							$tipo = $line['doc_referencias']; break;
							
							
				}
		
		if (strlen($tipo)==0)
			{
				return(0);
			} else {
				return(1);	
			}
	}	
function function_004()
	{
		global $d1,$d2,$d3,$d4,$d5,$d6,$d7,$valid;
		$protocolo = $_SESSION['protocol_submit'];
		
		$sql = "select * from submit_documento where doc_protocolo = '".$protocolo."' or id_doc = ".round($protocolo);
		$rlt = db_query($sql);
		$line = db_read($rlt);		
		$rg1 = 	regra03($line,0);
		$rg2 = 	regra03($line,1);
		$rg3 = 	regra03($line,2);
		$rg4 = 	regra03($line,3);
		$rg5 = 	regra03($line,4);
		$rg6 = 	regra03($line,5);
		$rg7 = 	regra03($line,6);
		
		$rg_author = regra01();
		$rg_file   = regra02();
		
		
		$sx .= '<TR><TD colspan=2>';
		$sx .= '<h2>Checklist</h2>';
		$sx .= '<table width="100%">';
		$sx .= '<TR align="center">';
		$sx .= '<TH width="50%">'.msg("item");
		$sx .= '<TH width="45%">'.msg("descript");
		$sx .= '<TH width="50">'.msg("check");
		/* Checkpost */
		
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01" width="50%">';
		$sx .= msg('manuscript_type');

		$sx .= '<TD class="tabela01" width="45%">';
		$sx .= $d1;
		
		$sx .= '<TD align="center" class="tabela01">';
		$sx .= mst_check($rg1);
		
		/* item 1 */		
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01" width="50%">';
		$sx .= msg('manuscript_title');
		$sx .= '<TD class="tabela01" width="45%">';
		$sx .= $d2;		
		$sx .= '<TD align="center" class="tabela01">';
		$sx .= mst_check($rg2);
		
		/* item 2 - smanuscript_abstract */
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01" width="50%">';
		$sx .= msg('smanuscript_abstract');
		$sx .= '<TD class="tabela01" width="45%">';
		$sx .= $d3;		
		$sx .= '<TD align="center" class="tabela01">';
		$sx .= mst_check($rg3);
				
		/* item 3 - manuscript_keyword */
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01" width="50%">';
		$sx .= msg('manuscript_keyword');
		$sx .= '<TD class="tabela01" width="45%">';
		$sx .= $d4;		
		$sx .= '<TD align="center" class="tabela01">';
		$sx .= mst_check($rg4);
		
		/* item 4 - autores */
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01" width="50%">';
		$sx .= msg('manuscript_authors');
		$sx .= '<TD class="tabela01" width="45%">';
		$sx .= '-';		
		$sx .= '<TD align="center" class="tabela01">';
		$sx .= mst_check($rg_author);		
				
		/* item 4 - Arquivos */
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01" width="50%">';
		$sx .= msg('manuscript_files');
		$sx .= '<TD class="tabela01" width="45%">';
		$sx .= '-';		
		$sx .= '<TD align="center" class="tabela01">';
		$sx .= mst_check($rg_file);
		
		$valid = 1;
		if (($rg_file == 0) or ($rg_author==0) or ($rg1 == 0) or ($rg2 == 0) or ($rg3 == 0) or ($rg4 == 0))
			{
				$valid = 0;
			}
		/* item 4 - Dados complementares */
		//$sx .= '<TR>';
		//$sx .= '<TD class="tabela01" width="50%">';
		//$sx .= msg('manuscript_reference');
		//$sx .= '<TD class="tabela01" width="45%">';
		//$sx .= $d5;		
		//$sx .= '<TD align="center" class="tabela01">';
		//$sx .= mst_check($rg5);
				
		$sx .= '</table>';
		return($sx);
	}
?>
