<?

$bmenu = array();
array_push($bmenu,array('F.A.Q.','faq.php','Frequentes perguntas e respostas'));
array_push($bmenu,array('Entre em contato','contato.php','Entre em contato, d�vidas e sugest�es'));
array_push($bmenu,array('Normas de submiss�o','normas.php','Normas para submiss�o de manuscritos'));
array_push($bmenu,array('Atualizar meus dados','meusdados.php','Atualiza��o de meus dados'));
if (strlen($tplogin) == 0) {
	array_push($bmenu,array('<img align="absmiddle" src="img/icone_rss.png" width="32" height="29" alt="" border="0">RSS Submiss�o','faq.php?dd0=002','Acompanhe novidades de seus manuscritos por RSS '));
	}
$tab_titulo = "Informa��es";

if ($idioma == 2)
	{
	$bmenu = array();
	array_push($bmenu,array('F.A.Q.','faq.php','Frequent Answers and Questions'));
	array_push($bmenu,array('Contact us','contato.php','Entre em contato, d�vidas e sugest�es'));
	array_push($bmenu,array('Normas to submit','normas.php','Normas para submiss�o de manuscritos'));
	array_push($bmenu,array('To update my data','meusdados.php','Atualiza��o de meus dados'));
	array_push($bmenu,array('<img align="absmiddle" src="img/icone_rss.png" width="32" height="29" alt="" border="0">RSS Submit','faq.php?dd0=002','Acompanhe novidades de seus manuscritos por RSS '));
	$tab_titulo = "Information";

	}
?>
<table width="210" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF">
<TR align="center"><TD colspan="3" height="24" background="img/menu_top.jpg"><font class="lt2"><font color="white"><B><?=$tab_titulo;?></TD></TR>
<TR><TD width="5">
	<TD width="200">
	<table width="200" cellpadding="2" cellspacing="0">
	<?
	for ($kq=0; $kq < count($bmenu); $kq++)
		{ ?>
		<TR><TD valign="middle"><A class="lt1" HREF="<?=$bmenu[$kq][1];?>" title="<?=$bmenu[$kq][2];?>" ><?=$bmenu[$kq][0];?></A>
		<? } ?>
	</table>
	</TD>
</TABLE>
