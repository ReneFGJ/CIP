<?php
$include = '../';
require("../db.php");
require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;
require("../_class/_class_pareceristas.php");
$par = new parecerista;
require("../_class/_class_parecer_pibic.php");
$pp = new parecer_pibic;
require("../_class/_class_ic.php");
$ic = new ic;
require($include.'sisdoc_email.php');


if ($dd[2]=='DECLINAR')
	{
		$sql = "update pibic_bolsa_contempladas set pb_relatorio_parcial_nota = -99
				where pb_protocolo = '".$dd[5]."' 
		";
		$rlt = db_query($sql);
		
		$sql = "update pibic_parecer_".date("Y")." set pp_status = 'D' where id_pp = ".$dd[3];
		$rlt = db_query($sql);
		//pb_relatorio_parcial_nota
		echo '<font color="blue">Declinou</font>';
		exit;
	}
	
require("_email.php");
print_r($dd);
/* TIPOS DE DOCUMENTOS */
$rtipo = $dd[2];			/* Tipo de Relatorio */
$edital = $dd[1];			/* Modalidade */
$proto = trim($dd[0]);		/* ID do trabalho */
$acao = $dd[90];
$avaliador = $dd[10];		/* Recupera o avaliador indicado */
$idpp = $dd[3];

if ($proto==sonumero($proto)) 
	{ while (strlen($proto) < 7) { $proto = '0'.$proto; } }
	
	
/* Seta paramentros do Sistema de Parecer */
$pp->protocolo = $proto;
$pp->modalidade = $edital;
$pp->tipo = $rtipo;

/* Dados do projeto */
$pb->le('',$proto);
$area = $pb->pb_semic_area;
$prof = $pb->pb_professor;


/* Tipos de relatórios */
require("../_class/_class_ic_acompanhamento.php");
$pari = new ic_relatorio;
$pari->tabela = $pp->tabela_vigente();

/* Excluir todas as avaliações */
/* 
 * $sql = "delete from ".$pari->tabela." where pp_tipo = '".$rtipo.""' or pp_tipo = '' ";
 * $rlt = db_query($sql);
 */

switch ($rtipo)
	{
	/* Relatorio Parcial */
	case 'RPAR':
		$field = 'pb_relatorio_parcial';
		$limit_avaliacoes = 1;
		break;
	case 'RPAC': /* Relatório Parcial Junior */
		$field = 'pb_relatorio_parcial_correcao';
		$limit_avaliacoes = 1;
		break;		
	case 'RPAJ': /* Relatório Parcial Junior */
		$field = 'pb_relatorio_parcial';
		$limit_avaliacoes = 1;
		break;		
	case 'RFIN': /* Relatório Parcial Junior */
		$field = 'pb_relatorio_final';
		$limit_avaliacoes = 10;
		break;		
	default:
		echo '<font color="red">Relatório não implementado '.$rtipo.'</font>';
		exit;
		break;
	}


echo '<TD colspan=10>';

/** Não existe ação */
if (strlen($acao) == 0)
{
	echo '<table class="tabela01" width="100%">';
	echo '<TR><TD>';
	echo '<B>'.$pb->pb_titulo_projeto.'</B>';
		echo '<BR>'.$prof;
	
	$pari->protocolo = $proto;
	echo $pp->avaliador_do_relatorio($rtipo);
	if ($pp->total_indicacoes < $limit_avaliacoes)
		{
		echo $pp->avaliador_idicar_form($proto,$area,$rtipo);
		} 
	echo '</table>';
	exit;
}

/* Acoes */

if ($acao == 'INDICAR')
	{		
		if ($prof == $avaliador)
			{
				echo '
				<script>
					alert("O Avaliador é o mesmo que o orientador neste projeto");
				</script>
				';
					
			} else {
				$avaliador = $dd[10];
				$par->le($avaliador);
				
				$trocas = array();
				array_push($trocas,array('$TITULO',$pb->pb_titulo_projeto));
				if (date("Ymd") > 20140805)
					{
					$pp->enviar_email_indicacao($proto,$par,$rtipo,$trocas);
					}
				$pp->inserir_idicacao_avaliacao($proto,$avaliador,$rtipo);
				$pp->avaliacoes_mudar_deadline($rtipo,20140815);
				
				$sql = "update pibic_bolsa_contempladas 
						set ".$field."_nota = -90
						where pb_protocolo = '".$proto."' ";
				$rlt = db_query($sql);
		
				$pr = round($proto);
				$sx = '
				<script>
					$("#TR'.$proto.'").hide();
					$("#TRI'.$proto.'").hide();
					alert("Indicado");
				</script>
				';
				echo $sx;
				exit;
			}	
	}

/* ACOES */
/* DECLINAR AVALIACAO */
	
if ($acao=='DECLINAR')
	{
		$id = round($dd[3]);

		$pp->declinar($id);
		
		$sql = "update pibic_bolsa_contempladas set pb_relatorio_final_nota = -99
				where pb_protocolo = '".$dd[5]."' 
		";
		$rlt = db_query($sql);
		
		//pb_relatorio_parcial_nota
		echo '<font color="blue">Declinou</font>';
		exit;
	}
function msg($x) { return($x); }
?>
