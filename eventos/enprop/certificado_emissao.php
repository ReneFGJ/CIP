<?
$include = '../../';
$tipo = $_GET['dd1'];
if ($tipo == 'E')
	{
		require("cab.php");
		require($include.'sisdoc_email.php');
	} else {
		require("db.php");
		require("_class/_class_proceeding.php");		
	}
$ev = new proceeding;

require("../../_class/_class_declaracao.php");
require("../../_class/_class_diretorio.php");
$ip = $_SERVER['REMOTE_ADDR'];
if (($dd[90] != checkpost($dd[0])) and (substr($ip,0,3) != '10.'))
	{
		echo 'Erro de post';
		exit;
	}
$ev->le($dd[0]);
$nome  = trim($ev->line['ev_nome']);

$dr = new diretorio;
require($include.'fphp-153/fpdf.php');
require($include."sisdoc_debug.php");
$destino = $dir.'/reol/pibicpr/public/documentos/';

$dr->diretorio_checa($destino);
$destino .= date("Y"); 			$dr->diretorio_checa($destino);
$destino .= '/'.date("m"); 		$dr->diretorio_checa($destino);
$destino .= '/D'.$dd[1].'_'.$dd[2].'_'.$dd[0].'_'.substr(md5($dd[0].$secu),4,8).'.pdf';

$folder = troca($destino,$dir,'');

$versao_pdf = '0.11.45';
$data_submit = date("d/m/Y");
$nr_doc = '00001/'.substr(date("Y"),2,2);

///////////////////////////////////////////////
class PDF extends FPDF
{
	function Header()
	{
	global $dir,$edital;
		 /////////////// mostrar imagem
		//Logo
	$back = lowercase($edital);
	$this->Image('img/certificado_enprop_2013.jpg',0,0,300);		
	/*$this->Image('../img/logo_ic.jpg',16,10,40);*/
		//Arial bold 15
	$this->SetLineWidth(0.2);	
	$this->SetFont('Times','B',12);
	//	//Move to the right
	$this->Cell(80);
	//	//Title
	//	$this->Cell(110,6,'Protocolo de Pesquisa',1,0,'R');
	//	//Line break
	//	////////////////////////// LOGOTIPO
	//$img_logo = '../img/logo_pucpr.jpg';
	//$this->Image($img_logo,185,10,20);
	
	$this->SetFont('Arial','',8);
	$this->MultiCell(220,2,'',0,'C');

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
	//	$this->Cell(0,10,'Pígina '.$this->PageNo().'/{nb}',0,0,'R');
	//	$this->Ln(3);
	//	$this->SetFont('Arial','I',4);
	//	$this->Cell(0,10,'RE2ol v.'.$versao_pdf,0,0,'L');
	}
}

////////////////////////////////////////////////////////////////
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->SetMargins(0, 0,0);
$ln = 0;
$pdf->AddPage('L');
$align='C';
////////////////////////////// DOCUMENTOS EM IMAGEM INICIO

		$pdf->Ln($ln);

		$pdf->SetFont('Arial','B',18);
		$pdf->Ln(25);
		$pdf->MultiCell(0,8,'',0,$align);
		$pdf->Ln($ln);
		$pdf->Ln(7);
		// DECL_AVALIADOR
		$ano = trim($dd[2]);
		///////////// Trocas
		$texto = 'Certificamos que $NOME participou do XXIX ENPROP 2013 - Encontro Nacional de Pró-Reitores de Pesquisa e Pós-Graduação, realizado nos dias 11 a 13 de dezembro de 2013 em Curitiba-PR.';
		$texto = troca($texto,'$NOME',$nome);
		////////////////////
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',14);
		$pdf->SetXY(40,70);
		$pdf->MultiCell(200,10,$texto,0,'J');	
		
		$texto = 'Curitiba, 13 de dezembro de 2013.';
				////////////////////
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',14);
		$pdf->SetXY(40,110);
		$pdf->MultiCell(200,15,$texto,0,'R');	
		
		$pdf->SetXY(50,150);
		$pdf->SetFont('Arial','',12);
		$pdf->MultiCell(80,5,'Prof Paulo Cesar Duque Estrada',0,'C');
		
		$pdf->SetXY(50,155);
		$pdf->SetFont('Arial','',10);	
		$pdf->MultiCell(80,5,'Presidente do Foprop',0,'C');		
		
		
		$pdf->SetXY(170,150);
		$pdf->SetFont('Arial','',12);
		$pdf->MultiCell(80,5,'Prof Waldemiro Gremski',0,'C');
		
		$pdf->SetXY(170,155);
		$pdf->SetFont('Arial','',10);	
		$pdf->MultiCell(80,5,'Pró-Reitor de Pesquisa e Pós-Graduação PUCPR',0,'C');			
		

		$pdf->SetXY(20,172);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Arquivo gerando em '.date("d/m/Y H:i"),0,'R');	

		$pdf->SetXY(20,172);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Declaração N.'.strzero($dd[0],5).'/'.date("Y"),0,'L');	

		$pdf->SetXY(20,172);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Validador: EP-'.strzero($dd[0],5),0,'C');	

$destino = 'certificados/ep-'.strzero($dd[0],5).'.pdf';

if (((strlen($destino) > 0)) and (substr($ip,0,3) != '10.'))
	{
		$pdf->Output($destino);

		$texto = UpperCaseSQL('DECLARAÇÃO '.$texto);
		
		if ($dd[1]=='T') { $pdf->Output(); }
		if ($dd[1]=='E') 
		{
			
			$email = trim($ev->line['ev_email']);
			$nome = trim($ev->line['ev_nome']);
			$file = $destino;
			
 			//boundary o que identifica cada parte da mensagem
			$fp = fopen($file,"rb"); 
			$anexo = fread($fp,filesize($file)); 
			$anexo = base64_encode($anexo); 
			fclose($fp); 
			$anexo = chunk_split($anexo);

	 		$quebra_linha="\r\n";
			$nome_asc = uppercasesql($nome);
			$nome_asc = lowercase(troca($nome_asc,' ','_'));
			
			$file_name = "certificado-ENPROP-".$nome_asc.'.pdf';
			
			$menss = 'Prezado participante do ENPROP'.chr(13).chr(10).chr(13).chr(10);
			$menss .= 'Conforme solicitado, encontra-se anexo o seu certificado de participação no XXIX ENPROP.'.chr(13).chr(10).chr(13).chr(10);
			$menss .= 'Cordialmente,'.chr(13).chr(10).chr(13).chr(10);
			$menss .= 'Comissão Organizadora'.chr(13).chr(10).chr(13).chr(10);
			$menss .= ''.chr(13).chr(10).chr(13).chr(10);
	 
 			//cabeçalho da mensagem
			$boundary = "XYZ-" . date("dmYis") . "-ZYX"; 
 
			$mens = "--$boundary" . $quebra_linha . ""; 
			$mens .= "Content-Transfer-Encoding: 8bits" . $quebra_linha . ""; 
			$mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $quebra_linha . "" . $quebra_linha . ""; //plain 
			$mens .= "$conteudo" . $quebra_linha . ""; 
			$mens .= "--$boundary" . $quebra_linha . ""; 
			$mens .= "Content-Type: application/pdf" . $quebra_linha . ""; 
			$mens .= "Content-Disposition: attachment; filename=\"".$file_name."\"" . $quebra_linha . ""; 
			$mens .= "Content-Transfer-Encoding: base64" . $quebra_linha . "" . $quebra_linha . ""; 
			$mens .= "$anexo" . $quebra_linha . ""; 
			$mens .= "--$boundary--" . $quebra_linha . ""; 
 
			$headers = "MIME-Version: 1.0" . $quebra_linha . ""; 
			$headers .= "From: ".$admin_nome." <" .$email_adm. "> ". $quebra_linha;
			$headers .= "Return-Path: $email_adm " . $quebra_linha . ""; 
			$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"" . $quebra_linha . ""; 
			$headers .= "$boundary" . $quebra_linha . "";
		 
 			//envia o e-mail
 			$para = $email;
			//$para = 'renefgj@gmail.com';
 			mail($para, 'Certificado ENPROP', $mens.$menss, $headers);			
			echo '<BR><BR>';
			echo 'Certificado enviado por e-mail ('.$para.')';		
		}
		//echo 'Arquivo salvo em '.$destino.' com sucesso !';
	} else {
		$pdf->Output();
	}
?>