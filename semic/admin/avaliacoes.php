<?php
require("cab.php");
require($include.'sisdoc_debug.php');

/* Declinar */
if ($dd[3]=='DEL')
	{
		$sql = "update pibic_semic_avaliador_notas set av_status = 9 where id_av = ".round($dd[2]);
		$rlt = db_query($sql);
	}


echo '
<div id="conteudo" style="margin:0 auto -330px;">
';
$d1 = mktime(0,0,0,10,24,2013,0);
$d2 = mktime(23,56,0,10,24,2013,0);

require("_class/_class_avaliador_relatorio.php");
$avc = new avaliador_relatorio;

		echo '<div id="cab_top">Lista de Avaliadores</div>';
		
		$sql = "select av_status, count(*) as total, av_tstamp_avaliacao_est, av_tipo_trabalho
				from pibic_semic_avaliador_notas				 
				where av_tstamp_avaliacao_est >= $d1 and av_tstamp_avaliacao_est <= $d2 
				group by av_status, av_tstamp_avaliacao_est, av_tipo_trabalho
				order by av_tstamp_avaliacao_est,  av_tipo_trabalho, av_status
		";
		$rlt = db_query($sql);
		
		echo '<table width="400">';
		$a = 0;
		$d = 0;
		$b = 0;
		while ($line = db_read($rlt))
			{
				echo '<TR>';
				echo '<TD>';
				echo date("d/m/Y H:i",$line['av_tstamp_avaliacao_est']);
				echo '<TD>';
				echo $line['av_tipo_trabalho'];
				echo '<TD>';
				$sta = $line['av_status'];
				echo $line['total'].' ';
				switch($sta)
					{
						case '0': echo 'Aberto'; $a = $a + $line['total']; break;
						case '1': echo 'Avaliados'; $b = $b + $line['total']; break;
						case '9': echo 'Declinados'; $d = $d + $line['total'];  break;
					}
				
			}
		$tot = $a+$b+$c;
		echo '<TR><TD colspan=4>Total de indicações ('.($a+$b+$c).')';
		echo '<TR><TD colspan=4>Total avaliados ('.($b).') ';
		echo '<TR><TD colspan=4>Total não avaliados ('.($a).') ';
		if ($tot > 0)
			{
				echo number_format(100*$b/$tot,1).'%';
			}
		echo '</table>';
		$sql = "select * from pibic_semic_avaliador_notas
				inner join pareceristas on us_codigo_id = av_parecerista_cod 
				where (av_tstamp_avaliacao_est >= $d1 and  av_tstamp_avaliacao_est <= $d2)
				and av_status = 0 
				order by us_nome, av_tstamp_avaliacao_est, av_area, av_numtrab
		";
		$rlt = db_query($sql);
		
	echo '<table width="100%" class="tabela00">';
	$xnome = "X";
	while ($line = db_read($rlt))
	{
		$nome = $line['us_nome'];
		if ($nome != $xnome)
			{
				$sx .= '<TR><TD colspan=6><A name="'.$line['id_us'].'"></a><B>'.$nome.'</B>';
				$xnome = $nome;
			}
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
		$status = round($line['av_status']);
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
				$sx .= '<A HREF="'.page().'?dd1='.$dd[1].'&dd2='.$line['id_av'].'&dd3=DEL&dd10=0#'.$line['id_us'].'">DECLINAR</A>';
			
			}
		$ll = $line;
	}
	echo $sx;
	echo '</table>';
require("foot.php");
?>


