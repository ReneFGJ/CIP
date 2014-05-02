<?
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require($include.'fphp-153/fpdf.php');
$coordenador_nome = 'CLEYBE VIEIRA';
$coordenador_nome_tipo = 'COORDENADOR INICAÇÃO CIENTÍFICA ';
$destino = $dd[1];

	$sql = "select * from pibic_bolsa_contempladas ";
	$sql .= " inner join pibic_aluno on pb_aluno = pa_cracha ";
	$sql .= " inner join pibic_professor on pb_professor = pp_cracha ";
	if (strlen($dd[99]) > 0)
		{
			$sql .= " where pb_protocolo = '".$dd[99]."' ";
		} else {
			$sql .= " where id_pb = ".$dd[0];
		}
	
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$proto = $line['doc_protocolo'];
	$proto_mae = $line['doc_protocolo_mae'];
	$bolsa = $line['pb_tipo'];
	$aluno_codigo = trim($line['pb_aluno']);
	$aluno_nome = trim($line['pa_nome']);
	$aluno_dn = stodbr($line['pa_nasc']);
	$aluno_curso = trim($line['pa_curso']);
	$aluno_cpf = trim($line['pa_cpf']);
	$aluno_rg = trim($line['pa_rg']);
	$aluno_tel1 = trim(trim($line['pa_tel1']).' '.trim($line['pa_tel2']));
	$aluno_email = trim($line['pa_email']);
	$aluno_endereco = trim($line['pa_endereco']);
	$aluno_bairro = trim($line['pa_bairro']);
	$aluno_estado = trim($line['pa_estado']);
	$aluno_CEP = trim($line['pa_cep']);
	$aluno_cidade = trim($line['pa_cidade']);
	$aluno_ass = troca(trim($line['pa_ass']),'/reol/pibic/','');
/////////////////////////////////////////////////////////////////////////////////////	
	$prof_cracha = trim($line['pb_professor']);
	$prof_nome = trim($line['pp_nome']);
	$prof_cpf = trim($line['pp_cpf']);
	$prof_tel1 =trim($line['pp_telefone']);
	$prof_tel2 =trim($line['pp_celular']);
	$prof_dn =stodbr(trim($line['pp_nasc']));
	$prof_email =trim($line['pp_email']);
	$prof_email_1 =trim($line['pp_email_1']);
	$prof_curso =trim($line['pp_curso']);
	$prof_ass = trim($line['pp_ass']);
/////////////////////////////////////////////////////////////////////////////////////////
	$tit_plano = $line['pb_titulo_plano'];
	$area = $line['doc_area'];
//$bolsa = 'G';

/////
if ($bolsa == 'V') 
	{
	$TIT_TERMO = 'TERMO DE ADESÃO À INICIAÇÃO TECNOLÓGICA VOLUNTÁRIA - ITV';
	$aluno_nome_tipo = 'ALUNO VOLUNTÁRIO';
	}
if ($bolsa == 'Y') 
	{
	$TIT_TERMO = 'TERMO DE ADESÃO À INICIAÇÃO TECNOLÓGICA VOLUNTÁRIA - ITV';
	$aluno_nome_tipo = 'ALUNO VOLUNTÁRIO';
	}

if ($bolsa == 'I') 
	{
	$TIT_TERMO = 'TERMO DE ADESÃO À INICIAÇÃO CIENTÍFICA VOLUNTÁRIA - ICV';
	$aluno_nome_tipo = 'ALUNO VOLUNTÁRIO';
	}
if ($bolsa == 'F') 
	{
	$TIT_TERMO = 'TERMO DE CONCESSÃO DE BOLSA DE INICIAÇÃO CIENTÍFICA';
	$aluno_nome_tipo = 'BOLSISTA';
	}
if ($bolsa == 'C') 
	{
	$TIT_TERMO = 'TERMO DE CONCESSÃO DE BOLSA DE INICIAÇÃO CIENTÍFICA';
	$aluno_nome_tipo = 'BOLSISTA';
	}
if ($bolsa == 'P') 
	{
	$TIT_TERMO = 'TERMO DE CONCESSÃO DE BOLSA DE INICIAÇÃO CIENTÍFICA';
	$aluno_nome_tipo = 'BOLSISTA';
	}
if ($bolsa == 'E') 
	{
	$TIT_TERMO = 'TERMO DE CONCESSÃO DE BOLSA DE INICIAÇÃO CIENTÍFICA (ESTRATÉGICA)';
	$aluno_nome_tipo = 'BOLSISTA';
	$bolsa == 'P';
	}
if ($bolsa == 'U') 
	{
	$TIT_TERMO = 'TERMO DE CONCESSÃO DE BOLSA DE INICIAÇÃO CIENTÍFICA (ESTRATÉGICA PUCPR)';
	$aluno_nome_tipo = 'BOLSISTA';
	$bolsa == 'P';
	}
if ($bolsa == 'G') 
	{
	$TIT_TERMO = 'TERMO DE ADESÃO À INICIAÇÃO TECNOLÓGICA - AGÊNCIA PUCPR';
	$aluno_nome_tipo = 'BOLSISTA';
	$bolsa == 'P';
	}
	
if ($bolsa == 'B') 
	{
	$TIT_TERMO = 'TERMO DE ADESÃO À INICIAÇÃO TECNOLÓGICA - CNPQ-Pibiti';
	$aluno_nome_tipo = 'BOLSISTA';
	}

if ($bolsa == 'O') 
	{
	$TIT_TERMO = 'TERMO DE ADESÃO À INICIAÇÃO TECNOLÓGICA - PUCPR-PIBITI';
	$aluno_nome_tipo = 'BOLSISTA';
	}

	
$sql = "select * from ic_noticia ";
$sql .= " where nw_ref = 'termo_".$bolsa."' ";
$rlt = db_query($sql);
$line = db_read($rlt);
$texto = $line['nw_descricao'];
$texto = troca($texto,chr(13),'');
$texto = troca($texto,chr(10),'');
$texto = troca($texto,'<BR>',chr(13).chr(10));
$texto = troca($texto,'<br>',chr(13).chr(10));

///////////////////////////////////////////////
$texto = troca($texto,'$aluno_dn',$aluno_dn);
$texto = troca($texto,'$aluno_curso',$aluno_curso);
$texto = troca($texto,'$$aluno_cpf',$$aluno_cpf);
$texto = troca($texto,'$aluno_rg',$aluno_rg);
$texto = troca($texto,'$aluno_cpf',$aluno_cpf);
$texto = troca($texto,'$aluno_tel1',$aluno_tel1);
$texto = troca($texto,'$aluno_email',$aluno_email);
$texto = troca($texto,'$aluno_endereco',$aluno_endereco);
$texto = troca($texto,'$aluno_bairro',$aluno_bairro);
$texto = troca($texto,'$aluno_cidade',$aluno_cidade);
$texto = troca($texto,'$aluno_bairro',$aluno_bairro);
$texto = troca($texto,'$aluno_estado',$aluno_estado);
$texto = troca($texto,'$aluno_CEP',$aluno_CEP);
$texto = troca($texto,'$aluno_nome',$aluno_nome);

$texto = troca($texto,'$protocolo',$proto);

$texto = troca($texto,'$prof_nome',$prof_nome);
$texto = troca($texto,'$prof_cpf',$prof_cpf);
$texto = troca($texto,'$prof_tel1',$prof_tel1);
$texto = troca($texto,'$prof_tel2',$prof_tel2);
$texto = troca($texto,'$prof_dn',$prof_dn);
$texto = troca($texto,'$prof_email',$prof_email);
$texto = troca($texto,'$prof_curso',$prof_curso);

$texto = troca($texto,'<style> P { margin: 0px; } </style>','');
$texto = troca($texto,'&nbsp;',' ');

$texto = troca($texto,'<BR>',chr(13).chr(10));

$texto = troca($texto,'$plano_titulo',$tit_plano);
///////////////////////////////////////////////
$prof_nome_tipo = "ORIENTADOR DO PROJETO";
///////////////////////////////////////////////

class PDF extends FPDF
{
	function Header()
	{
	global $dir;
		 /////////////// mostrar imagem
		//Logo
	$this->Image('img/logo_pibic.jpg',16,10,90);
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
		global $dd,$data_submit,$versao_pdf,$nr_doc,$proto;
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		$this->Cell(0,10,'Protocolo '.$proto,0,0,'L');
	//	$this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'R');
	//	$this->Ln(3);
	//	$this->SetFont('Arial','I',4);
	//	$this->Cell(0,10,'RE2ol v.'.$versao_pdf,0,0,'L');
	}
}
require($include.'sisdoc_debug.php');
////////////////////////////////////////////////////////////////
$pdf=new PDF();
$pdf->AliasNbPages();
$ln = 0;
$pdf->AddPage();
$align='C';
////////////////////////////// DOCUMENTOS EM IMAGEM INICIO

		$pdf->Ln($ln);

		$pdf->SetFont('Arial','B',14);
		$pdf->MultiCell(0,8,$TIT_TERMO,0,$align);
		$pdf->Ln($ln);
		if ($provisorio == 1)
			{
			$pdf->MultiCell(0,8,'** PROVISÓRIO **',0,$align);
			$pdf->Ln($ln);
			}
		$pdf->Ln(7);
		
		
		$align='J';
		$pdf->SetFont('Arial','',9);
		$pdf->MultiCell(0,4,$texto,0,$align);
		$pdf->Ln(7);
		
	
	$pdf->SetFont('Arial','',8);
	

if (strlen($destino) > 0)
	{
		$classe = date("Y").
		$uploaddir = $dir.'/reol/pibic/contrato/';
		diretorio_checa($uploaddir);
		$uploaddir = $dir.'/reol/pibic/contrato/'.date("Y").'/';
		diretorio_checa($uploaddir);

		$texto = UpperCaseSQL('DECLARAÇÂO '.$TIT_TERMO);
		
		$destino = $uploaddir.$proto.'-'.$aluno_codigo.'-'.$bolsa.date("Ymd").'.pdf';
		$sql = "insert into pibic_documento ";
		$sql .= "(doc_dd0,doc_tipo,doc_ano,";
		$sql .= "doc_texto_asc,doc_status,doc_data,";
		$sql .= "doc_hora,doc_arquivo ";
		$sql .= ") values (";
		$sql .= "'".$proto."','CT','".date("Y")."',";
		$sql .= "'".$proto.'-'.$bolsa.date("Ymd").'.pdf'."','A','".date("Ymd")."',";
		$sql .= "'".date("H:i")."','".$destino."')";
		$pdf->Output($destino);
	
		$rlt = db_query($sql);
		//echo 'Arquivo salvo em '.$destino.' com sucesso !';
	} else {
		$pdf->Output();
	}
	
function diretorio_checa($vdir)
	{
	if(is_dir($vdir))
		{ $rst =  '<FONT COLOR=GREEN>OK';
		} else { 
			$rst =  '<FONT COLOR=RED>NÃO OK';	
			mkdir($vdir, 0777);
			if(is_dir($vdir))
				{
				$rst =  '<FONT COLOR=BLUE>CRIADO';	
				}
		}
		$filename = $vdir."/index.htm";	
		if (!(file_exists($filename)))
		{
			$ourFileHandle = fopen($filename, 'w') or die("can't open file");
			$ss = "<!DOCTYPE HTML PUBLIC -//W3C//DTD HTML 4.01 Transitional//EN><html><head><title>404 : Page not found</title></head>";
			$ss = $ss . "<body bgcolor=#0080c0 marginheight=0 marginwidth=0><table align=center border=0 cellpadding=0 cellspacing=0>	";
			$ss = $ss . "<tbody><tr>	<td height=31 width=33><img src=/reol/noacess/quadro_lt.gif alt= border=0 height=31 width=33></td>	";
			$ss = $ss . "<td><img src=/reol/noacess/quadro_top.gif alt= border=0 height=31 width=600></td>	<td height=31 width=33>";
			$ss = $ss . "<img src=/reol/noacess/quadro_rt.gif alt= border=0 height=31 width=33></td>	</tr>	<tr>	<td>	";
			$ss = $ss . "<img src=/reol/noacess/quadro_left.gif alt= border=0 height=300 width=33></td>	<td align=center bgcolor=#ffffff>";
			$ss = $ss . "<img src=/reol/noacess/sisdoc_logo.jpg width=590 height=198 alt= border=0><BR>	<font color=#808080 face=Verdana size=1>";
			$ss = $ss . "&nbsp;&nbsp;&nbsp;&nbsp;	programação / program : <a href=mailto:rene@sisdoc.com.br>Rene F. Gabriel Junior</a>	<p>";
			$ss = $ss . "<font color=#808080 face=Verdana size=4>	<font color=#808080 face=Verdana size=1>&nbsp;	<font color=#ff0000 face=Verdana size=3><B>";
			$ss = $ss . "Acesso Restrito / Access restrit	</font></font></td>	<td><img src=/reol/noacess/quadro_right.gif alt= border=0 height=300 width=33></td></tr><tr>";
			$ss = $ss . "<td height=31 width=33><img src=/reol/noacess/quadro_lb.gif alt= border=0 height=31 width=33></td>	<td><img src=/reol/noacess/quadro_botton.gif alt= border=0 height=31 width=600></td>";
			$ss = $ss . "<td height=31 width=33><img src=/reol/noacess/quadro_rb.gif alt= border=0 height=31 width=33></td>	</tr></tbody></table></body></html>";
			$rst = $rst . '*';
			fwrite($ourFileHandle, $ss);
			fclose($ourFileHandle);		
		}
		return($rst);
	}	
?>