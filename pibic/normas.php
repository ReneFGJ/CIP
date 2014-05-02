<?
require("cab.php");
?>
<TABLE align="center" width="<?=$tab_max;?>" border="0" >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left">
<?
	$sql = "select * from ic_noticia where nw_ref = 'PIBIC_NORMA' and nw_idioma = '".$idioma_id."' ";
	$rrr = db_query($sql);
	if ($eline = db_read($rrr))
		{
		$sC = $eline['nw_titulo'];
		$texto = $eline['nw_descricao'];
		}
	echo '<h1>'.$sC.'</h1><font class="lt1">';
	echo mst($texto);
?>
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

<script>
function invi(obj)
{
<? for ($k=0;$k < count($sc1);$k++) { ?>
	if (obj==<?=$k;?>) { dsp<?=$k;?>.style.display = ''; }
<? } ?>
}
</script>
