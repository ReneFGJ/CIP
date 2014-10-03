<?
require("cab_fomento.php");
require('../_class/_class_fomento.php');

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_email.php');

require("../_class/_class_docentes.php");

	$clx = new fomento;
	$clx->le($dd[0]);
	
	echo '<A HREF="chamadas.php" class="submit-geral">VOLTAR</A>';
	
	$conteudo = $clx->mostra();
	$titulo = $clx->titulo;
	$titulo_email = $clx->titulo_email;
	echo $conteudo;

	$doc = new docentes;
	
	if ((strlen($acao) > 0) and ($dd[1] == '1'))
		{
			$sql = "select * from fomento_categorizacao 
						where catp_produto = '".strzero($dd[0],7)."' ";
			$rlt = db_query($sql);
			
			$emails = array();
			array_push($emails,'pdi@pucpr.br;Observatório PD&I');
			
			while ($xline = db_read($rlt))
				{
					$trc = trim($xline['catp_categoria']);
					echo '<BR>Processando '.$trc;
					switch($trc)
						{
						case '00002':
							$emails = $clx->professores_ss($emails);
							break;
						case '00003':
							$emails = $clx->professores_dr($emails);
							break;							
						case '00005':
							$emails = $clx->professores($emails);
							break;
						case '00010':
							$emails = $clx->alunos_ic($emails);
							break;
						case '00008':
							/* Coordenadores */
							$emails = $clx->ppg_coordenadores_email($emails);
							break;
						case '00009':
							/* Prof. Escola de Saúde */
							$emails = $clx->ppg_secretaria_email($emails);
							break;
						/* Escolas */
						case '00036':
							/* Prof. Escola de Saúde */
							$emails = $doc->docentes_email_escola('00010',$emails);
							break;
						case '00037':
							/* Prof. Escola de Saúde */
							array_push($emails,'pdi@pucpr.br;Observatorio PD&I');
							break;							
						case '00038':
							/* Prof. Escola Politécnica */
							$emails = $doc->docentes_email_escola('00009',$emails);
							break;														
						case '00039':
							/* Prof. Escola Arquitetura e Desgin */
							$emails = $doc->docentes_email_escola('00001',$emails);
							break;														
						case '00040':
							/* Prof. Escola Arquitetura e Desgin */
							$emails = $doc->docentes_email_escola('00003',$emails);
							break;														
						case '00041':
							/* Prof. Escola Comunicação e Artes */
							$emails = $doc->docentes_email_escola('00004',$emails);
							break;														
						case '00042':
							/* Prof. Escola de Direito */
							$emails = $doc->docentes_email_escola('00005',$emails);
							break;														
						case '00043':
							/* Prof. Escola de Humanidades */
							$emails = $doc->docentes_email_escola('00006',$emails);
							break;														
						case '00044':
							/* Prof. Escola de Medicina */
							$emails = $doc->docentes_email_escola('00007',$emails);
							break;														
						case '00045':
							/* Prof. Escola de Negócios */
							$emails = $doc->docentes_email_escola('00045',$emails);
							break;														
						default:
							echo '<BR>=xx=>'.$trc;
							echo '<font color="red">Regra de seleção não implementada</font>';
							exit;
						}
				}
			echo '<BR>';
			echo '<BR>Gerando fila para enviar e-mail';
			
			
			if (count($emails) > 0)
				{
					echo '<BR>Adicionando...'.count($emails).' emails<BR>';
					$clx->email_gera_fila_envio($titulo,$conteudo,$emails,$titulo_email);
					$clx->modificar_data_envio($dd[0]);
				}
				
		} else {
			echo '<form>';
			echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
			echo '<input type="hidden" name="dd1" value="1">';
			echo '<input type="submit" name="acao" value="Confirmar Envio da Comunicação" class="submit-geral">';
			echo '</form>';
		}

require("../foot.php");		
?> 