<?
$sp = '<TR><TD colspan="6">';
if ($parecer == true)
{
$sp .= $nl. '<fieldset><legend><font class="lt3"><B><I>Parecer do Plano do Aluno</I></B></font></legend>';
$sp .= $nl. '<table width="100%" class="lt1" boder=2>';

$cp = array();
$tabela = "";
$idfr = 1;
//////////////////////////////////////////////////////////////////// pergunta 1
$cpo = array();
array_push($cpo,array('dd'.$nr,$nr,'excelente','20')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'muito bom','15')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'bom','10')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'regular','5')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'ruim','2')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'muito ruim','X')); $nr++;
$pergunta = '<B>Crit�rio 4</B>:  Coer�ncia entre o projeto do orientador e o plano de trabalho do aluno, considerando a contribui��o para a forma��o do discente.';
$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.'</TD></TR>';
$sp .= $nl. '<TR class="lt1">';
///////////////////// buscar valor anteriormente gravados
if (strlen($acao) == 0)
	{
	for ($rp=0;$rp < count($rsp);$rp++)
		{
		if ($proto_file == trim($rsp[$rp][0]))
			{
			for ($rr=1;$rr < 5;$rr++)
				{
				$rrx = trim($rsp[$rp][$rr+1]);
				if (strlen($rrx) > 0)
					{
					$rrx = $proto_file.'-'.strzero($rr,2).'-'.$rrx;
					$idrr = $idcp+$rr-1; 
					if (strlen($rrx) > 0) { $dd[$idrr] = trim($rrx); }
					}
				}
			}
		}
		$dd[80] = $rsp[0][7];
	}
//////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
for ($rt = 0; $rt < count($cpo);$rt++)
	{
	$chk = '';
	$bold = '';
	$vlr = $proto_file.'-'.strzero($idfr,2).'-'.$cpo[$rt][3]; 
	if ($dd[$idcp] == $vlr) { $chk = 'checked'; $bold = '<B>'; }
	$sp .= $nl. '<TD><nobr><input type="radio" name="dd'.$idcp.'" value="'.$vlr.'" '.$chk.'> '.$bold.$cpo[$rt][2];
	}
$idcp++;
$idfr++;
///////////////////////////////////////////////////////////////
$sp .= '<TR><TD>&nbsp;</TD></TR>';
/////////////////////////////////////////////////////////////////////////////////	
//////////////////////////////////////////////////////////////////// pergunta 2
$cpo = array();
array_push($cpo,array('dd'.$nr,$nr,'excelente','15')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'muito bom','10')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'bom','5')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'regular','2')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'muito ruim','X')); $nr++;
$pergunta = '<B>Crit�rio 5</B>:  Roteiro de atividades do aluno considerando a sua adequa��o ao processo de inicia��o cient�fica.';
$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.'</TD></TR>';
$sp .= $nl. '<TR class="lt1">';

///////////////////////////////////////////////////////////////
for ($rt = 0; $rt < count($cpo);$rt++)
	{
	$chk = '';
	$bold = '';
	$vlr = $proto_file.'-'.strzero($idfr,2).'-'.$cpo[$rt][3]; 
	if ($dd[$idcp] == $vlr) { $chk = 'checked'; $bold = '<B>'; }
	$sp .= $nl. '<TD width="15%"><nobr><input type="radio" name="dd'.$idcp.'" value="'.$vlr.'" '.$chk.'> '.$bold.$cpo[$rt][2];
	}
$idcp++;
$idfr++;
///////////////////////////////////////////////////////////////
$sp .= '<TR><TD>&nbsp;</TD></TR>';	
	
/////////////////////////////////////////////////////////////////////////////////	
//////////////////////////////////////////////////////////////////// pergunta 3
$cpo = array();
array_push($cpo,array('dd'.$nr,$nr,'adequado ','10')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'parcialmente adequado ','2')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'inadequado ','X')); $nr++;
$pergunta = '<B>Crit�rio 6</B>:  Adequa��o do cronograma para a execu��o da proposta.';
$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.'</TD></TR>';
$sp .= $nl. '<TR class="lt1">';

///////////////////////////////////////////////////////////////
for ($rt = 0; $rt < count($cpo);$rt++)
	{
	$chk = '';
	$bold = '';
	$vlr = $proto_file.'-'.strzero($idfr,2).'-'.$cpo[$rt][3]; 
	if ($dd[$idcp] == $vlr) { $chk = 'checked'; $bold = '<B>'; }
	$sp .= $nl. '<TD><input type="radio" name="dd'.$idcp.'" value="'.$vlr.'" '.$chk.'> '.$bold.$cpo[$rt][2];
	}
$idcp++;
$idfr++;
///////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////////////////////////	

///////////////////////////////////////////////////////////////
$sp .= '<TR><TD>&nbsp;</TD></TR>';	
	
/////////////////////////////////////////////////////////////////////////////////	
//////////////////////////////////////////////////////////////////// pergunta 7
$cpo = array();
array_push($cpo,array('dd'.$nr,$nr,'SIM ','1')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'N�O ','2')); $nr++;
$pergunta = '<B>Crit�rio 7</B>:  Este projeto envolve seres humanos ou animais e, portanto, deve ser analisado pelo Comit� de �tica (CEP) ou Comit� de �tica no Uso de Animais (CEUA), respectivamente ?.';
$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.'</TD></TR>';
$sp .= $nl. '<TR class="lt1">';

///////////////////////////////////////////////////////////////
for ($rt = 0; $rt < count($cpo);$rt++)
	{
	$chk = '';
	$bold = '';
	$vlr = $proto_file.'-'.strzero($idfr,2).'-'.$cpo[$rt][3]; 
	if ($dd[$idcp] == $vlr) { $chk = 'checked'; $bold = '<B>'; }
	$sp .= $nl. '<TD><input type="radio" name="dd'.$idcp.'" value="'.$vlr.'" '.$chk.'> '.$bold.$cpo[$rt][2];
	}
$idcp++;
$idfr++;



$sp .= $nl .'<TR><TD align="right" colspan="6"><input type="submit" name="acao" value="gravar parecer parcial >>>"></TD></TR>';
$sp .= $nl .'</table>';
$sp .= $nl .'</fieldset>';
$sp .= $nl .'</TD></TR>';

///////////////////////////////////////////////////////////////
$sp .= '<TR><TD>&nbsp;</TD></TR>';	
	
/////////////////////////////////////////////////////////////////////////////////	
//////////////////////////////////////////////////////////////////// pergunta 8
if ($pre == true) {
$cpo = array();
array_push($cpo,array('dd'.$nr,$nr,'SIM ','1')); $nr++;
array_push($cpo,array('dd'.$nr,$nr,'N�O ','2')); $nr++;
$pergunta = '<B>Crit�rio 8</B>:  Este projeto foi assinalado pelo professor proponente para concorrer as bolsas de IC de �reas estrat�gicas da PUCPR. O projeto se enquadra em pelo menos uma das seguintes �reas: biotecnologia, nanotecnologia, tecnologias de informa��o e comunica��o, insumos para a sa�de, biocombust�veis, energia el�trica, energias renov�veis, agroneg�cio, biodiversidade e recursos naturais, meio ambiente e desenvolvimento, seguran�a p�blica, desenvolvimento sustent�vel, forma��o de professores, tecnologias educacionais, �tica e quest�es sociais?';
$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.'</TD></TR>';
$sp .= $nl. '<TR class="lt1">';

///////////////////////////////////////////////////////////////
for ($rt = 0; $rt < count($cpo);$rt++)
	{
	$chk = '';
	$bold = '';
	$vlr = $proto_file.'-'.strzero($idfr,2).'-'.$cpo[$rt][3]; 
	if ($dd[$idcp] == $vlr) { $chk = 'checked'; $bold = '<B>'; }
	$sp .= $nl. '<TD><input type="radio" name="dd'.$idcp.'" value="'.$vlr.'" '.$chk.'> '.$bold.$cpo[$rt][2];
	}
$idcp++;
$idfr++;



$sp .= $nl .'<TR><TD align="right" colspan="6"><input type="submit" name="acao" value="gravar parecer parcial >>>"></TD></TR>';
$sp .= $nl .'</table>';
$sp .= $nl .'</fieldset>';
$sp .= $nl .'</TD></TR>';
}
} ?>