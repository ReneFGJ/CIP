<?
require("cab.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_email.php");
require($include."cp2_gravar.php");
$tabela = "pibic_bolsa_contempladas";
$fld = "pb_relatorio_parcial";

$email_producao = trim($dd[2]);
$dd[3] = $dd[2];
echo '<H2>Relatório de planos de alunos não indicados para avaliação</H2>';
	{
		$sql = "select * from pibic_bolsa_contempladas ";
		$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
		$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
		$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
		$sql .= "left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";		
		$sql .= "left join pibic_parecer_2011 on pp_protocolo = pb_protocolo ";
		$sql .= " where (pp_status isnull)";
		$sql .= " and pb_ano = '2011' ";
		$sql .= " and ".$fld." > 20000101 ";
		$sql .= " and (pb_status <> 'C' and pb_status <> '@' ) ";
		$sql .= " order by pp_protocolo ";

		$rlt = db_query($sql);
		$s = '';
		$total = 0;
		$usnome = 'X';
		while ($line = db_read($rlt))
			{
			$total++;
			require("pibic_busca_resultado.php");
			}
		?>
		<table width="100%" class="lt1" border="0" cellpadding="3" cellspacing="0">
		<TR><TD></TD></TR>
		<?=$sr;?>
		</table>
		
		<table width="<?=$tab_max;?>" align="center" class="lt1">
		<?=$s;?>
		<TR><TD colspan="5" align="right">total de <?=$total;?> projetos indicados para avaliação</TD></TR>
		</table>
		<?
}

require("foot.php");	
?>