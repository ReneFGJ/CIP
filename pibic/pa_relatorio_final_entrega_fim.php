<?
require("cab.php");

require($include.'sisdoc_message.php');
require($include.'sisdoc_debug.php');
//require($include.'sisdoc_data.php');

require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_email.php');

require("../_class/_class_pibic_bolsa_contempladas.php");
require("../_class/_class_ic.php");
$ic = new ic;

	/* Mensagens */
	$tabela = 'pa_relatorio_final_entrega';
	
/* checa post */
$dd1 = $dd[1];
if (checkpost($dd1) != $dd[90])
	{
		echo msg_erro('Erro de checagem de envio de dados.');
		exit;
	}
$pb = new pibic_bolsa_contempladas;
$pb->le('',$dd1);
echo "<table width='".$tab_max."'>";
echo '<TR><TH colspan=2>'.msg('post_rel_parcial');

echo '<TR><TD>';
echo $pb->mostar_dados();

			$files = $pb->valida_relatorio_final(); 
			$ok = $files;
			if (strlen(trim($pb->pb_semic_idioma))==0) { $ok = 0; }
			if (strlen(trim($pb->pb_semic_area))==0) { $ok = 0; }
			
if ($ok == 1)
	{
		
$tabela = 'pa_relatorio_final_entrega_fim';
	
			
		$protocolo = $pb->pb_protocolo;
		$orientado = $pb->pb_professor_nome;
		$estudante = $pb->pb_est_nome;
		$titulo = $pb->pb_titulo_plano;
		$data = date("d/m/Y");
		$hora = date("H:i:s");
		$modalidade = $pb->pb_tipo_nome;
		
		$icr = $ic->ic('PIBIC_CPFIN');
		$ic = $icr['nw_descricao'];
		$it = $icr['nw_titulo'];
		
		$email_1 = $pb->pb_prof_email_1;
		$email_2 = $pb->pb_prof_email_2;

		/** trocas **/
		$ic = troca($ic,'$orientador','<B>'.$orientador.'</B>');
		$ic = troca($ic,'$professor','<B>'.$orientador.'</B>');
		$ic = troca($ic,'$estudante','<B>'.$estudante.'</B>');
		$ic = troca($ic,'$aluno','<B>'.$estudante.'</B>');
		$ic = troca($ic,'$titulo','<B>'.$titulo.'</B>');
		$ic = troca($ic,'$protocolo',$protocolo.'</B>');
		$ic = troca($ic,'$hora',$hora);
		$ic = troca($ic,'$data',$data);
		$ic = troca($ic,'$dia',$data);

		echo 'Relatório Final entregue com sucesso!';
				
		$ml = enviaremail('pibicpr@pucpr.br','',$it.'-'.$protocolo,$ic);
		if (strlen($email_1) > 0) { $ml = enviaremail($email_1,'',$it.'-'.$protocolo,$ic); echo '<BR>'.msg('send_to').' '.$email_1; }
		if (strlen($email_2) > 0) { $ml = enviaremail($email_2,'',$it.'-'.$protocolo,$ic); echo '<BR>'.msg('send_to').' '.$email_2; }
		
		echo '<BR><BR><form action="main.php">';
		echo '<input type="submit" value="'.msg('voltar').'" name="volta">'; 
		echo '</form>';
		
		$sql = "update ".$pb->tabela." ";
		$sql .= " set pb_relatorio_final = ".date("Ymd")." ";
		$sql .= " , pb_relatorio_final_nota = 0 ";
		$sql .= " where pb_protocolo = '".$protocolo."' ";
		$rlt = db_query($sql);
		
		$sql = "update pibic_ged_documento set doc_status = 'A' where (doc_status = '@') and (doc_dd0 = '$protocolo')";
		$rlt = db_query($sql);
				
		echo '<BR><BR><BR>';
	} else {
		echo msg('error_valid');
	}
echo '</table>';

require("foot.php");
?>
