<?
$login = 1;
$nocab = 'PR';
require("db.php");
require($include."sisdoc_security.php");
$err = login_id();

?>
  <title><?=$site_titulo;?></title>
  <link rel="SHORTCUT ICON" href="favicone.ico" type="image/x-icon" />
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <link rel="stylesheet" href="letras.css" type="text/css" />  
  <style type="text/css">
  body { 
  font-family: Verdana, Arial, sans-serif; font-size: 12px; margin: 10px;
	background-image : url(img/bg_<?=LowerCase($cab_sigla);?>_login.jpg);
	background-position : top;
	background-repeat : repeat-x;  
	margin-bottom : 0px;	
	margin-top : 0px;	
  }
  DIV { border : medium solid White; color: Black; font-size: 12px; font-family:arial,sans-serif; }   
  .lt6 { font-family: Georgia,Times New Roman; font-size: 32px; color: #950000; text-decoration: none }
  </style>
<body topmargin="0"  leftmargin="0" rightmargin="0" bgcolor="<?=$login_bg;?>">
<TABLE cellpadding="0" cellspacing="0" width="790" align="center" border="10" background="img/bg_login.jpg">
<TR valign="top">
<TD colspan="1"><FONT class="lt4"><CENTER><?=$site_titulo;?></CENTER></FONT></TD>
<TD width="20">&nbsp;</TD>
<TD valign="middle" width="360" align="center" bgcolor="#303030" >
<BR><BR><BR><BR><BR><BR>
<CENTER>
  <font class="lt2">
  </font>
  <TABLE class="lt1" align="center" width="290" cellpadding="0" cellspacing="0"> 
  <TR><TD colspan="2"><img src="img/bg_login_top.png" width="290" height="17" alt="" border="0"></TD></TR>
  <TR bgcolor="#FFCF08"><TD colspan="2" align="center"><b>Acesse sua conta
<form method="post" action="login.php"></TD></TR>
  <TR bgcolor="#FFCF08">
  <TD align="right">usuário:&nbsp;</TD>
  <TD><input type="text" name="dd1" value="<?=$dd[1];?>" size="20" maxlength="50"></TD></TR>
  <TR bgcolor="#FFCF08">
  <TD colspan="2" class="lt0">&nbsp;</TD>
  <TR bgcolor="#FFCF08">
  <TD align="right">senha:&nbsp;</TD>
  <TD><input type="password" name="dd2" value="" size="20" maxlength="50"></TD></TR>
  </TR>
  <TR bgcolor="#FFCF08">
  <TD colspan="2" class="lt0">&nbsp;</TD>
  <TR bgcolor="#FFCF08"><TD colspan="2" align="center"><font color="RED"><?=$err;?><FONT>
  <TR bgcolor="#FFCF08">
  <TD>&nbsp;</TD>
  <TD><input type="submit" name="acao" value="Acessar"></TD>
  </TR>
  <TR bgcolor="#FFCF08"><TD></form></TD></TR>
  <TR bgcolor="#FFCF08"><TD colspan="2">&nbsp;<font color="red"></font>&nbsp;</TD></TR>
  <TR><TD colspan="2"><img src="img/bg_login_botton.png" width="290" height="17" alt="" border="0">	</TD></TR>
  </TABLE>
<BR><BR>
<img src="img/bg_border_login.png" width="360" height="17" alt="" border="0">
<TR><TD colspan="3"><CENTER><BR>
<font class=lt1>Este é o site da <?=$site_titulo;?> para relacionamento com seus parceiros, 
<BR>caso estaja com problemas de acesso, 
<BR>entre em contato pelo e-mail <A HREF="mailto:<?=$email_adm?>"><?=$email_adm;?></A><BR>&nbsp;</font></TD></TR>
</TABLE>	