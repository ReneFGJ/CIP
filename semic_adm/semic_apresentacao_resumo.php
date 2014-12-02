<?php
require("cab_semic.php");

$sql= "select sum(oral) as oral, sum(poster) as poster, count(*) as total from (";
$sql .= "select 1 as oral,0 as poster, article_ref from articles where 
			journal_id = ".$jid." and article_publicado = 'S' and article_ref like '%*%' 
		";
$sql .= " union ";
$sql .= "select 0 as oral,1 as poster, article_ref from articles where 
			journal_id = ".$jid." and article_publicado = 'S' and not (article_ref like '%*%') 
		";
$sql .= ") as tabela ";
		$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		print_r($line);
	}

/* Áreas de apresentação */

$sql = "select * from articles 
			inner join sections on article_section = section_id
			where articles.journal_id = ".$jid." and article_publicado = 'S' 
	 		and (identify_type like '1%' or identify_type like '3%') and article_3_keywords like 'MS%'
		";
$rlt = db_query($sql);
$tot = 0;

while ($line = db_read($rlt))
	{
		$tot++;	
	}
echo '<h1>'.$tot.'</h1>';
require("../foot.php");	
?>