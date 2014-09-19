<?
$breadcrumbs = array();
require ("cab_semic.php");

$sql = "select * from (
		select substr(pb_semic_area,1,4) || '.00.00' as pb_area, * from pibic_parecer_2014
		inner join pibic_bolsa_contempladas on pb_protocolo = pp_protocolo
		where pp_tipo = 'RFIN' 
		and pp_status <> '@' and pp_status <> 'D' and pb_status <> 'C'
		) as tabela
		left join ajax_areadoconhecimento on pb_area = substr(a_cnpq,1,10)
		left join pibic_professor on pb_professor = pp_cracha
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
		$sx .= '&nbsp;';
		$sx .= $line['a_descricao'];
		$AREA = $area;

		$sx .= '<TD>' . $cor;
		$sx .= $line['pp_protocolo'];
		$sx .= '<TD>';
		$sx .= $line['pp_p01'];
		$sx .= '<TD>';
		if (trim($line['pp_p01']) == '20') {
			$ia++;
			$sx .= '<font color="red">*</font>';
		}
		$sx .= '<TD align="center">';
		$sx .= $line['pp_abe_11'];
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
	}
}
$sx .= '</table>';
echo '<BR>--->Aprovado com mérito: ' . $ia;
echo '<BR>--->Total de projetos: ' . $to;
echo $sx;

require ("../foot.php");
?>