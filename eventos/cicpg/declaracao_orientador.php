<?
$include = '../../';
require ("../../db.php");
require ($include . 'sisdoc_debug.php');
require ("../../_class/_class_declaracao.php");
require ("../../_class/_class_diretorio.php");
require ($include . 'fphp-153/fpdf.php');
require ($include . "sisdoc_debug.php");

$sql = "select max(id_doc) as numero from pibic_documento ";
$rlt = db_query($sql);
if ($line = db_read($rlt)) { $nr = $line['numero'] + 1;
}

$nr = strzero($nr, 6);

/** Projeto */

$sql = "select * from pibic_bolsa_contempladas 
			 inner join pibic_professor on pb_professor = pp_cracha 
			 inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo 
			 inner join pibic_aluno on pb_aluno = pa_cracha
			";
$sql .= " where pb_protocolo = '" . $dd[0]."'";
$sql .= " and pb_ano = '2013' ";

$rlt = db_query($sql);
$line = db_read($rlt);
$projeto_titulo = trim($line['pb_titulo_projeto']);
$nome_orientador = trim($line['pp_nome']);
$projeto_titulo = troca($projeto_titulo, chr(13), ' ');
$projeto_titulo = troca($projeto_titulo, chr(10), '');
$projeto_titulo = troca($projeto_titulo, '  ', ' ');
$aluno = trim($line['pa_nome']);
$edital = trim($line['pbt_edital']);
$bolsa = trim($line['pbt_descricao']);
$mm = trim($line['pb_semic_apresentacao']);
$bolsa_nome = trim($line['pbt_descricao']);

if ($line['pbt_auxilio'] == 0) { $bolsa = '';
} else {
	$bolsa = ' com ' . $bolsa;
}

$destino = 'certificados/';

$destino .= 'D' . $dd[1] . '_' . $dd[2] . '_' . $dd[0] . '_' . substr(md5($dd[0] . $secu), 4, 8) . '.pdf';

$folder = troca($destino, $dir, '');

$versao_pdf = '0.11.45';
$data_submit = date("d/m/Y");
$nr_doc = '00001/' . substr(date("Y"), 2, 2);
///////////////////////////////////////////////
class PDF extends FPDF {
	function Header() {
		global $dir, $edital;
		/////////////// mostrar imagem
		//Logo
		$back = lowercase($edital);
		$this -> Image('img/certifica-cicpg .jpg', 0, 0, 210);
		/*$this->Image('../img/logo_ic.jpg',16,10,40);*/
		//Arial bold 15
		$this -> SetLineWidth(0.2);
		$this -> SetFont('Times', 'B', 12);
		//	//Move to the right
		$this -> Cell(80);
		//	//Title
		//	$this->Cell(110,6,'Protocolo de Pesquisa',1,0,'R');
		//	//Line break
		//	////////////////////////// LOGOTIPO
		//$img_logo = '../img/logo_pucpr.jpg';
		//$this->Image($img_logo,185,10,20);

		$this -> SetFont('Arial', '', 8);
		$this -> MultiCell(220, 2, '', 0, 'C');
		$this -> MultiCell(220, 4, 'Pontifícia Universidade Católica do Paraná', 0, 'C');
		$this -> MultiCell(220, 4, 'Pró-Reitoria de Pesquisa e Pós-Graduação', 0, 'C');
		$this -> MultiCell(220, 4, 'Coordenação de Iniciação Científica', 0, 'C');
		$this -> MultiCell(220, 4, 'www.pucpr.br/ic', 0, 'C');
		$this -> MultiCell(220, 4, 'telefones: (41) 3271-1602 / 3271-1730', 0, 'C');

		//
		//		$this->SetFont('Arial','',6);
		//		for ($ll=0;$ll < 62;$ll++)
		//			{
		//			$this->SetXY(7,$ll*4+16);
		//			$this->Cell(0,10,$ll*1+1,0,0,'L');
		//			}
		$this -> SetXY(0, 40);
		$this -> Ln(0);
	}

	////////////////////////////////////////////////////////////////
	function Footer() {
		global $dd, $data_submit, $versao_pdf, $nr_doc;
		//Position at 1.5 cm from bottom
		//		$this->SetY(-15);
		//Arial italic 8
		$this -> SetFont('Arial', 'I', 8);
		//Page number
		//		$this->Cell(0,10,'Declaração n. '.$nr_doc.' em '.$data_submit,0,0,'L');
		//	$this->Cell(0,10,'Pígina '.$this->PageNo().'/{nb}',0,0,'R');
		//	$this->Ln(3);
		//	$this->SetFont('Arial','I',4);
		//	$this->Cell(0,10,'RE2ol v.'.$versao_pdf,0,0,'L');
	}

}

////////////////////////////////////////////////////////////////
$pdf = new PDF();
$pdf -> AliasNbPages();
$ln = 0;
$pdf -> AddPage();
$align = 'C';
////////////////////////////// DOCUMENTOS EM IMAGEM INICIO

$pdf -> Ln($ln);

$pdf -> SetFont('Arial', 'B', 18);
$pdf -> Ln(25);
$pdf -> MultiCell(0, 8, 'D E C L A R A Ç Ã O', 0, $align);
$pdf -> Ln($ln);
$pdf -> Ln(7);
// DECL_AVALIADOR
$ano = trim($dd[2]);
if (strlen($ano) == 0) { $ano = date("Y");
}

$tipo = 'DECL_SEMIC_' . $dd[1] . '_' . $ano;

/* Tipo de modalidade */
switch ($mm) {
	case 'P' :
		$tipo = 'DECL_SEMIC_P_2014';
		break;
	default :
		$tipo = 'DECL_SEMIC_' . $mm . '_2014';
		$tipo = 'DECL_ORIENTADOR_2014';
		break;
}

$sql = "select * from ic_noticia where nw_ref = '" . $tipo . "' ";
$rrr = db_query($sql);
if ($line = db_read($rrr)) {
	$texto = $line['nw_descricao'];
} else {
	echo "Texto não localizado para referência <B>'" . $tipo . "'</B>";
	exit ;
}
if (strlen($texto) == 0) { $texto = $tipo;
}
///////////// Trocas
$texto = troca($texto, '$professor_nome', $aval_nome);
if ($bolsa_nome == 'Qualificados/ICV') { $bolsa_nome = 'Iniciação Científica Voluntária';}
$texto = troca($texto, '<br>', chr(13) . chr(10));
$texto = troca($texto, '$ALUNO', $aluno);
$texto = troca($texto, '$PROFESSOR', $nome_orientador);
$texto = troca($texto, '$ORIENTADOR', $nome_orientador);
$texto = troca($texto, '$TITULO', trim($projeto_titulo));
$texto = troca($texto, '$MODALIDADE', trim($edital).' - '.trim($bolsa_nome));

/* Retira cídigo do itílico */
$texto = troca($texto, '<I>', '');
$texto = troca($texto, '</I>', '');
$texto = troca($texto, '<i>', '');
$texto = troca($texto, '</i>', '');

/* Retira cídigo do bold */
$texto = troca($texto, '<B>', '');
$texto = troca($texto, '</B>', '');
$texto = troca($texto, '<b>', '');
$texto = troca($texto, '</b>', '');

if ($edital == 'PIBIC') { $edital = 'Bolsas de Iniciação Científica (PIBIC)';
}
if ($edital == 'IS') { $edital = 'Bolsas de Iniciação Científica (PIBIC)';
}
if ($edital == 'PIBITI') { $edital = 'Bolsas em Desenvolvimento Tecnológico e Inovação (PIBITI)';
}
if ($edital == 'PIBIC_EM') { $edital = 'de Bolsas em Iniciação Científica para alunos do Ensino Médio (PIBIC Jr)';
}
if ($edital == 'CSF') { $edital = 'Ciíncia sem Fronteiras';
}
$texto = troca($texto, '$edital', $edital);

$texto = troca($texto, '$modalidade', $bolsa);

////////////////////
$pdf -> Ln(15);
$pdf -> SetFont('Arial', 'B', 14);
$pdf -> MultiCell(0, 8, $texto, 0, 'J');

/////////////////// Assinatura
$pdf -> SetXY(20, 20);
$img_logo = '../../img/wefuwe_ldjaasjh_xxcmv_xkcvbc.jpg';
//		$pdf->Image($img_logo,80,200,120);
$pdf -> Image($img_logo, 10, 200, 80);

$pdf -> SetXY(20, 265);
$pdf -> SetFont('Arial', '', 6);
$pdf -> MultiCell(0, 8, 'Arquivo gerando em ' . date("d/m/Y H:i"), 0, 'R');

$pdf -> SetXY(20, 265);
$pdf -> SetFont('Arial', '', 6);
$pdf -> MultiCell(0, 8, 'Declaração N.' . strzero(6, 5) . '/' . date("Y"), 0, 'L');

$pdf -> SetXY(20, 265);
$pdf -> SetFont('Arial', '', 6);
$pdf -> MultiCell(0, 8, 'Validador: D1-' . strzero($dd[0], 5), 0, 'C');

if ((strlen($destino) > 0)) {
	$pdf -> Output($destino);

	$texto = UpperCaseSQL('DECLARAÇÃO ' . $texto);
	$sql = "insert into pibic_documento ";
	$sql .= "(doc_dd0,doc_tipo,doc_ano,";
	$sql .= "doc_texto_asc,doc_status,doc_data,";
	$sql .= "doc_hora,doc_arquivo ";
	$sql .= ") values (";
	$sql .= "'" . substr($dd[0], 1, 7) . "','D1','" . date("Y") . "',";
	$sql .= "'" . $texto . "','A','" . date("Ymd") . "',";
	$sql .= "'" . date("H:i") . "','" . $folder . "')";
	$rlt = db_query($sql);
	$pdf -> Output();
	//echo 'Arquivo salvo em '.$destino.' com sucesso !';
} else {
	$pdf -> Output();
}
?>