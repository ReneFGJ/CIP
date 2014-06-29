<?
require("db.php");
//require($include."sisdoc_debug.php");
require($include.'fphp-153/fpdf.php');
require($include."sisdoc_cookie.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_email.php");

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
	$arquivo = $line['doc_arquivo'];
	}

/////////////////////////////////////////////// AVALIADOR
$sql = "select * from pareceristas ";
$sql .= " where us_codigo = '".$dd[0]."' ";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$aval_nome = trim($line['us_nome']);
	$aval_titu = trim($line['us_titulacao']);
	$aval_nome = trim($aval_titu.' '.$aval_nome);
	$aval_email_1 = trim($line['us_email']);
	$aval_email_2 = trim($line['us_email_alternativo']);
	
		// DECL_AVALIADOR
		$tipo = 'AVAL_AGRAD_SEMIC';
		$sql = "select * from ic_noticia where nw_ref = '".$tipo."' ";
		$rrr = db_query($sql);
		if ($line = db_read($rrr))
			{
			$texto = $line['nw_descricao'];
			}
			echo '<HR>'.$aval_nome.'<HR>';
		///////////// Trocas
		$texto = troca($texto,'$professor_nome',$aval_nome);
		$texto = troca($texto,'<br>',chr(13));
		$texto = troca($texto,'&nbsp;',' ');		
	}
?>
<BR>
enviar para <?=$aval_email_1;?>, <?=$eval_email_2;?>.

<?
$message .= "Content-Disposition: attachment; filename=\"$anexo_name\" \n";

$nl = chr(13).chr(10).'<BR>';
global $email_adm, $admin_nome;
$email_adm = "pibicpr@pucpr.br";
$admin_nome = "PIBIC-PUCPR ".date("Y");
$e3 = "PUCPR PIBIC ".date("Y")." - $titulo";
$e4 = "";

$boundary = "XYZ-" . date(dmyhms) . "-ZYX";

//d2_000000_0000137_0e761a54.pdf
//d2_000000_0000137_0e761a54.pdf


$message = "--$boundary\n";
$message .= "Content-Transfer-Encoding: 8bits\n";
$message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\n\n";
$message .= $texto;
$message .= "\n";

$full_path = trim($dir).trim($arquivo);
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
             $message .= "Content-Disposition: attachment; filename=\"declaracao_pibic_pucpr_".date("Y").".pdf\" \n";
             $message .= "Content-Transfer-Encoding: base64\n\n";
             $message .= "$encoded_split\n";
             }
		} else {
			echo $full_path;
			echo '<BR><font color="red">Documento não localizado no sistema</font><BR><BR>';
			exit;
		}
$message .= "--$boundary--\r\n";

$headers = "MIME-Version: 1.0\n";
$headers .= "From: ".$admin_nome." <" .$email_adm. "> \n";
$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";

//	$headers .= "To: ".$e1." \n";
;
//$mensagem=mail('cleybe.vieira@pucpr.br', "Declaração PIBICPR", $message, $headers);
$mensagem=mail("monitoramento@sisdoc.com.br", "Declaração PIBICPR", $message.' <BR> com copia para '.$aval_email_1.' '.$aval_email_2, $headers);
if (strlen($aval_email_1) > 0)
	{ $mensagem=mail($aval_email_1, "Declaração PIBICPR", $message, $headers); echo 'enviado para '.$aval_email_1;}
if (strlen($aval_email_2) > 0)
	{ $mensagem=mail($aval_email_2, "Declaração PIBICPR", $message, $headers); echo 'enviado para '.$aval_email_2; }
echo '---> enviado ';

echo '<font color="green">'.mst($texto).'</font>';
	
exit;
?>