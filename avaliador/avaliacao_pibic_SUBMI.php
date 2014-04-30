<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
$bbx = 'recupera';

$saved = 1;

require("../_class/_class_docentes.php");
$doc = new docentes;

require("../pibic/_ged_config_submit_pibic.php");
//if ($dd[90] != checkpost($id)) { echo 'Erro de post'; exit; }

require("../_class/_class_pibic_projetos.php");
$pj = new projetos;

/* Le dados da Indicação */
$parecer_pibic->tabela = 'pibic_parecer_'.date("Y");
$parecer_pibic->le($dd[0]);

if ($parecer_pibic->status != '@')
	{
		echo '<CENTER><BR><BR><BR>';
		echo '<h1>Projeto já avaliado</h1>';
		echo '<BR><BR><BR>';
		exit;
	}

$perfil = $_SESSION['user_perfil'];
if (strpos($perfil,'#COO'))
{
	echo '<HR>';
	echo $parecer_pibic->parecer_indicacao_row();
	echo '<HR>';
	//echo $parecer_pibic->mostra_avaliacao($dd[0]);
}

/* Recupera protocolo do projeto */
$protocolo = $parecer_pibic->protocolo;
$id = $parecer_pibic->id_pp;
$avaliador = $parecer_pibic->avaliador;

echo '<table width=95% align=center border=0 >';
echo '<TR><TD>';
/* */
$sql = "update ".$parecer_pibic->tabela." set pp_data_leitura = ".date("Ymd")." where id_pp = ".round($id);
$qrlt = db_query($sql);

$comentarios = 'Comentários';

/*********************************************************************/
echo '<P>';
echo '
<BR><BR><B>Prezado avaliador</B>
<BR>
<BR>O processo de avaliação é extremamente rápido e direto.
<BR>As informações estão apresentadas da seguinte forma:
<BR>- Projeto do professor orientador, identificado pelo ícone P.
<BR>- A este projeto está vinculado pelo menos 01 plano de trabalho do aluno, ícone A.
<BR>- A avaliação consiste na análise de cada uma destas partes a partir dos critérios especificados.
<BR>- O parecer qualitativo é de preenchimento obrigatório e será enviado ao professor proponente como feedback, visando o aprimoramento da pesquisa na nossa Instituição.
<BR>- Ao final, clique em gravar e enviar. Está encerrado o processo de avaliação!
<BR>Instruções para a avaliação de projetos.
<BR><A HREF="http://www2.pucpr.br/reol/public/20/archive/Instrucoes_avaliacao_de_projetos_ICI2013.pdf" targer="_new">Arquivo de instruções para avaliadores</A>
<BR><BR>Agradecemos sua valiosa contribuição para o nosso Programa.
<BR><BR>Cleybe Vieira
<BR>Coordenação da IC
<BR>pibicpr@pucpr.br
<BR>(41) 3271-1602 / 3271- 1730
';
echo '</P>';

/*********************************************************************/
echo '<form method="post" action="'.page().'">'.chr(13);
echo '<input type="hidden" name="dd0" value="'.$dd[0].'">'.chr(13);
 //* Recupera dados da bolsa */
$pj->le($protocolo);
/*********************************************************************/
/* Dados do professor */
echo '<center><h3>Dados do Professor Orientador</h3></center>';
$prof = $pj->professor;
$doc->le($prof);
echo $doc->mostra();


/*********************************************************************/
echo '<center><h3>Projeto do Professor Orientador</h3></center>';
echo $pj->mostra($pj->line);
echo '</table>';

if (strlen($acao) == 0)
	{
		$sql = "select * from ".$parecer_pibic->tabela."
				where id_pp = ".$dd[0];
		$rrlt = db_query($sql);
		if ($rline = db_read($rrlt))
			{
				$dd[13] = $rline['pp_p01'];
				$dd[14] = $rline['pp_p02'];
				$dd[15] = $rline['pp_p03'];
				$dd[16] = $rline['pp_p04'];
				$dd[80] = $rline['pp_abe_01'];
//				if (strlen($dd[13]) > 0) { $acao = 'xx'; }
				$acao = $bbx;				
			}
	}

/*********************************************************************/
echo '<TR><TD>';
echo '<BR><BR><center>';
echo  '<h1>Ficha de Avaliação do Projeto do Professor</h1>';
echo '</center>';

/* Ficha de avaliacao */
$sx = '<table class="tabela00" width="100%" border=0>';
$sx .= chr(13);
/** Campos do formulario **/
	$area1 = $pj->line['pj_area'];
	$area2 = $pj->line['pj_area_estra'];

$cp = $parecer_pibic->parecer_cp_modelo_pp('',$area1,$area2);
$ddx = 5;
for ($r=0;$r < count($cp); $r++)
	{
		$cor = '<font color="black">';
		if ((strlen($acao) > 0) and (strlen($dd[$ddx])==0)) { $cor = '<font color="red">'; }
		$fl = substr($cp[$r][0],1,1);
		$sx .= '<TR><TD>';
		if (($fl=='M') or ($fl=='S') or ($fl=='R')) { $sx .= '<B>'.$cor.$cp[$r][2].'</font></B>'; }
		$sx .= sget("dd".$ddx,$cp[$r][0],$cp[$r][2],$cp[$r][3],$cp[$r][4]);
		$ddx++;
	}
$sx .= '</table>';

echo $sx;
echo '<TR><TD colspan=4><input type="submit" name="acao" value="gravar avaliação >>>" class="botao-geral">';
echo '<TR><TD colspan=4><BR><BR><BR>';

/*********************************************************************/
/* SALVAR */
$rest = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
if ((strlen($acao) > 0) and ($acao != $bbx))
	{
		$rest[1] = round($dd[13]);
		$rest[2] = round($dd[14]);
		$rest[3] = round($dd[15]);
		$rest[4] = round($dd[16]);
		
		if ($rest[1]==0) { $saved = 0; }
		if ($rest[2]==0) { $saved = 0; }
		if ($rest[3]==0) { $saved = 0; }
		if (substr($area2,0,4) != '9.00') 
			{ if ($rest[4]==0) { $saved = 0; } }
		
		$sql = "update ".$parecer_pibic->tabela." 
					set pp_p01 = ".$rest[1].",
						pp_p02 = ".$rest[2].",
						pp_p03 = ".$rest[3].",
						pp_p04 = ".$rest[4].",
						pp_abe_01 = '".$dd[80]."'					
				where id_pp = ".$dd[0];
		$qrlt = db_query($sql);
	}

/*********************************************************************/
/* Planos */
$sql = "select * from pibic_submit_documento 
		left join pibic_aluno on doc_aluno = pa_cracha
		where doc_protocolo_mae = '$protocolo' and  doc_status <> 'X'
		";
$rlt = db_query($sql);

echo '<center>';
echo  '<h1>Plano(s) de Aluno(s) vinculado(s) ao Projeto do Professor</h1>';
echo '</center>';

$pl = 0;
$ged->tabela = 'pibic_ged_documento';

echo '<table class="tabela00" width="100%" border=0>';
while ($line = db_read($rlt))
	{
	echo '<TR valign="top"><TD><img src="'.http.'pibic/img/icone_plano_aluno.png" width="50">';
	echo '<TD>';
	echo $pj->mostra_plano_line($line);
	$proto_pp = trim($line['doc_protocolo']);
	$ged->protocol = trim($line['doc_protocolo']);
	//print_r($ged);
	//echo '<TR><td colspan=2 class="tabela01">Arquivos:';
	echo $ged->filelist();
	
	/* LEITURA DOS REGISTRO */
	$ddx = $pl*10+20;
	if ($acao == $bbx)
	{
		$sql = "select * from ".$parecer_pibic->tabela."
				where pp_protocolo = '".$proto_pp."' and
				  	pp_protocolo_mae = '".$protocolo."' and 
				  	pp_avaliador = '".$avaliador."' ";
		$qrlt = db_query($sql);	
		if ($rline = db_read($qrlt))
			{
				$dd[$ddx] = trim($rline['pp_p05']);
				$dd[$ddx+1] = trim($rline['pp_p06']);
				$dd[$ddx+2] = trim($rline['pp_p07']);
				$dd[$ddx+3] = trim($rline['pp_p08']);
			}
	}
	
	/* Ficha de avaliacao */
	$sx = '<table class="tabela00" width="100%" border=0>';
	$sx .= chr(13);
	/** Campos do formulario **/
	
	$cp = $parecer_pibic->parecer_cp_modelo_pl();
	for ($r=0;$r < count($cp); $r++)
		{
			$cor = '<font color="black">';
			if ((strlen($acao) > 0) and (strlen($dd[$ddx])==0)) { $cor = '<font color="red">'; }
			$fl = substr($cp[$r][0],1,1);
			$sx .= '<TR><TD>';
			//$sx .= $ddx;
			if (($fl=='M') or ($fl=='S') or ($fl=='R')) { $sx .= '<B>'.$cor.$cp[$r][2].'</font></B>'; }
			$sx .= sget("dd".$ddx,$cp[$r][0],$cp[$r][2],$cp[$r][3],$cp[$r][4]);
					
			$ddx++;
		}
	$sx .= '</table>';
	echo $sx;	
	echo '<TR><TD colspan=4><input name="acao" type="submit" value="gravar avaliação >>>" class="botao-geral">';
	echo '<TR><TD colspan=4><BR><BR><BR>';

	/*********************************************************************/
	/* SALVAR */
	$sql = "select * from ".$parecer_pibic->tabela."
			where pp_protocolo = '".$proto_pp."' and
				  pp_protocolo_mae = '".$protocolo."' and 
				  pp_avaliador = '".$avaliador."' ";
	$qrlt = db_query($sql);
	if (!($qline = db_read($qrlt)))
		{
			$sql = "insert into ".$parecer_pibic->tabela."
					(
						pp_protocolo,pp_protocolo_mae,pp_avaliador,
						pp_status, pp_tipo, pp_nrparecer,
						pp_revisor, pp_pontos, pp_pontos_pp,
						pp_data
					) values (
						'".$proto_pp."','".$protocolo."','".$avaliador."',
						'@','SUBMP','',
						'',0, 0,
						".date("Ymd")."
					)";
			$qrlt = db_query($sql);
		}
		
	if ((strlen($acao) > 0) and ($acao != $bbx))
		{
			$idx = $pl*10+26;
			if ($dd[$idx+0]==0) { $saved = 0; }
			if ($dd[$idx+1]==0) { $saved = 0; }
			if ($dd[$idx+2]==0) { $saved = 0; }
			
			$sql = "update ".$parecer_pibic->tabela." 
						set pp_p01 = ".$rest[1].",
							pp_p02 = ".$rest[2].",
							pp_p03 = ".$rest[3].",
							pp_p04 = ".$rest[4].",
							
							pp_p05 = ".round($dd[$idx+0]).",
							pp_p06 = ".round($dd[$idx+1]).",
							pp_p07 = ".round($dd[$idx+2]).",
							pp_p08 = ".round($dd[$idx+3]).",
							pp_abe_01 = '".$dd[80]."'					
					where 	pp_protocolo = '".$proto_pp."' and
				 		 	pp_protocolo_mae = '".$protocolo."' and 
				  			pp_avaliador = '".$avaliador."' ";					
			$qrlt = db_query($sql);
		}		
	
	$pl++;
	}

echo '<center>';
echo  '<h1>Parecer Qualitativo</h1>';
echo '</center>';

echo '<table class="tabela00" width="100%" border=0>';
echo '<TR><TD colspan=4>';

$cor = '<font color="black">';
if ((strlen($acao) > 0) and (strlen($dd[80]) < 10))
	{ $cor = '<FONT COLOR="RED">'; }
	
echo $cor.'<B>Parecer qualitativo</B>'.'</font>';
echo ' (<font color="red">campo obrigatório</font>)';
echo $cor.' será enviado como feedback para o professor
		proponente, com intuito de aprimoramento da pesquis
		a na iniciação científica em nossa
		instituição. </font>';
echo '<TR><TD>';
echo sget('dd80','$T80:6','',1,1);
echo '</table>';
echo '<TR><TD colspan=4><input type="submit" name="acao" value="gravar avaliação >>>" class="botao-geral">';




if (strlen($dd[80]) <= 5) { $saved = 0; }

if (($saved > 0) and ($acao != $bbx))
	{
		$sql = "update ".$parecer_pibic->tabela." set pp_status = 'B' 
				, pp_data = ".date("Ymd")."
				where (pp_protocolo = '".$protocolo."' 
					or pp_protocolo_mae = '".$protocolo."')
					and pp_avaliador = '$avaliador'	
				 ";
		$rlt = db_query($sql);
		
		redirecina('avaliacao_pibic_SUBMI_fim.php?dd0='.$dd[0]);
		exit;
		//$qrlt = db_query($sql);
			
		exit;
		
		
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
		
		
		//require("avaliacao_pibic_RPAC_pdf.php");		
		
		/* Enviar e-mail */
		require("../pibicpr/_email.php");
		$assunto = '[IC] '.$bolsa->pb_protocolo.' - '.$titulo;
		$filename = $file;
		
		
		$emails = array();
		array_push($emails,'monitoramento@sisdoc.com.br');
		//array_push($emails,'pibicpr@pucpr.br');
		//if (strlen($email1) > 0) { array_push($emails,$email1); }
		//if (strlen($email2) > 0) { array_push($emails,$email2); }
		
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


		
		redirecina('main.php');
		}

?>
