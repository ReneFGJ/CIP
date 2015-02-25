<?
require('sisdoc_search.php');
$mostra_issue = 0;
$display = 15;
$formato = 1;
$AutorFormato = 1;
if ((strlen($dd[1]) > 0) and (strlen($acao) > 0))
	{
	$sql = "select * from search ";
	$sql = $sql . "inner join articles on search.article_id = id_article ";
	$sql = $sql . 'inner join issue on article_issue = id_issue ';
	$sql = $sql . 'inner join sections on article_section = section_id ';
	$sql = $sql .' where ';
	if (($acao == $bt1) or ($acao=="autobusca"))
		{
		$sx = array();
		$sql = $sql .' (search.journal_id = '.$jid.') and ';
		$sql = $sql . '('.buscatextual(UpperCaseSQL($dd[1])).')  ';
//		$sql = $sql .' (articles.journal_id <> 2) and ';
//		$sql = $sql .' (issue.issue_published = 1) ';
		}
	if (isset($dd[96]) and (strlen($dd[96])>0)) { $sql = $sql . ' and '.$dd[96].' '; }
//	if (isset($dd[97]) and (strlen($dd[97])>0)) 
//		{ $sql = $sql . $dd[96].' '; }
	if (isset($dd[98]) and (strlen($dd[98])>0)) 
		{ 
		if ($dd[98] ==3 ) {$sql = $sql . " and (search.sc_tipo = 'KW') "; }
		if ($dd[98] ==1 ) {$sql = $sql . " and (search.sc_tipo = 'TI') "; }
		if ($dd[98] ==2 ) {$sql = $sql . " and (search.sc_tipo = 'AU') "; }
		}	
	$sql = $sql . ' order by issue_year desc, issue_volume desc, issue_number desc ';
//	$sql = "select * from search ";
//	$sql .= " where journal_id = 45 ";
	$sql = $sql . ' limit ';
	$sql = $sql . $display;

	
	$result = db_query($sql);
	$line = db_read($result);
	$art=3;
	$mostra_issue = False;
	
	if (strlen($is_max) ==0){$is_max = "704"; }
	echo '<TABLE width="98%" border="0" align="center">';
	require('titulo_mostra_2a.php');
	}
?>