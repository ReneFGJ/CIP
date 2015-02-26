<?
require("db.php");
//require($include."sisdoc_debug.php");
require($include.'fphp-153/fpdf.php');
require($include."sisdoc_cookie.php");
require($include."sisdoc_debug.php");

	
/////////////////////////////////////////////// AVALIADOR
$sql = "select * from pareceristas ";
$sql .= " where id_us = '".strzero($dd[0],7)."' ";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$aval_nome = trim($line['us_nome']);
	$aval_titu = trim($line['us_titulacao']);
	$aval_nome = trim($aval_titu.' '.$aval_nome);
	$inst = $line['us_instituicao'];
	$xinst = "CNPQ";
	$xinst = "NORM";
	if ($inst == '0000232') { $xinst = "PUCPR"; }
	if ($inst == '0000455') { $xinst = "PUCPR"; }
	$inst = $xinst;
	}
$versao_pdf = '0.09.33';
$data_submit = date("d/m/Y");
$nr_doc = '00001/'.substr(date("Y"),2,2);
///////////////////////////////////////////////
class PDF extends FPDF
{
	function Header()
	{
	global $dir;
		 /////////////// mostrar imagem
		//Logo
	$this->Image('img/logo_instituicao.jpg',16,10,40);
		//Arial bold 15
	$this->SetLineWidth(0.2);	
	$this->SetFont('Times','B',12);
	//	//Move to the right
	$this->Cell(80);
	//	//Title
	//	$this->Cell(110,6,'Protocolo de Pesquisa',1,0,'R');
	//	//Line break
	//	////////////////////////// LOGOTIPO
	$img_logo = 'img/logo_pucpr.jpg';
	$this->Image($img_logo,185,10,12);
	
	$this->SetFont('Arial','',8);
	$this->MultiCell(0,2,'',0,'C');
	$this->MultiCell(0,4,'Pontifícia Universidade Católica do Paraná',0,'C');
	$this->MultiCell(0,4,'Iniciação Cientifica e Tecnológica da PUCPR',0,'C');
	$this->MultiCell(0,4,'www.pucpr.br/semic',0,'C');
	$this->MultiCell(0,4,'telefones: (41) 3271-1602 / 3271-1730',0,'C');

	//
//		$this->SetFont('Arial','',6);		
//		for ($ll=0;$ll < 62;$ll++)
//			{
//			$this->SetXY(7,$ll*4+16);
//			$this->Cell(0,10,$ll*1+1,0,0,'L');
//			}
		$this->SetXY(0,40);
		$this->Ln(0);
	}
	////////////////////////////////////////////////////////////////
	function Footer()
	{
		global $dd,$data_submit,$versao_pdf,$nr_doc;
		//Position at 1.5 cm from bottom
//		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
//		$this->Cell(0,10,'Declaração n. '.$nr_doc.' em '.$data_submit,0,0,'L');
	//	$this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'R');
	//	$this->Ln(3);
	//	$this->SetFont('Arial','I',4);
	//	$this->Cell(0,10,'RE2ol v.'.$versao_pdf,0,0,'L');
	}
}

////////////////////////////////////////////////////////////////
$pdf=new PDF();
$pdf->AliasNbPages();
$ln = 0;
$pdf->AddPage();
$align='C';
////////////////////////////// DOCUMENTOS EM IMAGEM INICIO

		$pdf->Ln($ln);

		$pdf->SetFont('Arial','B',18);
		$pdf->Ln(25);
		$pdf->MultiCell(0,8,'D E C L A R A Ç Ã O',0,$align);
		$pdf->Ln($ln);
		$pdf->Ln(7);
		// DECL_AVALIADOR
		$tipo = 'D2_'.$inst.'_SEMIC_'.substr(date("Y"),2,2);
		$sql = "select * from ic_noticia where nw_ref = '".$tipo."' ";
		$rrr = db_query($sql);
		if ($line = db_read($rrr))
			{
			$texto = $line['nw_descricao'];
			} else {
				echo "Texto não localizado para referência <B>'".$tipo."'</B>";
				exit;
			}
			
		///////////// Trocas
		$texto = troca($texto,'$professor_nome',$aval_nome);
		$texto = troca($texto,'$avaliador',$aval_nome);
		$texto = troca($texto,'<br>',chr(13));
		$texto = troca($texto,'&nbsp;',' ');
		////////////////////
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',14);
		$pdf->MultiCell(0,8,$texto,0,'J');
	
		/////////////////// Assinatura	
		$pdf->SetXY(20,20);
		$img_logo = 'img/wefuwe_ldjaasjh_xxcmv_xkcvbd.jpg';
//		$pdf->Image($img_logo,80,200,120);		
		$pdf->Image($img_logo,10,200,60);
		$pdf->Setxy(10,220);
		$pdf->SetFont('Arial','',11);
		$pdf->MultiCell(0,4,'Profª Drª Cleybe Hiole Vieira',0,'L');
		$pdf->MultiCell(0,4,'Coordenadora da Iniciação Cientifica e Tecnológica da PUCPR',0,'L');

		$pdf->SetXY(20,265);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Arquivo gerando em '.date("d/m/Y H:i"),0,'R');	

		$pdf->SetXY(20,265);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Declaração Nº'.strzero(6,5).'/'.date("Y"),0,'L');	

		$pdf->SetXY(20,265);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Validador: D2-'.strzero($dd[0],5),0,'C');	

		$pdf->Output();
?>