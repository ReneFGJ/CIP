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
array_push($cp,array('$O '.$opb,'','Tipo de Bolsa',False,True,''));
array_push($cp,array('$T60:6','','Texto do e-mail',True,True,''));
array_push($cp,array('$O : &TST:e-mail de teste para pibucpr@pucpr.br (limite 10)&VID:Somente no video&SIM:SIM Confirmar envio de email','','Tipo',True,True,''));
array_push($cp,array('$D8','','Avaliação de',True,True,''));
array_push($cp,array('$D8','','TAté',True,True,''));
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
if ($saved > 0)
		{
		$email_producao = $dd[4];			
		$id = 0;
		/* */
		$sql = "select * from pibic_ged_documento 
				inner join pibic_bolsa_contempladas on pb_protocolo = doc_dd0 
				left join pibic_professor on pp_cracha = pb_professor
				left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
				left join pibic_aluno on pa_cracha = pb_aluno
				 where doc_tipo = 'AVLRP' 
				 and pb_ano = '".$dd[1]."'
				 and pb_status = 'A'
				 and doc_data >= ".brtos($dd[5])."
				 and doc_data <= ".brtos($dd[6])."
				 order by pp_nome
				 ";
								
		if ($email_producao == 'TST') { $sql .= " limit 10 "; }

		$rlt = db_query($sql);
		echo '<table width="'.$tab_max.'" class="lt0" align="center" border="0" cellpadding="2" cellspacing="0">';
		echo '<TR><TD align="center" colspan="10">Critérios - Ano:'.$dd[1].' <B>'.$bolsa.$tst.'</B>';
		echo '<TR><TD>';
		while ($line = db_read($rlt))
			{
			$id++;
		//require("pibic_busca_resultado.php");
		//javascript:newxy3('ged_download.php?dd0=213&dd90=bc178346fe',300,150);
		$chkpost = checkpost($line['id_doc'].$secu);
		$mlink = 'http://www2.pucpr.br/reol/pibicpr2/ged_download.php?dd0='.$line['id_doc'].'&dd90='.$chkpost;
		$link = '<A HREF="'.$mlink.'" targer="new">Link do parecer</A>';
		
		$texto = $dd[3];
		$e4 = $texto;
		$aluno_nome = '';
		require('email_body_tratar.php');
		$e4 = mst($texto);
		$e3 = '[PIBIC] - Resultado da avaliação - '.$aluno_nome;
		

		echo '<BR><BR>enviado para:';

		if ($email_producao == 'TST')
			{
			enviaremail('renefgj@gmail.com',$e2,$e3.' (teste)',$e4);
			enviaremail('pibicpr@pucpr.br',$e2,$e3.' (teste)',$e4);
			}
		/////////////////////// Enviar e-mail
		
		if ($email_producao == 'SIM')
			{
			if (strlen($pp_email_1) > 0) 
				{ enviaremail($pp_email_1,$e2,$e3,$e4); echo $pp_email_1.' ';}
			if (strlen($pp_email_2) > 0) 
				{ enviaremail($pp_email_2,$e2,$e3,$e4); echo $pp_email_2.' '; }
			//enviaremail('renefgj@gmail.com',$e2,$e3,$e4.'<BR>Enviado para '.$pp_email_1.' e '.$pp_email_2);
			//enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4.'<BR>Enviado para '.$pp_email_1.' e '.$pp_email_2);
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