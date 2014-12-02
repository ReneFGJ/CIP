<?php
require ("cab_semic.php");
require ($include . 'sisdoc_autor.php');
$jid = 85;
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs, array(http . 'admin/index.php', msg('principal')));
array_push($breadcrumbs, array(http . 'admin/index.php', msg('menu')));
echo '<div id="breadcrumbs">' . breadcrumbs() . '</div>';

require ("../editora/_class/_class_artigos.php");
$ar = new artigos;

require ("../_class/_class_semic.php");
$sm = new semic;
$sm -> tabela = "semic_ic_trabalho";
$sm -> tabela_autor = "semic_ic_trabalho_autor";

require ("../editora/_class/_class_secoes.php");
$sec = new secoes;

/* */
echo $sm->comparacao_semic_pibic();

//$sql = "delete from articles where journal_id = 67 and article_issue = 528";
//$rlt = db_query($sql);
//echo $sql;
//exit;
//$deli = " and (pb_semic_area like '6.01%') ";
$deli = '';
$tipo = 1;
$wh = " and article_ref like '%*%' ";
$wh = " and not (article_ref like '%*%') ";
$wh = " and (article_ref like '%T %') ";
$wh = '';
$wh = " and article_publicado <> 'N' and article_publicado <> 'X' "; 
$wh = ''; 
		
$sql = "select * from articles 
		inner join sections on article_section = section_id
		where  articles.journal_id = '" . strzero($jid, 7) . "'
		$wh
		order by identify_type, article_ref
";
$rlt = db_query($sql);
$sx = '<table class="tabela00">';
$xsa = 'x';
$ta = 0;
$tt = 0;
while ($line = db_read($rlt)) {
	$sa = $line['title'];
	if ($sa != $xsa) {
		if ($ta > 0) {
			if ($tipo != 2)
				{ $sx .= '<TR>'; }
			$sx .= '<TD colspan=>' . $ta . '</td><td>trabalho(s)</th>';
			$ta = 0;
		}
		$sx .= '<TR><TD colspan=5><B> ' . $line['identify_type']. ' '.$line['title'] . '</B></td></th>';
		$xsa = $sa;
	}
	if ($tipo != 2) {
		$sx .= '<TR>';
		$sx .= '<TD>' . $line['identify_type'];
		$sx .= '<TD>' . $line['article_ref'];
		$sx .= '<TD>' . $line['article_title'];
		$sx .= '<TD>' . $line['article_publicado'];
		$sx .= '<TD>' . $line['article_3_keywords'];
		$sx .= '<TD>' . $line['article_id'];
	}
	$ln = $line;
	$ta++;
	$tt++;
}
$sx .= '<TR><TD colspan=5>total ' . $ta . '</td></th>';
$sx .= '<TR><TD colspan=5>total geral ' . $tt . '</td></th>';
$ta = 0;
$sx .= '</table>';
echo $sx;
//echo '<HR>';
//print_r($ln);
//exit;

require ("../foot.php");
?>