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
array_push($cp,array('$O 1:Aprovados e não enviados&2:Aprovados e enviados','','Tipo',False,True,''));
array_push($cp,array('$C4','','Com dados detalhados',False,True,''));
$fld = "pb_resumo";
//////////////////
if (strlen($dd[1]) == 0) { $dd[1] = (date("Y")-1); }
if (strlen($acao) == 0) { $dd[4] = '1'; }
echo '<CENTER><font class=lt5>Resumos para enviar para o SEMIC</font></CENTER>';
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
		$sql .= " where (pb_status = 'A') ";
		$wsql = "";
		if (strlen(trim($dd[5])) > 0)
			{ 
				if ($dd[5] == '1') { $wsql .= " and (pb_resumo_nota = '2' ) "; $tst = " - Não enviado"; }
//			if ($dd[5] == '2') { $wsql .= " and (".$fld." > 20000101 ) ";  $tst = " - Entregues"; }
//			if ($dd[5] == '3') { $wsql .= " and (".$fld." > 20000101 and ".$fld."_nota = 1) ";  $tst = " - Entregues e aprovados"; }
//			if ($dd[5] == '4') { $wsql .= " and (".$fld." > 20000101 and ".$fld."_nota = 2) ";  $tst = " - Entregues e <B>não aprovados</B>"; }
			}

		if (strlen(trim($dd[1])) > 0)
			{ $wsql .= " and (pb_ano = '".$dd[1]."') "; }
		if (strlen(trim($dd[4])) == 0)
			{ $wsql .= " and (pb_tipo = '".$dd[3]."') "; }
		$sql .= $wsql. " order by pp_nome ";
		$sql_consulta = $sql;
		///////////////////////////////////////////////////////////////////////////////////////
		$rlt = db_query($sql);
		
			echo '<table width="'.$tab_max.'" class="lt0" align="center" border="0" cellpadding="2" cellspacing="0">';
			echo '<TR><TD align="center" colspan="10">Critérios - Ano:'.$dd[1].' <B>'.$bolsa.$tst.'</B>';
			echo '<TR><TD>';

		while ($line = db_read($rlt))
				{
				$dt = round($line['pb_semic']);
				if ($dt < 20000101)
					{
					$id++;
					require("pibic_busca_resultado.php");
					$sr .= '<TR bgcolor="'.$bgc.'">';
					$sr .= '<TD align="right"><I>Relatórios</I></TD><TD colspan="4">';
					if ($line[$fld] > 20000000)
						{
						$sr .= 'Resumo '.stodbr($line[$fld]);
						if ($line[$fld.'_nota'] == 0) { $sr .= ', <font color="#ff00ff">não avaliado'; }
						if ($line[$fld.'_nota'] == 2) { $sr .= ', <font color=green>aprovado'; }
						if ($line[$fld.'_nota'] == -1) { $sr .= ', <font color="orange">enviado para correções'; }
						} else {
						$sr .= '<font color="red">NÃO ENTREGUE</font>';
						}
					}
				}
			echo $sr;
			echo '</table>';
			echo '<BR><BR>Total >> '.$id;
		}
require("foot.php");
?>