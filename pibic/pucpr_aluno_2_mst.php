<?
$qsql = "select * from ";
$qsql .= " pibic_aluno pa_cracha ";
$qsql .= " where pa_cracha = '".$dd[1]."'";
$qrlt = db_query($qsql);
if ($qline = db_read($qrlt))
	{
	$sp .= '<TR class=lt1><TD align="right">Nome do aluno</TD><TD><B>'.$qline['pa_nome'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">Cracha</TD><TD><B>'.$qline['pa_cracha'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">Tipo</TD><TD><B>'.$qline['pa_escolaridade'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">CPF</TD><TD><B>'.$qline['pa_cpf'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">Centro</TD><TD><B>'.$qline['pa_centro'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">Curso</TD><TD><B>'.$qline['pa_curso'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">telefone</TD><TD><B>'.$qline['pa_tel1'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">&nbsp;</TD><TD><B>'.$qline['pa_tel2'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">e-mail</TD><TD><B>'.$qline['pa_email'].'</TD></TR>';
	$sp .= '<TR class=lt1><TD align="right">&nbsp;</TD><TD><B>'.$qline['pa_email_1'].'</TD></TR>';
	}

$st1 = '<a href="#" onclick="newxy2('.chr(39).'upload.php?dd1='.$dd[1].'&dd9=aluno_rg'.chr(39).',500,300);">';
$st2 = '<a href="#" onclick="newxy2('.chr(39).'upload.php?dd1='.$dd[1].'&dd9=aluno_cpf'.chr(39).',500,300);">';
$st3 = '<a href="#" onclick="newxy2('.chr(39).'upload.php?dd1='.$dd[1].'&dd9=aluno_ce'.chr(39).',500,300);">';

///////// RG
$tp = 'RG'; $xchave = UpperCaseSQL(substr(md5($tp.$dd[1].$tp),0,8));$dd[0] = $dd[1].'-01-'.$xchave.'-'.$dd[1];
$fl = $upload_dir = $dd[1].'-01-'.$xchave.'-'.$dd[1].'.jpg'; $fx = $_SERVER['DOCUMENT_ROOT'].'/reol/pibic/ass/rg/'.$fl;
if (file_exists($fx)) { $sa1 = ' <A HREF="ass/rg/'.$fl.'" target="_new">Visualizar RG</A>'; $pos++; } else
	{ $sa1 = '<font color=red>Não encontrado no sistema,</font> '; }
$st_rg .= $sa1.$st1.'<font color=blue> enviar novo arquivo</font></A>';

///////// CPF
$tp = 'CPF'; $xchave = UpperCaseSQL(substr(md5($tp.$dd[1].$tp),0,8));$dd[0] = $dd[1].'-01-'.$xchave.'-'.$dd[1];
$fl = $upload_dir = $dd[1].'-01-'.$xchave.'-'.$dd[1].'.jpg'; $fx = $_SERVER['DOCUMENT_ROOT'].'/reol/pibic/ass/cpf/'.$fl;
if (file_exists($fx)) { $sa2 = ' <A HREF="ass/cpf/'.$fl.'" target="_new">Visualizar CPF,</A>'; $pos++; } else
	{ $sa2 = '<font color=red>Não encontrado no sistema,</font> '; }
$st_cpf .= $sa2.$st2.'<font color=blue> enviar novo arquivo</font></A>';

///////// RG
$tp = 'ENDE'; $xchave = UpperCaseSQL(substr(md5($tp.$dd[1].$tp),0,8));$dd[0] = $dd[1].'-01-'.$xchave.'-'.$dd[1];
$fl = $upload_dir = $dd[1].'-01-'.$xchave.'-'.$dd[1].'.jpg'; $fx = $_SERVER['DOCUMENT_ROOT'].'/reol/pibic/ass/ende/'.$fl;
if (file_exists($fx)) { $sa3 = ' <A HREF="ass/ende/'.$fl.'" target="_new">Visualizar Endereço,</A>';  $pos++; } else
	{ $sa3 = '<font color=red>Não encontrado no sistema,</font> '; }
$st_ce .= $sa3.$st3.'<font color=blue> enviar novo arquivo</font></A>';

$sp .= '<TR><TD class="lt3"><B>Documentos</B></TD></TR>';
$sp .= '<TR><TD align="left">R.G.</TD><TD>'.$st_rg.'</TD></TR>';
$sp .= '<TR><TD align="left">CPF</TD><TD>'.$st_cpf.'</TD></TR>';
$sp .= '<TR><TD align="left">Endereço</TD><TD>'.$st_ce.'</TD></TR>';
?>
