<?
require("cab.php");

if (strlen($dd[1]) == 0)
{
?>
<BR><BR>
<table>
<TR><TD><form method="post"></TD></TR>
<TR><TD class="lt4">Buscar informações</TD></TR>
<TR><TD><input type="text" name="dd1" value="<?=$dd[1];?>" size="80" maxlength="200"></TD></TR>
<TR><TD align="right"><input type="submit" name="acao" value="Pesquisar >>>"></TD></TR>
<TR><TD></form></TD></TR>
</table>
<?
} else {
$sql = "select * from ";
}
require("foot.php");
?>