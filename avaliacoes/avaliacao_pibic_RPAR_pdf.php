<?
require($include.'fphp-153/fpdf.php');
require("../editora/checar_diretorio.php");
echo "OOO2O";
////////////////////////////////////////////////////////////////
$pdf = new FPDF();

$ln = 0;
$pdf->AddPage();

	$pdf->Image('../img/logo-cip.png',10,6,30);
	$pdf->Image('../img/logo_pucpr.jpg',190,6,13);
	$pdf->Ln($ln);
	
	$pdf->SetFont('Arial','',11);
	$pdf->MultiCell(0,5,'Pontifícia Universidade Católica do Paraná - PUCPR','','C');
	$pdf->MultiCell(0,5,'Programa de Iniciação Científica','','C');
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
	$pdf->MultiCell(0,8,'PARECER DO RELATÓRIO PARCIAL',0,'C');
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
							if ($dd[$r]==2) { $text = 'Necessita correções e resubmissão'; }
						}
					$pdf->MultiCell(0,5,$text,0,$align);
					$pdf->Ln(7);
				}
		}


	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',12);
	$text = "Cleybe Vieira";
	$pdf->MultiCell(0,5,$text,0,'L');

	$text = "Coordenação IC - PUCPR";
	$pdf->MultiCell(0,5,$text,0,'L');
	
	$pdf->SetFont('Arial','',8);
	$pdf->Ln(2);
	$text = "Parecer gerado automaticamente em ".date("d/m/Y H:m").'.';
	$pdf->MultiCell(0,5,$text,0,'L');

	$filename = 'parecer_'.strzero($dd[0],8).'_'.date("YmdHis").'pdf';
	$file = '../pibic/document/';
	echo '1111111111111111';
	dir($file);
	echo '222222222222222222';	
	$file .= date("Y").'/';
	dir($file);
	$file .= date("m").'/';
	dir($file);	
	$file .= $filename;
	
	echo '>>>>>>>>>>>>>>'.$file;
	
	$pdf->Output($file);
	echo '<A HREF="'.$file.'">Arquivos</A>';

