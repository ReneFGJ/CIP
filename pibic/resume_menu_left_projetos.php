<?
$bts = array();
$dr = array(0,0,0,0,0,0);

$sql = "select pb_tipo, pb_status, count(*) as total from pibic_bolsa_contempladas ";
$sql .= " where pb_professor = '".$id_pesq."' ";
$sql .= " and pb_status <> '@' ";
$sql .= " group by pb_tipo, pb_status ";

$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$sta = trim($line['pb_status']);
	$bs = trim($line['pb_tipo']);
	$bolsa = $bs;
	if ($sta == 'A') 
		{
		require('../pibicpr/bolsa_tipo.php');
		array_push($bts,array($bolsa_nome,$line['total'],$bs,$line['total']));
		$tot = $tot + $line['total'];
		$tota= $tota+ $line['total'];
		
		}
	if ($sta == '@') 
		{
		$dr[0] = $dr[0] + $line['total'];
		}
	if ($sta == 'B') { $dr[0] = $dr[0] + $line['total']; }
	if ($sta == 'S') 
		{
		$dr[2] = $dr[2] + $line['total'];
		}
	if ($sta == 'X') 
		{
		$dr[3] = $dr[3] + $line['total'];
		}
	if ($sta == 'F')  { $dr[0] = $dr[0] + $line['total']; }
	
//	echo '<BR>'.$sta.'_'.$line['total'];
	}


	
///////////////////////////////////// INSTITUCIONAL
	$amenu = array();
	for ($rx=0;$rx < count($bts);$rx++)
		{
		array_push($amenu,array('('.number_format($bts[$rx][1],0).') '.$bts[$rx][0],'bolsa.php?dd0='.$bts[$rx][2],$bts[$rx][1],$bts[$rx][3]));
		}
	
	array_push($amenu,array('('.number_format($dr[0],0).') Concluídas','bolsa.php?dd1=B','Concluídas',$dr[0]));
	array_push($amenu,array('('.number_format($dr[1],0).') Suspensas','bolsa.php?dd1=F','Suspensas',$dr[1]));
	array_push($amenu,array('('.number_format($dr[2],0).') Canceladas','bolsa.php?dd1=G','Canceladas',$dr[2]));
	array_push($amenu,array('('.number_format($dr[3],0).') Falta contrato','bolsa.php?dd0=@','Falta contrato',$dr[3]));
	$tab_titulo = "Bolsas implementadas";
	
//$tot = $tot + $dr[0] + $dr[1] + $dr[2] + $dr[3] + $dr[4] + $dr[5] + $dr[6] ;
//$tota = $tot + $dr[0] + $dr[1] + $dr[2] + $dr[3] + $dr[5] + $dr[7];
?>
<table cellpadding="0" cellspacing="0"  bgcolor="#EFEFEF" width="210">
<TR align="center"><TD colspan="3" height="24" background="img/menu_top.jpg"><font class="lt2"><font color="white"><B><?=$tab_titulo;?></TD></TR>
<TR><TD width="5">
	<TD width="200">
	<table cellpadding="2" cellspacing="0" width="200">
	<?
	for ($kq=0; $kq < count($amenu); $kq++)
		{ ?>
		<? if ($amenu[$kq][3] > 0 ) { ?>
		<TR><TD class="lt1">
		<A class="lt1" HREF="<?=$amenu[$kq][1];?>" title="<?=$amenu[$kq][3];?>">
		  <?=$amenu[$kq][0];?>
		</A><? } ?>
		<?	} ?>
	</table><font class="lt1"><center>Iniciação Científicas ativos: <B><?=$tota;?></B></center></font>
	</TD>
</TABLE>