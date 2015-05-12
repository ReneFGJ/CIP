<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_debug.php');
require("../_class/_class_ic.php");
$ic = new ic;

require('_email.php');

/*
 * Dados do avaliador
 */
require("../_class/_class_declaracao_ic.php");
$dec = new declaracao_ic;
$secu = $dec->secu;

$id = $dd[0];
$parecerista = $id;
$chk = checkpost($id.$secu);

if (strlen($dd[0])==8)
	{
		require("../_class/_class_docentes.php");
		$par = new docentes;		
		$par->le($parecerista); 
		$link = $par->link_avaliador;
		$nw = $ic->ic('ic_declaracao_av_int');
		$nome = trim($par->line['pp_nome']);
		$data = date("Ymd");
	} else {
		if (date("m") < 5)
			{
			echo '<H1>Em processamento</h1>';
			exit;
			}
		require("../_class/_class_pareceristas.php");
		$par = new parecerista;
		$par->le($parecerista); 
		$link = $par->link_avaliador;
		$nw = $ic->ic('ic_declaracao_av_ext');
		$nome = trim($par->line['us_nome']);
		$data = date("Ymd");		
	}
$titulo = $nw['nw_titulo'];
$texto = $nw['nw_descricao'];

$texto = troca($texto,'$nome',$nome);
$texto = troca($texto,'$issn',$issn);
$texto = troca($texto,'$ISSN',$issn);
$texto = troca($texto,'$NOME',$nome);
$texto = troca($texto,'$avaliador',$nome);
$texto = troca($texto,'$AVALIADOR',$nome);
$texto = troca($texto,'$link',$link);
$texto = troca($texto,'$LINK',$link);
$dia = substr($data,6,2);
$mes = round(substr($data,4,2));
$mes_nome = array('','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
$mes = $mes_nome[$mes];
$ano = substr($data,0,4);
$texto = troca($texto,'$REVISTA',$admin_nome);
$texto = troca($texto,'$DIA',$dia);
$texto = troca($texto,'$MES',$mes);
$texto = troca($texto,'$ANO',$ano);
$texto = troca($texto,'$EDITOR',$editor);



//echo '<BR><B>'.$titulo.'</B><BR>';
//echo mst($texto);

/*
 * PDF
 */
require($include.'fphp-153/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

	$img = '../img/email_ic_header.png';
	if (file_exists($img)) 
		{
			 $pdf->Image($img,0,0,210); 
		}
	
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,100,' ',0,0,'C');
$pdf->ln(60);
$pdf->SetFont('Arial','B',22);
$pdf->Cell(0,12,'D E C L A R A Ç Ã O',0,0,'C');
$pdf->ln(20);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,$texto);
$pdf->SetX(0);
$pdf->SetY(240);
$img = '../img/wefuwe_ldjaasjh_xxcmv_xkcvbc.jpg';
$pdf->Image($img,10,180,80);

$pdf->MultiCell(0,5,'Declaração N. '.$dd[0].'/'.$ano);
$pdf->MultiCell(0,5,'Emitida digitalmente ('.$email_adm.')');

$img = '../img/email_ic_foot.png';
$pdf->Image($img,0,260,210);
$pdf->Output();
?>
