<?php
require("cab.php");

require($include.'sisdoc_debug.php');
//ini_set('display_errors', 255	);
//ini_set('error_reporting', 255 );

/*
$ad = array(
674,762,736,307,1065,976,901,978,729,223,1080,663,695,947,987,430,221,1152,386);

for ($r=0;$r < count($ad);$r++)
	{
		$sql = "update  pibic_parecer_2015 set pp_p01=9 where id_pp = ".$ad[$r];
		$rlt = db_query($sql);
		//echo '<BR>'.$sql;
	}
 */


{
		$sql = "select * from pibic_parecer_2015 where pp_p01 isnull and pp_status='B' limit 1";	
		$rlt = db_query($sql);
		if (!($line = db_read($rlt))) { exit; }
		$protocolo = $line['pp_protocolo'];
		$idp = $line['id_pp'];
		echo $protocolo.'<BR>';
		//exit;
		require("avaliacao_pibic_RPAR_cp.php");

		for ($r=0;$r < count($cp);$r++)
			{
				$fld = trim($cp[$r][1]);
				$dd[$r] = $line[$fld];
				if ($fld=='pp_p01')
				{
					$dd[$r] = 1;
					$is = 1;
				}
			}

		require("../_class/_class_pibic_bolsa_contempladas.php");
		$bolsa = new pibic_bolsa_contempladas;
		$bolsa->le('',$protocolo);
		
		
		/** GED **/
		require_once('../_class/_class_ged.php');
		$ged = new ged;

		$ged->tabela = $bolsa->tabela_ged;
		$ged->protocol = $bolsa->pb_protocolo_mae;
		$ged->convert('pibic_ged_files','pibic_ged_documento');

		$ged->tabela = $bolsa->tabela_ged;
		$ged->protocol = $bolsa->pb_protocolo;
		$ged->convert('pibic_ged_files','pibic_ged_documento');	
	
		/*  */
		require($include.'sisdoc_email.php');
		
		require('../_class/_class_ic.php');
		$ic = new ic;
		$ics = 'RPAR_RESULT_'.$is;
	
		$text = $ic->ic($ics);
		
		$titulo = $text['nw_titulo'];
		$conteudo = $text['nw_descricao'];
		
		$email1 = trim($bolsa->pb_prof_email_1);
		$email2 = trim($bolsa->pb_prof_email_2);

		$proj_titulo = $bolsa->pb_titulo_projeto;
		
		$conteudo = troca($conteudo,'$aluno',$bolsa->pb_est_nome);
		
		require("avaliacao_pibic_RPAR_pdf.php");		
		echo 'SALVO';

		/* Enviar e-mail */
		require("../pibicpr/_email.php");
		$assunto = '[IC] '.$bolsa->pb_protocolo.' - '.$titulo;
		$filename = $file;
		
		
		$emails = array();
		//array_push($emails,'renefgj@gmail.com');
				
		array_push($emails,'pibicpr@pucpr.br');
		if (strlen($email1) > 0) { array_push($emails,$email1); }
		if (strlen($email2) > 0) { array_push($emails,$email2); }
		
		for ($r=0;$r < count($emails);$r++)
			{
		
 			//boundary o que identifica cada parte da mensagem
			$fp = fopen($file,"rb"); 
			$anexo = fread($fp,filesize($file)); 
			$anexo = base64_encode($anexo); 
			fclose($fp); 
			$anexo = chunk_split($anexo);
			
 			//$email_adm
 			//$admin_nome
	 
	 		$quebra_linha="\r\n";
			$file_name = "parecer_relatorio_parcial-".$bolsa->pb_protocolo.'.pdf';
	 
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
 			$para = $emails[$r];
 			mail($para, $assunto, $mens, $headers);
			echo '<BR>Enviado e-mail para '.$para;		
			}	

		$sql = "update pibic_bolsa_contempladas set 
				pb_relatorio_parcial_nota = ".round($is)."
				where pb_protocolo = '".$bolsa->pb_protocolo."' ";
		echo '<HR>'.$sql;
		$qrlt = db_query($sql);	
		$sql = "update pibic_parecer_2015 set pp_status = 'B', pp_p01='$is' where id_pp = ".round($idp);
		echo '<HR>'.$sql;
		$qrlt = db_query($sql);
		
		echo '<HR>OK';		
		exit;
	}
?>
