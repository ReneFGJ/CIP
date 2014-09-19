<?
$breadcrumbs=array();
require("cab_semic.php");

$sql = "
		select * from pibic_parecer_2014
		where pp_tipo = 'RFIN' 
		and pp_status <> '@' and pp_status <> 'D'
		order by pp_avaliador	
		";
$rlt = db_query($sql);

$sx = '<table>';
$sh .= '<TR><TH>Protocolo<TH colspan=2>Mérito<TH>Nota<TH>Orientador<TH>Estudante<TH>Status';
$tot = 0;
$AREA = '';
$ia=0;
$AVA = '';
$nt = 0;
$na = 0;
$nmax = 0;
$nmin = 10;
while ($line = db_read($rlt))
	{
		$ava = $line['pp_avaliador'];
		if ($ava != $AVA)
			{
				if ($na > 0)
					{
					$sx .= '<TD>'.$nt.'<TD>'.$na;
					$sx .= '<TD>'.($nt/$na);
					$sx .= '<TD>'.$nmax;
					$sx .= '<TD>'.$nmin;
					$sx .= '<TD><B>Dv='.($nmax-$nmin).'</B>';
					}
				$AVA = $ava;
				$nt = 0;
				$na = 0;	
				$nmax = 0;
				$nmin = 10;
			}
			
		$nota = troca($line['pp_abe_11'],',','.');
		if ($nota > 5)
			{
				$nt = $nt + $nota;
				$na++;
				if ($nota > $nmax) { $nmax = $nota; }
				if ($nota < $nmin) { $nmin = $nota; }
			}
		$sx .= '<TR>';
		$sx .= '<TD>'.$line['pp_protocolo'];
		$sx .= '<TD>'.$line['pp_avaliador'];
		$sx .= '<TD>'.$line['pp_abe_11'];
		$sx .= '<TD>'.$line['pp_status'];
		$sx .= '<TD>-->'.$nota;
	}
$sx .= '</table>';
echo '--->Aprovado com mérito: '.$ia;
echo $sx;

require("../foot.php");	
?>