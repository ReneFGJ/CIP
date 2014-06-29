<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
$eve = $dd[1];


$sql = "update pibic_semic_avaliador set  psa_p04 = 'HIS' ";
$sql .= " where psa_p04 = 'HI' and psa_p05 = 'SEMIC19'";
//$rlt = db_query($sql);

//$sql = "delete from pibic_semic_avaliador where id_psa = 3192";
//$rlt = db_query($sql);

$sql = " select * from pibic_semic_avaliador ";
$sql .= " left join  pareceristas  on us_codigo = psa_p01 ";
$sql .= " left join  instituicoes  on us_instituicao = inst_codigo ";
$sql .= " left join  sections on psa_p04 = abbrev ";
$sql .= " left join  articles on (article_section = section_id)";
$sql .= " and (to_number(psa_p02,'999') = article_seq) and (articles.journal_id = 45) ";
//$sql .= " and (psa_p05 = '".$semic."') ";
///////////////////////// se avaliado único
//if (strlen($dd[1]) > 0)
//	{ $sql .= " where us_codigo = '".$dd[1]."' "; } else 
//	{ $sql .= " where psa_p05 = '".$semic."'  "; }
$sql .= " where article_publicado <> 'X' ";
///////////////////////////////////////////
$sql .= "order by abbrev, article_seq, psa_p03 ";
$rlt = db_query($sql);
$tot = 0;
$idx = "X";
echo '<H1>Trabalhos x Apresentação</H1>';
echo '<table width="100%" class="lt1">';
while ($line = db_read($rlt))
	{
	$tipoe = trim($line['psa_p05']);
	$tipo = trim($line['psa_p03']);
	if ($idv > 0) { echo '<p style="page-break-before: always;"></p>'; }
	$idv++;
	$aval = trim(trim($line['us_titulacao']).' '.trim($line['us_nome']));
	$titulo = trim($line['article_title']);
	$titulo = UpperCase(substr($titulo,0,1)).Lowercase(substr($titulo,1,400));
	$id = strzero($line['id_psa'],5).'-'.dv($line['id_psa']);
	$resumo = $line['article_abstract'];
	$autor = $line['article_author'];
	$idart = trim($line['abbrev']).strzero($line['article_seq'],2);
	$avaliador = trim($line['us_nome']);
	$ava = trim($line['psa_abe_1']);
	
	if (strlen($ava) > 0)
		{
		$ava = "avaliado";
		$cor = '<font color="#c0c0c0">';
		} else {
		$cor = '<font color="#000000">';
		}
	if ($idart != $idx)
		{
		echo '<TR><TD><B>'.$idart.'</TD>';
		echo '<TD colspan="5"><B>'.$titulo.'</TD>';
		$idx = $idart;
		}
	echo '<TR '.coluna().'><TD></TD>';
	echo '<TD>'.$cor.$tipoe.'</TD>';
	echo '<TD>'.$cor.$tipo.'</TD>';
	echo '<TD>'.$cor.$avaliador.'</TD>';
	echo '<TD>'.$cor.$id.'</TD>';
	echo '<TD align="center">'.$cor.$ava.'</TD>';
	echo '</TR>';
	$x = $line;
	}
echo '</table>';
require("foot.php");
?>