<?
$sp = '';
if ($parecer == true)
{

$idfr = 1;
$cp = array();
$tabela = "pareceristas";
$cp = array();

if ((strlen($projeto_externo) == 'N�o') and (strlen($projeto_fomento) > 0))
	{
			$vlr = $proto_file.'-'.strzero($idfr,2).'-20'; 
			$sp .= $nl. '<TD><input type="hidden" name="dd'.$idcp.'" value="'.$vlr.'">'; $idcp++; $idfr++;
			$vlr = $proto_file.'-'.strzero($idfr,2).'-20'; 
			$sp .= $nl. '<TD><input type="hidden" name="dd'.$idcp.'" value="'.$vlr.'">'; $idcp++; $idfr++;
			$vlr = $proto_file.'-'.strzero($idfr,2).'-20'; 
			$sp .= $nl. '<TD><input type="hidden" name="dd'.$idcp.'" value="'.$vlr.'">'; $idcp++; $idfr++;
	} else {
		$sp .= $nl . '</TABLE>';
		$sp .= $nl . '<TABLE width='.$tab_max.'" align="center">';
		$sp .= $nl. '<TR><TD colspan="2"><fieldset><legend><font class="lt3"><B><I>Parecer do Projeto do Professor</I></B></font></legend>';
		$sp .= $nl. '<table width="100%" class="lt1" border=0 >';	
		//////////////////////////////////////////////////////////////////// pergunta 1
		$cpo = array();
		array_push($cpo,array('dd'.$nr,$nr,'excelente','20'));
		array_push($cpo,array('dd'.$nr,$nr,'muito bom','15'));
		array_push($cpo,array('dd'.$nr,$nr,'bom','10'));
		array_push($cpo,array('dd'.$nr,$nr,'regular','5'));
		array_push($cpo,array('dd'.$nr,$nr,'ruim','2'));
		array_push($cpo,array('dd'.$nr,$nr,'muito ruim','X'));
		
		$pergunta = '<B>Crit�rio 1</B>:  Relev�ncia do projeto do orientador e contribui��o para a forma��o do aluno.';
		$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.'</TD></TR>';
		$sp .= $nl. '<TR class="lt1">';
		///////////////////////////////////////////////////////////////
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
			}
		//////////////////////////////////////////////////////////////////////
		for ($rt = 0; $rt < count($cpo);$rt++)
			{
			$chk = '';
			$bold = '';
			$vlr = trim($proto_file.'-'.strzero($idfr,2).'-'.$cpo[$rt][3]); 
			if ($dd[$idcp] == $vlr) { $chk = 'checked'; $bold = '<B>'; }
			$sp .= $nl. '<TD width="15%"><nobr><input type="radio" name="dd'.$idcp.'" value="'.$vlr.'" '.$chk.'> '.$bold.$cpo[$rt][2];
			}
		$idcp++;
		$idfr++;
		///////////////////////////////////////////////////////////////
		$sp .= '<TR><TD>&nbsp;</TD></TR>';
		///////////////////////////////////////// 2
		$cpo = array();
		array_push($cpo,array('dd'.$nr,$nr,'excelente','20'));
		array_push($cpo,array('dd'.$nr,$nr,'muito bom','15'));
		array_push($cpo,array('dd'.$nr,$nr,'bom','10'));
		array_push($cpo,array('dd'.$nr,$nr,'regular','5'));
		array_push($cpo,array('dd'.$nr,$nr,'ruim','2'));
		array_push($cpo,array('dd'.$nr,$nr,'muito ruim','X'));
		
		$pergunta = '<B>Crit�rio 2</B>:  Coer�ncia do projeto do orientador de acordo com os itens: Introdu��o, Objetivo, M�todo e Refer�ncias Bibliogr�ficas.';
		$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.'</TD></TR>';
		$sp .= $nl. '<TR class="lt1">';
		
		for ($rt = 0; $rt < count($cpo);$rt++)
			{
			$chk = '';
			$bold = '';
			$vlr = $proto_file.'-'.strzero($idfr,2).'-'.$cpo[$rt][3]; 
			if ($dd[$idcp] == $vlr) { $chk = 'checked'; $bold = '<B>'; }
			$sp .= $nl. '<TD width="15%"><nobr><input type="radio" name="dd'.$idcp.'" value="'.$vlr.'" '.$chk.'> '.$bold.$cpo[$rt][2];
			}
		$sp .= '<TR><TD>&nbsp;</TD></TR>';
		$idcp++;
		$idfr++;
		///////////////////////////////////////// 3
		$cpo = array();
		array_push($cpo,array('dd'.$nr,$nr,'excelente','20'));
		array_push($cpo,array('dd'.$nr,$nr,'muito bom','15'));
		array_push($cpo,array('dd'.$nr,$nr,'bom','10'));
		array_push($cpo,array('dd'.$nr,$nr,'regular','5'));
		array_push($cpo,array('dd'.$nr,$nr,'ruim','2'));
		array_push($cpo,array('dd'.$nr,$nr,'muito ruim','X'));
	
		$pergunta = '<B>Crit�rio 3</B>:  Coer�ncia e adequa��o entre a capacita��o e a experi�ncia do professor orientador proponente e a realiza��o do projeto, considerando as informa��es curriculares apresentadas.';
		$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.'</TD></TR>';
		$sp .= $nl. '<TR class="lt1">';
		
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
		$sp .= '<TR><TD>&nbsp;</TD></TR>';


		if ($estrategica == 'S')
		{
			///////////////////////////////////////// 4
			$cpo = array();
			array_push($cpo,array('dd'.$nr,$nr,'SIM','1'));
			array_push($cpo,array('dd'.$nr,$nr,'N�O','0'));
		
			if ($pp_edital = 'PIBIC')
				{
				$pergunta = '<B>�rea Estrat�gica</B>:  ';
				$qst1 = 'Este projeto foi assinalado pelo professor proponente para concorrer as bolsas de IC de �reas estrat�gicas (<B>'.trim(substr($area_estrategicao,13,100)).'</B>) da PUCPR. O projeto se enquadra na �rea assinalada?';
				} else {
				$pergunta = '<B>Crit�rio Estrat�gico</B>:  ';
//				$qst1 = 'Crit�rio Estrat�gico: Este projeto foi assinalado pelo professor proponente para concorrer as bolsas da Ag�ncia PUC (ag�ncia de inova��o da PUCPR) na categoria <B>'.trim(substr($area_estrategicao,13,100)).'</B>. O projeto se enquadra no setor de atua��o assinalado e possui teor de tecnologia, inova��o ou tecnologia social?';
				$qsr1 = '�rea Estrat�gica: Este projeto foi assinalado pelo professor proponente para concorrer �s bolsas de IC na �rea estrat�gica:  <B>'.trim(substr($area_estrategicao,13,100)).'</B>. O projeto se enquadra na �rea assinalada?';
				}
			$sp .= $nl. '<TR><TD colspan="6" class="lt2">'.$pergunta.$qst1.'</TD></TR>';
			$sp .= $nl. '<TR class="lt1">';
			
			for ($rt = 0; $rt < count($cpo);$rt++)
				{
				$chk = '';
				$bold = '';
				$vlr = $proto_file.'-'.strzero($idfr,2).'-'.$cpo[$rt][3]; 
				if ($dd[$idcp] == $vlr) { $chk = 'checked'; $bold = '<B>'; }
				$sp .= $nl. '<TD><nobr><input type="radio" name="dd'.$idcp.'" value="'.$vlr.'" '.$chk.'> '.$bold.$cpo[$rt][2];
				}
//			$sp .= $nl .'<TR><TD align="right" colspan="6"><input type="submit" name="acao" value="gravar parecer parcial >>>"></TD></TR>';
			$sp .= '<TR><TD>&nbsp;</TD></TR>';
			$sp .= $nl .'</table>';
			$sp .= $nl .'</fieldset>';
			$sp .= $nl .'</TD></TR>';
			$idcp++;
			$idfr++;
			$sp .= '<TR><TD>&nbsp;</TD></TR>';
		}

		$sp .= $nl .'<TR><TD align="right" colspan="6"><input type="submit" name="acao" value="gravar parecer parcial >>>"></TD></TR>';
		
		$sp .= $nl .'</fieldset>';
		$sp .= $nl .'</TD></TR>';
		$sp .= '<TR><TD>&nbsp;</TD></TR>';
		$sp .= $nl .'</table>';
		
	}
}
	
	 ?>