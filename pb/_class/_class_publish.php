<?php
class publish
	{
	var $tabela='journals';
	var $jid;
	var $issn;
	var $email;
	var $http;
	var $title;
	var $layout;
	var $description;
	var $tipo;
	var $submission;
	var $suspended;
	
	var $cor_bg;
	var $cor_menu;
	
	var $google_id;
	
	var $cab_image;
	 
	var $tabela_infra = "";
	
	function documentos_obrigatorios()
		{
			global $pb;
			$sql = "select * from submit_documentos_obrigatorio
						where sdo_journal_id = '".$pb->jid."' 
						and sdo_ativo = 1
						";
			$rlt = db_query($sql);
			$sx .= '<h2>'.msg('document_submit_'.strzero($pb->jid,4)).'</h2>';
			$sx .= msg('document_info_'.strzero($pb->jid,4));
			$sx .= '<table width="100%" class="tabela01">';
			$sx .= '<TR><TH>'.msg('document_name');
			$sx .= '	<TH>'.msg('document_required');
			$sx .= '	<TH>'.msg('document_model');
			$sx .= '	<TH>'.msg('document_content');
			
			while ($line = db_read($rlt))
				{
					$modelo = trim($line['sdo_modelo']);
					$obrigatorio = trim($line['sdo_obrigatorio']);
					
					$sx .= '<TR>';
					$sx .= '<TD class="tabela01">';
					$sx .= $line['sdo_descricao'];
					$sx .= '<TD class="tabela01">';
					$sx .= msg('document_required_'.$obrigatorio);
					$sx .= '<TD align="center" class="tabela01">';
					if (strlen($modelo) > 0)
						{
							$sx .= '<A HREF="'.$modelo.'">Modelo de documento</A>';
						} else {
							$sx .= '-';
						}
					$sx .= '<TD class="tabela01">';
					$sx .= $line['sdo_content'];
				}
			$sx .= '</table>';
			return($sx);
		}
	
	function google_analytics()
		{
		$id = $this->$google_id;
		if (strlen($id)==0) { $id = "UA-12712904-1"; }
		
		$sx = '
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("'.$d.'");
		pageTracker._trackPageview();
		} catch(err) {}</script>			
		';
		/* Vers�o Maio-2013 */
		$sx = '		
			<script type="text/javascript">
			  var _gaq = _gaq || [];
  				_gaq.push([\'_setAccount\', \''.$id.'\']);
  				_gaq.push([\'_trackPageview\']);
		
  			(function() {
    			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    			ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  			})();
		</script>		
		';
		return($sx);
		}
	
	function fotos()
		{
			global $jid,$dir;
			
			$sx = '<center>';
			$dir_fotos = $dir.'/reol/public/'.$jid.'/images/';
			$ft = 0;
			for ($r=0;$r < 100;$r++)
				{
					$foto = $dir_fotos.'foto_'.strzero($r,4).'.jpg';
					if (file_exists($foto))
						{
						
						$foto = http.'public/'.$jid.'/images/foto_'.strzero($r,4).'.jpg';
						$sx .= '<A HREF="'.$foto.'" target="_new">';
						$sx .= '<img src="'.$foto.'" border=0 class="foto" id="foto'.strzero($ft,4).'" height="90">';
						$sx .= '</A>';
						$ft++;
						}
				}
			$sx .= '</center>';			
			
			return($sx);
		}
	
	function documments()
		{
			
		}
	
	function older_editions()
		{
			global $jid,$path;
			$jid = round($jid);
			$sql = "select * from issue
				where journal_id = $jid
				and issue_published = 1
				order by issue_year desc, issue_volume, issue_number 
			";
			$rlt = db_query($sql);
			$xyear = 0;
			$capas = array();
			
			$sx = '<table class="lt0">';
			while ($line = db_read($rlt))
			{
				$status = trim($line['issue_status']);
				$capa = trim($line['issue_capa']);
				
				if (($status == 'A') or ($status == 'S'))
				{
					$link = '<A HREF="'.http.'pb/index.php/'.$path.'?dd99=issue&dd0='.$line['id_issue'].'" class="link">';
					if (!(in_array($capa, $capas)))
						{ array_push($capas,$capa); }
					$year = $line['issue_year'];
					if ($year != $xyear)
						{
						$sx .= '<TR>';
						$sx .= '<TD class="tabela01">';
						$sx .= $year;
						}
					$sx .= '<TD align="center" width="70" class="td_titulo"><nobr>';
					$sx .= $link;
					$sx .= 'v.'.$line['issue_volume'];
					$sx .= ', n.'.$line['issue_number'];
					$sx .= '</A>';
					$xyear = $year;
					$ln = $line;
				}
			}
			$sx .= '</table>';
			
			$sa .= '<table width="100%" border=0>';
			$sa .= '<TR valign="top"><TD width="70%">';
			$sa .= msg('issue').'<BR>';
			$sa .= $sx;
			/* Capas */
			$sa .= '<TD width="30%">'.msg('capas').'<BR>';
			for ($r=0;$r < count($capas);$r++)
				{
					$sa .= '<img src="'.http.'public/'.$jid.'/capas/'.$capas[$r].'" height="110">&nbsp;';
				}
			$sa .= '</table>';

			return($sa);
		}
	function other_editions()
		{
			global $path;
			for ($r=0;$r <=9; $r++)
				{ $path = troca($path,$r,''); }
			$sql = "select * from journals 
						where path like '%".$path."%'
						and enabled = 1
						order by jn_title
					";	

			$rlt = db_query($sql);
			$sx = $this->about('other_editions/');
			$sx .= '<UL>';
			while ($line=db_read($rlt))
				{
					$link = http.'index.php/'.trim($line['path']);
					$sx .= '<LI>';
					$sx .= '<A HREF="'.$link.'" class="lt3">';
					$sx .= $line['jn_title'];
					$sx .= '</A><BR>';
					$sx .= '</LI>';
				}
			$sx .= '</UL>';
			return($sx);
		}
	
	function articles_resumo($last='')
		{
			global $layout,$sm;
			$sm = new issue;
			
			$sx = '<div>';
			if (strlen($last)==0)
				{ $last = $sm->ultima_edicao_publicada($this->jid); }
			$sx .= '<h3>'.$sm->issue_mostra($last).'</h3>';
			$sx .= $sm->sumary($last);
			$sx .= '</div>';
			
			$sx = $layout->sumario($sx);
			
			$sx .= $this->creative_commons();
			
			return($sx);
		}
	function articles_show($issue)
		{
			$sm = new issue;
			$sx .= '<div>';
			//$sx .= '<h1>'.msg('anais_0053').'</h1>'.chr(13);
			$last = $issue;
			$sx .= $sm->issue_mostra($last);
			$sx .= $sm->sumary($last);
			$sx .= '</div>';
			
			$sx .= $this->creative_commons();
			
			return($sx);
		}		
	
	function call_of_papers()
		{
			$sx .= '<div>';
			$sx .= '</div>';
			return($sx);
		}
		
	function call_of_papers_list()
		{
			$call = new call_of_paper;
			$call->journal = $jid = $this->jid;
			$sx = $call->list_open();			
			return($sx);
		}		
	
	function call_of_papers_desc()
		{
			
			return($sx);
		}
	function recupera_publish()
		{
			$pathi = $_SERVER['PATH_INFO'];
			if (strlen($pathi) > 0)
				{
				$pathi = substr($pathi,1,strlen($pathi));
				if (strlen($pathi) > 0) 
					{ $this->le($pathi); }
					$_SESSION['journal'] = $this->path;
					$_SESSION['journal_id'] = $this->jid;
				} else {
					$this->path = $_SESSION['journal'];
					$this->jid = $_SESSION['journal_id']; 
				}
			return(1);
		}
	function le($jid)
		{
			$sql = "select * from ".$this->tabela." where path='".LowerCaseSql($jid)."'";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->banner = trim($line['jnl_html_cab']);
					$this->jid = $line['journal_id'];
					$this->path = $line['path'];
					$this->title = $line['jn_title'];
					$this->description = $line['description'];
					$this->layout = $line['layout'];
					$this->http = $line['jn_http'];					
					$this->issn = $line['journal_issn'];
					$this->email = $line['jn_email'];
					$this->editor = $line['editor'];
					$this->submission = $line['jn_send_suspense'];
					$this->layout = $line['layout'];
					$this->tipo = $line['jnl_journals_tipo'];
					$this->submission = $line['jn_send'];
					$this->suspended = $line['jn_send_suspense'];
					$this->google_id = trim($line['jnl_google']);
					
					$this->id_en = trim($line['jnl_idiona_en']);
					$this->id_pt = trim($line['jnl_idiona_pt']);
					$this->id_es = trim($line['jnl_idiona_es']);
					$this->id_fr = trim($line['jnl_idiona_fr']);
					
					$this->cor_bg = trim($line['jn_bgcor']);
					$this->cor_menu = trim($line['jn_bgcor_menu']);
					return(1);
				}
			return(0);
		}	
	function cab()
		{
			global $site, $include_js;
			$layout = $this->layout;
			$title = $this->title;
			$jid = $_SESSION['journal_id'];
			$css_style = $site.'public/'.$jid.'/css/estilo.css';
			$css_roboto = $site.'css/style_font_roboto.css';
			$css_tabela = $site.'pb/css/style_table.css';
			$css_botao = $site.'pb/css/style_botao.css';
			$css_fonts = $site.'pb/css/style_fonts.css';
			$css_form = $site.'pb/css/style_form_submit.css';
			$css_ui = $site.'js/jquery-ui.css';
			
			$css = $site.'pb/skin/style_'.$layout.'.css'; 
			
			/* Header */
			$sx .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.chr(13).chr(10);
			$sx .= '<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">'.chr(13).chr(10);			
			$sx .= '<header>'.chr(13).chr(10);
			$sx .= '	<title>'.trim($title).'</title>'.chr(13).chr(10);
			$sx .= '	<link rel="stylesheet" href="'.$css_tabela.'" type="text/css" />'.chr(13).chr(10);
			$sx .= '	<link rel="stylesheet" href="'.$css_roboto.'" type="text/css" />'.chr(13).chr(10);
			$sx .= '	<link rel="stylesheet" href="'.$css_fonts.'" type="text/css" />'.chr(13).chr(10);
			$sx .= '	<link rel="stylesheet" href="'.$css_form.'" type="text/css" />'.chr(13).chr(10);
			$sx .= '	<link rel="stylesheet" href="'.$css_botao.'" type="text/css" />'.chr(13).chr(10);
			$sx .= '	<link rel="stylesheet" href="'.$css_style.'" type="text/css" />'.chr(13).chr(10);
			$sx .= '	<link rel="stylesheet" href="'.$css.'" type="text/css" />'.chr(13).chr(10);
			$sx .= '	<link rel="stylesheet" href="'.$css_ui.'" type="text/css" />'.chr(13).chr(10);
			$sx .= '	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />'.chr(13).chr(10);
			$sx .= '		<script type="text/javascript" src="'.http.'js/jquery.js"></script>'.chr(13).chr(10);
//			$sx .= '		<script type="text/javascript" src="'.http.'js/jquery.corner.js"></script>'.chr(13);
//			$sx .= '		<script type="text/javascript" src="'.http.'js/jquery.example.js"></script>'.chr(13);
			$sx .= '		<script type="text/javascript" src="'.http.'js/jquery-ui.js"></script>'.chr(13).chr(10);
			$sx .= '		<script src="'.http.'js/jquery.autocomplete.js"></script>'.chr(13).chr(10);
//			$sx .= '        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
//							<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>    
//						'.chr(13);			
			$sx .= $include_js;
//			$sx .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
			$sx .= '</header>'.chr(13).chr(10);
			$sx .= $this->google_analytics();
			
			$sx .= '<style>'.chr(13);
			$sx .= '#cab { background-color: '.$this->cor_menu.'; } ';
			$sx .= '#foot { background-color: #FFFFFF; } ';
			$sx .= '</style>'.chr(13);			
			
			/* background */
			if (strlen($this->cor_bg) > 0) { $sx .= '<body style="background-color: '.$this->cor_bg.'">'.chr(13).chr(10); }
			else { $sx .= '<body>'.chr(13); }
			return($sx);
		}
	function idiomas()
		{
			global $path,$dd;
			$sx = '<nav id="topmenu"><div>';
			$sx .= '<UL>';
			$sx .= '<LI><A HREF="'.http.'pb/index.php/'.$path.'?idioma=pt_BR&dd0='.$dd[0].'&dd99='.$dd[99].'">PORTUGU�S</A></LI>';
			$sx .= '<LI>|</LI>';
			$sx .= '<LI><A HREF="'.http.'pb/index.php/'.$path.'?idioma=en&dd0='.$dd[0].'&dd99='.$dd[99].'">ENGLISH</A></LI>';
			$sx .= '</UL>';
			$sx .= '</div>';
			$sx .= '</nav>';
			return($sx);
		}
	function cp()
		{
			global $tabela;
			$tabela = 'pb_info_texto';
			//$sql = "alter table ".$tabela." ADD COLUMN pij_tipo char(3)";
			//$rlt = db_query($sql);
			$cp = array();
			array_push($cp,array('$H8','id_pij','',False,True));
			array_push($cp,array('$S5','pij_journal_id','Jounral',True,True));
			array_push($cp,array('$Q pi_caption:pi_codigo:select * from pb_info where pi_type=\'J\' order by pi_ordem','pij_codigo','Codigo',True,True));
			array_push($cp,array('$S80','pij_caption','Titulo',False,True));
			array_push($cp,array('$T80:10','pij_text','',False,True));			
			array_push($cp,array('$D8','pij_until','at�',True,True));
			array_push($cp,array('$O 1:SIM&0:NAO','pij_ativo','Ativo',True,True));
			array_push($cp,array('$O pt_BR:Portugues&en_US:Ingles&es:Espanhol&fr:Franc�s','pij_language','Linguage',True,True));
			//array_push($cp,array('$O pt_BR:Portugues&en_US:Ingles','pij_language','Linguage',True,True));
			array_push($cp,array('$O TXT:Texto&HTM:Formatado HTML','pij_tipo','formato',True,True));
			
			return($cp);
		}
	function cp_infra()
		{
			global $tabela;
			$tabela = 'pb_info';
			$cp = array();
			array_push($cp,array('$H8','id_pi','',False,True));
			array_push($cp,array('$H8','pi_codigo','Journal',False,True));
			array_push($cp,array('$S20','pi_caption','Caption',True,True));
			array_push($cp,array('$[1-99]','pi_ordem','Ordem',True,True));
			array_push($cp,array('$O J:Journal','pi_type','Tipo',True,True));			
			array_push($cp,array('$[1-9]','pi_level','at�',True,True));
			array_push($cp,array('T80:5','pi_sample','Linguage',False,True));
			array_push($cp,array('$O about:Sobre&exped:Expediente','pi_location','Local',False,True));
			return($cp);
		}
	function updatex()
			{
				global $base;
				$c = 'pi';
				$c1 = 'id_'.$c;
				$c2 = $c.'_codigo';
				$c3 = 5;
				$sql = "update pb_info set $c2 = lpad($c1,$c3,0) 
						where $c2='' or 1=1";
				if ($base=='pgsql') { $sql = "update pb_info set $c2 = trim(to_char(id_".$c.",'".strzero(0,$c3)."')) where $c2='' "; }
				$rlt = db_query($sql);				
			}
	function structure()
		{
			$sql = "DROP TABLE pb_info";
			$rlt = db_query($sql);
			
			
			$sql = "DROP TABLE pb_info_texto";
			//$rlt = db_query($sql);
			
			$sql = "CREATE TABLE pb_info_texto 
					(
						id_pij serial NOT NULL,
						pij_journal_id integer,
						pij_codigo char(5),
						pij_ativo char(5),
						pij_until integer,
						pij_language char(5),
						pij_text text
					)";			
			//$rlt = db_query($sql);
			
			$sql = "CREATE TABLE pb_info 
					(
						id_pi serial NOT NULL,
						pi_codigo char(5),
						pi_caption char(20),
						pi_ordem integer,
						pi_type char(1),
						pi_level char(1),
						pi_sample text
					)";
			$rlt = db_query($sql);
			
			$a = array('about','mission','goal','vision','focus','peer_review','ethics',
						'submission','term_submission','copyright','periodicity','indexers',
						'editor','scientific_committee',
						'evaluators','contact','sponsor','publishing_house');
			
			for ($r=0;$r < count($a);$r++)
				{
				$sql = "insert into pb_info 
						(
							pi_codigo,	pi_caption,	pi_type, pi_sample, pi_ordem, pi_level, pi_location
						) values ('".strzero($r+1,5)."','".$a[$r]."','J','',".($r+1).",'1','about')";
						$rlt = db_query($sql);
					}	
							
		}
	function creative_commons()
		{
			global $LANG;
			$idioma = lowercase(substr($LANG,0,2));
			if (strlen($idioma)==0) { $idioma = 'pt'; }
			$tx = 'Licenciado sob uma <br>Licen�a Creative Commons';
			if ($idioma == 'en') { $tx = 'This work is licensed under a <BR>Creative Commons Attribution-Share'; }
			$sx = '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="cc">
					<tbody><tr><td align="right">
					<a href="http://creativecommons.org/licenses/by/3.0/deed.'.$idioma.'" target="_new">
					<img src="'.http.'img/img_logo_cc.png" border="0" align="right" height="30" style="padding: 2px 5px 5px 5px;">
					</a>'.$tx.'</td></tr>
					</tbody></table>';
			return($sx);
		}	
	function foot()
		{
			global $LANG,$jid;
			
			$file = "/pucpr/httpd/htdocs/www2.pucpr.br/reol/public/".$jid."/images/homeBottonLogoImage.png";
			$img = '<img src="'.http.'public/'.$jid.'/images/homeBottonLogoImage.png" width="100%">';
			if (file_exists($file) > 0)
				{
					$sx = '';
					$sx .= '<div id="foot">';
					$sx .= $img;
					$sx .= '<BR>';
					$sx .= '&copy 2006-'.date("Y").' - RE<SUP>2</SUP>ol v2.0';
					$sx .= ' - '.$LANG;
					$sx .= '</div>';
				} else {
					$sx = '';
					$sx .= '<div id="foot">';
					$sx .= '<BR>';
					$sx .= '&copy 2006-'.date("Y").' - RE<SUP>2</SUP>ol v2.0';
					$sx .= '<BR>'.$LANG;
					$sx .= '</div>';
				}
			return($sx);
		}

	function mostra_pagina($pg)
		{
			global $dd,$path;
			$sx = '';
			$ac = 0;

			$pg = trim($pg);
			if ($pg=='abeu') { $pg = 'about'; }
			if (strlen($pg)==0) { $pg = 'about'; }
			if ($pg=='inscricao')
				{ $sx = $this->about($pg);  $ac = 1;}			
			if ($pg=='organizacao')
				{ $sx = $this->about($pg);  $ac = 1;}	
			if ($pg=='about_cwb')
				{ $sx = $this->about($pg);  $ac = 1;}	
			if ($pg=='hospedagem')
				{ $sx = $this->about($pg);  $ac = 1;}	
			if ($pg=='restaurante')
				{ $sx = $this->about($pg);  $ac = 1;}
													
			if ($pg=='calls')
				{ $sx = $this->call_of_papers_list();  $ac = 1;}	
			if ($pg=='other_editions')
				{ $sx = $this->other_editions();  $ac = 1;}
			if ($pg=='pdf')
				{
					$id = $dd[1];
					$file = http.'index.php/'.$path.'?dd0='.$id.'&dd99=pdf';
					redirecina($file);
					exit;
				} 
				//}				
			if ($pg=='expediente')
				{ $sx = $this->about('exped'); $ac = 1; }
			if ($pg=='board')
				{ $sx = $this->about('exped'); $ac = 1; }
			
								

			if (($pg=='about') or (strlen($pg)==0))
				{ $sx = $this->about('about'); $ac = 1;}
			if ($ac==0) 
				{ $sx = $this->about($pg); }
			$sx .= '<BR><BR>';	
			if (($pg=='about') or ($pg=='actual'))
				{ $sx = $this->banner . $sx; }
			return($sx);
		}
		
	function editar_page($line)
		{
			global $site;
			$jid = $this->jid;
			$chk = checkpost($line['id_pij']);
			$sx = '<A href="#" onclick="newxy2(\''.$site.'pb/pb_edit.php?dd0='.$line['id_pij'].'&dd2='.trim($line['pi_codigo']).'&dd90='.$chk.'&dd1='.$jid.'\',840,600);">';
			$sx .= 'editar';
			$sx .= '</A>';
			return($sx);
		}
		
	function mostra($text,$tipo)
		{
			if ($tipo=='HTM')
			{
				$sx = ($text);
			} else {
				$sx = mst($text);
			}
			return($sx);
		}
	function about($id)
		{
			global $LANG,$edit_mode;
			$jid = $this->jid;
			$jid = round($jid);
			//$this->structure();
			//$sql = "ALTER TABLE pb_info_texto ADD COLUMN pij_caption char(80)";
			//$rlt = db_query($sql);
			
			$sql = "select * from pb_info 
					left join pb_info_texto 
						on pij_codigo = pi_codigo and pij_journal_id = $jid 
							and pij_language = '$LANG'
					where pi_location = '$id'
					order by pi_ordem
				";

			$rlt = db_query($sql);
			$cc = 0;
			while ($line = db_read($rlt))
				{
				$cc++;
				$ref = trim($line['pi_caption']);
				$txt = trim($line['pi_sample']);
				$cap = trim($line['pij_caption']);
				$text = trim($line['pij_text']);
				$tipo = trim($line['pij_tipo']);
				
				if (strlen($text) > 0)
					{ $txt = $this->mostra($text,$tipo); }
				if ($edit_mode==1)
					{ $dc = ' '.$this->editar_page($line); }
				$mst = 0;

				/* conversoes */
				//$txt = $this->mostrar_lattes($txt);
				
				if (strlen($text) > 0) { $mst = 1; }
				if ($edit_mode==1) { $mst = 1; }
							
				if ($mst == 1)
					{
					if (strlen($cap) > 0)
						{
							$sx .= '<h2>'.$cap.'</h2>'.$dc;		
						} else {
							if ($edit_mode==1)
								{ $sx .= '<h6>'.msg($ref).'</h6>'.$dc; }		
						}
					
					$sx .= '<P>';
					$sx .= $txt;
					$sx .= '</P>';
					}
				}
			if ($cc==0)
				{
					$this->info_novo($id,$jid);
				}
			return($sx);
		}
		
	function info_novo($id='',$jid=0)
		{
			global $LANG,$include;
			
				$sql = "select count(*) as total from pb_info 
					left join pb_info_texto 
						on pij_codigo = pi_codigo and pij_journal_id = $jid 
							and pij_language = '$LANG'
					where pi_location = '$id'
				";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{ $total = $line['total']; }
			if ($total == 0)
				{
					$sql = "insert into pb_info 
							( pi_caption, pi_ordem, pi_type, 
								pi_level, pi_sample, pi_location,
								pi_codigo
							) values (
							  '$id',1,'J',
							  '1','','$id',
							  ''
							)
					";
					$rlt = db_query($sql);
					$this->updatex();
				}
			return(0);
		}		
	function mostrar_lattes($txt)
		{
			$exl = 'http://lattes.cnpq.br/';
			$loop = 0;
			while ((strpos($txt,$exl) > 0) and ($loop < 20))
				{
					$loop++;
					$pos = strpos($txt,$exl);
					$fpos = $pos;
					for ($xpos = $pos;$xpos < strlen($txt);$xpos++)
						{
							$ch = substr($txt,$xpos,1);
							if ($ch < chr(33)) { $fpos = $xpos; $xpos = strlen($txt); }
						}
					$tpos = ($fpos-$pos);
					$latt = substr($txt,$pos,$tpos);
					$lat2 = substr($latt,7,strlen($latt));
					$lat2 = '<a href="httt://'.$latt.'" target="_new">lattes</A>';
					$lat2 = 'xxxxxx';
					$txt = troca($txt,$latt,$lat2);
					echo '->'.$latt;
					echo '<BR>->('.$pos.')'.$lat2;
					echo '<BR>'.$loop.'-->'.$latt."==".$lat2;

				}
			echo '<PRE>'.$txt.'</PRE>';
			echo '<HR>';
			$txt = troca($txt,'httt','http');
			
			return($txt);
		}
	function path()
		{
			
		}	
	}
?>
