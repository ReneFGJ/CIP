<?
require($include."sisdoc_email.php");

	$dd[99] = $proto;
	$destino = '';

	$sql = "select * from pibic_bolsa
			inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo "; 
	$sql .= " where pb_protocolo = '".$dd[0]."'";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$bolsa = $line['pb_tipo'];
	$bolsa_nome = $line['pbt_descricao'];
	$professor = $line['pb_professor'];
	$aluno = $line['pb_aluno'];

?>
<font class="lt3"><center>
TERMO DE IMPLEMENTAÇÃO DE BOLSA / ADESÃO ICV
</center></font>
<?

if (strlen($proto)==0)
	{
		echo '<H1>Sessão expirada</H1>';
		exit;
	}
	$destino = '1';
	$dd[1] = '1';
	$dd[99] = $proto;
	
	require("gerar_termo_pdf.php");
	
	$destino = troca($destino,'/pucpr/httpd/htdocs/www2.pucpr.br','');
	
	$sql = "select * from pibic_bolsa_contempladas where pb_protocolo = '".$proto."' ";
	$rlt = db_query($sql);
	
	$sql = "update pibic_bolsa set pb_validacao = ".date("Ymd")." where pb_protocolo = '".$proto."'; ";
	//$rlt = db_query($sql);
/////////////////////////////////////////////////////////////////////////////////////////
	echo '<center><h1>Ativação efetuada</h1></center>';
	
	$sql = "select * from ic_noticia ";
	$sql .= " where nw_ref = 'termo_final_3' ";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$texto = $line['nw_descricao'];
	echo ($texto.'<BR>');
////////////////////////////////$boundary = "XYZ-" . date(dmyhms) . "-ZYX";
	$texto .= CHR(13).'Contrato entregue com sucesso em '.date("d/m/Y H:i:s");

////////////////////////////////$boundary = "XYZ-" . date(dmyhms) . "-ZYX";
	$boundary = "XYZ-" . date(dmyhms) . "-ZYX";

	$anexo_name = 'contrato_PIBIC_'.date("Y").'_'.troca($aluno_nome,' ','_').'.pdf';
	$message = "--$boundary\n";
	$message .= "Content-Transfer-Encoding: 8bits\n";
	$message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\n\n";
	$message .= troca($texto,'<BR>',chr(13).chr(13));
	$message .= "\n";
//	$message .= "Content-Disposition: attachment; filename=\"$anexo_name\" \n";
	
	$full_path = $dir.$destino;
	if (file_exists($full_path))
		{
	          if ($fp = fopen($full_path,"rb")) {
	             $filename = array_pop(explode(chr(92),$full_path));
	             $contents = fread($fp,filesize($full_path));
	             $encoded = base64_encode($contents);
	             $encoded_split = chunk_split($encoded);
	             fclose($fp);
	             $message .= "--$boundary\n";
	             $message .= "Content-Type: $anexo_type\n";
	             $message .= "Content-Disposition: attachment; filename=\"$anexo_name\" \n";
	             $message .= "Content-Transfer-Encoding: base64\n\n";
	             $message .= "$encoded_split\n";
	             }
			} else {
				echo $full_path;
				echo '<BR><font color="red">Documento não localizado no sistema</font>';
			}
	$message .= "--$boundary--\r\n";
	////////////////////////////
	$headers = "MIME-Version: 1.0\n";
	$headers .= "From: PIBIC <pibicpr@pucpr.br> \r\n";
//	$headers .= "From: PIBIC <pibicpr@pucpr.br> \n";
	$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";

	require('../_class/_class_docentes.php');
	$docs = new docentes;
	$docs->le($professor);
	$prof_email = $docs->line['pp_email'];
	$prof_email_1 = $docs->line['pp_email_1'];
	
	require('../_class/_class_discentes.php');
	$disc = new discentes;
	$disc->le('',$aluno);
	$disc_email = $disc->line['pa_email'];
	$disc_email_1 = $disc->line['pa_email_1'];
	
	$e3 = '[PIBIC] - Ativação de '.$bolsa_nome.' - '.$aluno_nome;
	$e4 = $message;
	// e-mail de segurança
//	$e1 = 'pibicpr@pucpr.br';
//	enviaremail($e1,$e2,$e3,$e4);
//	$e1 = 'renefgj@gmail.com';
//	$mensagem=mail($e1,$e3, $e4, $headers); echo 'enviado para '.$e1;
	$e1 = 'pibicpr@pucpr.br';
	$mensagem=mail($e1,$e3, $e4, $headers); echo 'enviado para '.$e1;
		
	if (strlen($prof_email) > 0) 	{ 	$mensagem=mail($prof_email,$e3, $e4, $headers);  }
	if (strlen($prof_email_1) > 0) 	{ 	$mensagem=mail($prof_email_1,$e3, $e4, $headers);  }
	
	if (strlen($disc_email) > 0) 	{ 	$mensagem=mail($disc_email,$e3, $e4, $headers);  }
	if (strlen($disc_email_1) > 0) 	{ 	$mensagem=mail($disc_email_1,$e3, $e4, $headers);  }

?>
