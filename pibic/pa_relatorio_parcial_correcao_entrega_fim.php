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

	$tabela = page();
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
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
echo '<TR><TH colspan=2>'.msg('post_rel_cparcial');

echo '<TR><TD>';
echo $pb->mostar_dados();

$ok = 1;
	
if ($ok == 1)
	{
		$protocolo = $pb->pb_protocolo;
		$orientado = $pb->pb_professor_nome;
		$estudante = $pb->pb_est_nome;
		$titulo = $pb->pb_titulo_plano;
		$data = date("d/m/Y");
		$hora = date("H:i:s");
		$modalidade = $pb->pb_tipo_nome;
		
		$icr = $ic->ic('PIBIC_CPPAC');
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

		echo '<BR><BR><Center>
			<font color=green>Relatório Parcial entregue com sucesso!</font>
			<BR><BR>
			Foi enviado um e-mail com a confirmação de entrega do relatório.';

				
		$ml = enviaremail('pibicpr@pucpr.br','',$it.'-'.$protocolo,$ic);
		if (strlen($email_1) > 0) { $ml = enviaremail($email_1,'',$it.'-'.$protocolo,$ic); echo '<BR>'.msg('send_to').' '.$email_1; }
		if (strlen($email_2) > 0) { $ml = enviaremail($email_2,'',$it.'-'.$protocolo,$ic); echo '<BR>'.msg('send_to').' '.$email_2; }
		
		echo '<BR><BR><form action="main.php">';
		echo '<input type="submit" value="'.msg('voltar').'" name="volta">'; 
		echo '</form>';
		
		$sql = "update ".$pb->tabela." ";
		$sql .= " set pb_relatorio_parcial_correcao = ".date("Ymd")." ";
		$sql .= " , pb_relatorio_parcial_correcao_nota = 0 ";
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
