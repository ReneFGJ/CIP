<?
require($include.'sisdoc_search.php');
$chk = array('','','','','','');
if (strlen($dd[51]) == 0) { $chk[0] = 'checked'; } else
	{ $chk[$dd[51]] = 'checked'; }
?>
<table align="center">
<TR><TD><form method="post"></TD></TR>
<TR><TD class="lt1">Busca em</TD></TR>
<TR><TD>
<input type="text" name="dd50" value="<?=$dd[50];?>" style="font-size: 26px; width: 600px;">
</TD><TD><input type="submit" name="dd52" value="Buscar >>>" style="height: 40px;"></TD></TR>
<TR><TD class="lt0">
<input type="radio" name="dd51" value="0" <?=$chk[0];?> >Todos&nbsp;&nbsp;
<input type="radio" name="dd51" value="1" <?=$chk[1];?> >Docentes&nbsp;&nbsp;
<input type="radio" name="dd51" value="2" <?=$chk[2];?> >Discentes&nbsp;&nbsp;
<input type="radio" name="dd51" value="3" <?=$chk[3];?> >Títulos dos projetos/Bonificações&nbsp;&nbsp;
</TD></TR>
<TR><TD></form></TD></TR>
</table>

<?

if (($dd[51] == '0') or ($dd[51]=='3'))
	{
		require('main_busca_03.php');
	}

?>