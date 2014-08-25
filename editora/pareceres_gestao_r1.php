<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_data.php");
require($include."cp2_gravar.php");

$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$A8','','Indicações de avaliações',False,False,''));
array_push($cp,array('$D8','','Indicados de:',True,False,''));
array_push($cp,array('$D8','','até',True,False,''));

if (strlen($dd[2]) == 0) { $dd[2] = stodbr(DateAdd('m',-2,date("Ymd"))); }
if (strlen($dd[3]) == 0) { $dd[3] = date("d/m/Y"); };
$opc = ' :Todos';
$opc .= '&C:Avaliados';
$opc .= '&I:Indicados e não avaliados';
$opc .= '&X:Indidades e recusados';
array_push($cp,array('$O '.$opc,'','Tipos',False,True,''));

	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
if ($saved > 0)
	{
	$sql = "select * from reol_parecer_enviado ";
	$sql .= "left join pareceristas on pp_avaliador = us_codigo ";
	$sql .= "inner join submit_documento on pp_protocolo = doc_protocolo ";
	$sql .= "where doc_journal_id = '".strzero($jid,7)."' ";
	$sql .= "and (pp_data >= ".brtos($dd[2])." and pp_data <= ".brtos($dd[3]).") ";
	if (strlen($dd[4]) > 0)
		{ $sql .= " and pp_status = '".$dd[4]."' "; }
	$sql .= " order by us_nome ";
	$rlt = db_query($sql);
	
	$us = "X";
	$t1 = 0;
	$t2 = 0;
	$t3 = 0;
	while ($line = db_read($rlt))
		{
		$link2 = '<A HREF="subm.php?dd0='.$line['doc_protocolo'].'" target="_new2">';
		$dif = DiffDataDias($line['pp_data'],date("Ymd"));
		$cor = '';
		$st = $line['pp_status'];
		$sta = $line['pp_status'];
		$link = '';
		if ($st == 'I') 
			{ 
			$st = '<font color=green >Indicado</font>'; $to1++; 
			}
		if ($st == 'C') { $st = '<font color=blue >Avaliado</font>'; $to2++; $dif = '-'; }
		if ($st == 'X') { $st = '<font color=silver >Cancelado</font>'; $cor = '<font color="#606060">'; $to3++; $dif = '-'; }

		if ($sta == 'I')
			{
			if ($dif > 10) { $cor = '<font color="#FF8040">'; }
			if ($dif > 20) { $cor = '<font color="#ff00ff">'; }
			if ($dif > 30) { $cor = '<font color="#ff0000">'; }
			}
		$av = $line['pp_avaliador'];
		if ($av != $us)
			{
			$link = '<a href="#" title="enviar e-mail de pendências de avaliações" onclick="newxy2('.chr(39).'pareceres_gestao_email_1.php?dd0='.$line['pp_avaliador'].'&dd1='.strzero($jid,7).chr(39).',700,400);">';
			$link .= '<img src="img/icone_send_mail.png" width="24" height="24" alt="" border="0"></A>';
			$sc .= '<TR><TD colspan="10" class="lt2"><B>'.$line['us_nome'].' ('.$av.') '.$link.'</B></TD></TR>';
			$us = $av;
			}
		$sc .= '<TR '.coluna().'>';
		$sc .= '<TD>';
		$sc .= $link2;
		$sc .= $cor;
		$sc .= $line['doc_protocolo'];
		$sc .= '<TD>';
		$sc .= $cor;
		$sc .= Lowercase($line['doc_1_titulo']);
		$sc .= '<TD align="center">';

		$sc .= $st;
		$sc .= '<TD>';
		$sc .= $cor;
		$sc .= stodbr($line['pp_data']);
		$sc .= ' ';
		$sc .= $line['pp_hora'];
		$sc .= '<TD>';
		$sc .= $cor;
		$sc .= stodbr($line['pp_parecer_data']);
		$sc .= '<TD align="center">';
		$sc .= $cor;
		$sc .= $dif;
		}
	?>
	<table width="<?=$tab_max;?>" class="lt1" border=1 >
	<TR class="lt1" align="center"><TD>Indicados</TD><TD>Avaliados</TD><TD>Cancelados</TD></TR>
	<TR class="lt2" align="center"><TD><?=$to1;?></TD><TD><?=$to2;?></TD><TD><?=$to3;?></TD></TR>
	</table>
	<table width="<?=$tab_max;?>" class="lt1">
		<TR>
		<TH>Protocolo</TH>
		<TH>Título</TH>
		<TH><I>Status</I></TH>
		<TH>Dt. Indicação</TH>
		<TH>Dt. Avaliação</TH>
		<TH>Dias</TH>
		</TR>
		<?=$sc;?>
	</table>
	<?
	}

require("foot.php");	?>