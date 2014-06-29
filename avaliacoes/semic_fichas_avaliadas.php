<?
require("cab.php");
require($include.'sisdoc_debug.php');
$sql = "select seq, psa_p04,psa_p05, to_number(psa_p02,'99D9') as psa_p02, avg(to_number(psa_p06,'999D9')) as psa_p06, count(*) as psa_p00 from pibic_semic_avaliador ";
$sql .= "left join sections on (abbrev = psa_p04) and (journal_id = 35) ";
$sql .= " where psa_p06 <> '' ";
$sql .= " group by psa_p04,psa_p05, psa_p02 ,psa_p03, seq ";
$sql .= " order by seq, psa_p05, psa_p06 desc ";


//$sql = "update sections set seq_area = '9' where  journal_id = 45";
//$rlt = db_query($sql);<a href="../PUCPR_PibicPR"></a>

$xsql = "update sections set seq_area = '3' where (seq > 40 and seq <= 45) and journal_id = 45";
$xsql = "update sections set seq_area = '4' where (seq > 49 and seq <= 68) and journal_id = 45";
$xsql = "update sections set seq_area = '5' where (seq > 69 and seq <= 79) and journal_id = 45";
$xsql = "update sections set seq_area = '2' where (seq > 19 and seq <= 38) and journal_id = 45";
//$rlt = db_query($xsql);

$xsql = "select * from pibic_semic_avaliador where ((psa_abe_1 like '%.%') or (psa_abe_2 like '%.%')  or (psa_abe_3 like '%.%') ";
$xsql .= " or (psa_abe_1 like '%,%') or (psa_abe_2 like '%,%') or (psa_abe_3 like '%,%')";
$xsql .= " or (psa_checked <> 'L') or (psa_checked isnull)) and (psa_abe_1 <> '') limit 400";
$rlt = db_query($xsql);
$i = 0;
while ($line = db_read($rlt))
	{
	$i++;
	$n1 = $line['psa_abe_1'];
	$n1 = troca($n1,'.','-');
	$n1 = troca($n1,',','-');

	$n2 = $line['psa_abe_2'];
	$n2 = troca($n2,'.','-');
	$n2 = troca($n2,',','-');
	
	$n3 = $line['psa_abe_3'];
	$n3 = troca($n3,'.','-');
	$n3 = troca($n3,',','-');
	$notag = round($line['psa_abe_4']);
	if ($notag > 100) {$notag = $notag/10; }
	if ($notag <= 10) {$notag = $notag*10; }
	
	
	$nx1 = nota($n1);
	$nx2 = nota($n2);
	$nx3 = nota($n3);
	$nx4 = $notag;
	
	if ($nx1 < 0) { $nx1 = 0; }
	if ($nx2 < 0) { $nx2 = 0; }
	if ($nx3 < 0) { $nx3 = 0; }
	
	$nota = $nx1 + $nx2 + $nx3 +$nx4;
	
//	$nota = $nota + (100*round($line['psa_abs_5']));
	
	$sql = "update pibic_semic_avaliador set ";
	$sql .= " psa_abe_1 = '".$n1."',";
	$sql .= " psa_abe_2 = '".$n2."',";
	$sql .= " psa_abe_3 = '".$n3."',";
	$sql .= " psa_final = '".$nota."', ";
	$sql .= " psa_abe_4 = '".$notag."', ";
	$sql .= " psa_p06 = '".$nota."', ";
	$sql .= " psa_checked = 'L' ";
	$sql .= " where id_psa = ".$line['id_psa'];
//	print_r($line);
	if ($notag > 100)
		{
		print_r($line);
		echo 'ERRO ';
		exit;
		}
	echo '<BR>'.$n1.' '.$n2.' '.$n3.' => '.$notag.' ';
	echo ' ===>'.$nota;
//	echo '<BR>'.$sql;
//	echo '<HR>';
	$rrr = db_query($sql);
	}
if ($i > 0) { exit; }
$sql = "select seq_area as seq, seq as seq2, psa_p04,psa_p05, to_number(psa_p02,'99D9') as psa_p02, avg(psa_final) as psa_p06, count(*) as psa_p00 from pibic_semic_avaliador ";
$sql .= "left join sections on (abbrev = psa_p04) and (journal_id = 45) ";
$sql .= " where psa_p06 <> '' ";
$sql .= " group by seq_area,psa_p04,psa_p05, psa_p02 ,psa_p03, seq ";
$sql .= " order by seq_area, psa_p06 desc ";

$sql = "select seq_area as seq, seq as seq2, psa_p04, to_number(psa_p02,'99D9') as psa_p02, avg(psa_final) as psa_p06, count(*) as psa_p00 from pibic_semic_avaliador ";
$sql .= "left join sections on (abbrev = psa_p04) and (journal_id = 45) ";
$sql .= " where psa_p06 <> '' ";
$sql .= " group by seq_area,psa_p04, psa_p02 ,psa_p03, seq ";
$sql .= " order by seq_area, psa_p06 desc ";


$rlt = db_query($sql);
$id = 0;
$ad = 0;
$sq = -1;

$caps = array(
'0','Ciências da Vida','Ciências Exatas','Ciências Agrárias','Ciências Sociais Aplicadas','Ciências Humanas','6','7','8','9', 
'','','','','','','','','','',
'','Exatas','Vida','Agrárias','Humanas','Socias Aplicadas','','','','','',
);

while ($line = db_read($rlt))
	{
	if ($sq != $line['seq'])
		{
		$sq = $line['seq'];
		$sx .= '<TR><TD width="10%"><NOBR><B>'.$caps[$sq].' - ('.$sq.')</TD><TD colspan="5"><HR></TD></TR>';
		}
	$id++;
	$ad = $ad + $line['psa_p00'];
	$sx .= '<TR align="center" '.coluna().'>';
	$sx .= '<TD>';
	$sx .= $line['psa_p04'];
	$sx .= strzero($line['psa_p02'],2);
	$sx .= '<TD>';
	$sx .= $line['psa_p05'];
	$sx .= '<TD>';
	$sx .= number_format($line['psa_p06'],1);
	$sx .= '<TD>';
	$sx .= $line['psa_p00'];
	$sx .= '</TR>';
	$rr = $line;
	}
?>


<table width="<?=$tab_max;?>" align="center" class="lt1">
<TR><TH>Trabalho</TH><TH>Evento</TH><TH>Nota (soma)</TH><TH>Avaliações</TH></TR>
<?=$sx;?>
</table>
Total de avaliações <?=$ad;?>, avaliados <?=$id;?> em <?=date("d/m/Y H:i:s");?>
<?
require("foot.php");

function nota($aa)
	{
	$aa .= '-';
	$nts = array(0,0,0);
	$vlr = 0;
	$err = 0;
	if ($aa == 'NÃO APLICÁVEL-') { $vlr = 30; $aa = ''; }
	while (strpos($aa,'-') > 0)
		{
		$pos = strpos($aa,'-');
		$nt1 = round('0'.substr($aa,0,$pos));
		if (($nt1 <= 0) or ($nt1 > 10)) { $err = 1; } else
		{ $vlr = $vlr + $nt1; }
		$aa = substr($aa,$pos+1,strlen($aa));
		}
	if ($vlr > 30)
		{ echo 'erro ['.$aa.']'; exit; }
	if ($err == 1) { return(-1); } else { return($vlr); }
	}
?>