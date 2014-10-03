<?
$breadcrumbs=array();
require("cab_semic.php");

$bls = array(
		'A'=>'<font color="Blue">Apresentacao Oral</font> <font color="red">Inglês</font> (PIBIC)',
		'B'=>'Apresentação Oral - CICPG (PIBIC)',
		'C'=>'<font color="Green">Apresentação Oral</font> (PIBIC)',
		
		'D'=>'<font color="Blue">Apresentacao Oral</font> <font color="red">Inglês</font> (PIBITI)',
		'E'=>'Apresentação Oral - CICPG (PIBITI)',
		'F'=>'Apresentação Oral (PIBITI)',
		
		'L'=>'<font color="Blue">Poster</font> <font color="red">Inglês</font> (PIBIC)',
		'M'=>'Poster (PIBIC)',
		'N'=>'<font color="Blue">Poster</font> <font color="red">Inglês</font> (PIBITI)',
		'O'=>'Poster (PIBITI)',
		
		'V'=>'<font color="red">**VERIFICAR**</font>',
		'Z'=>'<font color="red">Não recomendado para apresentação</font>'
		
	);

$sql = "select count(*) as total, pb_semic_area_nova, pbt_edital 
			from pibic_bolsa_contempladas
			inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo			
			where pb_ano = '".(date("Y")-1)."'
				and pb_status <> 'C' and pb_semic_idioma = 'pt_BR'
				and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI')
		group by pb_semic_area_nova, pbt_edital	
		order by pb_semic_area_nova, pbt_edital		
		";
$rlt = db_query($sql);	
$ar = array();
$at = array();
while ($line = db_read($rlt))
	{
		array_push($ar,trim($line['pbt_edital']).' '.trim($line['pb_semic_area_nova']));
		array_push($at,$line['total']);
	}		

/* SALDOS */
$sql = "
		select pb_semic_apresentacao, count(*) as total from pibic_bolsa_contempladas 
		inner join ajax_areadoconhecimento on pb_semic_area_nova = a_cnpq
		
		inner join pibic_professor on pb_professor = pp_cracha
		inner join pibic_aluno on pb_aluno = pa_cracha
		inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo
		left join apoio_titulacao on ap_tit_codigo = pp_titulacao
		left join centro on centro_codigo = pp_escola

		where pb_ano = '".(date("Y")-1)."'
				and pb_status <> 'C'
				and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI')
		group by pb_semic_apresentacao
		order by pb_semic_apresentacao
		";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$ap = trim($line['pb_semic_apresentacao']);
		echo '<BR>';
		echo $bls[$ap];
		echo ' - '.$line['total'];
	}

/* Processo normal */

$sql = "
		select * from pibic_bolsa_contempladas 
		inner join ajax_areadoconhecimento on pb_semic_area_nova = a_cnpq
		
		inner join pibic_professor on pb_professor = pp_cracha
		inner join pibic_aluno on pb_aluno = pa_cracha
		inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo
		left join apoio_titulacao on ap_tit_codigo = pp_titulacao
		left join centro on centro_codigo = pp_escola

		where pb_ano = '".(date("Y")-1)."'
				and pb_status <> 'C'
				and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI')
				order by pbt_edital, pb_semic_idioma, a_cnpq, 
					pb_semic_nota desc, pb_semic_nota_original desc,
					pb_semic_merito desc
		
		";
$rlt = db_query($sql);

$sx = '<table border=1>';
$ia=0;
$AREA = '';
$pos = 0;
$lim = 0;

$ap = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$po = 0;
$np = 0;
while ($line = db_read($rlt))
	{
		$save = 1;
		$link = '<A HREF="/reol/pibicpr/pibic_detalhe.php?dd0='.$line['pb_protocolo'].'&dd90='.checkpost($line['pb_protocolo']).'" target="_new">';
		$area = trim($line['a_cnpq']);
		if ($area != $AREA)
			{
				$AREA = $area;
				$pos = 0;				
			}
				$aa = trim($line['pbt_edital']).' '.$area;
				$lin_in = array_search(trim($line['pbt_edital']).' '.$area,$ar);
				$lin = $lin_in;
				$tot = round(round($at[$lin] * 0.25 * 100)/100)+1;
				if ($tot == 0) { $tot = 1; }
				$sx .= '<TR><TD class="lt3" >'.$area;
				$sx .= '&nbsp;';
				$sx .= $line['a_descricao'];
		$pos++;
		//$sx .= '<TR>';
		$sx .= '<TD>';
		$sx .= $pos.'.';
		$sx .= '<TD>';
		$sx .= $link;
		$sx .= $line['pb_protocolo'];
		$sx .= '</A>';
		
		$sx .= '<TD>';
		$sx .= $line['pb_semic_idioma'];	
			
//		$sx .= '<TD>';
//		$sx .= number_format($line['pb_semic_nota']/100,1);	
//		$sx .= '<TD>';
//		$sx .= number_format($line['pb_semic_nota_original']/100,1);	
//		$sx .= '<TD>';
//		$sx .= $line['pb_semic_merito'];
//		$sx .= '<TD>'. $nota;
	
		$sx .= '<TD>';
		$sx .= $line['pbt_edital'];	
		
		$protocolo = $line['pb_protocolo'];
		$idioma = $line['pb_semic_idioma'];
		$area = $line['a_cnpq'];
		$nota = $line['pb_semic_nota_original'];
		$meirto = $line['pb_semic_merito'];
		$edital = trim($line['pbt_edital']);

		$apre = trim($line['pb_semic_apresentacao']);
		
		$sx .= '<TD><NOBR>'. $bls[$apre];
		$cor= '';
		//if ($line['pb_relatorio_final'] < 20140101) { $cor = '<font color="red">'; }
		//$sx .= '<TD>'.$cor.stodbr($line['pb_relatorio_final']);
		$sx .= '<TD><NOBR>'.$line['pp_centro'];
		$sx .= '<TD><NOBR>'.$line['pp_nome'];
		$sx .= '<TD><NOBR>'.$line['pp_email'];
		$sx .= '<TD><NOBR>'.$line['pp_email_1'];
		$sx .= '<TD><NOBR>'.$line['pa_nome'];
		$sx .= '<TD><NOBR>'.$line['pa_email'];
		$sx .= '<TD><NOBR>'.$line['pa_email_1'];
		$npos = 0;

		}
$sx .= '</table>';

echo $sx;
require("../foot.php");

?>