<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_debug.php');

require($include.'sisdoc_autor.php');

require_once('_class/_class_dtd_mark.php');
$ddd = new dtd_mark;

require_once('_class/_class_dtd_31.php');
$dtd = new dtd31;

$id = $dd[0];
if (strlen($id) == 0)
	{
		echo 'ERRO ID';
		exit;
	}

require("_class/_class_artigos.php");
$wk = new artigos;

require("_class/_class_issue.php");
$is = new issue;

$wk->le($id);
$wk->mostra_protocolos_antigos();
$REF = $wk->le_refs();
$dtd->set_refs($REF);

$dtd->set_article($wk->line);
$jid = $wk->line['journal_id'];
$issue = $wk->line['article_issue'];

$tabela = 'submit_files';
$id = $wk->line['article_protocolo_works'];

$ddd->exists_dtd_file_search($id);
$body = $ddd->conteudo;
$dtd->body = $body;

$is->le($issue);
$dtd->set_issue($is->line);

require("_class/_class_linguage.php");
$idi = new linguage;

/* recupera dados da publicacao */
require("_class/_class_journals.php");
$jnl = new journals;
$jnl->le($jid);


/* Marca infomacoes sobre periódico */
$dtd->set_journals($jnl->line);

/*
 * FILE NAME
 */
$page = trim($wk->line['article_pages']);
if (strpos($page,'-') > 0)
	{
		$page = trim(substr($page,0,strpos($page,'-')));
	}
while (strlen($page) < 4) { $page = '0'.$page; }
$path = trim($jnl->line['path']); $path = 'FM';
$file = trim($jnl->line['journal_issn']);
$npage = $page;
while (strlen($npage) < 5) { $npage = '0'.$npage; }

$dtd->filename = $file.'-'.$path.'-'.trim($is->line['issue_volume']).'-'.strzero($is->line['issue_number'],2).'-'.$npage;

header ("Content-Type:text/xml; charset=utf-8");
header('Content-Disposition: attachment; filename="'.$dtd->filename.'"');
echo $dtd->dtd();
?>