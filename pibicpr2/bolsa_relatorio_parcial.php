<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');
	
	require("../_class/_class_pibic_bolsa_contempladas.php");
	require("../_class/_class_semic.php");
	require("../_class/_class_google_graph.php");
	$gr = new grafico;	
	$semic = new semic;
	$pb = new pibic_bolsa_contempladas;
	$idioma = $pb->idioma();

$tabela = "";

/** Opções de bolsas **/
$sql = "select * from pibic_bolsa_tipo";
$rlt = db_query($sql);
$op = ' :--todas as opções--';
while ($line = db_read($rlt))
{
	$op .= '&';
	$op .= $line['pbt_codigo'];
	$op .= ':';
	$op .= $line['pbt_descricao'];
}

$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Ano',True,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$O '.$op,'','Tipo de Bosa',True,True,''));
array_push($cp,array('$O :Todos&1:Não Entregues&2:Entregues&3:Aprovados&4:Reprovados&5:Reprovados não entregues&6:Reprovados entregues','','Estatus do relatório',False,True,''));
array_push($cp,array('$C4','','Com dados detalhados',False,True,''));
$fld = "pb_relatorio_parcial";
//////////////////
if (strlen($dd[1]) == 0) { $dd[1] = (date("Y")-1); }
if (strlen($acao) == 0) { $dd[4] = '1'; }
echo '<CENTER><font class=lt5>Acompanhamento de relatório parcial</font></CENTER>';
?><TABLE width="500" align="center" border=0 ><TR><TD><form method="post" action="<?=page();?>"><?
for ($r=0;$r < count($cp);$r++)
	{
		echo '<TD>';
		echo sget('dd'.$r,$cp[$r][0],'','11','22');
	}
?><td>Detalhado</td><TD><input type="submit" value="calcular" name="acao"></TR></TABLE>
<?	
$email = '';
/////////////////////////////////////////////////////////////////// Relatório Parcial
if (strlen($acao) > 0)
		{
		$id = 0;
		$sql = "select * from pibic_bolsa_contempladas ";
		$sql .= " left join pibic_aluno on pa_cracha = pb_aluno ";
		$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
		$sql .= " left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
		$sql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
		$sql .= " where (pb_status = 'A') ";
		$wsql = "";
		if (strlen(trim($dd[4])) > 0)
			{ 
			if ($dd[4] == '1') { $wsql .= " and (".$fld." < 20000101 ) "; $tst = " - Não entregues"; }
			if ($dd[4] == '2') { $wsql .= " and (".$fld." > 20000101 ) ";  $tst = " - Entregues"; }
			if ($dd[4] == '3') { $wsql .= " and (".$fld." > 20000101 and ".$fld."_nota = 1) ";  $tst = " - Entregues e aprovados"; }
			if ($dd[4] == '4') { $wsql .= " and (".$fld." > 20000101 and ".$fld."_nota = 2) ";  $tst = " - Entregues e <B>não aprovados</B>"; }
			if ($dd[4] == '5') { $wsql .= " and (".$fld."_nota = 2 and ((pb_relatorio_parcial_correcao isnull) or (pb_relatorio_parcial_correcao < 20100101))) ";  $tst = " - Reprovados e não entregues <B>correção</B>"; }
			if ($dd[4] == '6') { $wsql .= " and (".$fld."_nota = 2 and pb_relatorio_parcial_correcao >= 20100101) ";  $tst = " - Reprovados e não entregues <B>correção</B>"; }
			}

		if (strlen(trim($dd[1])) > 0)
			{ $wsql .= " and (pb_ano = '".$dd[1]."') "; }
		if (strlen(trim($dd[3])) > 0)
			{ $wsql .= " and (pb_tipo = '".$dd[3]."') "; }
		$sql .= $wsql. " order by pp_nome ";
		$sql_consulta = $sql;
		///////////////////////////////////////////////////////////////////////////////////////
		echo '<TABLE border=1>';
		echo '<TR valign="top"><TD>';
		require("bolsa_relatorio_resumo.php");
		
		/***** Calcula gráficos ****/
		/** Não entregues */
		echo '<TD>';
		$sql = "select count(*) as total, 'Entregue' as descricao from pibic_bolsa_contempladas ";
		$sql .= " where (".$fld." > 20000101) and (pb_status = 'A')  ";		
		if (strlen(trim($dd[1])) > 0)
			{ $sql .= " and (pb_ano = '".$dd[1]."') "; }
		if (strlen(trim($dd[2])) > 0)
			{ $sql .= " and (pb_tipo = '".$dd[2]."') "; }

		/** Entregues */
		$sql .= " union ";
		$sql .= "select count(*) as total, 'Não entregue' as descricao from pibic_bolsa_contempladas ";
		$sql .= " where (".$fld." < 20000101) and (pb_status = 'A') ";	
		if (strlen(trim($dd[1])) > 0)
			{ $sql .= " and (pb_ano = '".$dd[1]."') "; }
		if (strlen(trim($dd[2])) > 0)
			{ $sql .= " and (pb_tipo = '".$dd[2]."') "; }
		$sql .= " order by descricao ";	
		$rlt = db_query($sql);
		
		$data = array();
		$toat = 0;
		$toat1 = 0;
		while ($line = db_read($rlt))
			{
				if ($line['descricao']=='Entregue') { $toat1 = $line['total']; }
				$toat = $toat + $line['total'];
				array_push($data,array($line['descricao']. '('.$line['total'].')',$line['total']));
			}
		///////////////// mostra resumo
		$sa = '<table width="100%" border=0 >';
		$sa .= '<TR valign="top"><TD>';
		$sa  .='<TD align="center">';
		$sa  .=$gr->pie($data);
		if ($toat > 0)
			{
			$sa .= '<BR>'.number_format($toat1/$toat*100,1).'% Entregue(s)';
			}
			$sa  .= '<BR><BR>';
		$sa .= '</table>';			
		echo $sa;
		/////////////////////////////////////////////////////////////////////////////////////// Dados detalhados
		echo $semic->idiomas_resumo();
		//echo $semic->area_resumo();
		/*** Detalhes **/
		echo '</table>';
		if (strlen($dd[5]) > 0) {
			///////////////////////////////
			$rlt = db_query($sql_consulta);
		
			if (strlen($dd[2]) > 0) 
				{
				$xsql = "select * from pibic_bolsa_tipo where pbt_codigo = '".$dd[2]."' ";
				$xrlt = db_query($xsql);
				$xline = db_read($xrlt);
				$bolsa = trim($xline['pbt_descricao']);
				}
				
			echo '<table width="'.$tab_max.'" class="lt0" align="center" border="0" cellpadding="2" cellspacing="0">';
			echo '<TR><TD align="center" colspan="10">Critérios - Ano:'.$dd[1].' <B>'.$bolsa.$tst.'</B>';
			echo '<TR><TD>';
			$email = '';
			while ($line = db_read($rlt))
				{
					$pp_email = trim($line['pp_email']);
					if (strlen($pp_email)) { $email .= $pp_email.'; ';}
					$pp_email = trim($line['pp_email_1']);
					if (strlen($pp_email)) { $email .= $pp_email.'; ';}
					
				$id++;
				require("pibic_busca_resultado.php");
				$sr .= '<TR bgcolor="'.$bgc.'">';
				$sr .= '<TD align="right"><I>Relatórios</I></TD><TD colspan="4">';
				if ($line[$fld] > 20000000)
					{
					$sr .= 'Relatório entregue em '.stodbr($line[$fld]);
					if ($line[$fld.'_nota'] == 0) { $sr .= ', <font color="#ff00ff">não avaliado'; }
					if ($line[$fld.'_nota'] == 1) { $sr .= ', <font color=green>aprovado'; }
					if ($line[$fld.'_nota'] == 2) { $sr .= ', <font color=red>pendências'; }
					if ($line[$fld.'_nota'] == -1) { $sr .= ', <font color="orange">enviado para correções'; }
					} else {
					$sr .= '<font color="red">NÃO ENTREGUE</font>';
					}
				}
			echo $sr;
			echo '</table>';
			echo '<BR><BR>Total >> '.$id;
			
			echo '<BR><span id="email2">ver e-mail dos professores</span><div id="email" style="display: none;" >';
			echo $email;
			echo '</div>';
			echo '<script>
					$("#email2").click(function () { $("#email").fadeIn("slow"); });
				  </script>';
			}
		}
	
require("foot.php");	
?>
