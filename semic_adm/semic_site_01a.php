<?php
require("cab_semic.php");

require("../_class/_class_semic.php");
$semic = new semic;

require("../_class/_class_artigos.php");
$ar = new artigos;

$jid = $semic->recupera_jid_do_semic();

$sql = "select * from ".$ar->tabela." 
		inner join sections on article_section = section_id 
		left join pibic_professor on article_author_pricipal = pp_cracha
		";
$sql .= " where ".$ar->tabela.".journal_id = '".$jid."'
			and article_publicado = 'S'
			order by article_internacional, identify_type, article_seq 
	
";
$sql .= " limit 2000 ";
$rlt = db_query($sql);
$xsec = '';
echo '<TT>';
$tot = 0;
while ($line = db_read($rlt))
	{
		$tot++;
		$sec = trim($line['title']);
		
		if ($sec != $xsec)
			{
				echo '<HR>'.$sec.'<HR>';
				$xsec = $sec;
			}
		echo $line['article_ref'];
		echo ' - '.$line['pp_centro'];
		echo '<BR>';
		//print_r($line);
		//exit;
		$ln = $line;
	}
echo '</TT>';
echo '<BR>-->'.$tot;
print_r($ln);
require("../foot.php");	
?>