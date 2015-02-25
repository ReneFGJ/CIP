<?
if ($parecer == true)
{
$ok_parecer = true;

$nrp = array();

for ($r=20;$r < $idcp;$r++)
	{
	if (strlen($dd[$r]) == 0) { $ok_parecer = false; }
	$nrproj = substr($dd[$r],0,7);
	$novo_proj = true;
	for ($k=0;$k < count($nrp);$k++)
		{
		if ($nrp[$k] == $nrproj) { $novo_proj = false; }
		}
	if ($novo_proj == true) { array_push($nrp,$nrproj); }
	}
	
/////////////////////////////////////////////////////////////////////////////////////////////////////
if (strlen($acao) > 0)
{
	for ($r=0;$r < count($nrp);$r++)
		{
		$sql = "select * from ";
		$sql .= "pibic_parecer ";
		$sql .= " where pp_protocolo_mae = '".$protocolo."' ";	
		$sql .= " and pp_avaliador = '".$dd[2]."' ";
		$sql .= " and pp_protocolo = '".$nrp[$r]."' ";
		$rlt = db_query($sql);
		if (!($line = db_read($rlt)))
			{
				if (strlen($nrp[$r]) > 0)
				{
				$sql = "insert into pibic_parecer ";
				$sql .= "(pp_nrparecer,pp_tipo,pp_protocolo,";
				$sql .= "pp_protocolo_mae,pp_avaliador,pp_status,";
				$sql .= "pp_data,pp_hora,pp_parecer_data";
				$sql .= ") values (";
				$sql .= "'','A','".$nrp[$r]."',";
				$sql .= "'".$protocolo."','".$dd[2]."','A',";
				$sql .= "'".date("Ymd")."','".date("H:i")."',19000101";
				$sql .= ")";
				$xrlt = db_query($sql);
				}
				//echo '<HR>'.$sql;
			}
		}
	}
////////////////////////////////////////////////////////////////// GRAVA PARECER PROVISÓRIO
if (strlen($acao) > 0)
	{
	$usql = "begin; ".$nl;
	for ($r=20;$r < $idcp;$r++)
		{
		$p = $dd[$r];
		$pr1 = substr($p,0,7);
		$pr2 = substr($p,8,2);
		$pr3 = substr($p,11,20);
		if (strlen($pr1) > 0)
			{
			$usql .= "update pibic_parecer set ";
			$usql .= "pp_data = '".date("Ymd")."', ";
			$usql .= "pp_hora = '".date("H:i")."', ";
			$usql .= " pp_p".$pr2." = '".$pr3."' ";
			if ($pr2 == '01') { $usql .= ", pp_abe_1 = '".$dd[80]."' "; }
			$usql .= " where pp_protocolo = '".$pr1."' ";
			$usql .= " and pp_avaliador = '".$dd[2]."' ";
			$usql .= "; ";
			$usql .= $nl;
			}
		}
			if (strlen($dd[82]) > 0)
				{
				$usql .= "update pibic_parecer set ";
				$usql .= "pp_data = '".date("Ymd")."', ";
				$usql .= "pp_hora = '".date("H:i")."', ";
				$usql .= " pp_abe_1 = '".$dd[82]."' "; 
				$usql .= " where pp_protocolo = '".$dd[83]."' ";
				$usql .= " and pp_avaliador = '".$dd[2]."' ";
				$usql .= "; ";
				$usql .= $nl;
				}
	$usql .= "commit; ";
	$urlt = db_query($usql);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
if ($pp_edital == 'PIBIC')
	{
	$sr .= $nl . '<TR><TD><B>Parecer qualitativo</B> (campo obrigatório) será enviado como feedback para o professor proponente, com intuito de aprimoramento da pesquisa na iniciação científica em nossa instituição.';
	} else {
	$sr .= $nl . '<TR><TD><B>Parecer qualitativo</B> (campo obrigatório) será enviado como feedback para o professor proponente, com intuito de aprimoramento da pesquisa na área de tecnologia, inovação e tecnologia social em nossa instituição.';
	}

$sr .= $nl . '<TR><TD><textarea cols="70" rows="12" name="dd80" style="width: '.$tab_max.'px;">'.$dd[80].'</textarea>';
if ($ok_parecer == false)
	{
	$sr .= '<TR><TD align="right"><font class="lt5"><font color="red">Alguns critérios não foram avaliados.';
	}
$sr .= $nl . '<TR><TD><input type="hidden" name="dd81" value="'.strzero($id,7).'"></TD></TR>';
$PAR_FS = 'PAR_FS1';
if ($ok_parecer == false) { $PAR_FS = 'PAR_FS2'; }
///////////////////////////////////////////////////
//////////////// Busca mensagem de entrada
$sql = "select * from ic_noticia where nw_ref = '".$PAR_FS."' and nw_idioma = 'pt_BR'";
$rrr = db_query($sql);

$texto = $PAR_FS;
if ($eline = db_read($rrr))
	{
	$sC = $eline['nw_titulo'];
	$texto = $eline['nw_descricao'];
	}

//////////////////////////////////////////////////////////////////////
if ((strlen($dd[80]) < 40) and (strlen($acao) > 0))
	{
	echo '<center><BR><BR><font class="lt4">';
	echo '<font color="red">Justificativa muito curta</font>';
	echo '</font></center>';
	echo '<script>'.$nl;
	echo "alert('Justificativa muito curta');".$nl;
	echo '</script>'.$nl;
	$ok_parecer = false;
	}
if ($ok_parecer == true)
	{
		$bb1 = "Gravar e enviar versão definitiva ao PIBIC >>>";
		$sr .= $nl . '<TR><TD align="right">';
		$sr .= '<fieldset><legend><font class="lt3">Enviar parecer definitivo</font></legend>';
		$sr .= '<div align="left" class="lt1">'.mst($texto).'</div><BR>';
		$sr .= '<input type="submit" name="acao" value="'.$bb1.'" style="width: 320px; height:40px;">';
		$sr .= '</fieldset>';
		
		if (trim($acao) == trim($bb1))
			{
			$sql = "update ";
			$sql .= "pibic_parecer ";
			$sql .= " set pp_status = 'B', ";
			$sql .= "pp_parecer_data = '".date("Ymd")."', ";
			$sql .= "pp_parecer_hora = '".date("H:i")."' ";
			$sql .= " where pp_protocolo_mae = '".$protocolo."' ";
			$sql .= " and pp_avaliador = '".$dd[2]."' ";
			$rlt = db_query($sql);
			
			global $email_adm, $admin_nome;

			$email_adm = "pibicpr@pucpr.br";
			$admin_nome = "PUCPR - Pibic ".date("Y");
			$e3 = "PUCPR PIBIC ".date("Y");
			$e3 = "Pibic ".date("Y")."- [".$protocolo."] - Parecer Concluído";
			$e4 = 'Parecer '.$protocolo.' foi relatado';
			$ec1 = "monitoramento@sisdoc.com.br";
			$rsp = enviaremail($ec1,$e2,$e3,$e4); 
			$rsp = enviaremail($email_adm,$e2,$e3,$e4);

			redirecina("parecerista_parecer.php?dd0=".$dd[0]."&dd1=".$dd[1]."&dd2=".$dd[2]);
			exit;
			}
	} else {
		$sr .= $nl . '<TR><TD align="right">';	
		$sr .= '<fieldset><legend><font class="lt3">Enviar parecer definitivo</font></legend>';
		$sr .= '<div align="left" class="lt1">'.mst($texto).'</div><BR>';
		$sr .= '<input type="submit" name="acao" value="gravar parecer parcial >>>"></TD></TR>';
		$sr .= '</fieldset>';
		
	}
$sr .= '<TR><TD>';
}
?>