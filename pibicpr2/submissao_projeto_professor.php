<?
require("cab.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_email.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_tips.php');
require($include.'sisdoc_debug.php');
$parecer = false;
//$dslq = "ALTER TABLE pibic_submit_documento ADD COLUMN doc_estrategica char(1);";
//$trlt = db_query($dslq);

//$dslq = "UPDATE pibic_submit_documento set doc_estrategica = 'N'";
//$trlt = db_query($dslq);

$tabela = "pibic_submit_documento";
$tabela2 = "pibic_submit_documento_valor";

$sql = "select * from ".$tabela." ";
$sql .= " left join pibic_professor on doc_autor_principal = pp_cracha ";
$sql .= " where id_doc = ".$dd[0];
$rlt = db_query($sql);
echo '<TABLE width='.$tab_max.'" align="center" border=0><TR><TD>';

if ($line = db_read($rlt))
	{
	$edital = $line['doc_edital'];
	////////////////////// Define nome do status atual
	$estrategica = $line['doc_estrategica'];
	$projeto_autor = $line['pp_nome'];
	$status = trim($line['doc_status']);
	$prj_nr = $line['doc_protocolo'];
	$protocolo = $line['doc_protocolo'];
	$emailpara = array();
	$ttitulo = $line['doc_1_titulo'];
	if (strlen(trim($line['pp_email'])) > 0) { array_push($emailpara,trim($line['pp_email'])); }
	if (strlen(trim($line['pp_email_1'])) > 0) { array_push($emailpara,trim($line['pp_email_1'])); }
	
	
	/////////////////////////////////////// Pareceres Gravados
	require("pibic_parecer_gravado.php");
	/////////////////////////////////////// Busca formumlario de acoes
	require("ed_reol_submit_acao.php");
	///////////////////////////////////////////////////////////////////
	
	if ($status == '@') { $status = 'Em submissão (@)'; }
	if ($status == 'A') { $status = 'Submetido (A)'; }
	if ($status == 'B') { $status = 'Com editor (B)'; }
	if ($status == 'C') { $status = 'Com parecerista (C)'; }
	if ($status == 'D') { $status = 'Avaliação concluída'; }
	if ($status == 'E') { $status = 'Finalizado'; }

	require("pibic_banner.php");
	
	$s .= '<TABLE width="'.$tab_max.'" class="lt1" border="0">';
	////////// Titulo do manuscrito
	$s .= '<TR><TD colspan="6" class="lt5" align="center">'.$line['doc_1_titulo'].'</TD></TR>';
	///////// Insere autores
	$s .= '<TR><TD colspan="6" class="lt5" align="center">'.$sa.'</TD></TR>';
	////////// Data Submissão, Status
	$s .= '<TR>';
	$s .= '<TH>data</TH>';
	$s .= '<TH>hora</TH>';
	$s .= '<TH>protocolo</TH>';
	$s .= '<TH>doc.ID</TH>';
	$s .= '<TH>status</TH>';
	$s .= '<TH>atualizado</TH>';
	$s .= '</TR>';
	
	$s .= '<TR>';
	$s .= '<TD colspan="1" class="lt2" align="center">'.stodbr($line['doc_data']).'</TD>';
	$s .= '<TD colspan="1" class="lt2" align="center">'.$line['doc_hora'].'</TD>';
	$s .= '<TD colspan="1" class="lt2" align="center">'.$line['doc_protocolo'].'</TD>';
	$s .= '<TD colspan="1" class="lt2" align="center">'.$line['doc_id'].'</TD>';
	$s .= '<TD colspan="1" class="lt2" align="center">'.$status.'</TD>';
	$s .= '<TD colspan="1" class="lt2" align="center">'.stodbr($line['doc_dt_atualizado']).'</TD>';
	$s .= '</TR>';
	
	$s .= '<TR>';
	$s .= '<TH colspan="5">Autor do projeto</TH>';
	$s .= '<TH>cod.interno</TH>';
	$s .= '</TR>';

	$s .= '<TR>';
	$s .= '<TD colspan="5">'.trim($line['ap_tit_titulo']).' '.trim($line['pp_nome']).'<BR>';
	$s .= '<A HREF="mailto:'.trim($line['pp_email']).'">'.trim($line['pp_email']).'</A>';
	$s .= '&nbsp;&nbsp;<A HREF="mailto:'.trim($line['pp_email_1']).'">'.trim($line['pp_email_1']).'</A>';
	$s .= '</TD>';
	$s .= '<TD colspan="1" align="center">'.$line['doc_autor_principal'].'</TD>';
	$s .= '</TR>';
	
if ($user_nivel >= 7)
	{	
	///////// Insere Acoes
		$s .= '<TR>';
		$s .= '<TD colspan="6" class="lt5" align="center">'.$sc.'</TD>';
		$s .= '</TR>';
	}
	///////// Fim da tabela principal
	$s .= '</TABLE>';
////////////////////////////////////////////////////////////////////// Grava parecer
$s .= $sq;	
/////////////////////////////////////////////////////////////////////////////////////
	require("pibic_projeto_resumo.php");	

	require("pibic_log.php");	
	echo $s;
	echo $sr;
	}
echo '</TABLE>';
	echo '<table width="'.$tab_max.'" class="lt0">';
	echo '<TR><TD colspan="6">Log</TD></TR>';
	echo $sl;
	echo '</table>';


require("foot.php");
?>