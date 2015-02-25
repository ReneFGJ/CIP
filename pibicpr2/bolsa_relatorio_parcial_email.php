<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');
	require($include.'sisdoc_email.php');
	require($include.'cp2_gravar.php');

$sql = "select * from pibic_bolsa_tipo ";
$rlt = db_query($sql);
$opb .= ' :---Todas as bolsas--';
while ($line = db_read($rlt))
	{
	$opb .= '&'.trim($line['pbt_codigo']).':'.trim($line['pbt_descricao']);
	}
	
$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Ano',True,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$O '.$opb,'','Tipo de Bolsa',False,True,''));
array_push($cp,array('$H8','','',False,True,''));
array_push($cp,array('$O 1:Não Entregues&2:Entregues&3:Aprovados&4:Reprovados& :Todos','','Estatus do relatório',False,True,''));
array_push($cp,array('$T60:6','','Texto do e-mail',True,True,''));
array_push($cp,array('$O : &TST:e-mail de teste para pibucpr@pucpr.br (limite 10)&SIM:SIM Confirmar envio de email','','Com dados detalhados',True,True,''));
$fld = "pb_relatorio_parcial";
//////////////////
if (strlen($dd[1]) == 0) { $dd[1] = (date("Y")-1); }
//if (strlen($acao) == 0) { $dd[4] = '1'; }
echo '<CENTER><font class=lt5>Acompanhamento de relatório parcial</font></CENTER>';
?><TABLE width="700" align="center"><TR><TD><?
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
			if ($dd[5] == '1') { $wsql .= " and (".$fld." < 20000101 ) "; $tst = " - Não entregues"; }
			if ($dd[5] == '2') { $wsql .= " and (".$fld." > 20000101 ) ";  $tst = " - Entregues"; }
			if ($dd[5] == '3') { $wsql .= " and (".$fld." > 20000101 and ".$fld."_nota = 1) ";  $tst = " - Entregues e aprovados"; }
			if ($dd[5] == '4') { $wsql .= " and (".$fld." > 20000101 and ".$fld."_nota = 2) ";  $tst = " - Entregues e reprovados"; }
			}

		if (strlen(trim($dd[1])) > 0)
			{ $wsql .= " and (pb_ano = '".$dd[1]."') "; }
		if (strlen(trim($dd[3])) > 0)
			{ $wsql .= " and (pb_tipo = '".$dd[3]."') "; }
		$sql .= $wsql. " order by pp_nome ";
		if ($dd[7] == 'TST') { $sql .= ' limit 40 '; }
		$sql_consulta = $sql;
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
//				require("pibic_busca_resultado.php");
				$sr .= '<TR bgcolor="'.$bgc.'">';
				$sr .= '<TD align="right"><I>Relatórios</I></TD><TD colspan="4">';
				if ($line[$fld] > 20000000)
					{
					$sr .= 'Relatório entregue em '.stodbr($line[$fld]);
					if ($line[$fld.'_nota'] == 0) { $sr .= ', não avaliado'; }
					if ($line[$fld.'_nota'] == 2) { $sr .= ', <B>não avaliado</B>'; }
					if ($line[$fld.'_nota'] == 1) { $sr .= ', <font color=green>aprovado'; }
					if ($line[$fld.'_nota'] == -1) { $sr .= ', <font color="red">reenviar'; }
					} else {
					$sr .= '<font color="red">NÃO ENTREGUE</font>';
					}
					
//////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////// RECUEPRA TEXTO
//		$tipo = "rel_par_ava";	
//		$sql = "select * from ic_noticia where nw_ref = '".$tipo."' and nw_journal = ".$jid;
//		$rrr = db_query($sql);
//		if ($line = db_read($rrr))
//			{
//			$texto = $line['nw_descricao'];
//			}
//			
//		$key = substr(md5($secu.$dd[10].$protocolo.$idp),5,10);
//		$link = $http.'../pibic/pibic_avaliacao_parcial.php?dd0='.$idp.'&dd1='.$key.'&dd2='.$dd[10].'&dd3='.$protocolo.'&dd4=002';
		$texto = $dd[6];
		
		/////////////////////////////////////
		/// email

		
		$e3 = '[PIBIC] - Relatorio parcial - '.$aluno_nome;
		$e4 = mst($texto);
		require('email_body_tratar.php');
		$e4 = $texto;
		
		echo '<BR><BR>enviado para:';
		$email_producao = $dd[7];

		if ($email_producao == 'TST')
			{
			enviaremail('renefgj@gmail.com',$e2,$e3,$e4);
			enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4);
			}
		/////////////////////// Enviar e-mail

		if ($email_producao == 'SIM')
			{
			enviaremail('renefgj@gmail.com',$e2,$e3,$e4);
			enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4);
			if (strlen($pp_email_1) > 0) 
				{ enviaremail($pp_email_1,$e2,$e3,$e4); echo $pp_email_1.' ';}
			if (strlen($pp_email_2) > 0) 
				{ enviaremail($pp_email_2,$e2,$e3,$e4); echo $pp_email_2.' '; }
			}
//////////////////////////////////////////////////////////////////////////////////////////////
		echo '<HR>';
		echo mst($e4);
			
		}
//			echo $sr;
			echo '</table>';
			echo '<BR><BR>Total >> '.$id;
			}

		}
?>
<pre>
		$titulo
		$aluno
		$professor
		$proto_mae
		$protocolo
		$nome
		$link
</pre>
<?
require("foot.php");	
?>