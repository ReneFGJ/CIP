<?
require("cab_fomento.php");
require('../_class/_class_fomento.php');

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_email.php');

	$clx = new fomento;
	$clx->le($dd[0]);
	
	echo '<A HREF="chamadas.php" class="submit-geral">VOLTAR</A>';
	
	$conteudo = $clx->mostra();
	$titulo = $clx->titulo;
	echo $conteudo;
		
	echo '<form>';
	echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
	echo '<input type="hidden" name="dd1" value="1">';
	echo '<input type="submit" name="acao" value="Confirmar Envio da Comunicação" class="submit-geral">';
	echo '</form>';
	
	if ((strlen($acao) > 0) and ($dd[1] == '1'))
		{
			$sql = "select * from fomento_categorizacao where catp_produto = '".strzero($dd[0],7)."' ";
			$rlt = db_query($sql);
			
			$emails = array();
			
			while ($line = db_read($rlt))
				{
					$trc = $line['catp_categoria'];
					switch($trc)
						{
						case '00002':
							$emails = $clx->professores_ss($emails);
							break;
						case '00005':
							$emails = $clx->professores($emails);
							break;
						case '00010':
							$emails = $clx->alunos_ic($emails);
							break;
						
						}
				}
			$clx->email_gera_fila_envio($titulo,$conteudo,$emails);
			
			sort($emails);
			echo '===>'.count($emails);		
		}

require("../foot.php");		
?> 