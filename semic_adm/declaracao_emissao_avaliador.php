<?
$include = '../';
function msg($x) { return($x); }
require("../db.php");
//require($include."sisdoc_debug.php");
// http://www2.pucpr.br/reol/pibicpr2/declaracao_emissao.php?
// dd10=Declara%E7%E3o%20de%20Ouvinte%20SEMIC%20%282011%29&
// dd1=P&
// dd2=2011&
// dd3=&
// dd0=89025776
require("../_class/_class_declaracao.php");
require("../_class/_class_diretorio.php");
require('../_class/_class_pareceristas.php');
$dr = new diretorio;
require($include.'fphp-153/fpdf.php');
require($include."sisdoc_cookie.php");
require($include."sisdoc_debug.php");

$estudante = new parecerista;
$estudante ->le($dd[0]); 
$aluno = $estudante->nome;
$curso = '';

$journal_id = read_cookie("journal_id");
$journal_title = read_cookie("journal_title");
$jid = intval($journal_id);

$sql = "select max(id_doc) as numero from pibic_documento ";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{ $nr = $line['numero']+1; }

$nr = strzero($nr,6);

/** Projeto */
	
if ($dd[1] == 'AV')
	{
	$sql = "select * from pareceristas
			";
	$sql .= " where us_codigo_id = '".$dd[0]."'";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$nome_orientador = trim($line['us_nome']);
	$aluno = trim($line['us_nome']);
	}	
	/* Conversoes */


$destino = $dir.'/reol/pibicpr/public/documentos/';
$dr->diretorio_checa($destino);
$destino .= date("Y"); 			$dr->diretorio_checa($destino);
$destino .= '/'.date("m"); 		$dr->diretorio_checa($destino);
$destino .= '/AV'.$dd[1].'_'.$dd[2].'_'.$dd[0].'_'.substr(md5($dd[0].$secu),4,8).'.pdf';

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
	$edital = 'semic';
		 /////////////// mostrar imagem
		//Logo
	$back = lowercase($edital);
	$this->Image('img/background_'.$back.'.jpg',0,0,210);		
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
	$this->MultiCell(220,4,'Pontif�cia Universidade Cat�lica do Paran�',0,'C');
	$this->MultiCell(220,4,'Pr�-Reitoria de Pesquisa e P�s-Gradua��o',0,'C');
	$this->MultiCell(220,4,'Coordena��o de Inicia��o Cient�fica',0,'C');
	$this->MultiCell(220,4,'www.pucpr.br/ic',0,'C');
	$this->MultiCell(220,4,'telefones: (41) 3271-1602 / 3271-1730',0,'C');

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
//		$this->Cell(0,10,'Declara��o n. '.$nr_doc.' em '.$data_submit,0,0,'L');
	//	$this->Cell(0,10,'P�gina '.$this->PageNo().'/{nb}',0,0,'R');
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
		$pdf->MultiCell(0,8,'D E C L A R A � � O',0,$align);
		$pdf->Ln($ln);
		$pdf->Ln(7);
		// DECL_AVALIADOR
		$ano = trim($dd[2]);
		if (strlen($ano)==0) { $ano = date("Y"); }

		$tipo = 'DECL_SEMIC_'.$dd[1].'_'.$ano;
		$sql = "select * from ic_noticia where nw_ref = '".$tipo."' ";
		$rrr = db_query($sql);
		if ($line = db_read($rrr))
			{
				$texto = $line['nw_descricao'];
			} else {
				echo "Texto n�o localizado para refer�ncia <B>'".$tipo."'</B>";
				exit;
			}
		if (strlen($texto)==0) { $texto = $tipo; }
		///////////// Trocas
		$texto = troca($texto,'$professor_nome',$aval_nome);

		$texto = troca($texto,'<br>',chr(13).chr(10));
		$texto = troca($texto,'$ALUNO',$aluno);
		$texto = troca($texto,'$aluno',$aluno);
		$texto = troca($texto,'$ORIENTADOR',$nome_orientador);
		$texto = troca($texto,'$TITULO',trim($projeto_titulo));
		$texto = troca($texto,'$BOLSA',$bolsa_tipo);
		
		/* Retira c�digo do it�lico */
		$texto = troca($texto,'<I>','');
		$texto = troca($texto,'</I>','');
		$texto = troca($texto,'<i>','');
		$texto = troca($texto,'</i>','');

		/* Retira c�digo do bold */
		$texto = troca($texto,'<B>','');
		$texto = troca($texto,'</B>','');
		$texto = troca($texto,'<b>','');
		$texto = troca($texto,'</b>','');
		
		if ($edital == 'PIBIC') { $edital = 'Bolsas de Inicia��o Cient�fica (PIBIC)'; }
		if ($edital == 'IS') { $edital = 'Bolsas de Inicia��o Cient�fica (PIBIC)'; }
		if ($edital == 'PIBITI') { $edital = 'Bolsas em Desenvolvimento Tecnol�gico e Inova��o (PIBITI)'; }
		if ($edital == 'PIBIC_EM') { $edital = 'de Bolsas em Inicia��o Cient�fica para alunos do Ensino M�dio (PIBIC Jr)'; }
		if ($edital == 'CSF') { $edital = 'Ci�ncia sem Fronteiras'; }
		$texto = troca($texto,'$edital',$edital);
		
		$texto = troca($texto,'$modalidade',$bolsa);

		////////////////////
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',14);
		$pdf->MultiCell(0,8,$texto,0,'J');
		
		
	
		/////////////////// Assinatura	
		$pdf->SetXY(20,20);
		$img_logo = '../img/wefuwe_ldjaasjh_xxcmv_xkcvbc.jpg';
//		$pdf->Image($img_logo,80,200,120);		
		$pdf->Image($img_logo,10,200,80);		

		$pdf->SetXY(20,265);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Arquivo gerando em '.date("d/m/Y H:i"),0,'R');	

		$pdf->SetXY(20,265);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(0,8,'Declara��o N.'.round($dd[0]).'/'.date("Y"),0,'L');	

		$pdf->SetXY(80,265);
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(20,8,'VA-'.checkpost(strzero($dd[0],8)));	

//if ((strlen($destino) > 0))
	{
		$pdf->Output($destino);

		$texto = UpperCaseSQL('DECLARA��O '.$texto);
		$sql = "insert into pibic_documento ";
		$sql .= "(doc_dd0,doc_tipo,doc_ano,";
		$sql .= "doc_texto_asc,doc_status,doc_data,";
		$sql .= "doc_hora,doc_arquivo ";
		$sql .= ") values (";
		$sql .= "'".substr($dd[0],1,8)."','A1','".date("Y")."',";
		$sql .= "'".$texto."','A','".date("Ymd")."',";
		$sql .= "'".date("H:i")."','".$folder."')";
		$rlt = db_query($sql);
		//$pdf->Output();
		//} else {
		$pdf->Output();
	}
?>