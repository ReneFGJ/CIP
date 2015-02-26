<?
require("cab.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_form2.php");
require($include."cp2_gravar.php");
global $bgc;

$opa = ' :Todas';
for ($ra = date("Y");$ra >= 2009;$ra--) { $opa .= '&'.$ra.':'.$ra; }
$opc = ' :Todas as bolsas ';
$sql = 'select * from pibic_bolsa_tipo order by pbt_descricao';
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$opc .= '&'.trim($line['pbt_codigo']).':'.trim($line['pbt_descricao']);
	}

		$tabela = '';
		$cp = array();
		array_push($cp,array('$H8','','',False,True,''));
		array_push($cp,array('$O '.$opa,'','Edital',False,True,''));
		array_push($cp,array('$D8','','De',True,True,''));
		array_push($cp,array('$D8','','até',True,True,''));
		array_push($cp,array('$O '.$opc,'','Bolsa',False,True,''));

		echo '<TABLE width="'.$tab_max.'">';
		echo '<TR><TD>';
		editar();
		echo '</TABLE>';	

if ($saved > 0)
{
$tipo = "CANCE";
$tipo_nome = "Relatório de Substituição de Estudantes";
$query = " (bh_acao = 90) ";
if (strlen($dd[1]) == 0) { $dd[1] = date("Y")-1; }
$dd[1] = trim($dd[1]);
$dd[4] = trim($dd[4]);
$sql = "select aa1.pa_nome as pa_nome, aa2.pa_nome as pa_nome2, pbt_descricao, ";
$sql .= "pb_titulo_projeto, id_pb, pbt_img, pb_professor, ";
$sql .= "pp_nome, pb_aluno, pb_protocolo, pb_ano,";
$sql .= "pb_relatorio_parcial, pb_relatorio_parcial_nota,";
$sql .= "pb_status, bh_data, bh_hora,  ";
$sql .= "bh_motivo, mt_descricao, bh_aluno_1 ";
$sql .= "";
$sql .= " from pibic_bolsa_historico ";
$sql .= " inner join pibic_bolsa_contempladas on bh_protocolo = pb_protocolo ";
$sql .= " left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
$sql .= " left join pibic_professor on pb_professor = pp_cracha ";
$sql .= " left join pibic_aluno as aa1 on pb_aluno = aa1.pa_cracha ";
$sql .= " left join pibic_motivos on mt_codigo = bh_motivo ";
$sql .= " left join pibic_aluno as aa2 on bh_aluno_1 = aa2.pa_cracha ";
$sql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
$sql .= " where ";
$sql .= $query;
if (strlen($dd[4]) > 0)
	{ $sql .= " and pb_tipo = '".$dd[4]."' "; }
if (strlen($dd[1]) > 0) 
	{ $sql .= "  and doc_ano = '".$dd[1]."' "; }
//$sql .= " and pb_status = 'C' ";
$sql .= " and bh_data >= ".brtos($dd[2]).' and bh_data <= '.brtos($dd[3]);
$sql .= " order by bh_data, bh_hora ";

$rlt = db_query($sql);
$it = 0;
while ($line = db_read($rlt))
	{
	$bolsa_nome = $line['pbt_descricao'];
	$protocolo = $line['bh_protocolo'];
	
	require("pibic_busca_resultado.php");
	$sr .= '<TR bgcolor="'.$bgc.'"><TD align="right" colspan="2">Motivo<TD colspan=1 ><B>'.$line['mt_descricao'].'</B> ('.$line['bh_motivo'].')</TD>';

	$sr .= '<TD align="right"><NOBR>Data da efetivação:</TD>';
	$sr .= '<TD colspan="1"><B><nobr>';
	$sr .= stodbr($line['bh_data']);
	$sr .= ' ';
	$sr .= $line['bh_hora'];
	$sr .= '</TD>';
	$sr .= '<TR>';
	
	$sr .= '<TR bgcolor="'.$bgc.'">';
	$sr .= '<TD colspan="2" align="right"><I><Nobr>Estudante (retirado)</TD><TD colspan="3">'.$line['pa_nome2'].' ('.trim($line['bh_aluno_1']).')';
	$sr .= '</TR>';

	}
?>
<BR>
<font class="lt5">
<center><?=$tipo_nome;?> - Ano <?=$dd[1];?></font><BR><font class="lt1">
<?=($dd[2]).' até '.($dd[3]); ?>
</font></center>
</font>
<BR>
<table width="<?=$tab_max;?>" align="center" class="lt1" border=0 >
<?=$sx;?>
<?=$sr;?>
</table>
<center>Total de <?=$it;?> protocolos com substituíção</center>
<BR><BR><BR>
<?
}

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;
$pb->relatorio_substituicoes('2011',$dd[4]);
require("foot.php");
?>