<?php
require("cab.php");
require($include.'sisdoc_form2.php');

require("../../_class/_class_pareceristas.php");
$par = new parecerista;

$par->le($dd[1]);
$id = strzero($dd[1],9);
for ($r=0;$r <= 99;$r++)
	{
		$idc = $id.strzero($r,2);
		if (cpf($idc) == 1)
			{
				$r = 100;
			}
	}


echo '
<div class="botao-0"><A HREF="http://www2.pucpr.br/reol/semic/avaliacao/SEMIC_avaliacao/index.php?dd1='.$idc.'&acao=login">Acesso</A></div>
';
echo '<HR>';
echo $par->mostra_dados();
echo '<BR>COD:'.$idc;

echo '<HR>';

/* Declinar */
if ($dd[3]=='DEL')
	{
		$sql = "update pibic_semic_avaliador_notas set av_status = 9 where id_av = ".round($dd[2]);
		$rlt = db_query($sql);
	}

$sql = "select * from pibic_semic_avaliador_notas 
			where av_parecerista_cod = '".strzero($dd[1],7)."' 
			and av_journal_id = 67
			order by av_tstamp_avaliacao_est, av_area, av_numtrab
			";
$rlt = db_query($sql);

echo '<h1>Agenda do Avaliador</h1>';

while ($line = db_read($rlt))
	{
		$data = $line['av_tstamp_avaliacao_est'];
		$sx .= '<TR>';
		$sx .= '<TD>'.date("d/m/Y H:i",$data);
		$sx .= '<TD>';
		$sx .= $line['av_area'];
		$sx .= $line['av_numtrab'];
		$sx .= '<TD>';
		$sx .= $line['av_tipo_trabalho'];
		$sx .= '<TD>';
		$sx .= $line['av_local'];
		$sx .= '<TD>';
		$status = $line['av_status'];
		if ($status == 1)
			{
				$sx .= 'Avaliado';
				$sx .= '<TD>';			
			}
		if ($status == 9)
			{
				$sx .= 'Declinado';
				$sx .= '<TD>';			
			}
		if ($status == 0)
			{
				$sx .= 'Não avaliado'; 
				$sx .= '<TD>';
				$sx .= '<A HREF="avaliador.php?dd1='.$dd[1].'&dd2='.$line['id_av'].'&dd3=DEL">DECLINAR</A>';
			
			}
		$ll = $line;
	}
echo '<table border=1 cellpadding=4 cellspacing=2 style="font-size: 12px;" width="100%">';
echo '<TR><TH>trab<TH>Tp<TH>Sala<TH>Status';
echo $sx;
echo '</table>';
function msg($t) { return($t); }

require("foot.php");
?>
