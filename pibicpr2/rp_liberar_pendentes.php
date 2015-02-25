<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');
	require($include.'sisdoc_email.php');
	require($include.'cp2_gravar.php');

$email_producao = $dd[2];

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Ano',True,True,''));
array_push($cp,array('$O : &TST:e-mail de teste para pibucpr@pucpr.br (limite 10)&VID:Somente no video&SIM:SIM Confirmar envio de email','','Tipo',True,True,''));
array_push($cp,array('$O N:Não&S:SIM','','Liberar nova avaliação',True,True,''));
array_push($cp,array('$T60:6','','Texto do e-mail',True,True,''));
//array_push($cp,array('$H8','','',True,True,''));
$fld = "pb_relatorio_parcial";
//////////////////
if (strlen($dd[1]) == 0) { $dd[1] = (date("Y")-1); }
//if (strlen($acao) == 0) { $dd[4] = '1'; }
echo '<CENTER><font class=lt5>Comunicação do Resultado do Relatório Parcial para o professor</font></CENTER>';
?><TABLE width="700" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE><?	

/////////////////////////////////////////////////////////////////// Relatório Parcial
$xsql = "";
if ($saved > 0)
		{
		$id = 0;
		$sql = "select * from pibic_bolsa_contempladas ";
		$sql .= " left join pibic_aluno on pa_cracha = pb_aluno ";
		$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
		$sql .= " left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
		$sql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
		$sql .= " inner join pibic_parecer_".$dd[1]." on pp_protocolo = pb_protocolo ";		
		$sql .= " where (pb_status = 'A') ";
		$sql .= " and doc_ano = '".$dd[1]."' ";
		$sql .= " and pp_status <> '@' ";
		$sql .= " and pl_p0 = 2 ";
		$sql .= " and pb_relatorio_parcial_nota > 0 ";
		$sql .= " order by pp_protocolo ";
		if ($email_producao == 'TST') { $sql .= " limit 5 "; }
		if ($email_producao == 'SIM') { $sql .= " limit 150 "; }

		$rlt = db_query($sql);
		
		echo '<table width="'.$tab_max.'" class="lt0" align="center" border="0" cellpadding="2" cellspacing="0">';
		echo '<TR><TD align="center" colspan="10">Critérios - Ano:'.$dd[1].' <B>'.$bolsa.$tst.'</B>';
		echo '<TR><TD>';
		while ($line = db_read($rlt))
			{
			$id++;
//				require("pibic_busca_resultado.php");
			$sr .= '<TR bgcolor="'.$bgc.'">';
			$sr .= '<TD align="right"><I>Relatórios</I></TD><TD colspan="4">';

		$link = '<A HREF="http://www2.pucpr.br/reol/pibicpr2/pibic_parecer_mostrar.php?dd0='.$line['id_pp'].'" targer="new">Link do parecer</A>';
		$texto = $dd[4];
		$e4 = $texto;
		require('email_body_tratar.php');
		$e4 = mst($texto);
		$e3 = '[PIBIC] - Abertura para reenvio de Relatorio parcial - '.$aluno_nome;
		
		$xsql .= "update pibic_bolsa_contempladas set pb_relatorio_parcial = 0, pb_relatorio_parcial_nota = -3 ";
		$xsql .=  " where id_pb = ".$line['id_pb'].';'.chr(13).chr(10);

		echo '<BR><BR>Enviado para ';
		if ($email_producao == 'TST')
			{
			enviaremail('renefgj@gmail.com',$e2,$e3,$e4);
			enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4);
			}
		/////////////////////// Enviar e-mail

		if ($email_producao == 'SIM')
			{
			if (strlen($pp_email_1) > 0) 
				{ enviaremail($pp_email_1,$e2,$e3,$e4); echo $pp_email_1.' ';}
			if (strlen($pp_email_2) > 0) 
				{ enviaremail($pp_email_2,$e2,$e3,$e4); echo $pp_email_2.' '; }
			enviaremail('renefgj@gmail.com',$e2,$e3,$e4.'<BR>Enviado para '.$pp_email_1.' e '.$pp_email_1);
			enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4.'<BR>Enviado para '.$pp_email_1.' e '.$pp_email_2);
			}
//////////////////////////////////////////////////////////////////////////////////////////////
		if ($email_producao == 'VID')
			{
			echo '<HR>';
			echo mst($e4);
			}
		}
//			echo $sr;
			echo '</table>';
			echo '<BR><BR>Total >> '.$id;
			}
		if ((strlen($xsql) > 0) and ($email_producao == 'SIM'))
			{
			$rlt = db_query($xsql);
			echo '<H2>Atualizado</H2>';
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