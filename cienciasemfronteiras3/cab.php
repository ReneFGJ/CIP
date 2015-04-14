<?php
$include = '';
$edit_mode = 0;
require('db.php');
require('../cab_institucional.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_colunas.php');

/* Mensagens do sistema */
require("../_class/_class_message.php");
$file = '../messages/msg_'.$LANG.'.php';
global $edit_mode;
$edit_mode = $_SESSION['editmode'];

if (file_exists($file)) { require($file); } else { echo 'message not found '.$file; }

$link_pt = '<A HREF="'.page().'?idioma=pt_BR">';
$link_en = '<A HREF="'.page().'?idioma=en_US">';
?>

<head>
	<title>:: <?php echo $institution_name;?> :: PUCPR ::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>"/>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $institution_site;?>favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/letras.css" />
	
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery.corner.js"></script>
	<script type="text/javascript" src="../js/jquery.example.js"></script>
	<script type="text/javascript" src="../js/jquery.autocomplete.js"></script>
</head>

<center>
<DIV ID="content_TOP">
	<table width=100% cellpadding="0" cellspacing="0" border=0>
	<TR><TD>
	<img src="img/logo.png">
	<TD align="right">
	<img src="img/logo2.png" height="92">
	</TD></TR>
	</table>
	
	<table width=100% cellpadding="0" cellspacing="0" border=0>
		<TR align="center" class="topmenu2">
			<TD><a href="index.php" class="topmenu2"><?=msg('home');?></a></TD>
			<TD><a href="apresentacao.php" class="topmenu2"><?=msg('csf_mn_about');?></a></TD>
			<TD><a href="chamadas.php" class="topmenu2"><?=msg('csf_mn_calls');?></a></TD>
			<TD><a href="depoimento.php" class="topmenu2"><?=msg('csf_mn_vc');?></a></TD>
			<TD><a href="inscricoes.php" class="topmenu2"><?=msg('csf_mn_assing');?></a></TD>
			<TD><a href="acesso.php" class="topmenu2"><?=msg('csf_mn_access');?></a></TD>
			<TD><a href="faq.php" class="topmenu2"><?=msg('csf_mn_faq');?></a></TD>
			<TD><a href="contact.php" class="topmenu2"><?=msg('csf_mn_contact');?></a></TD>
		</TR>
	</table>		
</DIV>
<table width=750 cellpadding="0" cellspacing="0" border=0 class="lt0" align="center">
		<TR>
			<TD width="90%"></TD>
			<TD width="10%"><NOBR><?php echo $link_en;?>English</A> | <?php echo $link_pt;?>Portugues</A></NOBR></TD></TR>
</table>


