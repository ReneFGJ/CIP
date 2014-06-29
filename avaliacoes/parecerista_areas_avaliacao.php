<?
require("cab.php");
		
$sql = "select * from pibic_semic_avaliador where psa_p01 = '".strzero($dd[0],7)."'  ";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$link = '<A HREF="parecerista_areas.php?dd0='.$dd[0].'&dd20='.$line['id_psa'].'&dd21=DEL">[del]</A>';
	$sx .= '<TR '.coluna().' class="lt4">';
	$sx .= '<TD>';
	$sx .= trim($line['psa_p04']);
	$sx .= strzero($line['psa_p02'],2);
	$sx .= '<TD>';
	$sx .= $line['psa_p03'];
	$sx .= '<TD>';
	$sx .= $line['psa_p05'];
	}
?>
<table width="<?=$tab_max;?>" class="lt2" border=1 >
	<TR><TD colspan="5" class="lt2" bgcolor="#ffc6c6"><center>Indicação da Avaliações</center></TD></TR>
	<?=$sx;?>
</table>