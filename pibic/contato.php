<?
require("cab.php");
?>
<TABLE align="center" width="<?=$tab_max;?>" border="0" >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left">
<?
$sql = "select * from ic_noticia where nw_ref = 'PIBIC_CONTATO' and nw_idioma = '".$idioma_id."' ";
//and nw_journal = ".$jid;
$rrr = db_query($sql);
?>
<br/>
<font class="lt1">
<?
if ($eline = db_read($rrr))
	{
	echo mst($eline['nw_descricao']);
	}
?>
</font>
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
<? require("foot.php"); ?>