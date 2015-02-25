<?php
require("db.php");
require($include."sisdoc_data.php");
require($include."sisdoc_debug.php");
require($include.'fphp-153/fpdf.php');
require($include."sisdoc_file.php");
$versao_pdf = '0.10.14';

if (strlen($dd[10]) > 0)
	{
	if ($dd[11] != md5('parecer'.$dd[10]))
		{ echo 'Erro de chave, consulte administração pibicpr@pucpr.br'; exit; }
	}

class PDF extends FPDF
{
//Page header
function Header()
{
global $dir;
 /////////////// mostrar imagem
	//Logo
	$this->Image('../pibic/img/homeHeaderLogoImage.jpg',10,8,150);
	//Arial bold 15
	$this->SetLineWidth(0.2);	
	$this->SetFont('ARIAL','B',12);
	//Move to the right
	$this->Cell(70);

	if ($dd[12] == 'F')
		{
			//Title
			$this->Cell(110,6,'Relatório Parcial',0,0,'R');
		} else {
			//Title
			$this->Cell(110,6,'Relatório Final e Resumo',0,0,'R');
		}
	//Line break
	////////////////////////// LOGOTIPO


	$this->SetFont('ARIAL','',6);		
//	for ($ll=0;$ll < 62;$ll++)
//		{
//		$this->SetXY(7,$ll*4+16);
//		$this->Cell(0,10,$ll*1+1,0,0,'L');
//		}
	$this->SetXY(0,39);
	$this->Ln(0);
	$this->Ln(0);
	$this->Ln(0);
}

//Page footer
function Footer()
{
	global $dd,$data_submit,$versao_pdf;
	//Position at 1.5 cm from bottom
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Page number
	$this->Cell(0,10,'Parecer '.$dd[0]);
	$this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'R');
	$this->Ln(3);
	$this->SetFont('Arial','I',4);
	$this->Cell(0,10,'RE2ol v.'.$versao_pdf,0,0,'L');
}
}
/////////////////////////////// ATENCAO NESTA ROTINA
/////////////////////////////// IMAGENS ANEXAS

$sql = "select * from  pibic_parecer_2010 ";
$sql .= " where id_pp = '0".$dd[0]."' ";
$sql .= " or pp_protocolo = '".$dd[10]."' ";
$sql .= " order by id_pp desc ";
$rlt = db_query($sql);
$rline = db_read($rlt);


///////////////////////// DADOS DO PROJETO
$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
$sql .= " where pb_protocolo = '".$rline['pp_protocolo']."' ";
$sql .= "order by pa_nome";
$rlt = db_query($sql);
$sx = '';
if ($line = db_read($rlt))
	{
	$ptip = $rline['pp_tipo'];
	if (strlen($dd[12]) == 0) { $dd[12] = substr($ptip,4,1); }

	$ano = $line['doc_ano'];
	$nota_parcial = $line['pb_relatorio_parcial_nota'];
	$nota_final   = $line['pb_relatorio_final_nota'];

	$data_parcial = $line['pb_relatorio_parcial'];
	$data_final   = $line['pb_relatorio_final'];
	
	$ttt = LowerCase($line['doc_1_titulo']);
	$ttt = UpperCase(substr($ttt,0,1)).substr($ttt,1,strlen($ttt));
	
	$ttp = LowerCase($line['pb_titulo_projeto']);
	$ttp = UpperCase(substr($ttp,0,1)).substr($ttp,1,strlen($ttp));
	$data_ativa = stodbr($line['pb_data_ativacao']);
	$pb_contrato = trim($line['pb_contrato']);
	$aluno     = trim($line['pa_nome']);
	$aluno_cracha = trim($line['pa_cracha']);
	$aluno_rg  = $line['pa_rg'];
	$aluno_cpf = $line['pa_cpf'];
	$aluno_pai = $line['pa_pai'];
	$aluno_mae = $line['pa_mae'];
	$aluno_end = mst($line['pa_endereco']);
	$prof      = trim($line['pp_nome']);
	$prof_cracha = trim($line['pp_cracha']);
	$protocolo = $line['pb_protocolo'];
	$protocolom= $line['pb_protocolo_mae'];	
	$pb_fomento = trim($line['pb_fomento']);
	$pb_bolsa_codigo = trim($line['pb_codigo']);
	$pb_bolsa = trim($line['pb_tipo']);
	
	if ($pb_bolsa == 'F') { $pb_bolsa = '<img src="img/logo_fa_mini.jpg">'; $pb_cod = 'FAR'; $tpbolsa = "Fundação Araucária"; }
	if ($pb_bolsa == 'P') { $pb_bolsa = '<img src="img/logo_pucpr_mini.jpg">'; $pb_cod = 'PUC'; $tpbolsa = "PUCPR"; }
	if ($pb_bolsa == 'C') { $pb_bolsa = '<img src="img/logo_cnpq_mini.jpg">'; $pb_cod = 'CNP'; $tpbolsa = "CNPq"; }
	if ($pb_bolsa == 'I') { $pb_bolsa = '<img src="img/logo_icv_mini.jpg">'; $pb_cod = 'ICV'; $tpbolsa = "Iniciação Científica Voluntária"; }
	
	$bolsa = trim($line['pb_tipo']);
	require("bolsa_tipo.php");
	}
	
	$file = trim($line['pl_filename']);
	$dire = $line['pl_data'];
	$orde = intval('0'.$line['sdo_ordem']);
	$exte = StrtoLower($line['pl_type']);
	$pl_data = trim($line['pl_data']);
	$arq = $dir.'/pibicpr/public/cep_submit/'.substr($pl_data,0,4).'/'.substr($pl_data,4,2).'/';


$pdf=new PDF();
$pdf->AliasNbPages();
$ln = 0;
$pdf->AddPage();

//////////////////
$pdf->SetFont('ARIAL','B',15);
$pdf->Ln($ln);
	if ($dd[12] == 'F')
		{
			//Title
			$pdf->MultiCell(0,8,"Parecer do Relatório Final e Resumo - ".$ano,0,'C');
		} else {
			//Title
			$pdf->MultiCell(0,8,"Parecer do Relatório Parcial - ".$ano,0,'C');
		}
$pdf->MultiCell(0,8," ",0,'C');
$pdf->MultiCell(0,8," ",0,'C');

//////////////////
// Protocolo: <B><?=$protocolo.'/'.$protocolom;
$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"Protocolo: ".$protocolo.'/'.$protocolom,0,'R');

/////////////////////////////////////////////
$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"TÍTULO DO PLANO DO ALUNO",0,'L');

$pdf->SetFont('ARIAL','B',18);
$pdf->MultiCell(0,8,$ttp,0,'L');
$pdf->MultiCell(0,8," ",0,'C');



//////////////////
$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"TÍTULO DO PROJETO DO PROFESSOR",0,'L');
$pdf->SetFont('ARIAL','B',14);
$pdf->MultiCell(0,6,$ttt,0,'L');

$pdf->Ln($ln);	
//////////////////////////////////////////////////////// DADOS DO ALUNO
//////////////////
$pdf->Ln($ln);
$pdf->MultiCell(0,8," ",0,'C');

$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"NOME DO ALUNO",0,'L');
$pdf->SetFont('ARIAL','B',14);
$pdf->MultiCell(0,6,$aluno.' ('.$aluno_cracha.')',0,'L');

$pdf->SetFont('ARIAL','',10);
$pdf->MultiCell(0,2,"Iniciação científica: ".$tpbolsa,0,'L');

$pdf->MultiCell(0,8," ",0,'C');

//////////////////////////////////////////////////////////////
$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"PROFESSOR ORIENTADOR",0,'L');
$pdf->SetFont('ARIAL','B',14);
$pdf->MultiCell(0,6,$prof.' ('.$prof_cracha.')',0,'L');
$pdf->MultiCell(0,8," ",0,'C');

////////////////////////////// DOCUMENTOS EM IMAGEM FINAL
//Set font

 ////////////////////////////////////////////////////////////// 1)
$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"1) Resultado da avaliação",0,'L');
$pdf->SetFont('ARIAL','B',14);

$tp = trim($rline['pl_p0']);
if ($tp == '1') { $tp = 'APROVADO'; }
if ($tp == '2') { $tp = 'PENDÊNCIA'; }
$pdf->MultiCell(0,6,$tp,0,'L');
$pdf->MultiCell(0,8," ",0,'C');

 ////////////////////////////////////////////////////////////// 2)
$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"2) Clareza, legibilidade e objetividade (português, organização geral do texto, figuras, gráficos, tabelas, referências, etc.):",0,'L');
$pdf->SetFont('ARIAL','B',14);

$txt = processa($rline['pl_p40']);
$txt2 = trim($rline['pl_p46']);
if (strlen($txt2) > 0) { $txt = trim($txt).'.'.chr(13).chr(10).lowercase($txt2); } else { $txt = trim($txt).'.'; }
$pdf->MultiCell(0,6,$txt,0,'L');
$pdf->MultiCell(0,8," ",0,'C');

 ////////////////////////////////////////////////////////////// 3)
$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"3) Cumprimento do cronograma previsto:",0,'L');
$pdf->SetFont('ARIAL','B',14);

$txt = processa($rline['pl_p41']);
$txt2 = trim($rline['pl_p47']);
if (strlen($txt2) > 0) { $txt = trim($txt).'.'.chr(13).chr(10).lowercase($txt2); } else { $txt = trim($txt).'.'; }
$pdf->MultiCell(0,6,$txt,0,'L');
$pdf->MultiCell(0,8," ",0,'C');

 ////////////////////////////////////////////////////////////// 4)
$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"4) Resultados parciais obtidos:",0,'L');
$pdf->SetFont('ARIAL','B',14);

$txt = processa($rline['pl_p42']);
$txt2 = trim($rline['pl_p48']);
if (strlen($txt2) > 0) { $txt = trim($txt).'.'.chr(13).chr(10).lowercase($txt2); } else { $txt = trim($txt).'.'; }
$pdf->MultiCell(0,6,$txt,0,'L');
$pdf->MultiCell(0,8," ",0,'C');

////////////////////////////////////////////////////////////// 5)
$comentario = trim($rline['pl_p43']);
if (strlen($comentario) == 0)
	{ $comentario = 'sem comentário'; }
	
$pdf->SetFont('Arial','',8);
$pdf->Ln($ln);
$pdf->MultiCell(0,2,"5) Comentários sobre a avaliação",0,'L');
$pdf->SetFont('ARIAL','B',14);
$pdf->MultiCell(0,6,$comentario,0,'L');
$pdf->MultiCell(0,8," ",0,'C');

$pdf->Ln($ln);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,8,'Arquivo gerando em '.date("d/m/Y H:i"),0,'R');

$ver = round('0'.$rline['pl_p15']);
if ($ver == 0) { $ver++; }

$data = $rline['pp_data'];

$arquivo = $protocolo.'-'.strzero($ver,2).'-'.substr(md5($protocolo.$ver.$secu),4,10).'_AVALIACAO_'.$rline['pp_data'].'.pdf';
$filename = '/reol/pibicpr/docs/submit/'.substr($data,0,4).'/'.substr($data,4,2).'/'.$arquivo;
$destino = $dir.'/reol/pibicpr/docs/submit/'.substr($data,0,4).'/'.substr($data,4,2).'/'.$arquivo;
$dirdest = $dir.'/reol/pibicpr/docs/submit/'.substr($data,0,4).'/'.substr($data,4,2).'/';
//$pdf->Output();
//exit;

if (strlen($destino) > 0)
	{
	
	$sql = "select * from pibic_ged_files ";
	$sql .= " where pl_filename = '".trim($arquivo)."' ";
	$vrlt = db_query($sql);
	if ($line = db_read($vrlt))
		{
			$pdf->Output();
		} else {
			$dirr = diretorio_checa($dirdest);
			$pdf->Output($destino);
			$sql = "insert into pibic_ged_files ";
			$sql .= "(pl_codigo,pl_filename,pl_data,pl_texto,pl_tp_doc) ";
			$sql .= " values ";
			$sql .= "('".$protocolo."','".$arquivo."','".$rline['pp_data']."',";
			$sql .= "'Avaliação Parcial ".stodbr($rline['pp_data'])." ','00025')";
			$rlt = db_query($sql);
			$pdf->Output();
		}
	} else {
		$pdf->Output();
	}
function processa($ttt)
	{
	$pos = strpos($ttt,'<font');
	if ($pos > 0)
		{ $ttt = substr($ttt,0,$pos); }
	$ttt = troca($ttt,'<B>','');
	$ttt = troca($ttt,'</B>','');
	return($ttt);
	}
?>
