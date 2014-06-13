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
	echo $conteudo;

	
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
						case '00036':
							/* Prof. Escola de Saúde */
							$doc = new docentes;
							$emails = $doc->docentes_email_escola('00010',$emails);
							break;
						case '00008':
							/* Coordenadores */
							$emails = $clx->ppg_coordenadores_email($emails);
							break;
						case '00009':
							/* Prof. Escola de Saúde */
							$emails = $clx->ppg_secretaria_email($emails);
							break;
						case '00017':
							/* Pesquisa básicas */
							break;						
						case '00037':
							/* Prof. Escola de Saúde */
							array_push($emails,'renefgj@gmail.com;Rene Faustino Gabriel Junior');
							array_push($emails,'pdi@pucpr.br;Observatório PD&I');
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
					$clx->email_gera_fila_envio($titulo,$conteudo,$emails);
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