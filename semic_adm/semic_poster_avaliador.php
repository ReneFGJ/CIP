<?php
require("cab_semic.php");
$jid = 85;

$sql = "select * from semic_blocos where  blk_codigo = '".$dd[0]."' 
";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
		echo '<h1>'.$line['blk_titulo'].'</h1>';
	}
	
$sql = "select * from pareceristas 
		left join (select count(*) as total, st_avaliador_1 from semic_trabalhos group by st_avaliador_1 ) as tabela on st_avaliador_1 = us_codigo
		where us_journal_id = ".$jid."  and us_ativo = 1 and us_aceito = 10
			order by us_nome
			limit 1000";
$rlt = db_query($sql);
$it = 0;
echo '<table width="100%">';

while ($line = db_read($rlt))
	{
		$it++;
		echo '<TR><TD>';
		$link = '<A HREF="semic_poster_indicacao.php?dd1='.$dd[0].'&dd2='.$line['us_codigo'].'">';
		echo '<TD>';
		echo round($line['total']);
		echo '<TD>';
		echo $link.$line['us_nome'];
		echo '</A>';
	}
echo '</table>';
echo '<BR>TOTAL:'.$it;
require("../foot.php");	
?>