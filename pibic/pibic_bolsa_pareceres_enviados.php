<BR>
<table width="<?=$tab_max;?>" align="center" class="lt1" border=1 cellpadding=3 cellspacing=0>
<TR>
	<TH>Indicação</TH>
	<TH>Tipo</TH>
	<TH>Avaliador</TH>
	<TH>Avaliação</TH>
	<TH>Data</TH>
</TR>
<TR><TD colspan="5" bgcolor="#c0c0c0"><B>Pareceres enviados</B></TD></TR>
<?
$sql = "select * from  pibic_parecer_2010 ";
$sql .= " where pp_protocolo = '".$protocolo."' ";
//$sql .= " and pp_status <> 'R' ";
$sql .= " and pp_status <> '@' ";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	PRINT_R($line);
	$avaliador = $line['pp_avaliador'];
	$status = $line['pp_status'];
	$data = stodbr($line['pp_data']).' '.$line['pp_hora'];
	
	$linkb = '<input type="button" name="ax" value="cancelar avaliação" onclick="newxy2('.chr(39).'rel_bolsa_envio_email_avaliador_local_anular.php?dd0='.$line['id_pp'].chr(39).',400,140);">';
	
	if ($line['pp_status'] == 'R') { $linkb = ''; }
	$tipo = $line['pp_tipo'];
	if (substr($tipo,4,1) == 'P') { $tipo = 'Avaliação do relatório parcial'; }
	if (substr($tipo,4,1) == 'F') { $tipo = 'Avaliação do relatório final e resumo'; }
	
	if (trim($line['pl_p0'])=='1')
		{
		$link = '<A HREF="javascript:newxy2('.chr(39).'pibic_parecer_mostrar.php?dd0='.$line['id_pp'].chr(39).',600,400);">';
		}
	
	if (trim($line['pl_p39'])=='1')
	{
		$link = '<A HREF="javascript:newxy2('.chr(39).'pibic_parecer_mostrar_final.php?dd0='.$line['id_pp'].chr(39).',600,400);">';
		$tipo = 'Avaliação do relatório final e resumo';
	}
	echo '<TR><TD width="10%"><nobr>';
	echo $data;
	echo '<TD>';
	echo $link.$tipo.'</A> ';
	echo '<TD width="10%">';
	echo $avaliador;
	echo '<TD align="center">&nbsp;';
	$tp = $line['pl_p44'];
	echo substr($tp,0,strpos($tp,','));
	echo '<TD align="right">&nbsp;';
	echo $linkb;
	echo '</TD></TR>';
	}
?>
</table>