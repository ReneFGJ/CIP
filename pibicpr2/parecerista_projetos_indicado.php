<?
require($include."sisdoc_debug.php");
$sql = "select pibic_parecer.pp_parecer_data as pp_parecer_data, pibic_parecer.pp_parecer_hora as pp_parecer_hora, ";
$sql .= " aa.pp_protocolo_mae as pp_protocolo_mae, aa.pp_protocolo as pp_protocolo, aa.pp_data as pp_data, aa.pp_hora as pp_hora, ";
$sql .= " pibic_parecer.pp_status as stb, aa.pp_status as sta ";
$sql .= " from pibic_parecer_enviado as aa ";
$sql .= "  left join  pibic_parecer on  aa.pp_protocolo_mae = pibic_parecer.pp_protocolo_mae ";
$sql .= " where aa.pp_avaliador = '".strzero($dd[0],7)."' ";
$sql .= " and aa.pp_protocolo_mae = aa.pp_protocolo ";
$sql .= " order by pp_data desc,pp_protocolo_mae,pp_protocolo ";
$rlt = db_query($sql);
$sx = '';
$ano = "X";
while ($line = db_read($rlt))
	{
	$xano = substr($line['pp_data'],0,4);
	if ($ano != $xano)
		{
		$sx .= '<TR align="center"><TD colspan="10" class="lt3">'.$xano.'</TD></TR>';
		$ano = $xano;
		}
	$sta = $line['sta'];
	$stb = $line['stb'];
	$rst = $sta.'<->'.$stb;
	$rs2 = $rst;
	$cor = '';
	if ($stb == 'X')
		{ $rst = 'cancelado'; $cor = '<font color="#c0c0c0">'; }
	if ($sta == 'D')
		{ $rst = 'declinou';  $cor = '<font color="#ff80c0">'; }
	if (($sta == 'I') and ($stb == ''))
		{ $rst = 'não avaliado';  $cor = '<font color="#0080ff">'; }
	if (($sta == 'I') and ($stb == 'B'))
		{ $rst = 'avaliado';  $cor = '<font color="#008080">'; }
	if (($sta == 'I') and ($stb == 'A'))
		{ $rst = 'não finalizado';  $cor = '<font color="#66ff66">'; }	
	
	$link = '<A HREF="ed_pibic_submit_article.php?dd0='.$line['pp_protocolo_mae'].'">';
	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD>';
	$sx .= $link;
	$sx .= $line['pp_protocolo_mae'];
	$sx .= '<TD>';
	$sx .= $cor;
	$sx .= $line['pp_protocolo'];
	$sx .= '<TD>';
	$sx .= $cor;
	$sx .= stodbr($line['pp_data']);
	$sx .= '<TD>';
	$sx .= $cor;
	$sx .= $line['pp_hora'];
	$sx .= '<TD>';
	$sx .= $cor;
	$sx .= stodbr($line['pp_parecer_data']);
	$sx .= '<TD>';
	$sx .= $cor;
	$sx .= $line['pp_parecer_hora'];
	$sx .= '<TD>';
	$sx .= $cor;
	$sx .=  $rst;
	$sx .= '<TD>';
	$sx .= $cor;
	$sx .=  $rs2;
	}
?>
	<center><font class="lt5">Projetos indicados para o parecerista</center>
	<TABLE width="<?=$tab_max;?>" class="lt1">
		<TR><TH>Protolo Mãe
			<TH>Protolo 
			<TH>data
			<TH>hora
			<TH>Parecer data
			<TH>Parecer hora
			<TH colspan="2">Status
		<?=$sx;?>
	</TABLE>