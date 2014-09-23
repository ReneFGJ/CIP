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

$n1 = 0;
$n2 = 0;
$fc = 8.29763130793;
//$sql = "ALTER TABLE pibic_professor add column pp_fc double precision ";
//$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
		$ava = $line['pp_avaliador'];
		if ($ava != $AVA)
			{
				if ($na > 0)
					{
					$med = ($nt/$na);
					$sx .= '<TD>'.$nt.'<TD>'.$na;
					$sx .= '<TD>MED='.($nt/$na);
					$sx .= '<TD>'.$nmax;
					$sx .= '<TD>'.$nmin;
					$sx .= '<TD><B>Dv='.($nmax-$nmin).'</B>';
					$sx .= '<TD><font color="red">'.($med - $fc).'</font>';
					
					$t = atualiza_fc($AVA,($med - $fc));
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
				$n1 = $n1 + $nota;
				$n2++;
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

				if ($na > 0)
					{
					$med = ($nt/$na);
					$sx .= '<TD>'.$nt.'<TD>'.$na;
					$sx .= '<TD>MED='.($nt/$na);
					$sx .= '<TD>'.$nmax;
					$sx .= '<TD>'.$nmin;
					$sx .= '<TD><B>Dv='.($nmax-$nmin).'</B>';
					$sx .= '<TD><font color="red">'.($med - $fc).'</font>';
					
					$t = atualiza_fc($AVA,($med - $fc));
					}
$sx .= '</table>';
echo '--->Aprovado com mérito: '.$ia;
echo $sx;
echo '<HR>'.$n1.'=='.$n2.'=='.($n1/$n2).'<HR>';
require("../foot.php");	

function atualiza_fc($cracha,$fc)
	{
		$cracha = trim($cracha);
		$fc = (($fc * 1000) / 1000);
		$sql = "update pibic_professor set pp_fc = $fc where pp_cracha = '$cracha' ";
		$rlt = db_query($sql);
		echo '<BR>'.$sql;
	}
?>