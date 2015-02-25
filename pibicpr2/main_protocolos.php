<?
/* Elimita todos os protocolo pendentes */
//$sql = "update pibic_protocolo set  pr_status = 'B' where pr_status = 'A' ";
//$rlt = db_query($sql);

$sql = "select pr_codigo,pr_tipo, pr_status,";
$sql .= " a1.pa_nome as nome1, ";
$sql .= " a2.pa_nome as nome2, ";
$sql .= " pr_data, pr_aluno_1, pr_aluno_2, ";
$sql .= " pr_hora ";

$sql .= "  from pibic_protocolo ";
$sql .= " left join pibic_aluno as a1 on a1.pa_cracha = pr_aluno_1 ";
$sql .= " left join pibic_aluno as a2 on a2.pa_cracha = pr_aluno_2 ";
$sql .= " where pr_status = 'A' ";
$rlt = db_query($sql);

$id = 0;

$sx .= '<H2>Protocolo de solicitações dos alunos</H2>';
$sx .= '<table width="'.$tab_max.'" class="lt1">';
$sx .=  '<TR><TH>Protocolo</TH><TH>Solicitação</TH><TH>Data</TH><TH>Hora</TH><TH>Estudante</TH><TH>Estudante</TH></TR>';
while ($line = db_read($rlt))
	{
	$id++;
	$codt = '';
	$cod = trim($line['pr_tipo']);
	if ($cod == 'SUB') { $codt = 'Substituição'; }
	$link = '<A HREF="protocolo_'.trim($line['pr_tipo']).'.php?dd0='.$line['pr_codigo'].'">';
	$sx .=  '<TR>';
	$sx .=  '<TD>';
	$sx .= $link;
	$sx .=  $line['pr_codigo'];
	$sx .=  '<TD>';
	$sx .= $link;
	$sx .=  $codt;
	$sx .=  '<TD>';
	$sx .= $link;
	$sx .=  stodbr($line['pr_data']);
	$sx .=  '<TD>';
	$sx .= $link;
	$sx .=  $line['pr_hora'];
	$sx .=  '<TD>';
	$sx .= $link;
	$sx .=  trim($line['nome2']);
	$sx .=  ' ('.trim($line['pr_aluno_2']).')';

	$sx .=  '<TD>';
	$sx .= $link;
	$sx .=  trim($line['nome1']);
	$sx .=  ' ('.trim($line['pr_aluno_1']).')';

	$sx .=  '</TR>';
	}
$sx .=  '</table>';

if ($id > 0)
	{
	echo $sx;
	}
?>