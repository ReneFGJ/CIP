<?
$breadcrumbs = array();
require ("cab_semic.php");
$sql = "alter table pibic_bolsa_contempladas add column pb_semic_nota_original int8";
//$rlt = db_query($sql);

$sql = "select * from (
		select trim(parecer.pp_avaliador) as av, trim(pibic_professor.pp_cracha) as avaliador, pp_fc as fc, substr(pb_semic_area,1,4) || '.00.00' as pb_area, * 
		from pibic_parecer_".date("Y")." as parecer
		inner join pibic_professor on trim(parecer.pp_avaliador) = trim(pibic_professor.pp_cracha) 
		inner join pibic_bolsa_contempladas on pb_protocolo = pp_protocolo
		where pp_tipo = 'RFIN' 
		and pp_status <> '@' and pp_status <> 'D' and pb_status <> 'C'
		) as tabela
		left join ajax_areadoconhecimento on pb_area = substr(a_cnpq,1,10)
		left join pibic_professor as orientador on pb_professor = orientador.pp_cracha
		left join pibic_aluno on pb_aluno = pa_cracha
		inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
		where a_cnpq <> '2.02.00.00-5' and a_cnpq <> '3.07.00.00-0'
		order by pb_protocolo, pb_area, a_descricao, pp_p01 desc, pb_protocolo, pp_abe_11
		
		";
$rlt = db_query($sql);

$sx = '<table>';
$sx .= '<TR><TH>Área<TH>Protocolo<TH colspan=2>Mérito<TH>Nota<TH>Orientador<TH>Estudante<TH>Status';

$tot = 0;
$AREA = '';
$ia = 0;
$PROTO = '';
$to = 0;
while ($line = db_read($rlt)) {
	$proto = trim($line['pb_protocolo']);
	if ($PROTO != $proto) {
		$PROTO = $proto;

		$cor = '<font color="black">';
		if (trim($line['pp_p01']) == '20') { $cor = '<font color="blue">';
		}
		if (trim($line['pp_p01']) == '10') { $cor = '<font color="orange">';
		}
		$area = $line['a_cnpq'];
		$sx .= '<TR>';
		$sx .= '<TD>';
		$sx .= $line['pb_area'];
		$area = trim($line['a_cnpq']);
		$sx .= '&nbsp;';
		$sx .= $line['a_descricao'];
		$AREA = $area;
		$proto = $line['pb_protocolo'];
		$sx .= '<TD>' . $cor;
		$sx .= $line['pp_protocolo'];
		$sx .= '<TD>';
		$sx .= $line['pp_p01'];
		$sx .= '<TD>';
		$fc = $line['fc'];
		$nota = $line['pp_abe_11'] + $fc;
		$notao = round('0'.$line['pp_abe_11']*100);
		if ($nota > 10) { $nota = 10; }
		if ($nota < 0) { $nota = 0; }
		$merito = 0;
		if (trim($line['pp_p01']) == '20') {
			$ia++;
			$sx .= '<font color="red">*</font>';
			$merito = 1;
		}
		$sx .= '<TD align="center">';
		$sx .= number_format($nota,1,',','.');
		$sx .= '<TD><NOBR>['.trim($line['avaliador']).']';
		
	
		$sx .= '<TD>';
		$sx .= $fc;
		$sx .= '<TD>';
		$sx .= $line['pp_nome'];
		$sx .= '<TD>';
		$sx .= $line['pp_centro'];
		$sx .= '<TD>';
		$sx .= $line['pa_nome'];
		$sx .= '<TD>';
		$sx .= $line['pb_semic_idioma'];
		$sx .= '<TD>';
		$sx .= $line['pbt_edital'];
		$sx .= '<TD>';
		$sx .= $line['pbt_descricao'];
		$sx .= '<TD>';
		$sx .= $line['pb_ano'];
		$sx .= '<TD>';
		$sx .= $line['pb_status'];
		$to++;
		$nota = strzero($nota*100,5);
		$sql = "update pibic_bolsa_contempladas set
				pb_semic_nota = '".$nota."',
				pb_semic_apresentacao = '',
				pb_semic_merito = '$merito',
				pb_semic_area_nova = '$area',
				pb_semic_nota_original = $notao
				where pb_protocolo = '".trim($proto)."' ";
		$rrr=db_query($sql);
		//echo '<BR>'.$sql;
	}
}
$sx .= '</table>';
echo '<BR>--->Aprovado com mérito: ' . $ia;
echo '<BR>--->Total de projetos: ' . $to;
echo $sx;

require ("../foot.php");
?>