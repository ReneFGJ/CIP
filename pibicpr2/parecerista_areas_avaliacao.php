<?
require($include."sisdoc_debug.php");

//$sql = "update pibic_semic_avaliador set psa_p05 = 'MP13' where psa_p05 = 'MP12' and id_psa > 2700 ";
//$rlt = db_query($sql);

//$sql = "delete from pibic_semic_avaliador where psa_p05 = 'MP12' ";
//$rlt = db_query($sql);
$sql = "select * from sections where journal_id = 67 order by abbrev";
$rlt = db_query($sql);
$op = '';
$opi = '';
while ($line = db_read($rlt))
	{
		$op .= '<option value="'.$line['abbrev'].'">'.$line['abbrev'].'</option>'.chr(13);
		$opi .= '<option value="i'.$line['abbrev'].'">i'.$line['abbrev'].'</option>'.chr(13);
	}
$op .= $opi;
?>
<table bgcolor="#FFE1FF" width="<?=$tab_max;?>">
<TR><TD><form method="post"></TD></TR>
<TR><TD colspan="4" class="lt2"><B>Indicação de parecerista para o seminário</B></TD></TR>
<TR>
<TD><nobr>
<select name="dd52" size="1">
<option value="<?=$dd[52];?>"><?=$dd[52];?></option>
<?=$op;?>
</select>
<input type="text" name="dd30" size="5" maxlength="5" value=""></TD>
<TD><select name="dd31" size="1">
<option value="<?=$dd[31];?>"><?=$dd[31];?></option>
<option value="Oral">Oral</option>
<option value="Poster">Poster</option>
</select></TD>
<TD><select name="dd32" size="1">
<option value="<?=$dd[32];?>"><?=$dd[32];?></option>
<option value="SEMIC21">SEMIC21</option>
<option value="MP15">MP15</option>
</select></TD>
<TD><input type="submit" name="adicionar >>"></TD>
<TD width="80%"></TD>
</TR >
<TR><TD></form></TD></TR>
</table>

<?
if ((strlen($dd[30]) > 0) and (strlen($dd[31]) > 0) and (strlen($dd[32]) > 0))
	{
	$sql = "insert into pibic_semic_avaliador ";
	$sql .= "(psa_p01,psa_p02,psa_p03,";
	$sql .= " psa_p04,psa_p05,psa_p06,";
	$sql .= "psa_abe_1, psa_abe_2, psa_abe_3, ";
	$sql .= "psa_abe_4, psa_abe_5 )";
	$sql .= " values ";
	$sql .= "('".strzero($dd[0],7)."','".$dd[30]."','".$dd[31]."',";
	$sql .= "'".$dd[52]."','".$dd[32]."','',";
	$sql .= "'','','',";
	$sql .= "'','')";
	$rlt = db_query($sql);
	}

if ($dd[21] == 'DEL')
	{
	$sql = "delete from pibic_semic_avaliador where id_psa = ".$dd[20];
	$rlt = db_query($sql);	
	}
		
$sql = "select * from pibic_semic_avaliador where psa_p01 = '".strzero($dd[0],7)."'  ";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$link = '<A HREF="parecerista_areas.php?dd0='.$dd[0].'&dd20='.$line['id_psa'].'&dd21=DEL">[del]</A>';
	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD>';
	$sx .= $line['psa_p04'];
	$sx .= '<TD>';
	$sx .= $line['psa_p02'];
	$sx .= '<TD>';
	$sx .= $line['psa_p03'];
	$sx .= '<TD>';
	$sx .= $line['psa_p05'];
	$sx .= '<TD>';
	$sx .= $link;
	}
?>
<table width="<?=$tab_max;?>" class="lt1">
	<?=$sx;?>
</table>