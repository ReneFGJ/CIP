<?
class submit
	{
	var $id;
	var $title;
	var $journal;
	var $autor;
	var $status;
	var $protocolo;
	var $update;
	var $data;
	var $hora;
	var $area;
	
	var $autor_nome;
	var $autor_email;
	var $autor_email_alt;
	var $author_codigo;
	var $journal;
		
	var $tabela = "submit_documento";
	
	function set_journal($id)
		{
			$this->journal = round($id);
		}
	
	function resumo()
		{
			$sql = "select * from ".$this->tabela."
					where doc_journal_id = '".round($this->journal)."'
					of doc_journal_id = '".strzero($this->journal,7)."'
					";
			echo $sql;
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					exit;
				}
		}
	
	function msg($ac)
		{
			switch($ac)
				{
				case 'action_A': $ac = 'Indicar avaliador'; break;
				case 'action_B': $ac = 'Aceitar para avaliação'; break;
				case 'action_@': $ac = 'Devolver ao autor'; break;
				case 'action_C': $ac = 'Indicar novo avaliador'; break;
				case 'action_X': $ac = 'Cancelar submissão'; break;
				case 'action_G': $ac = 'Aprovar trabalho para publicação'; break;
				case 'action_N': $ac = 'Não aprovar trabalho'; break;
				}
			return($ac);
		}
	
	function show_search_form()
		{
			global $dd,$acao;
			
			$sx .= '<div style="border: 1px solid #202020; padding: 20px; ">';
			$sx .= '<div style="width: 100%">
					FILTRAR PESQUISA
					</div>
					';
			$sx .= '
			<form action="'.page().'" method="get" >
				<div>
				<input type="text" style="width: 80%;" name="dd1" >
				<input type="submit" value="BUSCA" style="width: 15%;" name="dd1" >
				</div>
			</form>
			';
			
			$sx .= '</div><BR>';
			return($sx);
		}
	
	/* A - Subnetido
	 * B - Aceito para avaliação
	 * ?
	 * */ 
	function action_execute()
		{
			global $dd,$acao;
			
			$sta = trim($dd[2]);
			switch ($sta)
				{
				case 'B': $this->execute_B(); break;
				case 'C': $this->execute_C(); break;
				case 'D': $this->execute_C(); break;
				case 'E': $this->execute_C(); break;
				case 'F': $this->execute_C(); break;
				case 'G': $this->execute_G(); break;
				case 'H': $this->execute_C(); break;
				case 'X': $this->execute_X(); break;
				}
		}
	function execute_B()
		{
			global $dd,$acao,$hd;
			$sx = '';
			$sx = 'Enviando e-mail de aceit';
			/* insere no hisetorico */
			/* Modifica status */
			/* Enviar e-mail ao responsável */
			
			/* insere no historico */
			//$hs->insere_historico($protocolo,'AVA',$avaliador,$user);
			
			/* Modifica status */
			//$this->alterar_status('B');
			
			/* enviar e-mail */
			$complemento = $dd[4];
			if ($dd[3]=='1')
				{
					$proto = $this->protocolo;
					$nome = $this->autor_nome;
					$email = $this->autor_email;
					$editor = $hd->editor;
					$title = $this->title;
					
					$mes = $this->ic("subm_B",1);
					$ms = $mes[1];
					$titulo = $mes[0];
					
					$ms = troca($ms,'$JOURNAL',$hd->journal_name);
					$ms = troca($ms,'$PROTOCOLO',$proto);
					$ms = troca($ms,'$TITULO',$title);
					$ms = troca($ms,'$EDITOR',$editor);
					
					echo '-->'.$email;
					enviaremail('renefgj@gmail.com','',$titulo,$ms);
					echo '<BR>enviado';
				}
			
			exit;
			return($sx);
		}

	function execute_X()
		{
			global $dd,$acao,$hd;
			$sx = '';
			$sx = 'Cancelamento de projeto';
			/* insere no hisetorico */
			/* Modifica status */
			/* Enviar e-mail ao responsável */
			
			/* insere no historico */
			//$hs->insere_historico($protocolo,'AVA',$avaliador,$user);
			
			/* Modifica status */
			$this->alterar_status('X');
			
			/* enviar e-mail */
			$complemento = $dd[4];
			if ($dd[3]=='1')
				{
					$proto = $this->protocolo;
					$nome = $this->autor_nome;
					$email = $this->autor_email;
					$editor = $hd->editor;
					$title = $this->title;
					
					$mes = $this->ic("subm_X",1);
					$ms = $mes[1];
					$titulo = $mes[0];
					
					$ms = troca($ms,'$JOURNAL',$hd->journal_name);
					$ms = troca($ms,'$PROTOCOLO',$proto);
					$ms = troca($ms,'$TITULO',$title);
					$ms = troca($ms,'$EDITOR',$editor);
					
					echo '-->'.$email;
					enviaremail('renefgj@gmail.com','',$titulo,$ms);
					echo '<BR>enviado';
				}
			
			exit;
			return($sx);
		}


	function execute_G()
		{
			$sx = '';
			/* insere no historico */
			/* Modifica status */
			$this->alterar_status('G');
			/* Enviar e-mail ao responsável */
			$sx .= '<HR>G<HR>';
			return($sx);
		}

	function execute_C()
		{
			global $dd, $hd;
			$user = strzero($hd->user_id,7);
			$protocolo = strzero($dd[0],7);
			$sx = '';
			$pp = new parecer;
			
			$hs = new submit_historico;
			$tof = round($dd[9]);
			$av = array();
			$sql = '';
			for ($r=0;$r < $tof;$r++)
				{
					$ps = trim($_POST["ddi".$r]).trim($_GET['ddi'.$r]);
					if (strlen($ps) > 0)
						{
							array_push($av,$ps);
							if (strlen($sql) > 0)
								{ $sql .= ' or '; }
							$sql .= "(us_codigo = '$ps') "; 
						}
				}
			if ($tof > 0)
			{
				$sql = "select * from pareceristas where ".$sql."
						order by us_nome
						";
				$rlt = db_query($sql);
				
				while ($line = db_read($rlt))
					{
						/* Inserir avaliacao */
						$avaliador = trim($line['us_codigo']);
						$tipo = 'AV001';
						$pp->inserir_avaliacao($protocolo, $avaliador,$tipo);
						
						/* insere no historico */
						$hs->insere_historico($protocolo,'AVA',$avaliador,$user);
						
						/* Modifica status */
						$this->alterar_status('C');
						
						/* Enviar e-mail ao responsável */
						$ref = 'subm_C';
						if (strlen($dd[3]) > 0)
							{
							$pp->enviar_email($avaliador,$ref,$protocolo);
							}
					}
			}
			return($sx);
		}

	function alterar_status($sta)
		{
			$protocolo = $this->protocolo;
			$sql = "update ".$this->tabela." set doc_status = '$sta' 
					where doc_protocolo = '$protocolo'
			";
			$rlt = db_query($sql);
			return(1);
		}
	function ic($id,$tipo=0)
		{
			global $jid,$secu;
			$jnid = strzero($jid,7);
			$sql = "select * from ic_noticia where nw_ref='$id' 
					and nw_journal = $jid ";
			
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$titulo = $line['nw_titulo'];
					$text = $line['nw_descricao'];
				}
			if ($tipo == 1)
				{
					return(array($titulo,$text));
					exit;
				}
			$link = '<span onclick="newxy2(\'ic_editar_sel.php?dd1='.$jid.'&dd2='.$id.'&dd90='.checkpost($jid.$id.$secu).'\',600,400);" class="link">editar mensagem: '.$id.'</span>';
			$sx .= '<table class="tabela20" width="100%">
					<TR class="tabela_title"><td colspan=3><B>Modelo da comunicação</B>
					<TR class="tabela_title"><TH style="font-size: 14px;">Título do e-mail: <B>'.$titulo.'</B>
					<TR class="tabela"><TD>'.mst($text).'
					<TR><TD>'.$link.'
					</table>
					';
			
			return($sx);
		}
	function show_button($cap,$txt,$email=0,$comment=0,$form='')
		{
			global $dd;
			$sx .= '<form id="form" method="post" action="submit_works_detalhes.php" class="tabela10">'.chr(13);
			$sx .= '<input type="hidden" name="dd0" value="'.$dd[1].'">'.chr(13);
			$sx .= '<input type="hidden" name="dd2" value="'.$dd[2].'">'.chr(13);
			$sx .= '<input type="hidden" name="dd5" value="ACAO">'.chr(13);
			$sx .= '<input type="hidden" name="dd90" value="'.$dd[90].'">'.chr(13);
			
			$sx .= '<table class="tabela20" width="100%">';
			//$sx .= '<TR><TD colspan=2 bgcolor="#FFFFFF">';
			//$sx .= 'Marque os avaliadores';
			if (strlen($form) > 1)
				{
					$sx .= '<TR><TD>';
					$sx .= $form;
				}
			/* informações */
			if ($comment == 1)
				{
					$sx .= '
					<TR class="tabela_title"><td><B>'.$txt.'</B>
					<TR><TD align="left">
					<textarea name="dd4" rows="8" cols="60" style="width: 400px;"></textarea>
					'.chr(13);
				}
						
			/* botao */
			if ($email == 1)
				{
					$sx .= '
					
					<TR><TD align="left">
					<input type="checkbox" name="dd3" value="1" checked> Enviar e-mail para comunicar
					'.chr(13);
				}
			$sx .= '</table>';
			
			
			$sx .= '<input type="submit" value="'.$cap.'" class="botao-confirmar" id="bt00">
					'.chr(13);
			$sx .= '</form>'.chr(13);
			return($sx);
		}

	/* ACAOES */
	
	function action_B()
		{
			global $dd,$acao;
			$sx .= '<table width="100%" class="tabela">
					<TR class="tabela_title" valign="top">
						<TH colspan="10" class="tabela_title">'.msg("actions").'
					<TR valign="top">
						<TD width="49%">
							'.$this->show_button('confirmar >>>','Comunicar Autor',1,1).'
						<td width="2%">&nbsp;
						<TD width="49%">
							'.$this->ic("subm_B").'	
					</table>
			';
			return($sx);	
		}

	function action_X()
		{
			global $dd,$acao;
			$sx .= '<table width="100%" class="tabela">
					<TR class="tabela_title" valign="top">
						<TH colspan="10" class="tabela_title">'.msg("actions").'
					<TR valign="top">
						<TD width="49%">
							'.$this->show_button('confirmar >>>','Comunicar Autor',1,1).'
						<td width="2%">&nbsp;
						<TD width="49%">
							'.$this->ic("subm_X").'	
					</table>
			';
			return($sx);	
		}

	function action_C()
		{
			global $dd,$acao,$jid;
			$pp = new parecer;

			$form = $pp->indicar_avaliadores('',$jid);			
			$sx .= '<table width="100%" class="tabela">
					<TR class="tabela_title" valign="top">
						<TH colspan="10" class="tabela_title">'.msg("actions").'
					<TR valign="top">
						<TD width="49%">
							'.$this->show_button('confirmar >>>',$text,1,0,$form).'
						<td width="2%">&nbsp;
						<TD width="49%">
							'.$this->ic("subm_C").'	
					</table>
			';
			return($sx);	
		}		
	
	function actions_show($sh='')
		{
			$sn = array();
			$st = array();
			
			switch ($sh)
				{
				case 'A': 
					array_push($sn,'B');
					array_push($sn,'@');
					array_push($sn,'N');
					array_push($sn,'X');
					break;
				case 'B': 
					array_push($sn,'B');
					array_push($sn,'@');
					array_push($sn,'X');
					break;
				case 'C': 
					array_push($sn,'C');
					array_push($sn,'N');
					array_push($sn,'X');
					array_push($sn,'G');
					break;										
				case 'G': 
					array_push($sn,'G');
					array_push($sn,'X');
					break;
				}
			$sx = '<table width="100%" class="tabela20" border=0>';
			$sx .= '<TR class="tabela_title">
				<TH colspan="10" class="tabela_title">'.msg("actions");
			$sx .= $this->actions_display($sn,$sh);
			$sx .= '</table>';
			$sx .= '<div stlye="float: clear">&nbsp;</div>';
			return($sx);
		}
	function actions_display($a1,$a2)
		{
			global $dd;
			$col = 99;
			for ($r=0;$r < count($a1);$r++)
				{
				if ($col > 2)
					{ $sx .= '<TR class="padding5" style="background-color: #FFFFFF;">'; $col = 0; }
				$sx .= '<TD align="center">';
				$sx .= '<input type="button" 
							id="bt'.strzero($r,2).'" 
							value="'.$this->msg('action_'.$a1[$r]).'" 
							class="botao-finalizar" 
							style="padding: 2px 15x 2px 15px; width: 200px;"
							onclick="goto(\''.$a1[$r].'\')"
							>';
				$col++;
				}
			$sx .= '
				<script>
				function goto(id)
					{
						var link_call = "submit_works_actions.php?dd2="+id+"&dd1='.$dd[1].'&dd90='.$dd[90].'";
						var $tela01 = $.ajax(link_call)
							.done(function(data) { $("#actions").html(data); })
							.always(function(data) { $("#actions").html(data); });			
					}
				</script>			
			';
			
			return($sx);
		}
	function action_execute_button($op)
		{
			switch ($op)
			{
			case "B": $sx = $this->action_B(); break;
			case "C": $sx = $this->action_C(); break;
			case "X": $sx = $this->action_X(); break;
			}
			return($sx);
			
		}
	function actions()
		{
			global $dd;
			$sx .= '<div id="actions">Não foi possível carregar a página
					</div>
			';
			$sx .= '
			<script>
			
			var link_call = "submit_works_actions.php?dd1='.$this->id.'&dd90='.checkpost($this->id).'";
			
			var $tela01 = $.ajax(link_call)
				.done(function(data) { $("#actions").html(data); })
				.always(function(data) { $("#actions").html(data); });	

			</script>';
			return($sx);
		}
	
	function show_list($st='')
		{
			global $jid;
			if (strlen($st) > 0) { $wh = " and doc_status = '$st' "; }
			$order  = " doc_status,  doc_dt_atualizado desc, doc_hora desc ";
			$sql = "select * from submit_documento 
					left join submit_status on doc_status = s_status
					where doc_journal_id = '".strzero($jid,7)."'
						and doc_status <> 'X' and doc_status <> '@' and doc_status <> 'Z' and doc_status <> 'N'
						$wh
					order by doc_status, doc_update, s_descricao_1
					";
			$rlt = db_query($sql); 
			
			$xses = 'x';
			$xiss = 0;
			$sx = '<table width="100%" class="tabela00">';
			
			while ($line = db_read($rlt))
			{
				$ses = trim($line['title']);		
				if ($xses != $ses)
					{
						$sx .= '<TR ><TD colspan=5><h3>'.$line['title'].'</h3>';
						$xses = $ses;
					}
				$sx .= $this->show_work($line);
				$ln = $line;	
			}
			$sx .= '</table>';
			//print_r($ln);
			return($sx);
		}	
		
		function show_work($line)
			{
				$tot++;
				$dias = DateDif($line['doc_update'],date("Ymd"),'d');
				$ndias = DateDif($line['doc_data'],date("Ymd"),'d');
				if ($dias > 1000) { $dias = $ndias; }
					$titulo = trim($line['doc_1_titulo']);
				if (strlen($titulo) == 0) { $titulo = '## submetido sem título ##'; }
				$dias = '<font class="lt5"><font color="red">'.$dias.'<font class="lt0"><BR>dias';
				$link = '<A HREF="submit_works_detalhes.php?dd0='.$line['id_doc'].'"><font color="blue" style="font-size: 13px;">';
				$status = trim($line['doc_status']);
				$sta = $status;
				if ($status == 'A') { $status = '<font color="green"><B>Submetido</B></font>'; }
				$sr .= '<TR valign="top">';
				$sr .= '<TD rowspan="3" width="5%"><nobr>';
				$sr .= '<img src="img/subm_icone_'.$sta.'.png" height="64" alt="" border="0">';
				$sr .= '<img src="img/subm_bar_'.$sta.'.png"  height="64" alt="" border="0">';
				$sr .= '</TD>';
				$sr .= '<TD class="lt0">PROTOCOLO: '.$line['doc_protocolo'].' - '.$status.'</TD>';
				$sr .= '<TR><TD colspan="6" class="lt3"><B>'.$link.$titulo.'</TD>';
				$sr .= '<TD rowspan="2" align="center">'.$ndias.'/'.$dias.'</TD>';
				$sr .= '<TR class="lt0">';
				$sr .= '<TD><font color="#c0c0c0">Atualizado: <B>'.stodbr($line['doc_dt_atualizado']).' '.$line['doc_hora'].'</TD>';
				$sr .= '<TD><font color="#c0c0c0">Submissão: <B>'.stodbr($line['doc_update']).'</TD>';
				$sr .= '</TR>';
				$sr .= '<TR class="lt0">';
				$sr .= '<TD colspan="2"><font color="#c0c0c0">Autor: <B>'.$line['sa_nome'].'</TD>';
				$sr .= '<TR><TD colspan="8" height="1" bgcolor="#c0c0c0"></TD></TR>';
				return($sr);
			}		

	/***  ***/
	function mostra_submissoes() 
		{
		global $jid;
		$njid = strzero($jid,7);
		echo '<div style="background: #FFFFFA;">';
		$sql = "select * from submit_documento 
			left join submit_autor on doc_autor_principal = sa_codigo
			where doc_journal_id = '$njid'
			and ((doc_status <> '@') and (doc_status <> 'Z') and (doc_status <> 'X') and (doc_status <> 'N'))
			order by doc_status, doc_data desc
			";
		
		$rlt = db_query($sql);
		$status = $this->status();
		//echo $sub->resumo();
		
		$xsta = '';
		$sx .= '<table width="100%">';
		while ($line = db_read($rlt))
			{
			$sx .= $this->show_work($line);
			}
		$sx .= '</table>';
		return($sx);
			$ln = $line;
			$di = $line['doc_update'];
			if (round($di) == 0)
				{ $di = $line['doc_data']; }
			$dias = DateDif($di,date("Ymd"),'d');
			$ndias = DateDif($line['doc_data'],date("Ymd"),'d');
			
			$sta = trim($line['doc_status']);
		
			if ($sta != $xsta)
				{
					$xsta = $sta;
					$sx .= '<div><HR><h3>'.$status[$sta].' - '.$sta.'</h3><HR></div>';
				}
			
			$sx .= '<div class="tabela30 lt0" style="backgroud-color: #FFFF00; ">';
			$sx .= $this->mostra_dias_submissão($dias);
			$sx .= '<A HREF="submit_detalhe.php?dd0='.$line['id_doc'].'&dd90='.checkpost($line['id_doc']).'" class="lt2">';
			$sx .= $line['doc_1_titulo'];
			$sx .= '</A>';
			
			$sx .= '<BR>
				<font class="lt1">'.stodbr($line['doc_data']).' - </font> 
				<font class="lt1"><B>'.trim($line['sa_nome']).'</B></font>
				<font class="lt1">, atualizado em '.stodbr($line['doc_update']).'</font>
				<font class="lt1">, postado em '.stodbr($line['doc_dt_atualizado']).'</font>
				';
				$sx .= '<BR><BR>';
				$sx .= '</div>';
			
		echo $sx;
		echo '</div>';			
		}
	
	
	function  autor_valida()
		{
			$_SESSION['autor_n'] = $this->author_nome;
			$_SESSION['autor_e1'] = $this->author_email;
			$_SESSION['autor_e2'] = $this->author_email_alt;
			$_SESSION['autor_cod'] = $this->author_codigo;
			return(1); 
		}
		
	function recuperar_autor($protocolo='')
		{
			$codigo = '';
			$sql = "select * from ".$this->tabela." 
					left join submit_autor on doc_autor_principal = sa_codigo
					where doc_protocolo='".$protocolo."' ";
			$sql .= "limit 1 ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$codigo = trim($line['doc_autor_principal']);
					$this->author_nome = $line['sa_nome'];
					$this->author_email = $line['sa_email'];					
					$this->author_email_alt = $line['sa_email_alt'];
					$this->author_codigo = $line['sa_codigo'];
				}
			return($codigo);
		}
	
	function cp()
		{
			
		}
		
	function mostra_dias_submissão($dias)
		{
			$sx = '<div class="submit_dias">
					'.$dias.'<sup class="submit_dias_sup">dias</sup>
				</div>';
			return($sx);
		}
		
	function resumo_mostra()
		{
			global $jid;
			$journal_id = strzero($jid,7);
			$sql = "select count(*) as total, doc_status from submit_documento 
				left join submit_autor on doc_autor_principal = sa_codigo
				where doc_journal_id = '$journal_id'
				and ((doc_status <> '@') and (doc_status <> 'Z') and (doc_status <> 'X'))
				group by doc_status
				order by doc_status
				";	
			$rlt = db_query($sql);
			$rs = array(0,0,0,0,0,0,0,0,0);
			while ($line = db_read($rlt))
				{
					$sta = trim($line['doc_status']);
					$total = $line['total'];
					switch ($sta)
						{
						case 'A': $rs[0] = $rs[0] + $total; break;
						case 'C': $rs[3] = $rs[3] + $total; break;
						case 'O': $rs[3] = $rs[3] + $total; break;
						case 'E': $rs[1] = $rs[1] + $total; break;
						case 'G': $rs[1] = $rs[1] + $total; break;
						case 'M': $rs[1] = $rs[1] + $total; break;
						case 'L': $rs[2] = $rs[2] + $total; break;
						
						}
				}
			$sx = '<table class="tabela20" width="100%">';
			$sx .= '<TR><TH class="tabela_title" colspan=4>Resumo das Submissões';
			$sx .= '<TR align="center">
						<TH class="tabela10"><center>Submetidos</center>
						<TH class="tabela10"><center>Com editor</center>
						<TH class="tabela10"><center>Com autor</center>
						<TH class="tabela10"><center>Com parecerista</center>';
			$sx .= '<TR>
						<TD align="center"  class="lt4">'.$rs[0].'
						<TD align="center"  class="lt4">'.$rs[1].'
						<TD align="center"  class="lt4">'.$rs[2].'
						<TD align="center"  class="lt4">'.$rs[3].'
						';
			$sx .= '</table>';		
			return($sx);
		}
		
	function status()
		{
			$st = array(
				'@'=>'Em submissão pelo autor',
				'#'=>'Em Correção de submissão pelo autor',
				'A'=>'Submetido, aguardando aceite para avaliação',
				'B'=>'Aceito para avaliação, aguardando indicação de avaliador',
				'C'=>'Em avaliação por parecerista Ad Hoc',
				'D'=>'Avaliação finalizada pelo avaliador',
				'G'=>'Aguardando documentação de direitos autorais dos autores',
				'O'=>'Reavaliação do parecerista Ad Hoc',
				'H'=>'Aceito para publicação',
				'I'=>'Aceito para publicação, falta definir edição',
				'M'=>'Devolvido pelo autor com as correções',
				'N'=>'Não aprovado',
				'L'=>'Enviado para o autor para correções',
				'Q'=>'Enviado para editora',
				'Z'=>'Aceito para publicação',
				'X'=>'Cancelado'				
			);
			return($st);
		}
	function le($id='',$protocolo='')
		{
			if (strlen($id) > 0) { $this->id = $id; }
			if (strlen($protocolo) > 0) { $this->protocolo = $protocolo; }
			$sql = "select * from ".$this->tabela." 
					left join submit_autor on doc_autor_principal = sa_codigo 
					where id_doc = ".round($this->id)."
				or doc_protocolo = '$protocolo' ";
			$rlt = db_query($sql);
			
			if ($line = db_read($rlt))
				{
					$this->autor_nome = trim($line['sa_nome']);
					$this->autor_email = trim($line['sa_email']);
					$this->autor_email_alt = trim($line['sa_email_alt']);
					$this->autor_nome = trim($line['sa_nome']);
					$this->title = $line['doc_1_titulo'];
					$this->journal = $line['doc_journal_id']; 
					$this->autor = trim($line['doc_status']);
					$this->status = trim($line['doc_status']);
					$this->protocolo = trim($line['doc_protocolo']);
					$this->update = $line['doc_dt_atualizado'];
					$this->data = $line['doc_data'];
					$this->hora = $line['doc_hora'];
					$this->autor_principal = trim($line['doc_autor_principal']);
				}
			return(1);
		}	

	/** Mostra dados do sistema **/
	function mostra_dados()
		{
			$status = $this->status();
			$sx .= '<fieldset>'.chr(13);
			$sx .= '<legend><font class="lt1"><B>informações sobre submissão</B></font></legend>'.chr(13);
			$sx .= '<table width="100%">'.chr(13);
			$sx .= '<TR><TD class="lt0" width="10%" align="right">título</TD>'.chr(13);
			$sx .= '<TD class="lt3" colspan="3"><B>'.$this->title.'</B></TD>'.chr(13);
			$sx .= '<TD rowspan="10" align="right">'.chr(13);
			$sx .= '<img src="img/subm_icone_'.$this->status.'.png" width="60" alt=""></TD>'.chr(13);
			$sx .= '</TR>'.chr(13);
			$sx .= '<TR><TD class="lt0" width="10%" align="right"><I>status</I></TD>'.chr(13);
			$sx .= '<TD class="lt2"><B>'.$status[$this->status].'</B> ['.$this->status.']</TD>'.chr(13);
			$sx .= '<TR><TD class="lt0" align="right">data submi.</TD>'.chr(13);
			$sx .= '<TD class="lt1">'.stodbr($this->data).' '.$this->hora.'</TD>'.chr(13);
			$sx .= '<TD class="lt0" align="right">protocolo</TD>'.chr(13);
			$sx .= '<TD class="lt1"><B>'.$this->protocolo.'</B></TD>'.chr(13);
			$sx .= '<TR><TD class="lt0" align="right">atualizado</TD>'.chr(13);
			$sx .= '<TD class="lt1">'.stodbr($this->update).'</TD>'.chr(13);
			
			/** caso contenha especificação de área **/
			if (strlen($$this->area) > 0) 
				{ $sx .= '<TD class="lt0" align="right">área</TD><TD class="lt1"><B>'.$this->area.'</B></TD>'; }
			$sx .= '</TR>'.chr(13);
			$sx .= '</TR>'.chr(13);
			$sx .= '</table>'.chr(13);
			$sx .= '</fieldset>';
			return($sx);
		}
	function mostra_autor_principal()
		{
			return($this->mostra_autores());
		}
	function mostra_autores()
		{
			$sx = '<BR>';
			$sx .= '<table width="100%" border="0" class="tabela10">
					<TR><TH class="tabela_title" colspan=5>sobre o autor principal';
			$sx .= '<TR><TD class="tabela10" width="10%" align="right">nome</TD>';
			$sx .= '<TD class="tabela10" colspan="3"><B>'.$this->autor_nome.'</B></TD>'.chr(13);
			$sx .= '<TD width="48" rowspan=4>';
			$sx .= $this->relacionamento_com_autor();
			$sx .= '</TR>'.chr(13);
			$sx .= '<TR><TD class="tabela10" width="15%" align="right">e-mail</TD>';
			$sx .= '<TD class="tabela10"><B>'.$this->autor_email.'</B></TD>'.chr(13); 
			$sx .= '<TR><TD class="tabela10" width="15%" align="right">e-mail (alt.)</TD>';
			$sx .= '<TD class="tabela10"><B>'.$this->autor_email_alt.'</B></TD>'.chr(13);
			$sx .= '</table>'.chr(13);
			$sx .= '<BR>';
			return($sx);
		}
	function relacionamento_com_autor()
		{
			$sx = '<center>';	
			$sx .= '<A HREF="javascript:newxy2(\'autor_relacionamento.php?dd0='.$this->protocolo.'\',500,300);" alt="relacionamento com autor principal">';
			$sx .= '<img src="img/icone_email.png" height="48" border=0>';
			$sx .= '</A>';
			$sx .= '<BR>';
			$sx .= '<font class="lt0">sem mensagens</font>';
			return($sx);
		}
	function relacionamento_form()
		{
			global $dd,$acao,$http;
			$sx = '
			<form method="post">
			<table width="100%">
			<TR class="lt1"><TD>Autor principal</TD><TD align="right" rowspan=2>
			<img src="img/icone_email.png" height="48" border=0>
			</TR>
			<TR><TD>'.$this->autor_nome.'
			<TR class="lt1"><TD>Assunto</TD></TR>
			<TR><TD colspan=2><input type="text" maxsize="100" style="width: 100%" value="'.$dd[1].'" name="dd1"></TD></TR>
			<TR class="lt1"><TD>Mensagem</TD></TR>
			<TR><TD colspan=2><textarea name="dd2" rows=6 style="width: 100%">'.$dd[2].'</textarea></TD></TR>
			<TR><TD><input type="submit" value="enviar mensagens" name="acao"></TD></TR>	
			</table>
			</form>
			';
			
			if (strlen($acao) > 0)
				{
					if ((strlen($dd[1]) > 0) and (strlen($dd[2]) > 0))
						{
							echo 'enviar e-mail';
							$dd[2] = mst($dd[2]);
							$dd[2] .= '<BR><BR>Protocolo '.$this->protocolo;
							$texto = $dd[2];
							$dd[2] .= '<BR><BR>Para responder este e-mail click no link abaixo<BR>';
							$link = $http.'submissao/relacionamento_autor.php?dd0='.$this->protocolo.'&dd1='.checkpost($this->protocolo);
							$link = '<a href="'.$link.'">'.$link.'</A>';
							$dd[2] .= $link;
							
							$this->relacionamento_grava($dd[1],$texto);
							enviaremail('renefgj@gmail.com','',$this->protocolo.' - '.$dd[1],$dd[2]);
							enviaremail($this->autor_email,'',$this->protocolo.' - '.$dd[1],$dd[2]);
							echo '<CENTER><H2>e-mail enviado com sucesso!</center>';
							exit;
						} 
				}
			return($sx);
		}
	function relacionamento_grava($assunto,$texto)
		{
			//$this->strucuture();
			$protocolo = $this->protocolo;
			$data = date("Ymd");
			$hora = date("H:i:s");
			$sql = "insert into submissao_relacionamento
				(
				sr_protocolo, sr_assunto, sr_texto,
				sr_data, sr_hora )
				values
				( '$protocolo','$assunto','$texto',
				$data,'$hora')
			";
			$rlt = db_query($sql);
		}
		
	function mostra_autores_todos()
		{
		$sx = '
    		<table width="100%" border="0" class="tabela10">
    		<TR><TH class="tabela_title" colspan=4>sobre o(s) autor(es)
			<TR><TH>nome</TH><TH>e-mail</TH><TH>cidade</TH><TH>Lattes</TR>
			';
			$sql2 = "select * from submit_autores ";
			$sql2 .= " left join apoio_titulacao on qa_titulo = ap_tit_codigo ";
			$sql2 .= " where qa_protocolo = '".$this->protocolo."' ";
			$sql2 .= " limit 20 ";
			$rlt2 = db_query($sql2);
			while ($line2 = db_read($rlt2))
				{
				$lattes = trim($line2['qa_lattes']);
				if (strlen($lattes) > 0)
					{ $lattes = '<A HREF="'.$lattes.'" target="new_"><img src="img/icone_lattes.gif" width="20" height="20" alt="" border="0"></A>'; }
				$titulacao = trim($line2['ap_tit_titulo']);
			
				$nome2 = trim($line2['qa_nome']);
				$cidade2 = trim($line2['qa_cidade']);
		//		$nome2 = trim($line2['qa_instituicao']);
				$titula2 = trim($line2['qa_titulo']);
				$email2 = trim($line2['qa_email']);
				
				$sx .= '<TR><TD class="tabela10" colspan="1">'.trim(trim($titulacao).' '.trim($nome2)).'</TD>
        			<TD class="tabela10">'.$email2.'</TD> 
            		<TD class="tabela10">'.$cidade2.'</TD>   
					<TD align="center">'.$lattes.'</TD>        
	        	</TR></TR>';
	        	}
    		$sx .= '</table><BR><BR>';
			return($sx); 			
		}
	function relacionamento_lista()
		{
			$sql = "select * from submissao_relacionamento
					where sr_protocolo = '".$this->protocolo."' 
					";
			$rlt = db_query($sql);
			$sa = '';
			while ($line = db_read($rlt))
				{
					$sa .= '<TR>';
					$sa .= '<TD>';
					$sa .= stodbr($line['sr_data']);
					$sa .= ' ';
					$sa .= trim($line['sr_hora']);					
					$sa .= '<TR>';
					$sa .= '<TD><B>';
					$sa .= trim($line['sr_assunto']);
					$sa .= '<TR>';
					$sa .= '<TD>';
					$sa .= trim($line['sr_texto']);
					$sa .= '<TR><TD><HR>';
				}
			if (strlen($sa)==0) { $sa = '<TR><TD>Sem relacionamento</TD></TR>';}
			$sx = '
				<table width="100%" class="lt1">
				<TR><TD><B>Relacionamentos anteriores com este protocolo</B></TD></TR>
				';
			$sx .= $sa;
			$sx .= '</table>';
			return($sx);	
			
		}
	function strucuture()
		{
			$sql = "CREATE TABLE submissao_relacionamento
				(
				id_sr serial NOT NULL,
				sr_protocolo char(7),
				sr_assunto char(100),
				sr_texto text,
				sr_data int,
				sr_hora char(8)
				);
			";
			$rlt = db_query($sql);
		}
	}
?>
