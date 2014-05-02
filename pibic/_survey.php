<?php
$include = '../';
require("../db.php");
echo '
<head>
<META HTTP-EQUIV=Refresh CONTENT="3600; URL=http://www2.pucpr.br/reol/logout.php">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="description" content="">
<link rel="shortcut icon" type="image/x-icon" href="http://www2.pucpr.br/reol/favicon.ico" />
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_cabecalho.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_midias.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_body.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_fonts.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_botao.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_table.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_font_roboto.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_font-awesome.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_form.css">
<script language="JavaScript" type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery-1.7.1.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery.corner.js"></script>
<title>CIP | Centro Integrado de Pesquisa | PUCPR</title>
</head>
';
require($include.'sisdoc_data.php');

require($include.'_class_form.php');
$form = new form;

require('../_class/_class_docentes.php');
$doc = new docentes;

if ((strlen($dd[0]) > 0) and (strlen($dd[90]) > 0))
	{
		redirecina('_survey_01.php?dd0='.$dd[0].'&dd90='.$dd[90]);
		exit;
	}

if (strlen($dd[50]) > 0)
	{
		$_SESSION['professor'] = $dd[50];
		$professor = $dd[50];
		//'88888951';
	} else {
		$professor = $_SESSION['professor'];
	}

$doc->le($professor);


require('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

$pb->le('','0007176');

echo '<table width="800" align="center"><TR><TD>';

echo '<font class="tabela00 lt3">
Prezados Orientadores
<BR><BR>
Estou preparando o relatório institucional do PIBIC e PIBITI, vigência 2012-2013 e 2013-2014. Uma informação bastante importante tem a ver com os resultados das pesquisas desenvolvidas tanto em termos de apresentação em Congressos (oral ou pôster), e publicações.
<BR><BR>Caso tenha alguma orientação que conseguiu atingir esse resultado por favor nos informe:
<BR><BR>
</font>';

/* */
echo $doc->mostra_dados();

$sql = "select * from ".$pb->tabela." 
		inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo
		where pb_professor = '".$professor."' 
		and pb_status <> 'C'
		order by pb_ano desc
		";
$rlt = db_query($sql);

echo '<table width="100%">';
while ($line = db_read($rlt))
	{
		echo $pb->mostra_registro($line);		
	}
echo '</table>';





?>