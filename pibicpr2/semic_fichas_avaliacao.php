<?php
$d0 = $_GET['dd0'];
if (strlen($d0) > 0)
	{
		require("db.php");
	} else {
		require("cab.php");
	}
require("../_class/_class_semic.php");
require($include.'sisdoc_autor.php');

$sm = new semic;
			$evento = 'SEMIC21';
			$mostra = 'MP15';

if (strlen($dd[0]) == 0)
	{
		echo $sm->ficha_de_avaliacao_por_avaliador();
		exit;
	}			
$rlt = $sm->mostra_ficha_de_avaliacao_por_avaliador($dd[0]);



$semic = $dd[10];
$tit1 = "XXI SEMINÁRIO DE INICIAÇÃO CIENTÍFICA DA PUCPR";
$tit1 .= "<BR>";
$tit1 .= 'XV Mostra de Pesquisa da Pós-Graduação';

$tit2 = "22, 23 de 24 de novembro de 2013";
$aval = "Rene Faustino Gabriel Junior";
$id = "1231-1";
$titulo = "A AVALIÇÂO DAS DIVERSAS FRENTES EPISTEMOLÓGICA DO SABER CIENTÌFICO";
$idart = "COMP01";

$id = "1231-1";
$titulo = "A AVALIÇÂO DAS DIVERSAS FRENTES EPISTEMOLÓGICA DO SABER CIENTÌFICO";
$idart = "COMP01";
echo '<CENTER>';
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
			require("ficha_avaliacao_dados.php");
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

