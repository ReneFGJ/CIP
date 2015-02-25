<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Ano',True,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo','','Tipo de Bosa',True,True,''));
array_push($cp,array('$C4','','Todas as bolsas',False,True,''));
array_push($cp,array('$O 0:Todos&1:Não indicados&2:Indicados e não avaliados&3:Indicados e avaliados&4:Avaliados e não aprovados','','Estatus do relatório',True,True,''));
array_push($cp,array('$C4','','Com dados detalhados',False,True,''));
$fld = "pb_relatorio_final";
//////////////////
if (strlen($dd[1]) == 0) { $dd[1] = (date("Y")-1); }
if (strlen($acao) == 0) { $dd[4] = '1'; }
echo '<CENTER><font class=lt5>Indicação de relatório parcial</font></CENTER>';
?><TABLE width="500" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE><?	

/////////////////////////////////////////////////////////////////// Relatório Parcial
if ($saved > 0)
		{
		$id = 0;
		$sql = "select * from pibic_bolsa_contempladas ";
		$sql .= " left join pibic_aluno on pa_cracha = pb_aluno ";
		$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
		$sql .= " left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
		$sql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
		$sql .= " left join (select count(*) as tp, pp_protocolo from pibic_parecer_2010 where (pp_status = '@' or pp_status = 'A' and pp_data > ".(round($dd[1]+1))."0501) group by pp_protocolo) as pareceres  on pp_protocolo = pb_protocolo ";
		$sql .= " where (pb_status = 'A') ";
		$wsql = "";
		$wsql .= " and (".$fld." > 20000101 ) ";  $tst = " - Entregues"; }
		if (strlen(trim($dd[1])) > 0)
			{ $wsql .= " and (pb_ano = '".$dd[1]."') "; }
		if (strlen(trim($dd[4])) == 0)
			{ $wsql .= " and (pb_tipo = '".$dd[3]."') "; }
		$sql .= $wsql. " order by pp_nome ";
		$sql_consulta = $sql;
		///////////////////////////////////////////////////////////////////////////////////////
		
		///////////////// mostra resumo
		require("bolsa_relatorio_resumo.php");
		/////////////////////////////////////////////////////////////////////////////////////// Dados detalhados
		if (strlen($dd[6]) > 0) {
			///////////////////////////////
			$rlt = db_query($sql_consulta);
		
			if (strlen($dd[3]) > 0) 
				{
				$xsql = "select * from pibic_bolsa_tipo where pbt_codigo = '".$dd[3]."' ";
				$xrlt = db_query($xsql);
				$xline = db_read($xrlt);
				$bolsa = trim($xline['pbt_descricao']);
				}
				
			echo '<table width="'.$tab_max.'" class="lt0" align="center" border="0" cellpadding="2" cellspacing="0">';
			echo '<TR><TD align="center" colspan="10">Critérios - Ano:'.$dd[1].' <B>'.$bolsa.$tst.'</B>';
			echo '<TR><TD>';
			while ($line = db_read($rlt))
				{
				$id++;
				 /*  :Todos&1:Não indicados&2:Indicados e não avaliados&3:Indicados e avaliados&4:Avaliados e não aprovados */

				$tp = round($line['tp']);
				if (
					(($tp == 0) and ($dd[5]=='1')) or
					(($tp > 0) and ($dd[5]=='2')) or
					($dd[5] == '0')
					)
					{
					require("pibic_busca_resultado.php");
					$sr .= '<TR bgcolor="'.$bgc.'">';
					$sr .= '<TD align="right"><I>Relatórios</I></TD><TD colspan="4">';
					if ($line[$fld] > 20000000)
						{
						$sr .= 'Relatório final entregue em '.stodbr($line[$fld]);
						if ($line[$fld.'_nota'] == 0) { $sr .= ', <font color="#ff00ff">não avaliado'; }
						if ($line[$fld.'_nota'] == 2) { $sr .= ', <font color=green>aprovado'; }
						if ($line[$fld.'_nota'] == -1) { $sr .= ', <font color=red>pendências'; }
						if ($line[$fld.'_nota'] == -2) { $sr .= ', <font color="orange">enviado para correções'; }
					} else {
						$sr .= '<font color="red">NÃO ENTREGUE</font>';
					}
					if ($tp > 0)
						{ $sr .= ', Indicado para '.$tp.' avaliadores.'; }
					}
				}
			echo $sr;
			echo '</table>';
			echo '<BR><BR>Total >> '.$id;
		}
	
require("foot.php");	
?>