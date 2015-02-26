<?
$nota1 = array();
for ($r=0;$r < 21;$r++)
	{
	$vlr = '??';
	if (($r == 20) or ($r == 15)) { $vlr = 'excelente'; }
	if (($r >= 16) and ($r < 20)) { $vlr = 'muito bom'; }
	if (($r >= 13) and ($r < 15)) { $vlr = 'bom'; }
	if (($r >= 7) and ($r < 13)) { $vlr = 'regular'; }
	if (($r >= 2) and ($r < 7)) { $vlr = 'ruim'; }
	if (($r >= 0) and ($r < 2)) { $vlr = 'muito ruim'; }
	array_push($nota1,$vlr);
	}
$nota2 = $nota1;
$nota3 = $nota1;

$sqe = '';
$tsql = "select *,pibic_parecer.pp_status as sta, ";
$tsql .= " pibic_parecer_enviado.id_pp as pp, ";
$tsql .= " pibic_parecer_enviado.pp_status as stb ";
$tsql .= " from pibic_parecer_enviado ";
$tsql .= "left join pareceristas on pp_avaliador = us_codigo ";
$tsql .= "inner join instituicoes on us_instituicao = inst_codigo ";
$tsql .= "left join pibic_parecer on pibic_parecer_enviado.pp_protocolo = pibic_parecer.pp_protocolo and ";
$tsql .= " pibic_parecer_enviado.pp_avaliador = pibic_parecer.pp_avaliador";
$tsql .= " where pibic_parecer_enviado.pp_protocolo = '".$protocolo."' and pibic_parecer_enviado.pp_protocolo=pibic_parecer_enviado.pp_protocolo_mae ";
$trlt = db_query($tsql);
while ($tline = db_read($trlt))
	{
	$chk = md5($tline['pp'].$secu);
	$linkd = '<A HREF="#tag" onclick="newxy2('.chr(39).'parecer_declinar.php?dd0='.$tline['pp'].'&dd2='.$chk.chr(39).',400,200);">declinar</A>';
	if ($user_nivel < 9) {$linkd = ''; }	
	$sqe .= '<TR>';
	$sqe .= '<TD width="5%">'.trim($tline['us_codigo']).'</TD>';	
	$sqe .= '<TD>'.trim($tline['us_nome']).'('.trim($tline['inst_abreviatura']).')</TD>';
	if (strlen($tline['sta']) == 0)
		{
			if ($tline['stb'] == 'D')
				{
					$sqe .= '<TD align="center">declinou...</TD>';	
					$sqe .= '<TD align="center">&nbsp;</TD>';	
					$sqe .= '<TD align="center">&nbsp;</TD>';
				} else {
					$sqe .= '<TD align="center">'.$linkd.'</TD>';	
					$sqe .= '<TD align="center">&nbsp;</TD>';	
					$sqe .= '<TD align="center">'.$tline['stb'].'<->'.$tline['sta'].'</TD>';
				}
		} else {
			$sqe .= '<TD align="center">'.stodbr($tline['pp_data']).'</TD>';	
			$sqe .= '<TD align="center">'.$tline['pp_hora'].'</TD>';	
			$sqe .= '<TD align="center">'.$tline['stb'].'<->'.$tline['sta'].'</TD>';
		}
	}

$tsql = "select * from pibic_parecer ";
$tsql .= " where pp_protocolo_mae = '".$protocolo."' ";
$tsql .= " order by pp_protocolo, pp_avaliador  ";
$trlt = db_query($tsql);
$sq = '';
$sqc = '';
////////// Titulo do manuscrito
$acor = -1;
$vcor = array('#FFFFFF','#F7F7F7','#EFEFEF','#E7E7E7','#DFDFDF','#D7D7D7');
$av = 'X';
while ($tline = db_read($trlt))
	{
	if ($av != trim($tline['pp_avaliador']))
		{
		$acor++;
		$av = trim($tline['pp_avaliador']);
		}
	$link = '<A HREF="#" onclick="newxy2('.chr(39).'ed_edit.php?dd0='.$tline['id_pp'].'&dd99=pibic_parecer'.chr(39).',640,500);">';
	$sq .= '<TR bgcolor="'.$vcor[$acor].'">';
	$sq .= '<TD>'.$tline['pp_protocolo'].'</TD>';
	$sq .= '<TD>'.$tline['pp_avaliador'].'</TD>';
	$sq .= '<TD>'.$link.$tline['pp_status'].'</TD>';
	$sq .= '<TD>'.stodbr($tline['pp_data']).'</TD>';
	$sq .= '<TD>'.$tline['pp_hora'].'</TD>';
	$sq .= '<TD>'.stodbr($tline['pp_parecer_data']).'</TD>';
	$sq .= '<TD>'.$tline['pp_parecer_hora'].'</TD>';
	
	$nt1 = round($tline['pp_p01']);
	$nt2 = round($tline['pp_p02']);
	$nt3 = round($tline['pp_p03']);
	$sq .= '<TD align="center">'.$nota1[$nt1].'('.$nt1.')</TD>';
	$sq .= '<TD align="center">'.$nota2[$nt2].'('.$nt2.')</TD>';
	$sq .= '<TD align="center">'.$nota3[$nt3].'('.$nt3.')</TD>';
//	$sq .= '<TD>'.$tline['pp_p04'].'</TD>';
	$rs = trim($tline['pp_p04']);
	if ($rs == '1') { $rs = 'SIM'; }
	if ($rs == '2') { $rs = 'NÃO'; }
	if ($rs == '0') { $rs = '<font color="red">NÃO</font>'; }
	
	if ($tline['pp_protocolo'] == $tline['pp_protocolo_mae'])
		{
			$sq .= '<TD align="center">'.$rs.'</TD>';
			$sq .= '<TD align="center">&nbsp;-&nbsp;</TD>';
		} else {
			$sq .= '<TD align="center">&nbsp;-&nbsp;</TD>';
			$sq .= '<TD align="center">'.$rs.'</TD>';
		}
	if ($tline['pp_protocolo'] == $tline['pp_protocolo_mae'])
		{
		$sqc .= '<TR valign="top"><TH colspan="12" colspan=2>comentário</TD><TR valign="top"><TD>'.$tline['pp_avaliador'].'</TD><TD colspan="112">'.$tline['pp_abe_1'].'</TD>';
		}
	$sq .= '</TR>';
	}

if (($user_log != 'cleybe.vieira') and ($user_log != 'rene'))
	{
	$sqe = '';
	}
	
if (strlen($sqe) > 0)
	{
	$sqe = '<font class="lt4"><CENTER>Parecerista</CENTER></font><TABLE width="'.$tab_max.'" class="lt1" border="0">' .
	'<TR><TH>Código<TH>avaliador</TH><TH>data</TH>'.'<TH>hora</TH>'.$sqe.'</TABLE>';
	}	
if (strlen($sq) > 0)
	{
	$sq = '<font class="lt4"><CENTER>Parecer</CENTER></font><TABLE width="'.$tab_max.'" class="lt1" border="0"><TR><TH>projeto</TH><TH>avaliador</TH><TH>sta</TH><TH>data</TH><TH>hora</TH>'
	.'<TH>parecer</TH><TH>hora</TH><TH>Crit 1</TH><TH>Crit 2</TH><TH>Crit 3</TH><TH>Estr.</TH><TH>CEP/CEUA</TH>'.$sq.$sqc.'</TABLE>';
	}

$sq = $sqe . $sq;
?>