<?
$sp = '<TR><TD colspan="6">';
if ($parecer == true)
{
	$sp .= $nl. '<fieldset><legend><font class="lt3"><B><I>Parecer do Plano de trabalho PIBIC Jr.</I></B></font></legend>';
	$sp .= $nl. '<table width="100%" class="lt1" boder=2>';

	$cp = array();
	$tabela = "";
	$idfr = 1;
	//////////////////////////////////////////////////////////////////// pergunta 1
	$cpo = array();
	///////////////////////////////////////////////////////////////
	$sp .= '<TR><TD>&nbsp;</TD></TR>';	
		
	/////////////////////////////////////////////////////////////////////////////////	
	//////////////////////////////////////////////////////////////////// pergunta 8
	$pergunta = '<B>Critério Jr</B>:  O plano de trabalho proposta para o PIBICJr é adequado para iniciação científica de um aluno de ensino médio?';
	$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.'</TD></TR>';
	$sp .= $nl. '<TR class="lt1">';
	$sp .= $ln. '<TD>';
	$vlr = $dd[$idcp];
	$v1 = $proto_file.'-'.strzero(19,2).'-'.'1';
	$v2 = $proto_file.'-'.strzero(19,2).'-'.'0';
	if ($vlr==$v1) { $chkx1 = 'checked'; }
	if ($vlr==$v2) { $chkx2 = 'checked'; }
	$sp .= $ln. '<input type="radio" name="dd'.$idcp.'" value="'.$v1.'" '.$chkx1.'>SIM';
	$sp .= $ln. '<input type="radio" name="dd'.$idcp.'" value="'.$v2.'" '.$chkx2.'>NÃO';
	$idcp++;
	$idfr++;	
	$vlr = $dd[82];
	$sp .= $nl. '<TR><TD colspan="6" class="lt2">Sugestões (opcional)</TD></TR>';
	$sp .= $nl. '<TR class="lt1">';
	$sp .= $nl. '<TD><textarea cols="60" rows="4" name="dd82">'.$vlr.'</textarea>';
	$sp .= $nl. '<input type="hidden" name="dd83" value="'.$proto_fil.'">';
	//$sp .= '<input type="text" name="dd'.$idcp.'" value="'.$vlr.'" '.$chk.'> '.$bold.$cpo[$rt][2];
} ?>