<?php
    require("cab_semic.php");
	
	/* FASE I */
	$sql = "select * from articles 
			where journal_id = 85
			and article_publicado = ''	
			order by article_autores
	";
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
		{
			echo '<BR>';
			echo $line['article_ref'].' ';
			echo '['.$line['article_publicado'].'] ';
			echo $line['article_autores'];
			$sql = "update articles set article_publicado = 'S' where id_article = ".$line['id_article'];
			echo $sql;
			//$rrr = db_query($sql);
		}
	
	$sql = "select * from articles 
			where journal_id = 85	
			and article_autores like '%[confirmar]%'
			and article_publicado = 'S'
			order by article_autores
	";
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
		{
			echo '<BR>';
			echo $line['article_ref'].' ';
			echo '['.$line['article_publicado'].'] ';
			echo $line['article_autores'];
			$sql = "update articles set article_publicado = 'N' where id_article = ".$line['id_article'];
			$rrr = db_query($sql);
		}
?>