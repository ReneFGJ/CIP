<?
require("db.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");

$sistema = "RE<SUP>2</SUP>ol";
$sistema_link = '<A HREF="http://www.sisdoc.com.br" class="lt1">';
$versao = "v2.11.25";
$bgcolor = '#FFFFFF';
$cab_sigla = 'PIBIC/PIBITI/PIBIC Jr';
$site_titulo = "Programa de Iniciação Científica, Tecnológica e Inovocação";
$cab_nome = $site_titulo;

/* Parametros */
$secu_main = $secu;
$secu = "pibicpr2010";
$email_adm="pibicpr@pucpr.br";
$emailadmin = $email_adm;
$email_nome='"PIBIC (PUCPR)"';
$admin_nome=$email_nome;
$tab_max = '98%';

/* Dados do usuário */
$user_nome = 'Professor';
$user_nivel = '1';

$cabnav = array();
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$site_titulo;?></title>
	<link rel="STYLESHEET" type="text/css" href="css/letras.css">	
<style>
  body { 
  font-family: Verdana, Arial, sans-serif; font-size: 12px; margin: 10px;
	background-image : url(img/bg_<?=LowerCase($cab_sigla);?>.jpg);
	background-position : top;
	background-repeat : repeat-x;
	background-color : <?=$bgcolor;?>;
	margin-bottom : 0px;	
	margin-top : 0px;	
  }
.title_cab
	{
	font-family : "Times New Roman";
	font-size : 14px;
	color : #1f1f1f;	
	}	
legend.no-expand-all{padding:12px 15px 4px 10px;margin:0 0 0 -12px;} 
legend {color:#333333;padding:4px 15px 4px 10px;margin:4px 12px 8px 8px;_margin-top:0px; 
 border-top:1px solid #EDEDED;border-left:1px solid #EDEDED;border-right:1px solid #969696; 
 border-bottom:1px solid #969696;background:#E7ECF0;font-weight:bold;font-size:1em;} 
.content-container {width:96%;margin-top:8px;padding:10px;position:relative; font-size:10px; } 
</style>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0">
<table width="100%" align="center" cellpadding="3" cellspacing="0" bgcolor="<?=$cab_bg;?>">
<TR valign="top" class="title_cab">
	<td width="10">&nbsp;</td>
	<TD><img src="img/logo_instituicao.gif" width="73" height="84" alt="" border="0"></TD>
	<TD align="right"><font size="5"><?=$cab_sigla;?></font><BR><?=$cab_nome;?><BR><I><?=$cab_slogan;?></I><BR><?=$user_nome.' ('.$user_nivel.') '.$user_log;?></TD>
	<td width="10">&nbsp;</td>
</TR>
</table>
<? require("submissao_cab_top_menu.php"); ?><center>
