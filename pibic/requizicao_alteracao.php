<?
require("cab.php");
require($include."sisdoc_debug.php");
?>
<TABLE align="center" width="<?=$tab_max;?>" border=0 >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left" class="lt2">
Bem vindo prof.(a) <B><?=$nome;?></B>.<BR>Cod. funcional: <B><?=$id_pesq;?></B><BR>
<BR>
<??>
<CENTER>Formulário não disponível</CENTER>
<? // require("submit_menu_right.php");?>
<TD width="210">
<? require("resume_menu_left_projetos.php");?>
<BR>
<? // require("resume_menu_left.php");?>
<BR>
<? require("resume_menu_left_3.php");?>
<BR>
<? require("resume_menu_left_2.php");?>
<BR>
<? require("resume_menu_left_mail.php");?>

</table>
<?
require("foot_body.php");
require("foot.php");
?>