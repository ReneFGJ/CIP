<?
session_start();
ob_start();

$include = '../';
require("../db.php");
require("../cab_institucional.php");
require($include.'sisdoc_data.php');
require('../_class/_class_message.php');
require("../_class/_class_pareceristas.php");

require("../_class/_class_parecer_pibic.php");
$parecer_pibic = new parecer_pibic;
require("../editora/_class/_class_parecer_model.php");
$parecer_model = new parecer_model;
$par = new parecerista;

$msg = '../messages/msg_pt_BR.php';
$LANG="pt_BR";
require($msg);
$par->security();

?>

<header>
	<title>:: Portal do Avaliador Acadêmico</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/avaliador/css/style_avaliador.css">
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_body.css">
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_botao.css">
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_cabecalho.css">
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_font_roboto.css">
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_table.css">
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_avaliador.css">
	
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_fonts.css" type="text/css" />	
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_editora.css" type="text/css" />
	<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_table.css" type="text/css" />
	
	<script language="JavaScript" src="../js/jquery-1.7.1.js"></script>
	<script language="JavaScript" src="../js/jquery.corner.js"></script>
</header>

<?
if ((strlen($par->nome) == 0) and (strlen($dd[0])==0))
	{
		echo '<CENTER>';
		echo '<H1>Sessão expirada</h1>';
		echo '<h2>Sua sessão expirou, acesse novamente pelo link recebido no e-mail</h2>';
		exit;	
	}
?>
<table width="98%" border=0 cellpadding="10" cellspacing="0" class="tabela00">
<TR><TD colspan="3">	
	<div class="fields" id="fields" style="display: none;">
		<table width="100%" cellpadding="0" cellspacing="3">
		<TR valign="top"><TD>
			<img src="<?php echo http; ?>img/logo-cip.png" height="50" align="left">
			<font color="#000000">&nbsp;&nbsp;
			<font style="font-size:28px;">
			<I>Portal do Avaliador</I></font>
		<TD align="right">
			<font color="#000000">
			<font style="font-size:12px;">
			avaliador: <B><?php echo $par->nome; ?></B><BR>
			instituição: <B><?php echo $par->instituicao; ?></B>
		</TR>
		</table>
	</div>
</TD></TR>

<TR valign="top"><TD width=180 >
<div id="menu_left">
	<table width=100% cellpadding="3" cellspacing="0">
	<TR><TH>menu principal
	<TR><TD align="center"><A href="main.php" class="dul">Página Inicial</A>
	<TR><TD align="center"><A href="my_account.php" class="dul">Meus dados</A>
	<TR><TD align="center"><A href="declaracao.php" class="dul">Declarações de avaliador</A>
	</table>
</div>
</div>
</TD><TD>
<div id="content">

<script>
	var tela = $('#fields').corner();	
	var tela = $('#fields').fadeIn('slow', function() { });		
	var tela = $('#menu_left').corner();	
	var tela = $('#content').corner();	
</script>
