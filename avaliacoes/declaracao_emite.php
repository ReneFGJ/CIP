<?
require("db.php");
require($include.'sisdoc_pdf.php');
$versao_pdf = '0.0.34a';
class PDF extends FPDF
{
//Page header
function Header()
{
	//Logo
	//$this->Image('../img/logo_re2ol.jpg',10,8,16);
	//Arial bold 15
	$this->SetFont('Times','B',12);
	//Move to the right
	$this->Cell(80);
	//Title
	$this->Cell(110,6,'Manuscrito de pesquisa',1,0,'R');
	//Line break
	$this->SetFont('ARIAL','',6);		
//	for ($ll=0;$ll < 62;$ll++)
//		{
//		$this->SetXY(7,$ll*4+16);
//		$this->Cell(0,10,$ll*1+1,0,0,'L');
//		}
//	$this->SetXY(0,20);
//	$this->Ln(0);
}

//Page footer
function Footer()
{
	global $dd,$data_submit,$versao_pdf;
	//Position at 1.5 cm from bottom
//	$this->SetY(-15);
	//Arial italic 8
//	$this->SetFont('Arial','I',8);
	//Page number
//	$this->Cell(0,10,'Submissão n. '.$dd[0].' em '.$data_submit,0,0,'L');
//	$this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'R');
//	$this->Ln(3);
//	$this->SetFont('Arial','I',4);
//	$this->Cell(0,10,'RE2ol v.'.$versao_pdf,0,0,'L');
}
}

/////////////////// INÌCIO DO PDF
$pdf=new PDF();
$ln = 0;

$pdf->AliasNbPages();
$pdf->AddPage();

/////////////////////////////// Titulo
$pdf->SetFont('Times','',16);
$pdf->Ln($ln);
$pdf->MultiCell(0,8,$titulo,0,'C');
$pdf->Ln($ln);
$pdf->SetFontSize(14);	

//if (strlen($destino) > 0)
//	{
//		$pdf->Output($destino);
//		echo 'Arquivo salvo em:'.$destino;
//	} else {
		$pdf->Output();
//	}

?>