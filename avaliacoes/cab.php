<?
require("db.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_security.php");
require('cab_navegacao.php');

security();
$sistema = "RE<SUP>2</SUP>ol";
$sistema_link = '<A HREF="http://www.sisdoc.com.br" class="lt1">';
$versao = "v2.10.37";
$user_id = read_cookie('nw_user');
$user_nome = read_cookie('nw_user_nome');
$user_nivel = read_cookie('nw_nivel');
$user_log = read_cookie('nw_log');
$jid = 55;
$cabnav = array();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?=$site_titulo;?></title>
	<link rel="STYLESHEET" type="text/css" href="css/letras.css">	
</head>
<style>
BODY {
	font-family : "MS Sans Serif", Geneva, sans-serif;
	font-size : 12px;
	color : 1f1f1f;
	background-image : url(img/bg_<?=trim(lowercase($cab_sigla));?>.png);
	background-position : top;
	background-repeat : repeat-x;
	
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
<body topmargin="0" leftmargin="0" rightmargin="0">
<table width="100%" background="img/bg_cab.jpg" align="center" cellpadding="0" cellspacing="3" bgcolor="<?=$cab_bg;?>" style=""background-image : url(img/bg_cab.jpg);>
<TR valign="top" class="title_cab">
	<TD><img src="img/logo_instituicao.gif" alt="" border="0"></TD>
	<TD align="right"><font size="5"><?=$cab_sigla;?></font><BR><?=$cab_nome;?><BR><I><?=$cab_slogan;?></I><BR><?=$user_nome.' ('.$user_nivel.') '.$user_log;?></TD>
</TR>
</table>
<? require("cab_top_menu.php"); ?><CENTER>
