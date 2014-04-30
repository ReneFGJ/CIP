<?php
require("cab.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');

require("../_class/_class_ic.php");
$ic = new ic;

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

$cp = 'pp_email, pp_email_1, pp_nome, id_article, article_title, article_autores ';
//$cp = '*';
$sql = "select count(*) as a, 0 as r from articles 
		left join pibic_professor on article_author_pricipal = pp_cracha
		where (article_publicado <> 'X') and journal_id = ".$jid."
		and ((article_dt_revisao isnull) or (article_dt_revisao < 20000101))
		union
		select 0, count(*) as R from articles 
		left join pibic_professor on article_author_pricipal = pp_cracha
		where (article_publicado <> 'X') and journal_id = ".$jid."
		and (article_dt_revisao > 20000101) 
		";
$rlt = db_query($sql);
$texto = '	';
$journal_id = $jid;

while ($line = db_read($rlt))
	{
		$tp = $tp + $line['a'];
		$tr = $tr + $line['r'];
	}
	
echo '<H1>Revisões</h1>';
echo '<h3>Abertas: '.$tp.'</h3>';
echo '<h3>Validados: '.$tr.'</h3>';
echo '<h3>Total: <B>'.($tr+$tp).'</B></h3>';
echo $hd->foot();
?>
