<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

		$sql = "select * from pibic_bolsa_contempladas ";
		$sql .= " left join pibic_aluno on pa_cracha = pb_aluno ";
		$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
		$sql .= " left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
		$sql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
		$sql .= " where (pb_status = 'A' or pb_status = 'C' or pb_status = 'B') ";
		$sql .= " and pb_ano = '2010' ";
		$sql .= " order by pa_centro, pa_curso, pa_nome ";
		
$rlt = db_query($sql);

$cc1='X';
$cc2='X';
$to1=0;
$to2=0;
$to3=0;
$sr = array(0,0,0,0,0,0,0);
$hr = '	<Th colspan="2">Nome do estudante</Th><Th>Cracha</Th><Th>Prof. Orientador</Th><Th>Tipo de bolsa</Th><TH>Status</TH>';
while ($line = db_read($rlt))
	{
	$centro = $line['pa_centro'];
	$curso = $line['pa_curso'];
	
	if ($centro != $cc1)
		{ 
		if ($to2 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do curso '.$to2.'</I></TD></TR>'; $to2 = 0;}
		if ($to1 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do centro '.$to1.'</I></TD></TR>'; $to1 = 0;}
		$sx .= '<TR><TD colspan="5">&nbsp;</TD></TR><TR><TD class="lt4" colspan="5" colspan="5" align="center"><H1><B>'.$centro.'</B></H1></TD></TR>'; $cc1=$centro; 
		}
	if ($curso != $cc2)
		{ 
		if ($to2 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do curso '.$to2.'</I></TD></TR>'; $to2 = 0;}
		$sx .= '<TR><TD width="20" colspan="1"></TD><TD class="lt3" colspan="4"><B>'.$curso.'</B></TD></TR>'; $cc2=$curso; 
		$sx .= $hr;
		}
	$st = trim($line['pb_status']);
	
	if ($st == 'C') { $st = '**CANCELADO**'; $sr[0] = $sr[0] + 1; }
	if ($st == 'A') { $st = 'Ativa';  $sr[1] = $sr[1] + 1; }
	if ($st == 'B') { $st = 'Concluído';  $sr[2] = $sr[2] + 1; }
	$sx .= '<TR>';
	$sx .= '<TD>&nbsp;</TD>';
	$sx .= '<TD>'.$line['pa_nome'];
	$sx .= '<TD align="center">'.$line['pa_cracha'];
	$sx .= '<TD>'.$line['pp_nome'];
	$sx .= '<TD>'.$line['pbt_descricao'];
	$sx .= '<TD>'.$st;
	$sx .= '</TR>';
	$to1++;
	$to2++;
	$to3++;
	}
if ($to2 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do curso '.$to2.'</I></TD></TR>'; $to2 = 0;}
if ($to1 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I>total do centro '.$to1.'</I></TD></TR>'; $to1 = 0;}
if ($to3 > 0) { $sx .= '<TR><TD colspan="5" align="right"><I><B>total geral de estudantes '.$to3.'</I></TD></TR>';}
?>
<BR><BR>
<CENTER>
<FONT CLASS="lt4">Relatório de Estudantes em Iniciação Científica</FONT>
<BR><font class="lt2">Centro / Curso / Aluno</font>
<BR><BR>

<table width="400" border="1">
<TR><TD>Ativos</TD><TD align="right"><?=$sr[1];?> estudantes</TD></TR>
<TR><TD>Concluídos</TD><TD align="right"><?=$sr[2];?> estudantes</TD></TR>
<TR><TD>Cancelados</TD><TD align="right"><?=$sr[0];?> estudantes</TD></TR>
</table>

<table class="lt1" width="<?=$tab_max;?>" border="0"> 
<?=$sx;?>
</TABLE>
<? require("foot.php");	?>