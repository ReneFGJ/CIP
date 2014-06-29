<?
require("db.php");
//require($include."sisdoc_debug.php");
require($include.'fphp-153/fpdf.php');
require($include."sisdoc_cookie.php");
require($include."sisdoc_debug.php");
require("upload_checa_dir.php");

$journal_id = read_cookie("journal_id");
$journal_title = read_cookie("journal_title");
$jid = intval($journal_id);

$sql = "select * from pibic_documento ";
$sql .= "where doc_tipo = 'D2' ";
$sql .= "and doc_ano = '".date("Y")."' ";
$sql .= "and doc_dd0 = '".$dd[0]."' ";
$sql .= "order by id_doc desc ";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	echo 'Declaração já foi gerada';
	exit;
	}

$sql = "select max(id_doc) as numero from pibic_documento ";
if ($line = db_read($rlt))
	{ $nr = $line['numero']+1; }

$nr = strzero($nr,6);



$destino = $dir.'/reol/pibicpr/public/documentos/';
$tela = diretorio_checa($destino);
$destino .= date("Y");
$tela =  diretorio_checa($destino);
$destino .= '/'.date("m");
$tela =  diretorio_checa($destino);
$destino .= '/d2_'.$nr.'_'.$dd[0].'_'.substr(md5($dd[0].$secu),4,8).'.pdf';

$folder = troca($destino,$dir,'');

/////////////////////////////////////////////// AVALIADOR
$sql = "select * from pareceristas ";
$sql .= " where us_codigo = '".$dd[0]."' ";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$aval_nome = trim($line['us_nome']);
	$aval_titu = trim($line['us_titulacao']);
	$aval_nome = trim($aval_titu.' '.$aval_nome);
	$inst = $line['us_instituicao'];
	$xinst = "CNPQ";
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
	$this->MultiCell(0,4,'Pró-Reitoria Acadêmica',0,'C');
	$this->MultiCell(0,4,'Coordenação de Iniciação Científica',0,'C');
	$this->MultiCell(0,4,'www.pucpr.br/pibic',0,'C');
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
		$texto = troca($texto,'<br>',chr(13));
		$texto = troca($texto,'&nbsp;',' ');
		////////////////////
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',14);
		$pdf->MultiCell(0,8,$texto,0,'J');
	
		/////////////////// Assinatura	
		$pdf->SetXY(20,20);
		$img_logo = 'img/wefuwe_ldjaasjh_xxcmv_xkcvbc.jpg';
//		$pdf->Image($img_logo,80,200,120);		
		$pdf->Image($img_logo,10,200,120);		

		$pdf->SetXY(20,265);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Arquivo gerando em '.date("d/m/Y H:i"),0,'R');	

		$pdf->SetXY(20,265);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Declaração Nº'.strzero(6,5).'/'.date("Y"),0,'L');	

		$pdf->SetXY(20,265);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Validador: D2-'.strzero($dd[0],5),0,'C');	

if (strlen($destino) > 0)
	{
		$pdf->Output($destino);

		$texto = UpperCaseSQL('DECLARAÇÂO '.$texto);
		$sql = "insert into pibic_documento ";
		$sql .= "(doc_dd0,doc_tipo,doc_ano,";
		$sql .= "doc_texto_asc,doc_status,doc_data,";
		$sql .= "doc_hora,doc_arquivo ";
		$sql .= ") values (";
		$sql .= "'".$dd[0]."','D2','".date("Y")."',";
		$sql .= "'".$texto."','A','".date("Ymd")."',";
		$sql .= "'".date("H:i")."','".$folder."')";
		$rlt = db_query($sql);
		echo 'Arquivo salvo em '.$destino.' com sucesso !';
		?>
		<script>
			close();
		</script>
		<?
	} else {
		$pdf->Output();
	}
?>