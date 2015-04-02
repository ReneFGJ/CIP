<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

require("../_class/_class_pibic_bolsa_contempladas.php");
$bolsa = new pibic_bolsa_contempladas;

/* Le dados da Indica��o */
$parecer_pibic->tabela = 'pibic_parecer_'.date("Y");
$ok = $parecer_pibic->le($dd[0]);
	
/* Recupera protocolo do projeto */
$protocolo = $parecer_pibic->protocolo;


echo '<table width=95% align=center >';
echo '<TR><TD>';

$id = $dd[0];
if ($dd[90] != checkpost($id)) { echo 'Erro de post'; exit; }

/* */
$sql = "update ".$parecer_pibic->tabela." set pp_data_leitura = ".date("Ymd")." where id_pp = ".round($id);
$qrlt = db_query($sql);

/* Recupera dados da bolsa */
$bolsa->le('',$protocolo);
echo $bolsa->mostar_dados();

/** GED **/
require_once('../_class/_class_ged.php');
$ged = new ged;

$ged->tabela = $bolsa->tabela_ged;
$ged->protocol = $bolsa->pb_protocolo_mae;
$ged->convert('pibic_ged_files','pibic_ged_documento');

$ged->tabela = $bolsa->tabela_ged;
$ged->protocol = $bolsa->pb_protocolo;
$ged->convert('pibic_ged_files','pibic_ged_documento');

//echo $bolsa->filelist();
echo $ged->filelist();

$comentarios = 'Coment�rios';

$sp = '<HR width=70% size=1><BR>';

echo '<P>';
echo mst('
<BR><BR><B>Prezado avaliador</B>
<BR><BR>Para cada pergunta abaixo haver� um campo de preenchimento obrigat�rio para seus coment�rios relacionados com a op��o assinalada. Informamos que as frases na cor azul s�o informativas e restritas aos avaliadores e tem o prop�sito de dar uma uniformidade m�nima nas avalia��es.
<BR><BR>Ap�s a sua avalia��o, o parecer ser� enviado ao professor orientador para conhecimento e corre��es, se for o caso. Nosso intuito � que aluno e professor orientador recebam seu feedback qualitativo e, a partir destes, poder�o aprimorar o andamento da pesquisa e o aprendizado do aluno.
<BR><BR>Agradecemos imensamente sua participa��o e colabora��o.
<BR><BR>Comit� Gestor 
');
echo '</P>';


$form_title = '<BR><B>Ficha de Avalia��o do Relat�rio Parcial</B>';
/** Campos do formulario **/
require('avaliacao_pibic_RPAC_cp.php');

if (strlen($acao) > 0)
	{
		$sr = '';
		for ($r=0;$r < count($cp);$r++)
			{
				if (($cp[$r][3]==True) and (strlen(trim($dd[$r]))==0))
					{
						$txt = $cp[$r][2];
						$sr .= '<LI><B>'.$txt.'</B> � obriat�rio</LI>'.chr(13);
					}
			}
		if (strlen($sr) > 0)
			{
				echo '<div style="background-color: #FFA0A0">';
				echo '<h2><font color="red">Erro: campos obrigat�rios</font></h2>';
				
				echo '<font color="red">';
				echo '<UL>';
				echo $sr;
				echo '</UL>';
				echo '</font>';
				
				echo '</div>';
				
				echo '<script>'.chr(13);
				echo ' alert("campos obrigat�rios n�o preenchidos")';
				echo '</script>'.chr(13);
			}
	}


if (strlen($acao) > 0)
	{
	$posicao_aprovacao = 0;
	$isx = 0;
	$sql = "update ".$tabela." set ";
	for ($r=1;$r < count($cp);$r++)
		{
			/* recupera status de aprova��o */
			if ($cp[$r][1]=='pp_p01') { $is = $dd[$r]; }

			/* */
			if (strlen($cp[$r][1]) > 0)
				{
					if ($isx == 1) { $sql .= ', '; }
					$sql .= $cp[$r][1] ." = '".$dd[$r]."' ";
					$isx = 1;
				}
		}
	$sql .= " where id_pp = ".$dd[0];
	$rlt = db_query($sql);
	}
echo '<TR><TD>'.msg('avaliador_info');
echo '<TR><TD align=center class=lt5>'.$form_title;
echo '<TR><TD>';
$tabela = '';
editar();
echo '</table>';
	
if ($saved > 0)
	{
		require($include.'sisdoc_email.php');
		
		require('../_class/_class_ic.php');
		$ic = new ic;
		$ics = 'RPAC_RESULT_'.$is;
	
		$text = $ic->ic($ics);
		
		$titulo = $text['nw_titulo'];
		$conteudo = $text['nw_descricao'];
		
		$email1 = trim($bolsa->pb_prof_email_1);
		$email2 = trim($bolsa->pb_prof_email_2);

		$proj_titulo = $bolsa->pb_titulo_projeto;
		
		$conteudo = troca($conteudo,'$aluno',$bolsa->pb_est_nome);
		
		
		require("avaliacao_pibic_RPAC_pdf.php");		
		
		/* Enviar e-mail */
		require("../pibicpr/_email.php");
		$assunto = '[IC] '.$bolsa->pb_protocolo.' - '.$titulo;
		$filename = $file;
		
		
		$emails = array();
		//array_push($emails,'renefgj@gmail.com');
		
		array_push($emails,'pibicpr@pucpr.br');
		array_push($emails,'renefgj@gmail.com');
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
	 
 			//cabe�alho da mensagem
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
				pb_relatorio_parcial_correcao_nota = ".round($is)."
				where pb_protocolo = '".$bolsa->pb_protocolo."' ";
		$qrlt = db_query($sql);	
		$sql = "update ".$parecer_pibic->tabela." set pp_status = 'B' where id_pp = ".round($id);
		$qrlt = db_query($sql);
		
		redirecina('main.php');
		}

?>
