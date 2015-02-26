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
//////////////////
if (strlen($dd[1]) == 0) { $dd[1] = (date("Y")-1); }
if (strlen($acao) == 0) { $dd[4] = '1'; }
echo '<CENTER><font class=lt5>Próximas bolsas para indicar</font></CENTER>';
?>
<TABLE width="500" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE>
<?	
/////////////////////////////////////////////////////////////////// Relatório Parcial
if ($saved > 0)
		{

		require("../_class/_class_discentes.php");
		$dis = new discentes;
			
		$sql = "select * from pibic_bolsa_contempladas ";
		$sql .= " left join pibic_submit_documento on pb_protocolo = doc_protocolo ";
		$sql .= " left join pibic_aluno on pa_cracha = pb_aluno ";
		$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
		$sql .= " left join apoio_titulacao on ap_tit_codigo = pp_titulacao ";
		$sql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
		$sql .= " where (pb_status = 'A') ";
		$sql .= " and (pb_tipo = 'I' or pb_tipo = 'A')"; // ou A
		$sql .= " and (pb_ano = '".$dd[1]."' )";
		$sql .= " order by pb_area_conhecimento, doc_nota desc  ";
		$rlt = db_query($sql);
		$xarea = "X";
		$tot = 0;
		$tota = 0;
		$xprof = '';
		while ($line = db_read($rlt))
			{
			$col = coluna();
			$area = trim($line['pb_area_conhecimento']);
			$prof = trim($line['pb_professor']);
			if ($xarea != $area)
				{
				$varea = $area;
				if ($area == 'V') { $varea = 'Ciências da Vida'; }
				if ($area == 'H') { $varea = 'Ciências Humanas'; }
				if ($area == 'E') { $varea = 'Ciências Exatas'; }
				if ($tota > 0) 
					{ $sx .= '<TR><TD colspan="5" align="right"><I>Total da área '.$tota.'</I></TD></TR>'; }
				$sx .= '<TR bgcolor="#c0c0c0"><TD colspan="5" align="center" class="lt3">'.$varea.'</TD></TR>';
				$xarea = $area;
				$tota = 0;
				}
			if ($xprof != $prof)
				{
//				print_r($line);
//					exit;
				$sx .= '<TR>';
				$sx .= '<TD colspan="2">Professor: <B>';
				$sx .= $line['pp_nome'];
				$sx .= '('.trim($line['ap_tit_titulo']).')';
				$sx .= '<TD rowspan="2">';

				$xsql = "select * from pibic_bolsa_contempladas ";
				$xsql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
				$xsql .= " where pb_professor = '".$line['pb_professor']."' ";
				$xsql .= " and pb_ano = '".$line['pb_ano']."' ";
				$vprof = '';
				$xprof = $prof;
				$xrlt = db_query($xsql);
				while ($xline = db_read($xrlt))
					{
					$img = trim($xline['pbt_img']);
					$sx .= '<img src="img/'.$img.'" alt="" border="0">&nbsp;';
					}
				}
			$sx .= '<TR '.$col.'>';

			$sx .= '<TD rowspan="2"><NOBR><B>Nota:';
			$sx .= $line['doc_nota'].'</B>';
			$sx .= '<BR>'.$line['doc_edital'];
			$sx .= ' '.$line['doc_ano'];


			$sx .= '<TR '.$col.'>';
			$sx .= '<TD>';
			$img = trim($line['pbt_img']);
			$sx .= '<img src="img/'.$img.'" alt="" border="0">&nbsp;';
			$sx .= '('.$line['pb_tipo'].') ';
			$sx .= 'Voluntátio: '.$line['pa_nome'];
			$sx .= $dis->mostra_comentario($line['pa_obs']);
			$sx .= '<TD>';
			$img = trim($line['doc_protocolo']);
			$sx .= '</TR>';
			$xline = $line;
			
			$tot = $tot + 1;
			$tota = $tota + 1;
			}
if ($tota > 0) 
	{ $sx .= '<TR><TD colspan="5" align="right"><I>Total da área '.$tota.'</I></TD></TR>'; }
	
echo '<table width="'.$tab_max.'" class="lt1">';
echo $sx;
echo '</table>';
echo '<center> total '.$tot.'</center>';

}
	
require("foot.php");	
?>