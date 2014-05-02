<?
$dr = array(0,0,0,0,0,0,0,0,0,0,0,0,0);

////////////////////////////////////// ZERA TUDO
//$sql = "delete from ".$cdoc." ;".chr(13).chr(10);
//$sql .= "delete from ".$tdov ." ;".chr(13).chr(10);
//$sql .= "delete from ".$tdov." ;".chr(13).chr(10);
//$sql .= "delete from ".." ;".chr(13).chr(10);
//$rlt = db_query($sql);
///////////////////////////////////////////////// RESETA ANTIGOS
//$sql = "update ".$tdoc." set doc_status = 'X' ";
//$sql .= " where doc_ano = '2009' and doc_status = '@' ";
//$rlt = db_query($sql);
//echo $sql;


$sql = "select doc_status, count(*) as total from ".$tdoc." ";
$sql .= " where doc_autor_principal ='".strzero($id_pesq,7)."' ";
$sql .= " and doc_journal_id = '".strzero($jid,7)."'";
$sql .= " and doc_protocolo_mae = '' ";
$sql .= " group by doc_status ";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$sta = trim($line['doc_status']);
	if ($sta == '@') { $dr[0] = $line['total']; }
	if ($sta == 'A') { $dr[1] = $line['total']; }
	if ($sta == 'B') { $dr[2] = $line['total']; }
	if ($sta == 'C') { $dr[2] = $line['total']; }
	if ($sta == 'E') { $dr[5] = $line['total']; }
//	echo '<BR>'.$sta.'_'.$line['total'];
	}


$tab_titulo = "manuscritos do autor";

	$amenu = array();
	array_push($amenu,array('('.number_format($dr[0],0).') em submissão','submit_projetos.php?dd0=@','manuscritos em submissão'));
	array_push($amenu,array('('.number_format($dr[1],0).') submetidos','submit_projetos.php?dd0=A','manuscritos em submissão'));
	array_push($amenu,array('('.number_format($dr[2],0).') em análise','submit_projetos.php?dd0=B','manuscritos em submissão'));
//	array_push($amenu,array('('.number_format($dr[3],0).') concluído','submit_projetos.php?dd0=C','manuscritos concluidos'));
//	array_push($amenu,array('('.number_format($dr[4],0).') em andamento','submit_projetos.php?dd0=P','manuscritos com pendências'));
	array_push($amenu,array('('.number_format($dr[5],0).') avaliação finalizada','submit_projetos.php?dd0=E','processo de avaliação finalizad'));
	$tab_titulo = "Projetos do professor";
	$tab_titulo = "Submissões do professor";
	

?>
<table cellpadding="0" cellspacing="0"  bgcolor="#EFEFEF" width="210">
<TR align="center"><TD colspan="3" height="24" background="img/menu_top.jpg"><font class="lt2"><font color="white"><B><?=$tab_titulo;?></TD></TR>
<TR><TD width="5">
	<TD width="200">
	<table cellpadding="2" cellspacing="0" width="200">
	<?
	for ($kq=0; $kq < count($amenu); $kq++)
		{ ?>
		<TR><TD><A class="lt1" HREF="<?=$amenu[$kq][1];?>" title="<?=$amenu[$kq][2];?>">
		  <?=$amenu[$kq][0];?>
		</A><? } ?>
	</table>
	</TD>
</TABLE>