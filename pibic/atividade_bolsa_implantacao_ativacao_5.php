<?
require($include."sisdoc_email.php");

	$sql = "select * from pibic_bolsa ";
	$sql .= " where id_pb = ".$dd[0];
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$bolsa = $line['pb_tipo'];
	require("pibic_bolsa_tipos.php");
?>
<font class="lt3"><center>
TERMO DE IMPLEMENTA��O DE BOLSA ou ADES�O ICV
</center></font>
<?
if ( $dd[11] == '1')
	{
	$destino = '1';
	require("gerar_termo_pdf.php");
	$destino = troca($destino,'/pucpr/httpd/htdocs/www2.pucpr.br','');
	$sql = "select * from pibic_bolsa_contempladas where pb_protocolo = '".$proto."' ";
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
			$sql = " update pibic_bolsa_contempladas ";
			$sql .= " set pb_tipo = '".$bolsa."', ";
			$sql .= " pb_aluno = '".$aluno_codigo."' ";
			$sql .= " where pb_protocolo = '".$proto."'; ";

			$sql .= " insert into pibic_bolsa_historico ";
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= "bh_log,bh_acao,bh_historico) values ";
			$sql .= "('".$proto."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "1,3,'Troca de modalidade de bolsa para o protocolor ".$proto."') ; ";
			
			$rlt = db_query($sql);
		} else {
			$sql = "insert into pibic_bolsa_contempladas ";
			$sql .= "(pb_aluno,pb_professor,pb_protocolo,";
			$sql .= "pb_protocolo_mae,pb_tipo,pb_data,";
			$sql .= "pb_hora,pb_ativo,pb_ativacao,pb_desativacao,";
			
			$sql .= "pb_contrato,pb_titulo_projeto,pb_titulo_plano,";
			$sql .= "pb_fomento,pb_status,pb_area_conhecimento,";
			$sql .= "pb_codigo,pb_data_ativacao,pb_data_encerramento,pb_relatorio_parcial,";
			$sql .= "pb_relatorio_parcial_nota,pb_relatorio_final,pb_relatorio_final_nota,";
			$sql .= "pb_resumo,pb_resumo_nota,pibic_resumo_text,";
			$sql .= "pibic_resumo_colaborador,pibic_resumo_keywork,pb_ano";
			$sql .= ") values (";
			$sql .= "'".$aluno_codigo."','".$prof_cracha."','".$proto."',";
			$sql .= "'".$proto_mae."','".$bolsa."','".date("Ymd")."',";
			$sql .= "'".date("H:i")."','1','".date("Ymd")."','19000101',";
			$sql .= "'".$proto."','".trim($tit_plano)."',";
			$sql .= "'','','A',";
			$sql .= "'".$area."','','".(date("Ymd"))."'";
			$sql .= ",'19000101','19000101','1'";
			$sql .= ",'0','0','0'";
			$sql .= ",'0','',''";
			$sql .= ",'','".(date("Y"))."'); ";
	
			$sql .= " insert into pibic_bolsa_historico ";
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= "bh_log,bh_acao,bh_historico) values ";
			$sql .= "('".$proto."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "1,3,'Implanta��o de bolsa para o protocolor ".$proto."') ; ";
			$rlt = db_query($sql);
	}
	$sql = "update pibic_bolsa set pb_ativacao = ".date("Ymd")." where pb_protocolo = '".$proto."'; ";
	$rlt = db_query($sql);
/////////////////////////////////////////////////////////////////////////////////////////
	$sql = "select * from ic_noticia ";
	$sql .= " where nw_ref = 'termo_final' ";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$texto = '<BR>'.$line['nw_descricao'];
	$texto .= '<BR><BR>Protocolo:'.$proto;
	$texto .= '<BR>';
	$texto = mst($texto);
	
	if ((trim($bolsa) == 'F') or (trim($bolsa) == 'F'))
		{
			$texto .= '<BR><BR>';
			$texto .= '<h3>BOLSAS DA FUNDA��O ARAUC�RIA</h3>
						<BR>
						<font color="green">per�odo de implementa��o: 13/08/2014 a 18/08/2014</font>
						<BR>
						<BR>Para bolsas da Funda��o Arauc�ria, o aluno dever� ter uma conta corrente pr�pria e individual, em banco de sua prefer�ncia (contas-poupan�a n�o s�o aceitas pelo �rg�o de fomento). O Professor Orientador dever� preencher os dados do aluno no portal (www.pucpr.br/cip) bem como, anexar c�pias digitalizadas dos documentos do aluno (RG, CPF,  comprovante de resid�ncia, c�pia da conta banc�ria e atestado de matr�cula, o qual o aluno  dever� solicitar em car�ter de urg�ncia no SIGA). Ap�s este cadastro, o professor dever� imprimir 2 (duas) vias do termo de concess�o de bolsa, anexar c�pias de CPF, RG, comprovante de resid�ncia, curr�culo Lattes e atestado de matr�cula e entregar no t�rreo do pr�dio da Administra��o.
						<BR><BR>Ambos, aluno e Professor Orientador, dever�o comparecer obrigatoriamente na coordena��o do PIBIC at� dia 18/08/2013, para entrega desta documenta��o e assinatura de ades�o � bolsa.';
		}

	echo $texto.'<BR><BR>';
	echo '<h3><font color="green">Primeira etapa finalizada com sucesso!</font></h3>';
	
	////////////////////////////
//	$headers = "MIME-Version: 1.0\n";
//	$headers .= "From: PIBIC <pibicpr@pucpr.br> \r\n";
//	$headers .= "From: PIBIC <pibicpr@pucpr.br> \n";
//	$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
	
	$e3 = '[PIBIC] - Pr�-ativa��o de '.$bolsa_nome.' - '.$aluno_nome;
	$e4 = $message.$texto;
	// e-mail de seguran�a
//	$e1 = 'pibicpr@pucpr.br';
//	enviaremail($e1,$e2,$e3,$e4);
	//$e1 = 'renefgj@gmail.com';
	//enviaremail($e1,'',$e3, $e4); echo '<BR>enviado para '.$e1;
	
	$e1 = 'pibicpr@pucpr.br';
	enviaremail($e1,'',$e3, $e4); echo '<BR>enviado para '.$e1;
	
	if (strlen($prof_email) > 0) 	
		{
			enviaremail($prof_email,'',$e3, $e4); echo '<BR>enviado para '.$prof_email;
		}
		
	if (strlen($prof_email_1) > 0) 	
		{
			enviaremail($prof_email_1,'',$e3, $e4); echo '<BR>enviado para '.$prof_email;
		}
	
	require("atividade_bolsa_implantacao_aluno.php");

	} else {
?>
<h3>Finaliza��o da 1� etapa de implementa��o</h3>
<font class="lt2">
<BR>Declaro:
<UL>
<LI>ter conhecimento das normas que regem o Programa de Inicia��o Cient�fica da PUCPR (resolu��o e Caderno de Normas);</LI>
<LI>que respondo pela veracidade de todas as informa��es acima.</LI>
</UL>
<BR>
<a href="gerar_termo.php?dd0=<?=$dd[0];?>" target="new">Visualiza��o da Minuta do Termo</a>	
<BR>
<BR>Declaro que li o termo de minuta e estou de acordo.
<BR>
<BR>
<form method="post">
	<input type="checkbox" name="dd11" value="1">SIM, concordo com os termos
	<input type="hidden" name="dd0" value="<?=$dd[0];?>">
	<input type="hidden" name="dd1" value="<?=$dd[1];?>">
	<input type="hidden" name="dd2" value="<?=$dd[2];?>">
	<input type="hidden" name="dd3" value="<?=$dd[3];?>">
	<input type="hidden" name="dd4" value="<?=$dd[4];?>">
	<input type="hidden" name="dd5" value="5">
	<input type="submit" name="acao" value="aceitar termo">
</form>
</font>
<?
}
?>
