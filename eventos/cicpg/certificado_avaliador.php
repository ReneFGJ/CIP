<?php
$av = trim($dd[15]);
$jid = 85;
if (strlen($av) > 0)
	{
		//$av = 'lucia.maziero@gmail.com';
		$sql = "select * from pareceristas where us_email = '".$av."' 
				and us_journal_id = $jid
		";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
				$nome = trim($line['us_nome']);
				$idc = $line['id_us'];
				$codigo = $line['us_codigo'];
				
				/* Valida avaliações */
				$total = 0;
				$sql = "select count(*) as total from semic_parecer_2014 where pp_avaliador = '$codigo' and (pp_status <> '@' and pp_status <> 'X')";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$total = $line['total'];
					}
				
				if ($total > 0)
					{
					$link = '<A HREF="http://www2.pucpr.br/reol/eventos/cicpg/declaracao_avaliador.php?dd0='.$idc.'&dd90='.md5($idc.'2014').'" 
							class="botao_certificado" target="_new"
					>';
					$link .= 'Imprimir declaração de avaliador';
					$link .= '</A>';
					$tela = $link.$tela;
					} else {
						$tela = '<font color="red">Não foi localizado avaliações deste e-mail, consulte a administração por meio do e-mail pibicpr@pucpr.br</font>'.$tela;
					}				
			} else {
						$tela = '<font color="red">E-mail não localizado, consulte a administração por meio do e-mail pibicpr@pucpr.br</font>'.$tela;				
			}
	}
?>