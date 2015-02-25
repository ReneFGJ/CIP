<?
	$tit1 = $line['article_title'];
	$tit1 .= $line['article_3_title'];
	$tit1 .= $line['article_keywords'];
	$tit1 .= $line['article_author'];
	$id = $dd[0];
	$tit1 = uppercasesql($tit1);
	
//	$sql = "delete from search where journal_id = 45";
//	$rrr = db_query($sql);

	$sql = "insert into search (sc_tipo,journal_id,sc_idioma,sc_texto,sc_texto_asc,article_id) values ";
	$sql = $sql . "('GE','".$jid."','pt_BR','".$tit1."','".$tit1."','".$id."')";
	$rrr = db_query($sql);
	
	echo '<BR><BR>Gravado !!!';
	
?>
