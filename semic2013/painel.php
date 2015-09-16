<?php
session_start();
ob_start();	
$dd = array('','','','','','','');
$dd[2] = strtoupper($_GET['dd2']);
$tb = $dd[2];
require("painel_busca.php");
$dd[1]=$layout;
require("layout_poster.php")
?>
<head>
<META HTTP-EQUIV=Refresh CONTENT="60; URL=http://www2.pucpr.br/reol/semic/painel.php">
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
<title>SEMIC | PUCPR</title>
</head>
				<script type="text/javascript">
				  var _gaq = _gaq || [];
  				_gaq.push(['_setAccount', 'UA-12712904-7']);
  				_gaq.push(['_trackPageview']);
				  (function() {
    			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				  })();
				</script>
<body style="font-family: 'Roboto, Arial, Tahoma, Verdana'; Size: 12px;">
<style>
	.blue
		{
			background-color: red;
			border: 6px solid red;
		}
</style>
<script>
	$("#<?=$p;?>").addClass("blue");
</script>
<?
if (strlen($d) > 0)
	{
		echo '<font color="blue"><B>';
		echo $tb.' apresentação dia ';
		echo $d.', localização: painel nº '.$p;
		echo ' (sessão '.$layout.')';
		echo '</B></font>';
	} else {
		echo '&nbsp;<BR>';
	}
?>
<center>
	<form action="painel.php" method="get">
	Para localizar a posição de seu trabalho, informe o código (ex: MEDVET01):
	<input type="text" size=20 maxlength="18" name="dd2">
	&nbsp;
	<input type="submit" value="localizar >>>" name="acao">
	</form>
</center>
