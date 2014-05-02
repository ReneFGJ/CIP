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

require('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

$pb->le('',$dd[0]);


echo '<table width="800" align="center"><TR><TD>';

echo '<font class="tabela00 lt3">
Prezados Orientadores
<BR><BR>
Estou preparando o relatório institucional do PIBIC e PIBITI, vigência 2012-2013 e 2013-2014. Uma informação bastante importante tem a ver com os resultados das pesquisas desenvolvidas tanto em termos de apresentação em Congressos (oral ou pôster), e publicações.
<BR><BR>Caso tenha alguma orientação que conseguiu atingir esse resultado por favor nos informe:
<BR><BR>
</font>';

echo $pb->mostar_dados();
$ln = $pb->line['pb_publicacao'];


if (strlen($acao) == 0)
	{
		for ($r=2;$r < 50;$r++)
		{
			if (substr($ln,$r,1) == '1') { $dd[$r] = '1'; echo '<BR>dd'.$r.'='.$dd[$r]; }
		}
		$dd[15] = $pb->line['pb_publicacao_desc'];	
	}

$cp = array(); 
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$A','','A orientação resultou em:',False,True));
array_push($cp,array('$C1','','nenhuma publicação em periódico, evento ou patente',False,True));
array_push($cp,array('$C1','','apresentado em evento nacional',False,True));
array_push($cp,array('$C1','','apresentado em evento internacional',False,True));
array_push($cp,array('$C1','','publicação em revista A1',False,True));
array_push($cp,array('$C1','','publicação em revista A2',False,True));
array_push($cp,array('$C1','','publicação em revista B1',False,True));
array_push($cp,array('$C1','','publicação em revista B2',False,True));
array_push($cp,array('$C1','','publicação em revista B3',False,True));
array_push($cp,array('$C1','','publicação em revista B4',False,True));
array_push($cp,array('$C1','','publicação em revista B5',False,True));
array_push($cp,array('$C1','','geração uma requisição de Patente',False,True));
array_push($cp,array('$C1','','num produto/serviço',False,True));

array_push($cp,array('$A','','Descreva os eventos ou periódicos que foram publicados',False,True));

array_push($cp,array('$T60:6','','',False,True));

array_push($cp,array('$B8','','Finalizar questionário >>>',False,True));

$tela = $form->editar($cp,'');

$rs = '';
for ($r=0;$r < count($cp);$r++)
	{
		if (strlen($dd[$r]) > 0)
			{ $rs .= '1'; } else { $rs .= '0'; }		
	}



if ($form->saved > 0)
	{
		$pb->atualiza_publicacao($dd[0],$rs,$dd[15]);
		redirecina('_survey.php');
	} else {
		echo $tela;		
	}


echo '</table>';
function msg($x) { return($x); }

echo 'FIM';	
?>