<?
require("cab.php");
require($include.'sisdoc_debug.php');

//$sql = "ALTER TABLE pibic_semic_avaliador  ADD COLUMN psa_checked char(1) ";
//$rlt = db_query($sql);

$sql = "update pibic_semic_avaliador set psa_final = to_number(psa_p06,'999D9') where psa_p06 <> ''";
$rlt = db_query($sql);

$sql = "select * from pibic_semic_avaliador ";
$sql .= " where psa_p06 <> '' ";
$sql .= " order by psa_p04, psa_p02, psa_p06 desc ";

//$sql = "select * from pibic_semic_avaliador ";
//$sql .= " where psa_p06 <> '' ";


$id = 0;
$rlt = db_query($sql);
$tot = 0;
$sqlu = '';
while ($line = db_read($rlt))
	{
	$tot++;
	$id = strzero($line['id_psa'],5).'-'.dv($line['id_psa']);
	$sx .= '<TR align="center" '.coluna().'>';
	$sx .= '<TD align="left">';
//	$sx .= $line['id_psa'];
	$sx .= $id;
	$sx .= '<TD align="left">';
	$sx .= $line['psa_p04'];
	$sx .= strzero($line['psa_p02'],2);
	$sx .= '<TD>';
	$sx .= $line['psa_p05'];
	$sx .= '<TD>';
	$sx .= $line['psa_p06'];
	$sx .= '<TD>';
	$sx .= $line['psa_p01'];
	$sx .= '<TD>';
	$sx .= $line['psa_p02'];
	$sx .= '<TD>';
	$sx .= $line['psa_p03'];
	$sx .= '<TD>[';
	$sx .= $line['psa_abe_1'];
	$sx .= ']<TD>';
	$sx .= $line['psa_abe_2'];
	$sx .= '<TD>[';
	$sx .= $line['psa_abe_3'];
	$sx .= ']<TD>';
	if ($line['psa_abe_4'] < 11) 
		{
			 $sx .= '<font color="red">';
			 if ($line['psa_abe_4'] > 0)
			 {
			 	$sqlu .= "update pibic_semic_avaliador set psa_abe_4 = ".($line['psa_abe_4']*10)." where id_psa = ".$line['id_psa'].'; '.chr(13);
			 } 
		}
	$sx .= $line['psa_abe_4'];
	$sx .= '<TD>';
	$sx .= $line['psa_abe_5'];
	$sx .= '<TD>';
	$sx .= $line['psa_abe_6'];
	$sx .= '<TD>=>';
	$sx .= $line['psa_final'];
	$sx .= '<TD>';
	$sx .= $line['psa_checked'];
	$sx .= '</TR>';
	$rr = $line;
	}
if (strlen($sqlu) > 0)
	{
		//echo $sqlu;
		//$rlt = db_query($sqlu);
	}
?>


<table width="100%" align="center" class="lt1">
<TR><TH>Trabalho</TH><TH>Evento</TH><TH>Nota (soma)</TH><TH>Avaliações</TH></TR>
<?=$sx;?>
</table>
Total <?=$tot; ?>
<?

?>