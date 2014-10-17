<?
require ("cab.php");
/////////////////////////////////////////////////// MANAGERS
echo $hd -> menu();
echo '<div id="conteudo">';
echo $hd -> main_content('Artigos Duplicados');

$sql = "select asc7(Upper(article_title)) as titulo, id_article from articles 
			where journal_id = $jid 
			and article_publicado = 'S'
			order by titulo
";
$rlt = db_query($sql);
$xtit = '';
$sx = '<table class="tabela00">';
$id = 0;
while ($line = db_read($rlt)) {
	$tit = trim($line['titulo']);
	//echo $tit . '<BR>';
	$link = '<A HREF="article_editar.php?dd0='.$line['id_article'].'" target="_new">';
	if ($tit == $xtit) {
		$id++;
		$sx .= $sa;
		$sx .= '<TR>';
		$sx .= '<TD>';
		$sx .= '<font color="red">';
		$sx .= $link.$line['id_article'].'</a>';
		$sx .= '</font>';
		$sx .= '<TD>';
		$sx .= $line['titulo'];
	}

	$sa = '<TR>';
	$sa .= '<TD>';
	$sa .= '<font color="red">';
	$sa .= $link.$line['id_article'].'</a>';
	$sa .= '</font>';
	$sa .= '<TD>';
	$sa .= $line['titulo'];
	$xtit = $tit;
}
$sx .= '<TR><TD colspan=2>Total de ' . $id;
$sx .= '</table>';
echo $sx;
echo '</div>';

require ("foot.php");
?>