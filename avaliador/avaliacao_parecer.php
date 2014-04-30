<?
require("cab.php");
require($include.'sisdoc_debug.php');


$file = '../messages/msg_'.page();
if (file_exists($file)) { require($file); }

/** GED **/
require("_ged_config.php");

/** Bolsas **/
require("../_class/_class_pibic_bolsa_contempladas.php");
$bolsa = new pibic_bolsa_contempladas;

if (strlen($dd[0])==0)
	{
	$sql = "select * from pibic_parecer_2011 where pp_status = 'B' ";
	$sql .= " and pp_tipo = '2012P' ";
	echo $sql;
	$rlt = db_query($sql);
	
	while ($line = db_read($rlt))
		{
			echo '<BR>';
			$link = '<a href="avaliacao_parecer.php?dd0='.$line['id_pp'].'&dd90='.checkpost($line['id_pp']).'">';
			$link .= 'PDF ';
			$link .= $line['id_pp'];
			$link .= '</A>';
			echo $link;
		}
	exit;
	}	
$id = $dd[0];
if (strlen($id) > 0)
	{
	if ($dd[90] != checkpost($id)) { echo 'Erro de post'; exit; }
	require("avaliacao_pibic_cp.php");
	
	/** Class do PDF **/
	require($include.'sisdoc_pdf.php');
	require($include.'sisdoc_pdf_extend.php');
	$ok = $parecer->le($id);
	if ($parecer->status != 'B')
		{ echo 'Parecer já processado'; exit; }
	if ($ok == 1)
		{
			$bolsa->le('',$parecer->protocolo);
			echo 'Protocolo :'.$parecer->protocolo;
			echo '<HR>';
			$orientador = $bolsa->pb_professor_nome;
			$estudante = $bolsa->pb_est_nome;
			$titulo = $bolsa->pb_titulo_plano;
			$titulo = troca($titulo,chr(13),'');
			$titulo = troca($titulo,chr(10),'');
			
			/** Nome do arquivo para salvar **/
			$file = $_SERVER['DOCUMENT_ROOT'];
			$file .= '/reol/pibic/document/'.date("Y");
			$ged->dir($file);
			$file .= '/'.date("m");
			$ged->dir($file);
			$file .= '/'.$bolsa->pb_protocolo.'-'.substr(md5($bolsa->pb_protocolo),0,10).'-avaliacao_parcial.pdf';
		
			/*** Abre PDF **/
			$pdf = new PDF();
			$pdf->AddPage();
			
			/** Imagem do Programa **/
			$pdf->image('../pibic/img/homeHeaderLogoImage.jpg');
			$pdf->ln(10);
			
			/** Dados Iniciais do Projeto **/
			$pdf->SetFont('Arial','B',22);			
			$pdf->MultiCell(200,10,$titulo,0,'C');
						
			$pdf->SetFont('Arial','',12);
			$html = 'Orientador: <I>'.$orientador.'</I>';
			$html .= '<BR>Estudante: <I>'.$estudante.'</I>';
			$html .= '<BR>Procolo: <I>'.$bolsa->pb_protocolo.' / '.$bolsa->pb_protocolo_mae.'</I>';
						
			$pdf->WriteHTML($html);

			$html = $parecer->avaliacao_parecer_ver();

			$pdf->SetFont('Arial','',12);	
			$pdf->WriteHTML($html);
			$pdf->Output($file);
			
			/** Salva Ged **/
			$ged->protocol = $bolsa->pb_protocolo;
			$ged->file_name = $parecer->protocolo.'-parecer_avaliacao.pdf';
			$ged->file_type = 'AVLRP';
			$ged->file_saved = $file;
			$ged->file_size = filesize($file);
			$ged->file_path = $file;
			$ged->file_data = date("Ymd");
			$ged->file_time = date("H:i:s");
			$ged->save();
			echo 'Salvo em: '.$file;
			$parecer->status = 'C';
			$ok = $parecer->parecer_alterar_status();
			
			echo '<META HTTP-EQUIV="Refresh" CONTENT="3;URL=avaliacao_parecer.php">';
		} else {
			echo 'Erro ao acessar o parecer';
		}
	}
?>
