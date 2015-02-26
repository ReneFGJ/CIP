<?
require("cab.php");
?>
<TABLE align="center" width="<?=$tab_max;?>" border="0" >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left">
<?
$sql = "select * from ic_noticia where nw_ref = 'PIBIC_CONTATO' ";
//and nw_journal = ".$jid;
$rrr = db_query($sql);
?>
<br/>
<font class="lt1">
<?
while ($eline = db_read($rrr))
	{
	echo mst($eline['nw_descricao']);
	echo '<BR><BR>';
	}
?>
</font>
<? require("foot.php"); ?>