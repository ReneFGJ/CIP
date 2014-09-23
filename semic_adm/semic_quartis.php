<?
$breadcrumbs=array();
require("cab_semic.php");

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

$sx = '<table>';
$ia=0;
$AREA = '';
$pos = 0;
$lim = 0;
while ($line = db_read($rlt))
	{
		$area = trim($line['a_cnpq']);
		if ($area != $AREA)
			{
				$lin_in = array_search(trim($line['pbt_edital']).' '.$area,$ar);
				$lin = $lin_in;
				$tot = round(round($at[$lin] * 0.25 * 100)/100);
				$sx .= '<TR><TD class="lt3" colspan=2>'.$area.' ('.$lin.'/'.$tot.')';
				$sx .= '&nbsp;';
				$sx .= $line['a_descricao'];
				$AREA = $area;
				$pos = 0;
			}
		$pos++;
		$sx .= '<TR>';
		$sx .= '<TD>';
		$sx .= $pos.'.';
		$sx .= '<TD>';
		$sx .= $line['pb_protocolo'];
		
		$sx .= '<TD>';
		$sx .= $line['pb_semic_idioma'];	
			
		$sx .= '<TD>';
		$sx .= number_format($line['pb_semic_nota']/100,1);	
		$sx .= '<TD>';
		$sx .= number_format($line['pb_semic_nota_original']/100,1);	
				$sx .= '<TD>';
		$sx .= $line['pb_semic_merito'];	
		$sx .= '<TD>';
		$sx .= $line['pbt_edital'];	
		
		$protocolo = $line['pb_protocolo'];
		$idioma = $line['pb_semic_idioma'];
		$area = $line['a_cnpq'];
		$nota = $line['pb_semic_nota_original'];
		$meirto = $line['pb_semic_merito'];
		$edital = trim($line['pbt_edital']);

		$apre = $line['pb_semic_apresentacao'];
		$save = 1;
		switch ($apre)
			{
				case 'O': $sx .= '<font color="blue">Apresentação Oral</font>'; $save = 0; break;
				case 'P': $sx .= '<font color="Green">Apresentação Poster</font>'; $save = 0; break;
				case 'N': $sx .= '<font color="Red">Não aprovado para apresentação</font>'; $save = 0; break;
				case ' ': $sx .= '<font color="Orange">Em definição</font>'; $save = 0; break; 
			}
		/* Posicao */
		$npos = 0;
		if ($save == 1)
			{
				if ($pos <= $tot)
					{ $tipo = 'O'; $npos = 1; }
					
				if ($nota < 6) { $tipo = 'N'; $npos = 1; }
			}
		if ($save == 1)
			{		
				grava_regras($protocolo,$idioma,$nota,$npos,$merito,$edital);
			}
		}
$sx .= '</table>';
echo $sx;
require("../foot.php");

function grava_regras($protocolo,$idioma,$nota,$npos,$merito,$edital)
	{
		$tipo = '';
		if ($idioma == 'en_US')
			{
				if ($nota > 850) { $tipo = 'O'; }
				else {
					if ($nota > 650) 
					{ $tipo = 'P'; }
					else { $tipo = 'N'; }
				}
			} else {
				if ($npos == 1)
					{
						$tipo = 'O';
					} else {
						$tipo = 'P';
					}
				if ($edital == 'PIBITI') { $tipo = ' '; }
				if ($nota < 6) { $tipo = 'N'; }
			}
			
		if ($tipo != '')
			{
			$sql = "update pibic_bolsa_contempladas 
					set pb_semic_apresentacao = '$tipo'
				where pb_protocolo = '$protocolo'
				";
			$qqq = db_query($sql);
			}
		
	}
?>