<?
$include = '../';
require($include.'db.php');

require("../_class/_class_semic.php");
require("../_class/_class_message.php");

require($include.'_class_form.php');
$form = new form;
$semic->tabela = "semic_ic_trabalho";
$semic->tabela_autor = "semic_ic_trabalho_autor";

$sx = '
<head>
<META HTTP-EQUIV=Refresh CONTENT="3600; URL=http://www2.pucpr.br/reol/logout.php">
<meta name="description" content="">
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
echo $sx;
echo '<h1>Trabalho</h1>';
$semic = new semic;
$semic->tabela = "semic_ic_trabalho";
$semic->tabela_autor = "semic_ic_trabalho_autor";
$tabela = $semic->tabela;

$cp = array();
array_push($cp,array('$H8','id_sm','',False,True));
array_push($cp,array('$HV','',$dd[1],'',False,True));
array_push($cp,array('$T60:7','sm_'.$dd[1],'',False,True));
echo '<HR>';
echo $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		require("../close.php");
	}
?>


