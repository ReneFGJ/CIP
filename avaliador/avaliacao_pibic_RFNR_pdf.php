<?
require($include.'fphp-153/fpdf.php');
////////////////////////////////////////////////////////////////
$pdf = new FPDF();

$ln = 0;
$pdf->AddPage();

	$pdf->Image('../img/logo-cip.png',10,6,30);
	$pdf->Image('../img/logo_pucpr.jpg',190,6,13);
	$pdf->Ln($ln);
	
	$pdf->SetFont('Arial','',11);
	$pdf->MultiCell(0,5,'Pontif�cia Universidade Cat�lica do Paran� - PUCPR','','C');
	$pdf->MultiCell(0,5,'Programa de Inicia��o Cient�fica','','C');
	$pdf->SetFont('Arial','',8);
	$pdf->MultiCell(0,5,'PIBIC / PIBITI / PIBIC Jr / IS - '.date("Y"),'','C');

	$pdf->Ln(24);

	$pdf->SetFont('Arial','B',11);
	$pdf->MultiCell(0,5,'Protocolo: '.$bolsa->pb_protocolo,'','R');
	
	$pdf->SetFont('Arial','B',14);
	$pdf->MultiCell(0,8,$bolsa->pb_titulo_projeto,'','C');
	
	$pdf->Ln(3);
	$pdf->SetFont('Arial','',11);
	$pdf->MultiCell(0,5,'Orientador');
	$pdf->SetFont('Arial','B',11);
	$pdf->MultiCell(0,5,$bolsa->pb_professor_nome);
	
	$pdf->Ln(3);
	$pdf->SetFont('Arial','',11);
	$pdf->MultiCell(0,5,'Estudante');
	$pdf->SetFont('Arial','B',11);
	$pdf->MultiCell(0,5,$bolsa->pb_est_nome);
	
	$pdf->SetFont('Arial','B',18);
	$pdf->Ln(10);
	$pdf->MultiCell(0,8,'PARECER DE REAVALIA��O DO RELAT�RIO FINAL',0,'C');
	$pdf->Ln($ln);
	$pdf->Ln(7);

	$align = 'J';

	for ($r=9;$r < count($cp);$r++)
		{
			if (strlen($cp[$r][1]) > 0)
				{
					$pdf->SetFont('Arial','B',10);
					$text = ' '.$cp[$r][2];
					$text = troca($text,'<TR>','');
					$text = troca($text,'</div>','');
					$text = troca($text,'<BR>','');
					$text = troca($text,'<B>','');
					$text = troca($text,'</B>','');
					$text = troca($text,'</FONT>','');
					$text = troca($text,'<font color=blue >','');
					if (strpos($text,'>') > 0)
						{
							$text = substr($text,strpos($text,'>')+1,strlen($text));
						}
					
					$pdf->MultiCell(0,6,$text,0,$align);
					
					$pdf->SetFont('Arial','',12);
					$text = $dd[$r];
					
					if ($cp[$r][1]=='pp_p01')
						{
							$pdf->SetFont('Arial','',14);
							if ($dd[$r]==1) { $text = 'Aprovado'; }
							if ($dd[$r]==2) { $text = 'Necessita corre��es e resubmiss�o'; }
						}
					$pdf->MultiCell(0,5,$text,0,$align);
					$pdf->Ln(7);
				}
		}


	$pdf->Ln(8);
//	$pdf->SetFont('Arial','B',12);
//	$text = "Cleybe Vieira";
//	$pdf->MultiCell(0,5,$text,0,'L');

//	$text = "Coordena��o IC - PUCPR";
//	$pdf->MultiCell(0,5,$text,0,'L');
	
	$pdf->SetFont('Arial','',8);
	$pdf->Ln(2);
	$text = "Parecer gerado automaticamente em ".date("d/m/Y H:m").'.';
	$pdf->MultiCell(0,5,$text,0,'L');

	$filename = 'parecer_'.strzero($dd[0],8).'_'.date("Ym").'.pdf';
	$file = '../pibic/document/';
	diretorio_checa($file);
	$file .= date("Y").'/';
	diretorio_checa($file);
	$file .= date("m").'/';
	diretorio_checa($file);	
	$file .= $filename;
	
	$pdf->Output($file);
	
	$sql = "delete from ".$ged->tabela." where doc_tipo= 'PRD' ";
	//$rlt = db_query($sql);
	
	/* SALVAR */
	$ged->file_type = "PRD";
	$ged->file_data = date("Ymd");
	$ged->file_time = date("H:i");
	$ged->file_name = $filename;
	$ged->file_saved = $file;
	$ged->file_size = filesize($file);
	$ged->file_versao = '1';
	
	$ged->save();
	
function diretorio_checa($vdir)
	{
	if(is_dir($vdir))
		{ 
			/* Pasta criada */
		} else { 	
			mkdir($vdir, 0777);
		}	
		return($rst);
	}	
