<?
$login = 1;
$nocab = 'PR';
require("db.php");
require($include."sisdoc_security.php");
$err = login_id();

?>
  <title><?=$title;?></title>
  <link rel="SHORTCUT ICON" href="favicone.ico" type="image/x-icon" />
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <link rel="stylesheet" href="letras.css" type="text/css" />  
  <style type="text/css">
  body { 
  font-family: Verdana, Arial, sans-serif; font-size: 12px; margin: 10px;
	background-image : url(img/bg_<?=LowerCase($cab_sigla);?>_login.jpg);
	background-position : top;
	background-repeat : repeat-x;  
  }
  DIV { border : medium solid White; color: Black; font-size: 12px; font-family:arial,sans-serif; }   
  .lt6 { font-family: Georgia,Times New Roman; font-size: 32px; color: #950000; text-decoration: none }
  </style>
  <body topmargin="0" bgcolor="<?=$login_bg;?>">
<TABLE cellpadding="0" cellspacing="0" width="790" height="540" align="center" border="0" background="2img/bg_login.jpg">
	<TR><TD colspan="3"><FONT class="lt4"><CENTER><?=$site_titulo;?></CENTER></FONT></TD></TR>
<TR class="lt2"><TD>&nbsp;</TD></TR>
<TR valign="top"><TD valign="middle" width="320" >
<BR><CENTER>

<TD width="20">&nbsp;</TD>
<TD width="300">
<BR><BR><BR><BR><BR><BR><BR><BR>
<DIV style="width:300"><CENTER>
  <font class="lt2">
  Acesse sua conta
  </font>
  <TABLE class="lt1" align="center" width="250">
  <TR><TD><form method="post" action="login.php"></TD></TR>
  <TR>
  <TD align="right">usuário:&nbsp;</TD>
  <TD><input type="text" name="dd1" value="<?=$dd[1];?>" size="20" maxlength="50"></TD></TR>
  <TR>
  <TD align="right">senha:&nbsp;</TD>
  <TD><input type="password" name="dd2" value="" size="20" maxlength="50"></TD></TR>
  </TR>
  <TR><TD colspan="2" align="center"><font color="RED"><?=$err;?><FONT>
  <TR>
  <TD>&nbsp;</TD>
  <TD><input type="submit" name="acao" value="Acessar"></TD>
  </TR>
  <TR><TD></form></TD></TR>
  <TR><TD colspan="2">&nbsp;<font color="red"></font>&nbsp;</TD></TR>
  </TABLE>
</DIV>
</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD colspan="3"><CENTER><BR>
<font class=lt1>Este é o site da <?=$site_titulo;?> para relacionamento com seus parceiros, 
<BR>caso estaja com problemas de acesso, 
<BR>entre em contato pelo e-mail <A HREF="mailto:<?=$email_adm?>"><?=$email_adm;?></A><BR>&nbsp;</font></TD></TR>
<TR><TD height="30%">&nbsp;</TD></TR>

</TABLE>	