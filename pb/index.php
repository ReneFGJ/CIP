<?php
/**
 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com>
 * @package Publication
 * @version 0.13.27
 */

/* Carrega arquivo de configuraçoes */
require("db.php");

$include_js='';
$include_meta='';

/* Mensagens padrao do sistema */
require("../_class/_class_message.php");
$idioma=$_GET['idioma'];
if (strlen($idioma) > 0)
	{
		$_SESSION['idioma'] = $idioma;
	}
$LANG = $_SESSION['idioma'];

if (strlen($LANG)==0) { $LANG = 'pt_BR'; }

$file = "../messages/msg_".$LANG.".php";
if (file_exists($file)) { require($file); } else { echo 'Message not found. '.$file; exit; }
require($include.'sisdoc_debug.php');
/* Carrega classes */
require("../_class/_class_article.php");
require("../_class/_class_autor.php");
require("_class/_class_calls_of_papers.php");
require("../editora/_class/_class_issue.php");
require("../editora/_class/_class_patrocinadores.php");
require("_class/_class_publish.php");

/* Define os objetos */
$art = new autor;
$art = new article;
$pb = new publish;
$sp = new patrocinadores;
$pb->recupera_publish();
$jid = $pb->jid;

if (strlen($jid) == 0)
	{
		redirecina('../catalogo.php');
		exit;
	}

/* Carrega Layout da revista */
if ((substr($pb->layout,0,1) != '5') and (substr($pb->layout,0,1) != '2')) 
	{ $pb->layout = '5000'; }
require('_class/_class_layout_'.$pb->layout.'.php');
$layout = new layout;

/* Edit Mode */
$edit_mode = round($_SESSION['editmode']);

/* Arquivos GEDS */
require("_ged_config.php");

/* Thema da revista de comunicacao */
$thema = $pb->layout;

/* Regras de página principal para alguns layouts */
//if (($thema == '2001') and (strlen($dd[99])==0)) { $dd[99] = 'capa'; }


/**
 * Monta estrutura das telas do usuario
 */

/* Cabecalho */
echo $pb->cab();
/* Requires */
require($include.'sisdoc_windows.php');
require($include.'sisdoc_autor.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_email.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');

if (strlen($dd[99]) == 0) { $dd[99] = 'actual'; }

require('index_menus.php');

echo $layout->cab();
echo '<link rel="stylesheet" href="'.http.'public/'.$jid.'/css/estilo.css" type="text/css" />'.chr(13);
$redireciona = 0;

/* mostrar os conteudos */
$page = $dd[99];
if (strlen($page)==0) { $page = 'actual'; }

switch ($page)
	{
	case 'manuscript_edit': 
			require("manuscript_edit.php"); 
			$redireciona = 1; break;		
	case 'submit_myaccount': 
			require("submit_myaccount.php"); 
			$redireciona = 0; 
			break;		
	case 'capa':
			echo $pb->banner;		 
			echo $layout->capa(); 
			echo $layout->mostrar_ensaio();	
			$redireciona=1; 
	
			break;
	/* Submissão nova */
	case 'logout':
			require("logout.php");
			break;
	case 'manuscript':
			require("manuscript.php");
			break;

	/* Submissao de trabalhos */
	case 'submit':
			require("submit.php"); 
			$redireciona = 1; break;
	case 'submit2': 
			require("submit_2.php"); 
			$redireciona = 1; break;
	case 'manuscript_resume': require("manuscript_resume.php"); $redireciona = 1; break;
	case 'manuscript_cancel': require("manuscript_cancel.php"); $redireciona = 1; break;
	case 'manuscript_detalhes': require("manuscript_detalhes.php"); $redireciona = 1; break;
	
	case 'submit_logout': require("submit_logout.php"); $redireciona = 1; break;
	case 'newuser':
			echo $pb->banner; 
			require("new_user.php"); 
			$redireciona = 1; break;
	  
	case 'anais':
			echo $pb->banner; 
			$sx = $pb->articles_resumo();  
			$redireciona = 1; break;
	case 'actual': 
			echo $pb->banner; 
			$sx = $pb->articles_resumo();
			echo '<HR>';
			$sx .= $sp->mostra($jid);  
			$redireciona = 1; break;
	case 'about':
				echo $pb->banner; 
				$sx .= $pb->about('about');
				$sx .= $sp->mostra($jid); 
				$redireciona = 1; 
				break; 
	/* ISSUE */
	case 'issues':
				echo $pb->banner; 
				echo '<h2>memória</h2>'. 
				$layout->issues($jid); $redireciona = 1; 
				break;
	case 'issue':
				echo $pb->banner; 
				$issue = new issue; 
				$sx = $pb->articles_resumo(round('0'.$dd[0])); $redireciona = 1; break;
	/* view article */
	case 'view':
			echo $pb->banner; 
			$art = new article;
			$issue = new issue;					
			$art->le($dd[1]);
			$last = $art->article_issue;
			$sx .= '<h6>'.msg('article').'</h6>';
			$sx .= $issue->issue_mostra($last);
			$sx .= $art->mostrar_artigo();
			$sx .= $art->pdf();
			$sx .= '<BR><BR><BR>';
			$ac = 1;		
		 	$redireciona = 1; break;
	/* Fotos */
	case 'fotos': $sf = $pb->fotos(); $sx = troca($sx,'$fotos',$sf); $redireciona = 1; break;
	case 'contact':
			echo $pb->banner; 
			$sx .= $pb->mostra_pagina('contact'); 
			break; 
	case 'schedule':
			echo $pb->banner; 
			$sx .= $pb->mostra_pagina('schedule'); 
			break;	
	case 'authors':
			echo $pb->banner; 
			echo $pb->documentos_obrigatorios();
			$sx .= $pb->mostra_pagina('authors'); 
			break; 
	case 'board':
			echo $pb->banner; 
			$sx .= $pb->mostra_pagina('board');
			$sx .= $sp->mostra($jid); 
			break; 
	case 'expediente':
			echo $pb->banner; 
			$sx .= $pb->mostra_pagina('expediente');
		$sx .= $sp->mostra($jid); 
			break; 	
	case 'other_editions': 
			echo $pb->banner;
			$sx .= $pb->mostra_pagina('other_editions'); 
			break; 	
	default:
			echo $pb->banner;
			if (strlen($capa)==0) { $capa = 'about'; }
			echo $pb->banner;
		
			$sx .= $pb->about($capa); $redireciona = 1; 
		break;
		
		
	}
	
/* Mostra conteudo */
if ((strlen($dd[99]) > 0) and ($redireciona==0)) 
	{ $sx = $pb->mostra_pagina($dd[99]); $redireciona = 1; }
echo $sx;

/* Rodape */
echo $layout->foot();
echo $pb->foot();
?>