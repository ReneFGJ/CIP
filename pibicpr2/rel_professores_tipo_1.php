<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

		$sql = "select * from pibic_bolsa_contempladas ";
		$sql .= " left join pibic_aluno on pa_cracha = pb_aluno ";
		$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
		$sql .= " left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
		$sql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
		$sql .= " where (pb_status = 'A') ";
		$sql .= " order by pp_ss desc, pa_centro, pp_negocio, pp_nome  ";
		
$rlt = db_query($sql);

$cc1='X';
$cc2='X';
$to1=0;
$to2=0;
$to3=0;
$to4=0;
$to5=0;
$hr = '	<Th colspan="2">Nome do professor</Th><Th>Estudante</Th><Th>Curso</Th><Th>Tipo de bolsa</Th>';
while ($line = db_read($rlt))
	{
	//print_r($line);
	//exit;
	$ss = $line['pp_ss'];
	$centro = $line['pa_centro'];
	$curso = '';
	
	if ($ss != $ss1)
		{
		if ($to5 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do tipo SS '.$to5.'</I></TD></TR>'; $to5 = 0;}
		$sx .= '<TR><TD colspan="5">&nbsp;</TD></TR><TR><TD class="lt4" colspan="5" colspan="5" align="center"><H1><B>Strict:'.$ss.'</B></H1></TD></TR>'; $ss1=$ss; 
		$sx .= $hr;
		$to5=0;			
		}

	if ($centro != $cc1)
		{ 
		if ($to2 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do curso '.$to2.'</I></TD></TR>'; $to2 = 0;}
		if ($to1 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do centro '.$to1.'</I></TD></TR>'; $to1 = 0;}
		$sx .= '<TR><TD colspan="5">&nbsp;</TD></TR><TR><TD class="lt3" colspan="5" colspan="5" align="center"><B>'.$centro.'</B></TD></TR>'; $cc1=$centro; 
		$sx .= $hr;
		}
	if ($curso != $cc2)
		{ 
		if ($to2 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do curso '.$to2.'</I></TD></TR>'; $to2 = 0;}
		$sx .= '<TR><TD width="20" colspan="1"></TD><TD class="lt3" colspan="4"><B>'.$curso.'</B></TD></TR>'; $cc2=$curso; 
		}
	$sx .= '<TR>';
	$sx .= '<TD>&nbsp;</TD>';
	$sx .= '<TD>'.$line['pp_nome'];
	$sx .= '('.$line['pp_ss'].')';
//	$sx .= '<TD align="center">'.$line['pa_cracha'];
	$sx .= '<TD>'.$line['pa_nome'];
	$curso = trim($line['pa_curso']);
	if (strpos($curso,'(') > 0) { $curso = substr($curso,0,strpos($curso,'(')); }
	$sx .= '<TD>'.lowercase($curso);
	$sx .= '<TD>'.$line['pbt_descricao'];
	$sx .= '</TR>';
	$to1++;
	$to2++;
	$to3++;
	$to4++;
	$to5++;
	}
if ($to5 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do tipo SS '.$to5.'</I></TD></TR>'; $to5 = 0;}
if ($to2 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do curso '.$to2.'</I></TD></TR>'; $to2 = 0;}
if ($to1 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do centro '.$to1.'</I></TD></TR>'; $to1 = 0;}
if ($to3 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I><B>total geral de estudantes '.$to3.'</I></TD></TR>';}
if ($to4 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do tipo (Geral SS) '.$to4.'</I></TD></TR>'; $to5 = 0;}
?>
<BR><BR>
<CENTER>
<H2>Relatório de Bolsas Ativas</H2>
<BR><font class="lt2">Centro / Professor / Aluno</font>
<table class="lt1" width="<?=$tab_max;?>" border="0"> 
<?=$sx;?>
</TABLE>
<? require("foot.php");	?>