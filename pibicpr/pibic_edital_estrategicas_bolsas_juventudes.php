<?php
require("cab.php");
require("../_class/_class_pibic_projetos.php");
$pj = new projetos;

if (strlen($dd[1]) == 0)
	{
		$ano = date("Y");		
	} else {
		$ano = $dd[1];
	}

$meta = 1100;

require($include.'_class_form.php');
$form = new form;

echo '<H3>Edital por Áreas estratégicas</h3>';

$sql = "select * from pibic_submit_documento 
		inner join pibic_projetos on pj_codigo = doc_protocolo_mae
		inner join pibic_professor on pj_professor = pp_cracha
		inner join ajax_areadoconhecimento on pj_area_estra = a_cnpq
		left join centro on pp_escola = centro_codigo
		left join (
					select count(*) as nota, pp_protocolo 
					from pibic_parecer_$ano where pp_p05='1' 
					group by pp_protocolo
					) as tabela on pp_protocolo = doc_protocolo
		left join pibic_bolsa_contempladas on doc_protocolo = pb_protocolo
		left join pibic_aluno on pa_cracha = pb_aluno	
		left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
		where (doc_ano = '".$ano."') 
			and (pj_status <> 'X')
			and (doc_status <> 'X')
			and pj_ano = '$ano'
			and (pj_area_estra = '9.00.00.01-X')
		order by pj_area_estra, doc_nota desc, pp_nome, doc_protocolo_mae, doc_protocolo
		";
		
$rlt = db_query($sql);

$sx = '<Table width="98%" align="center" class="tabela00">';
$sx .= '<TR>
			<TH width="10%">Professor
			<TH width="1%"  align="rigth">SS
			<TH width="5%">Escola
			<TH width="5%">Codigo			
			<TH width="15%">Projeto do professor
			<TH width="5%">Protocolo
			<TH width="15%">Plano de trabalho
				<!--<TH width="3%">Nota-->
			<TH width="5%">Ano
			<TH width="5%">Doc. aluno
			<TH width="5%">Edital
			<TH width="5%">Cod. Aluno
			<TH width="10%">Nome Auno
			<TH width="1%">Status
			<TH width="5%">Modalidade bolsa									
			';
			
$tot = 0;
while ($line = db_read($rlt))
	{
		$area  				= $line['pj_area_estra'];
		$area_descricao 	= $line['a_descricao'];	
		$titpl 				= ucfirst(strtolower($line['doc_1_titulo']));
		$titpj 				= ucfirst(strtolower($line['pj_titulo']));
		//$nota 				= $line['doc_nota'];
		$aval 				= $line['doc_avaliacoes'];				
		$prof 				= ucwords(strtolower($line['pp_nome']));	
		$prot 				= $line['doc_protocolo'];
		$protj 				= $line['doc_protocolo_mae'];
		//Busca o status da tabela [pibic_bolsa_contempladas]
		$status				= $line['pb_status'];	
			if ($status == '@') { $bolsa_status = 'Não implementada'; }	
	        if ($status == 'A') { $bolsa_status = 'Ativa'; }
	        if ($status == 'B') { $bolsa_status = 'Concluida'; }
	        if ($status == 'F') { $bolsa_status = 'Finalizada'; }
	        if ($status == 'C') { $bolsa_status = 'Cancelada'; }
	        if ($status == 'S') { $bolsa_status = 'Suspensa'; }
		//Busca o tipo de bolsa da tabela [pibic_bolsa_contempladas]
		$bolsa = $line['pb_tipo'];
			if ($bolsa == 'P') { $bolsa_descricao = 'Bolsista PUCPR'; }
			if ($bolsa == 'F') { $bolsa_descricao = 'Bolsista Fundação Araucária'; }
			if ($bolsa == 'C') { $bolsa_descricao = 'Bolsista CNPq'; }
			if ($bolsa == 'I') { $bolsa_descricao = 'Bolsista ICV'; }
			if ($bolsa == 'A') { $bolsa_descricao = 'Qualificados'; }
			if ($bolsa == '7') { $bolsa_descricao = 'Juventude'; }			
		
		if ($area != $xarea)
			{	
				$sx .= '<TR><TD colspan=10><font color="blue" class="lt4">';
				$sx .= $area;
				$sx .= $area_descricao;
				$xarea = $area;
				$sx .= $ano;			
				$sx .= '</font>';
			}	
		{			
		$sx .= '<TR>';
			$sx .= '<TD class="tabela01">';
			$sx .= $prof;
			$xprof = $prof;
			$sx .= '<TD class="tabela01">';
			$sx .= $line['pp_ss'];
			$sx .= '<TD class="tabela01">';
			$sx .= $line['centro_nome'];
			$sx .= '<TD class="tabela01">';
			$sx .= $protj;
			$sx .= '<TD class="tabela01">';
			$sx .= $titpj;
			$sx .= '<TD class="tabela01">';
			$sx .= $prot;
			$sx .= '<TD class="tabela01">';
			$sx .= $titpl;
			//$sx .= '<TD class="tabela01">';
			//$sx .= $nota;
			$sx .= '<TD class="tabela01">';
			$sx .= $line['doc_ano'];
			$sx .= '<TD class="tabela01">';
			$sx .= $line['pb_protocolo'];
			$sx .= '<TD class="tabela01">';
			$sx .= $line['doc_edital'];
			$sx .= '<TD class="tabela01">';
			$sx .= $line['pb_aluno'];			
			$sx .= '<TD class="tabela01">';
			$sx .= ucwords(strtolower($line['pa_nome']));								
			$sx .= '<TD class="tabela01">';
			$sx .= $bolsa_status;				
			$sx .= '<TD class="tabela01">';
			$sx .= $bolsa_descricao;			
		$tot++;
		}
	}
$sx .= '<TR><TD colspan=5>'.msg('total').' '.$tot;
$sx .= '</table>';
echo $sx;

?>
