<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require("../cab_institucional.php");
require($include.'sisdoc_breadcrumb.php');
?><head>
	<title>::CIP::</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="STYLESHEET" type="text/css" href="../css/letras.css">	
</head><?
require('../security.php');
$user = new usuario;
$tela = $user->Security();

$sistema = "RE<SUP>2</SUP>ol";
$sistema_link = '<A HREF="http://www.sisdoc.com.br" class="lt1">';
$versao = "v2.10.37";
$cabnav = array();
$cab_bg="#108010";
$cab_sigla = "CSF";
$cab_nome = 'Ci�ncia Sem Fronteiras - PUCPR';
$cab_slogan = 'Estude no Exterior';

$user_nome = $user->user_nome;
$user_nivel = $user->user_nivel;
$user_log = $user->user_login;
$cab_menu_bg = '#A0A0A0';
$tab_max = "95%";
?>
<style>  
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
<table width="100%" align="center" cellpadding="3" cellspacing="0" background="img/logo_project_bg.png" bgcolor="<?=$cab_bg;?>">
<TR valign="top" class="title_cab">
	<td width="10">&nbsp;</td>
	<TD><img src="../cip/img/logo_instituicao.gif" width="73" height="84" alt="" border="0"></TD>
	<TD align="right"><font size="5" COLOR="white"><?=$cab_sigla;?></font><BR>
		<font color="#C0C0C0">
		<?=$cab_nome;?><BR><I><?=$cab_slogan;?></I><BR><?=$user_nome.' ('.$user_nivel.') '.$user_log;?></TD>
	<td width="10">&nbsp;</td>
</TR>
</table>
<? require("cab_top_menu.php"); ?><center>