<?
require("cab.php");
$pibic_ano = date("Y");
if (strlen($dd[2]) > 0)
	{ $pibic_ano = $dd[2]; }
$link = 'rel_bolsa_aluno.php?dd2=2012';
	
$tabela = "pibic_bolsa_contempladas";
//$sql = "update ".$tabela." set pb_status = 'C', pb_desativacao=20120306 where pb_status = '@' ";
//$rlt = db_query($sql);
$sql = "update ".$tabela." set pb_relatorio_parcial = 20110601 
	, pb_relatorio_parcial_nota = 1
	, pb_relatorio_final_nota = 2
where pb_tipo = 'J' and pb_ano = '2011'";
//$rlt = db_query($sql);

$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
if (strlen($dd[0]) > 0)
	{
		$sql .= " where (pb_tipo = '".$dd[0]."' )";
	} else {
		$sql .= " where (pb_status <> 'C') ";
	}
	
if (strlen($dd[1]) > 0)
	{
		$sql .= " and pb_status = '".$dd[1]."' ";
	} else {
		$sql .= " and pb_status <> 'C' ";
	}
	
//$sql .= " and pb_data_ativacao > 20080101 ";
//$sql .= " and pb_data = '".$dd[2]."' ";

$sql .= " and pb_ano = '".$pibic_ano."' ";


$sqlo = "order by pa_curso, pp_nome";

if ($dd[50] == '1')
	{ $sqlo = "order by pb_ativacao desc, pa_centro, pa_curso, pp_nome "; }

$sql .= $sqlo;
$rlt = db_query($sql);

$sz = "";
$sc = "";
$sp = "";
$tot0 = 0;
$tot1 = 0;
$tot2 = 0;

while ($line = db_read($rlt))
	{
//	print_r($line);
//	exit;
	$link = '<A HREF="pibic_bolsas_contempladas.php?dd0='.$line['id_pb'].'" target="_new">';
	$tot2++;
	$centro = $line['pa_centro'];
	$curso = $line['pa_curso'];
	$prof  = $line['pp_cracha'];
	$tipo = $line['pb_tipo'];
	$doc_protocolo = $line['pb_protocolo'];
	
	$bolsa_img = '';

	$bolsa = $tipo;
	require("bolsa_tipo.php");
	$tipo_d = $bolsa_nome;
	
	if ($centro != $sz)
		{
		if ($tot0 > 0)
			{ $sx .= '<TR><TD colspan="2" align="right">Total de '.$tot0.' bolsa pelo centro</TD></TR>'; }
		$sx .= '<TR><TD class="lt4" colspan="2" align="center"><HR><B>'.$centro.'</TD></TR>';
		$sz = $centro;
		$tot0 = 0;
		}
	if ($curso != $sc)
		{
		if (($tot1 > 0) and ($tot0 > 0))
			{ $sx .= '<TR><TD colspan="2" align="right">Total de '.$tot1.' bolsa pelo curso</TD></TR>'; }
		$sx .= '<TR><TD class="lt4" colspan="2">'.$curso.'</TD></TR>';
		$sc = $curso;
		$tot1 = 0;
		}
	$col = coluna();
	if ($prof != $sp)
		{
		$sx .= '<TR '.$col.'><TD class="lt3" colspan="2">'.$line['pp_nome'].' ('.$line['pa_cracha'].')</TD></TR>';
		$sp = $prof;
		}

	$sx .= '<TR '.$col.' >';
	$sx .= '<TD width="50">'.$bolsa_img.'</TD>';
	$sx .= '<TD>';
	$sx .= 'Aluno '.$link.$line['pa_nome'].'</A> ('.$line['pp_cracha'].')';
	$sx .= '<BR>';
	$sx .= $line['doc_1_titulo'];
	$sx .= '<BR>';
	$sx .= 'Bolsa: <B>'.$tipo_d.'</B> ';
	$sx .= ' Protocolo: '.$doc_protocolo.'&nbsp;&nbsp;&nbsp;&nbsp;';
	if ($line['pb_ativacao'] != '19000101')
		{
		$sx .= 'Data ativação '.stodbr($line['pb_ativacao']);
		}
	$sx .= '</TR>';
	$tot0++;
	$tot1++;
	}

if ($tot1 > 0)
	{ $sx .= '<TR><TD colspan="2" align="right">Total de '.$tot1.' bolsa pelo curso</TD></TR>'; }
if ($tot0 > 0)
	{ $sx .= '<TR><TD colspan="2" align="right">Total de '.$tot0.' bolsa pelo centro</TD></TR>'; }
if ($tot2 > 0)
	{ $sx .= '<TR><TD colspan="2" align="right">Total de '.$tot2.' bolsa implantadas</TD></TR>'; }

echo '<A HREF="rel_bolsa_aluno.php?dd50=1&dd0='.$dd[0].'&dd1='.$dd[1].'&dd2='.$dd[2].'&dd3='.$dd[3].'&dd4='.$dd[4].'">Ordem de ativação</A>';
echo ' | ';
echo '<A HREF="rel_bolsa_aluno.php?dd50=&dd0='.$dd[0].'&dd1='.$dd[1].'&dd2='.$dd[2].'&dd3='.$dd[3].'&dd4='.$dd[4].'">Ordem de curso</A>';

echo '<H2>Relatório de Bolsas</H2>';

echo '<table border="0" width="'.$tab_max.'" align="center" class="lt0">';
echo $sx;
echo '</table>';

?>
<center>
<table>
<TR align="center">
<?php 
for ($r=2009;$r <= date("Y");$r++) 
	{
		echo '<TD>';
		echo '<a href="rel_bolsa_aluno_xml.php?dd0='.$dd[0].'&dd1='.$dd[1].'&dd2='.$r.'&dd3='.$dd[3].'" alt="Exportar dados para o Excel"><img src="img/icone_excel_big.png" width="32" height="32" alt="" border="0"></a><BR>'.$r.'</center>';
	}
?>
</table>
<?
require("foot.php");	
?>