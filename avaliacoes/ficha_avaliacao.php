<?
require("db.php");
require($include.'sisdoc_autor.php');
$semic = $dd[10];
$tit1 = "XX SEMINÁRIO DE INICIAÇÃO CIENTÍFICA DA PUCPR";
$tit1 .= "<BR>";
$tit1 .= 'XIV mostra de pesquisa de pesquisa da Pós-Graduação';

$tit2 = "06,07 e 08 de novembro de 2012";
$aval = "Rene Faustino Gabriel Junior";
$id = "1231-1";
$titulo = "A AVALIÇÂO DAS DIVERSAS FRENTES EPISTEMOLÓGICA DO SABER CIENTÌFICO";
$idart = "COMP01";

$sql = " select * from pibic_semic_avaliador ";
$sql .= " left join  pareceristas  on us_codigo = psa_p01 ";
$sql .= " left join  instituicoes  on us_instituicao = inst_codigo ";
$sql .= " left join  sections on psa_p04 = abbrev ";
$sql .= " left join  articles on (article_section = section_id) and (to_number(psa_p02,'999') = article_seq)  and (psa_p05 = '".$semic."') ";
///////////////////////// se avaliado único
if (strlen($dd[1]) > 0)
	{ $sql .= " where us_codigo = '".$dd[1]."' "; } else 
	{ $sql .= " where psa_p05 = '".$semic."'  "; }
$sql .= " and article_publicado <> 'X' ";
///////////////////////////////////////////
$sql .= "order by abbrev, article_seq ";
echo $sql;

$rlt = db_query($sql);
$idv = 0;
while ($line = db_read($rlt))
	{
	$tipoe = trim($line['psa_p05']);
	$tipo = trim($line['psa_p03']);
	if ($idv > 0) { echo '<p style="page-break-before: always;"></p>'; }
	$idv++;
	$aval = trim(trim($line['us_titulacao']).' '.trim($line['us_nome']));
	$titulo = trim($line['article_title']);
	$id = strzero($line['id_psa'],5).'-'.dv($line['id_psa']);
	$resumo = $line['article_abstract'];
	$autor = $line['article_author'];
	$idart = trim($line['article_ref']);
	
	if (strlen(trim($titulo)) > 0)
		{
			echo '<BR>===>'.$tipo;
			print_r($line);
		//require("ficha_avaliacao_dados.php");
		}
	}


?>
<html>
<head>
	<title>:: FICHA DE AVALIAÇÃO</title>
	<link rel="STYLESHEET" type="text/css" href="css/letras.css">
</head>
<body class="lt2">

<?

?>

</body>
</html>
