<?php
if (strlen($dd[10]) == 0) { $dd[10] = trim($bon->beneficiario);}
require_once("../_class/_class_discentes.php");
$dis = new discentes;
$pag = 1;

if (strlen($dd[10]) > 0)
	{
		$dis->consulta($dd[10]);
		if ($dis->le('',$dd[10]) == 1)
			{

				if ((strlen($dd[11]) > 0) and (strlen($dd[12]) > 0) and (strlen($dd[13]) > 0))
					{
						$professor = $bon->professor;
						$aluno = $bon->beneficiario;
						$ano = $dd[11];
						$modalidade = $dd[12];
						$programa = $dd[13];
						$doc->cadastrar_orientacao($professor,$aluno,$ano,$modalidade,$programa);
					}
				
				$dados_discente = $dis->mostra_dados_pessoais();
				$discente = $dd[10]; 
				
				$sql = "update bonificacao set bn_beneficiario = '".$discente."' where id_bn = ".round($dd[0]);
				$rlt = db_query($sql);

				$dis->orientador_da_discente($discente);
				$erro02 = 0;
				if ($dis->ss_ano_entrada > 2000)
					{
						if ($dis->ss_ano_saida > 2000)
							{
								$entrada .= '<font class="erro2"><font color="red">Estudante já titulado em '.$dis->ss_ano_saida.'</font>';
								$erro02 = 1;
							} else {
								$entrada .= 'Entrada no programa em <B>'.$dis->ss_ano_entrada.'</B> na modalidade <B>'.$dis->ss_modalidade_nome.'</B>';
								$entrada .= '<input type="hidden" name="dd11" value="'.$dis->ss_ano_entrada.'">'.chr(13);
								$entrada .= '<input type="hidden" name="dd12" value="'.$dis->ss_modalidade.'">'.chr(13);
								$entrada .= '<input type="hidden" name="dd13" value="'.$dis->ss_programa.'">'.chr(13);
							}
						
					} else {				
						$entrada = 'Entrada no programa em <select name="dd11"><option value="">::ano::</option>'.chr(13);
						for ($r=date("Y");$r > (date("Y")-6);$r--)
							{
								$entrada .= '<option value="'.$r.'">'.$r.'</option>'.chr(13);
							}
						$entrada .= '</select>';
						
						$entrada .= '<BR>Modalidade ';
						$entrada .= '<select name="dd12">';
						$entrada .= '<option value="">::Modalide::</option>';
						$entrada .= '<option value="D">Doutorado</option>';
						$entrada .= '<option value="M">Mestrado</option>';
						$entrada .= '</select>';
						
						$entrada .= '<BR>Programa ';
						$entrada .= '<select name="dd13">';
						$sql = "select * from programa_pos_docentes 
								inner join programa_pos on pdce_programa = pos_codigo
								where pdce_ano_saida < 2000 and pdce_docente = '".$bon->professor."'";
						
						$rlt = db_query($sql);
						while ($line = db_read($rlt))
							{
								$check = '';
								$entrada .= '<option value="'.$line['pos_codigo'].'" '.$check.'>'.trim($line['pos_nome']).'</option>';								
							}
						
						$entrada .= '</select>';						
					} 
			} else {
				$msg_erro = '<font color="red">Código inválido</font>';
			}
	}
if ((strlen($discente) > 0)) { $pag++; }
echo $pos->show($pag,3,array('1','2'));
?>
<table width="100%" class="lt1">
	<TR><TD colspan=5 class="lt3"><h3>Solicitação de Isenção de Aluno de Pós-Graduação</h3></TR>
		
	<TR><TD>
		<table width="100%" class="lt1">
			<TR valign="top"><TD width="100"><CENTER><font style="font-size: 25px;">1º</font><BR>ETAPA</TD>
				<TD><B>Identificação do estudante</B>
					Informar o código do estudante que ira receber a isenção, conforme ato normativo.
					<form method="get" action="<?php echo page();?>">
						Código do estudante <input type="text" size=10 name="dd10" maxlength="12" value="<?php echo $dd[10];?>"> Ex:101<B><font color=red>88112233</font></B>1 (informe somente os 8 digitos)
						<input type="hidden" name="dd0" value="<?php echo $dd[0];?>">
						<input type="hidden" name="dd1" value="<?php echo $dd[1];?>">
						<input type="hidden" name="dd90" value="<?php echo $dd[90];?>">
						<BR><input type="submit" name="acao" value="indicar >>" />
					</form>
					<?php echo $msg_erro; ?>
				</TD>
			</TR>		
		
			<?php 
			/** Pase 2 - Discente foi inserido **/
			if ((strlen($discente) > 0)) { ?>
			<TR valign="top"><TD width="100"><CENTER><font style="font-size: 25px;">2º</font><BR>ETAPA</TD>
				<TD><B>Confirmação dos dados do estudante.</B>
					<form method="get" action="<?php echo page();?>">
						<?php echo $dados_discente; ?>
						<input type="hidden" name="dd0" value="<?php echo $dd[0];?>">
						<input type="hidden" name="dd10" value="<?php echo $dd[10];?>">
						<input type="hidden" name="dd12" value="1">
						<input type="hidden" name="dd1" value="<?php echo $dd[1];?>">
						<input type="hidden" name="dd90" value="<?php echo $dd[90];?>">
						<BR> 
							<?php echo $entrada; ?>
						<? if ($erro02 == 0) { echo '<BR><input type="submit" name="acao" value="confirmar indicação >>" />'; } ?>
					</form>
				</TD>
			</TR>		
			<?php }
			$link = "javascript:newxy2('isencao_pdf.php?dd0=".$dd[0]."&dd90=".$dd[90]."',600,600);";
			/** Pase 3 - Gerar Termo **/
			
			if ((strlen($discente) > 0) and (strlen($dd[12]) > 0)) { ?>
			<TR valign="top"><TD width="100"><CENTER><font style="font-size: 25px;">3º</font><BR>ETAPA</TD>
				<TD><B>Geração e impressão do Termo de Isenção.</B>
				<BR><img src="../img/icone_pdf.gif">
					Clique <A href="<?php echo $link;?>">aqui</A> para impimir o termo de isenção, solicitando a assinatura do estudante, coordenador do programa e do professor orietador.
			<TR><TD>&nbsp;</TD></TR>
			<? }
			
			
			if ((strlen($discente) > 0) and (strlen($dd[12]) > 0)) { ?>
			<TR valign="top"><TD width="100"><CENTER><font style="font-size: 25px;">4º</font><BR>ETAPA</TD>
				<TD><B>Postar documento assinado</B>
				<BR>Digitalize o documento com as assiaturas e faça <I>upload</I> no sistema, preferencialmente em formato PDF.
				<TR><TD></TD><TD>
			<?
				$ged->protocol = $bon->protocolo;
				$ged->file_type = 'TIS';
				echo $ged->filelist();
				echo $ged->upload_botton_with_type($bon->protocolo,'','TIS');					
			 } 
			 
			 IF ($ged->total_files > 0)
			 	{
			 		echo '<BR>
					<TR valign="top"><TD width="100"><CENTER><font style="font-size: 25px;">5º</font><BR>ETAPA</TD>
						<TD><B>Finalizar solicitação</B>';
					?>
					<form method="get" action="<?php echo page();?>">
						<input type="hidden" name="dd0" value="<?php echo $dd[0];?>">
						<input type="hidden" name="dd10" value="<?php echo $dd[10];?>">
						<input type="hidden" name="dd12" value="1">
						<input type="hidden" name="dd13" value="1">
						<input type="hidden" name="dd1" value="<?php echo $dd[1];?>">
						<input type="hidden" name="dd90" value="<?php echo $dd[90];?>">
						<BR>
						<input type="submit" name="acao" value="finalizar indicação" style="width: 300px; height:30px;" /> 
					</form>
					<?		
					
					if ($dd[13] == '1')
						{
							require("../cip/_email.php");
							/* Envia e-mail */
							$historico = 'Solicitação de isenção de estudante';
							$bon->historico_inserir($bon->protocolo,'SIN',$historico);
							$bon->isencoes_solicitar();
							$doc->le($bon->professor);
							$email1 = $doc->pp_email;
							$email2 = $doc->pp_email_1;
							echo '----FIM---';
							exit;
							$texto = msg("email_fim_isencao");
							$texto .= $dados_discente;
							$texto = troca($texto,'$orientador',$doc->pp_nome);
							$texto = troca($texto,'$protocolo',$bon->protocolo);
							enviaremail('renefgj@gmail.com','','Isenção de Estudante Stricto Sensu',$texto);
							enviaremail('cip@pucr.br','','Isenção de Estudante Stricto Sensu',$texto);
							
							
							for ($r=0;$r < count($emails_isencao);$r++)
								{
									enviaremail($emails_isencao[$r],'','Isenção de Estudante Stricto Sensu',$texto);
								}
							
							if (strlen($email1) > 0) { enviaremail($email1,'','Isenção para Estudante Stricto Sensu',$texto); }
							if (strlen($email2) > 0) { enviaremail($email2,'','Isenção para Estudante Stricto Sensu',$texto); }
							
							echo 'email enviado';
							
							echo '<center><font color="green">';
							echo 'Solicitação efetivada com sucesso!';
							exit;
							/* Altera Status */
							/* Redireciona página */
						}				
			 		
			 	}
			 ?>
	</TD></TR>
	
</table>
