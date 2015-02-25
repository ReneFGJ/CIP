<?
$debug = true;
$tabela = " articles ";
require("cab.php");
require($include.'sisdoc_autor.php');
require("../layout/classe/_class_artigos.php");
$journal_id = 67;
$jid = 67;
//	$sql = "delete from search where journal_id = 45";
//	$rrr = db_query($sql);

//	$sql =  "delete from autores ";
//	$sql = $sql . " where journal_id = ".$jid;
//	$rrr = db_query($sql);

	require($include."sisdoc_debug.php");
	
	if (strlen($dd[0])==0)
	{
	$sql = "select max(id_article) as art_id from ".$tabela.' as article ';
	$sql .= " left join search on article_id = id_article ";
	$sql .= " where article.journal_id = ".$journal_id;
	$sql .= " and sc_idioma isnull ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$dd[0] = $line['art_id'];
		}
	}

$debug = true;
////////////////////////////////////////////////////////
if (strlen($dd[0]) > 0)
{
	$id = $dd[0];
	$art = new artigo;
	$art->recupera_article($id);
	$art->indexar_autores();
	
	echo 'ID:'.$dd[0];
	echo '<META HTTP-EQUIV=Refresh CONTENT="2; URL=semic_indexar.php">';
}
require("foot.php");		
?>