<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_windows.php");
$eve = $dd[1];



if ($eve == 'SEMIC') { $eve = "SEMIC19"; }
if ($eve == 'MP') { $eve = "MP13"; }
echo '<center>';

$sql = "select * from (";
$sql .= "SELECT count(*) as total, psa_p05, us_instituicao from (";
$sql .= "(select 1, psa_p05, us_instituição from pibic_semic_avaliador group by psa_p05, us_instituicao, psa_p01 ) as tabela01 ";
$sql .= " group by psa_p05, us_instituicao";
$sql .= ") as laboratorio ";
$sql .= " left join  instituicao  on us_instituicao = inst_codigo ";
$sql .= " order by psa_p05, inst_nome ";
//$rlt = db_query($sql);


$sql = "select count(*) as total, psa_p05, us_instituicao from ";
$sql .= "(select 1, psa_p05, psa_p01 from pibic_semic_avaliador group by psa_p05, psa_p01 ) as tabela01 ";
$sql .= " left join  instituicao  on us_instituicao = inst_codigo ";
$sql .= " group by psa_p05, us_instituicao";

$sql = "select count(*) as total, inst_nome, psa_p05 from ";
$sql .= "(select 1, psa_p05, psa_p01 from pibic_semic_avaliador group by psa_p05, psa_p01) as tabela01 ";
$sql .= " left join  pareceristas  on us_codigo = psa_p01 ";
$sql .= " left join  instituicao  on us_instituicao = inst_codigo ";
$sql .= " group by psa_p05, inst_nome";
$sql .= " order by psa_p05, inst_nome ";
$sql .= " ";
$rlt = db_query($sql);


while ($line = db_read($rlt))
	{
//	print_r($line);
//	echo '<HR>';
	$sx .= '<TR>';
	$sx .= '<TD>'.$line['psa_p05'].'</TD>';
	$sx .= '<TD>'.$line['inst_nome'].'</TD>';
	$sx .= '<TD>'.$line['total'].'</TD>';
	$sx .= '</TR>';
	}
echo '<table>';
echo $sx;
echo '</table>';
require("foot.php");
?>