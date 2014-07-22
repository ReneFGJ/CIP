<?php
class survey
	{
		var $nome;
		var $cracha;
		var $id;
		var $status;
		
	function lista($tp='')
		{
			global $email_adm, $admin_nome,$dd;
			
			$ic = new ic;
			$wh = '';
			if ($tp=='1')
			{
				$wh = " where surv_0x = 'SIM' ";
			}
			$sql = "select * from csf_survey 
					left join ajax_pais on pais_codigo = surv_pais
					$wh
					order by surv_nome, surv_cracha ";
			$rlt = db_query($sql);

			$xcra = 'x';
			$sx = '<table width="900">';
			$id=0;
			while ($line=db_read($rlt))
			 	{
			 		$id++;
			 		$link = 'survey_ver.php?dd0='.$line['id_surv'];
					$link = '<A HREF="'.$link.'" target="new'.$line['id_surv'].'">';
			 		$sx .= '<TR><TD>';
					$sx .= $link;
			 		$sx .= $line['surv_nome'];
					$sx .= '</A>';
					$sx .= '<TD>';
					$sx .= $line['surv_status'];
					$sx .= '<TD>';
					$sx .= $line['surv_universidade'];
					$sx .= '<TD>';
					$sx .= $line['pais_nome'];
			 	}
			$sx .= '<TR><TD colspan=10>Total '.$id;
			$sx .= '</table>';
			return($sx);			

		}		
		
	function mostra()
		{
			$line = $this->line;
			$cps = array($this->cp_01(),$this->cp_02(),$this->cp_03(),$this->cp_04());
			for ($y=0;$y < count($cps);$y++)
			{
			$cp = $cps[$y];
			for ($r=0;$r < count($cp);$r++)
				{
					$field = $cp[$r][1];
					$vlr = trim($line[$field]);
					
					if ((strlen($vlr) > 0) and (strlen($cp[$r][2])) > 0)
						{
						echo $cp[$r][2];
						//echo ' ('.$field.')';
						echo '<BR><B>';
						if (substr($cp[$r][0],0,2)=='$D')
							{
								echo stodbr($vlr);
							} else {
								echo mst($vlr);		
							}
						
						echo '</B>';
						echo '<HR>';
						}
				}
			}
		}
		
	function le($id)
		{
			$sql = "select * from csf_survey
					left join pibic_aluno on surv_cracha = pa_cracha 
					where id_surv = ".round($id);
			$rlt = db_query($sql);		
			if ($line = db_read($rlt))
			{
				$this->line = $line;
				$this->nome = trim($line['surv_nome']);
				$this->cracha = trim($line['surv_cracha']);
				$this->id = $line['id_surv'];
				$this->status = trim($line['surv_status']);
			}
		}
	function enviar_email()
		{
			global $email_adm, $admin_nome,$dd;
			
			$ic = new ic;
			$rs = $ic->ic('CSF_SURVEY');
			
			$titulo = $rs['nw_titulo'];
			$texto_original = $rs['nw_descricao'];
			
			$email_adm = 'pibicpr@pucpr.br';
			$admin_nome = 'Ciencia sem Fronteiras - PUCPR';
			
			$sql = "select * from csf_survey where surv_status = '@' order by surv_cracha ";
			$rlt = db_query($sql);
			
			$xcra = 'x';
			while ($line=db_read($rlt))
			 	{
			 		$cracha = $line['surv_cracha'];
					if ($xcra != $cracha)
					{
					$email1 = trim($line['surv_email_1']);
					$email2 = trim($line['surv_email_2']);
					$nome = trim($line['surv_nome']);
					$link = 'http://www2.pucpr.br/reol/cienciasemfronteiras/survey.php?dd0='.$line['id_surv'].'&pag=1';
					$link = '<A HREF="'.$link.'">'.$link.'</A>';
					$texto = troca($texto_original,'$link',$link);
					$texto = troca($texto,'$nome',$nome);
					$xcra = $cracha;
					enviaremail('renefgj@gmail.com','',$titulo,$texto);
					if (strlen($email1) > 0) { echo '<BR>Enviado para '.$email1; enviaremail($email1,'',$titulo,$texto); }
					if (strlen($email2) > 0) { echo '<BR>Enviado para '.$email2; enviaremail($email2,'',$titulo,$texto); }
					}
			 	}
			
			exit;
			

		}		
		
	function resumo()
		{
			$sql = "select count(*) as total, surv_status 
						from csf_survey
						group by surv_status
						";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					print_r($line);
					echo '<HR>';
				}
		}
	function busca_alunos_questionario_csf($wh,$cracha='')
		{
			$wh = " (pb_protocolo like '$wh%') ";
			if (strlen($cracha) > 0)
				{ $wh = " pa_cracha = '$cracha' "; }
				
			$sql = "select * from pibic_bolsa_contempladas
					inner join pibic_aluno on pb_aluno = pa_cracha 
					where $wh and pb_status <> 'C' ";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					$cracha = trim($line['pa_cracha']);
					$nome = trim($line['pa_nome']);
					$email = trim($line['pa_email']);
					$email2 = trim($line['pa_email_1']);
					$this->insere_participante('CSF01',$cracha,$nome,$email,$email2);
				}
		}
	function insere_participante($tipo,$cracha,$nome,$email,$email2,$reverte=0)
		{
			$data = date("Ymd");
			$sql = "select * from csf_survey where surv_cracha = '$cracha' and surv_tipo = '$tipo' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					if ($reverte == 1)
						{
							$sql = "update csf_survey 
										set 
										surv_status = '@',
										surv_email_1 = '$email1',
										surv_email_2 = '$email2'
										where id_surv = ".$line['id_surv'];
							$rlt = db_query($sql);
						}
				} else {
					$sql = "insert into csf_survey 
						(
						surv_tipo, surv_nome, surv_cracha,
						surv_email_1, surv_email_2, surv_data, 
						surv_status
						) values (
						'$tipo','$nome','$cracha',
						'$email','$email2',$data,
						'@')
					";
					$rlt = db_query($sql);
				}
			return(1);
		}
	function sctruct()
		{
			$sql = "create table csf_survey
				(
				id_surv serial not null,
				surv_data_resposta integer,
				surv_tipo char(5),
				surv_cracha char(8),
				surv_nome char(80),
				surv_email_1 char(80),
				surv_email_2 char(80),
				surv_data integer,
				surv_status char(1),
				surv_universidade char(80),
				surv_pais char(7),
				surv_area char(40),
				surv_gestao char(10),
				surv_inicio integer,
				surv_fim integer,
				surv_lingua char(3),
				surv_lingua_di integer,
				surv_linhua_df integer,
				
				surv_01 char(80),
				surv_02 char(80),
				surv_03 char(80),
				surv_04 char(80),
				surv_05 char(80),
				surv_06 char(80),
				surv_07 char(80),
				surv_08 char(80),
				surv_09 char(80),
				surv_0A char(80),
				surv_0B char(80),
				surv_0C char(80),
				surv_0D char(80),
				surv_0E char(80),
				surv_0F char(80),
				surv_0G char(80),
				surv_0H char(80),
				surv_0I char(80),
				surv_0J char(80),
				surv_0K char(80),
				surv_0L char(80),
				surv_0M char(80),
				surv_0N char(80),
				surv_0O char(80),
				surv_0P char(80),
				surv_0Q char(80),
				surv_0R char(80),
				surv_0S char(80),
				
				surv_10 text,
				surv_11 text,
				surv_12 text,
				surv_13 text,
				surv_14 text,
				surv_15 text,
				surv_16 text,
				surv_17 text,
				surv_18 text,
				surv_19 text,
				surv_1A text,
				surv_1B text,
				surv_1C text,
				surv_1D text,
				surv_1E text,
				surv_1F text
				)
			";
			$rlt = db_query($sql);
		}
	function cp_01()
		{
			global $dd,$acao;
			$cp = array();
			
			//$sql = "alter table csf_survey alter column surv_area TYPE char(80) ";
			//$rlt = db_query($sql);
			
			array_push($cp,array('$H8','id_surv','',False,True));
			//array_push($cp,array('$S8','surv_cracha','',True,True));
			//array_push($cp,array('$S200','surv_nome','',True,True));
			
			$opa = ' : ';
			$opa .= '&Engenharias e demais áreas tecnológicas:Engenharias e demais áreas tecnológicas';
			$opa .= '&Ciências Exatas e da Terra:Ciências Exatas e da Terra';
			$opa .= '&Biologia, Ciências Biomédicas e da Saúde:Biologia, Ciências Biomédicas e da Saúde';
			$opa .= '&Computação e Tecnologias da Informação:Computação e Tecnologias da Informação';
			$opa .= '&Tecnologia Aeroespacial:Tecnologia Aeroespacial';
			$opa .= '&Fármacos:Fármacos';
			$opa .= '&Produção Agrícola Sustentável:Produção Agrícola Sustentável';
			$opa .= '&Petróleo, Gás e Carvão Mineral:Petróleo, Gás e Carvão Mineral';
			$opa .= '&Energias Renováveis:Energias Renováveis';
			$opa .= '&Tecnologia Mineral:Tecnologia Mineral';
			$opa .= '&Biotecnologia:Biotecnologia';
			$opa .= '&Nanotecnologia e Novos Materiais:Nanotecnologia e Novos Materiais';
			$opa .= '&Tecnologias de Prevenção e Mitigação de Desastres Naturais:Tecnologias de Prevenção e Mitigação de Desastres Naturais';
			$opa .= '&Biodiversidade e Bioprospecção:Biodiversidade e Bioprospecção';
			$opa .= '&Ciências do Mar:Ciências do Mar';
			$opa .= '&Indústria Criativa:Indústria Criativa';
			$opa .= '&Novas Tecnologias de Engenharia Construtiva:Novas Tecnologias de Engenharia Construtiva';
			$opa .= '&Formação de Tecnólogos:Formação de Tecnólogos';
			
			array_push($cp,array('$A8','','Destino do intercâmbio',False,True));
			array_push($cp,array('$Q pais_nome:pais_codigo:select * from ajax_pais order by pais_nome','surv_pais','País de destino',True,True));
			array_push($cp,array('$S200','surv_universidade','Nome da universidade',True,True));
			
			array_push($cp,array('$A8','','Gestão da bolsa',False,True));
			array_push($cp,array('$O'.$opa,'surv_area','Área prioritária',True,True));
			array_push($cp,array('$O : &CNPq:CNPq&CAPES:CAPES','surv_gestao','Gestão',True,True));
			
			array_push($cp,array('$A8','','Vigência da bolsa (estimado)',False,True));
			
			array_push($cp,array('$D8','surv_inicio','Data de início',True,True));
			array_push($cp,array('$D8','surv_fim','Data de finalização',True,True));
			
			array_push($cp,array('$O : &SIM:SIM&NÃO:NÃO','surv_lingua','Realizou curso de idima no extrangeiro?',True,True));
			array_push($cp,array('$M8','','Se marcou "sim", informe as dados do curso de idioma',False,True));
			array_push($cp,array('$D8','surv_lingua_di','Data de início',False,True));
			array_push($cp,array('$D8','surv_linhua_df','Data de finalização',False,True));
			
			array_push($cp,array('$B8','','Salvar e continuar (1/4) >>',False,True));
						
			return($cp);
		}
		

	function cp_02()
		{
			global $dd,$acao;
			$op1 = ' :selecione uma opção';
			$op1 .= '&televisão:pela televisão';
			$op1 .= '&divulgação PUCPR:por divulgação da PUCPR';
			$op1 .= '&professor:pelo professor';
			$op1 .= '&amigo:por um amigo';
			$op1 .= '&rádio:pelo rádio';
			$op1 .= '&jornal:pelo jornal impresso';
			$op1 .= '&internet:pela internet';
			$op1 .= '&rede sociais:pelas rede sociais';
			
			$op2 = ' :selecione uma opção';
			$op2 .= '&Excelente:Excelente';
			$op2 .= '&Bom:Bom';
			$op2 .= '&Regular:Regular';
			$op2 .= '&Ruim:Ruim';
			$op2 .= '&Não utilizei:Não utilizei';
			
			$cp = array();
			array_push($cp,array('$H8','id_surv','',False,True));
			
			array_push($cp,array('$V','surv_nome','',False,False));
			
			array_push($cp,array('${','','Sobre a divulgação do Ciência sem Fronteiras (CsF)',False,True));
			array_push($cp,array('$A','','Divulgação do CsF na PUCPR',False,True));
			array_push($cp,array('$O '.$op1,'surv_01','Como ficou sabendo do programa?',True,True));
			array_push($cp,array('$}','','Sobre a divulgação do Ciência sem Fronteiras',False,True));
			
			array_push($cp,array('${','','Sobre a processo de inscrição no programa Ciência sem Fronteiras (CsF)',False,True));
			array_push($cp,array('$A','','CsF no CNPq, CAPES e Parceiros',False,True));
			array_push($cp,array('$O '.$op2,'surv_02','Inscrição no site Csf Oficial (CNPq, CAPES)',True,True));
			array_push($cp,array('$O '.$op2,'surv_03','Serviços de apoio prestados pelo CNPq, Capes e Parceiro',True,True));
			array_push($cp,array('$O '.$op2,'surv_04','Informações em relação aos documentos exigidos',True,True));
			array_push($cp,array('$T80:4','surv_10','Observações ou comentários',False,True));

			array_push($cp,array('$A','','CsF na PUCPR',False,True));
			array_push($cp,array('$O '.$op2,'surv_05','Processo de Inscrição no site CsF da PUCPR',True,True));
			array_push($cp,array('$O '.$op2,'surv_06','Serviços de apoio e orientação da PUCPR',True,True));
			array_push($cp,array('$O '.$op2,'surv_07','Informações e orientações em relação aos documentos exigidos',True,True));
			array_push($cp,array('$T80:4','surv_11','Observações ou comentários',False,True));
			array_push($cp,array('$}','','',False,True));

			array_push($cp,array('${','','Sobre a preparação pré-partida',False,True));
			array_push($cp,array('$O '.$op2,'surv_08','Serviços de apoio prestados pelo escritório internacional e Coordenação do CsF da PUCPR',True,True));
			array_push($cp,array('$O '.$op2,'surv_09','Sessões informativas de pré-partida',True,True));
			array_push($cp,array('$T80:4','surv_12','Observações ou comentários',False,True));
			array_push($cp,array('$}','','',False,True));

			array_push($cp,array('$B8','','Salvar e continuar (2/4) >>',False,True));

			return($cp);
		}
	function cp_03()
		{
			global $dd,$acao;	
			$op2 = ' :selecione uma opção';
			$op2 .= '&Excelente:Excelente';
			$op2 .= '&Bom:Bom';
			$op2 .= '&Regular:Regular';
			$op2 .= '&Ruim:Ruim';
			$op2 .= '&Não utilizei:Não utilizei';
			
			$op3 = ' :selecione uma opção';
			$op3 .= '&SIM:SIM';
			$op3 .= '&NÃO:NÃO';

			$op4 = ' :selecione uma opção';
			$op4 .= '&Verdade:Verdade';
			$op4 .= '&Falso:Falso';
			$op4 .= '&Não aplicado:Não aplicado';
			
			$op5 = ' :selecione uma opção';
			$op5 .= '&Muito:Muito';
			$op5 .= '&Não muito:Não Muito';
			$op5 .= '&Pouco:Pouco';
			
			$op6 = ' :selecione uma opção';
			$op6 .= '&Alojamento da Universidade:Alojamento da Universidade';
			$op6 .= '&Locação com outros amigos:Locação com outros amigos';
			$op6 .= '&Alojamento particular (alugado):Alojamento particular (alugado)';
			$op6 .= '&Casa de parentes/amigos:Casa de parentes/amigos';
			$op6 .= '&Outros:Outros';
			
			$cp = array();
			array_push($cp,array('$H8','id_surv','',False,True));

			array_push($cp,array('$A','','Universidade estrangeira',False,True));
			array_push($cp,array('$O '.$op2,'surv_0a','Apoio pré-partida',True,True));
			array_push($cp,array('$O '.$op2,'surv_0b','Organização',True,True));
			array_push($cp,array('$O '.$op2,'surv_0c','Programa de recepção aos alunos internacionais',True,True));
			array_push($cp,array('$O '.$op2,'surv_0d','Serviço de apoio aos alunos internacionais',True,True));
			array_push($cp,array('$O '.$op2,'surv_0e','Auxilío com a escolha das matérias',True,True));
			array_push($cp,array('$O '.$op3,'surv_0f','Contei com o apoio de um professor tutor/supervisor para a escolha das disciplinas',True,True));
			array_push($cp,array('$O '.$op2,'surv_0g','Eventos sociais e de integração',True,True));
			array_push($cp,array('$T80:4','surv_13','Observações ou comentários',False,True));
			
			array_push($cp,array('$A','','Questões Acadêmicas (apenas para os alunos que já iniciaram as atividades letivas)',False,True));
			array_push($cp,array('$O '.$op4,'surv_0h','As matérias que fiz são de grande relevância para o meu curso ou para meu desenvolvimento acadêmico',True,True));
			array_push($cp,array('$O '.$op4,'surv_0i','A maioria das matérias poderão ser aproveitadas no meu curso atual',True,True));
			array_push($cp,array('$O '.$op5,'surv_0j','O quanto você considera que a barreira da lingua impactou a sua per performace acadêmica?',True,True));
			array_push($cp,array('$O '.$op4,'surv_0k','A minha experiência faz com que eu deseje continuar meus estudos em nível de pós-graduação (mestrado)',True,True));
			array_push($cp,array('$T80:4','surv_14','Observações ou comentários',False,True));

			array_push($cp,array('$A','','Curso de idioma',False,True));
			array_push($cp,array('$O '.$op2,'surv_0l','Minha performace no curso de idioma está sendo',True,True));
			array_push($cp,array('$O '.$op2,'surv_0m','Performace dos professores',True,True));
			array_push($cp,array('$O '.$op2,'surv_0n','Qualidade geral do curso',True,True));
			array_push($cp,array('$T80:4','surv_15','Observações ou comentários',False,True));
			
			array_push($cp,array('$A','','Acomodações',False,True));
			array_push($cp,array('$O '.$op6,'surv_0o','Acomodação',True,True));
			array_push($cp,array('$O '.$op2,'surv_0p','Localização',True,True));
			array_push($cp,array('$O '.$op2,'surv_0q','Processos de inscrição e reserva',True,True));
			array_push($cp,array('$O '.$op2,'surv_0r','Quartos',True,True));
			array_push($cp,array('$O '.$op2,'surv_0s','Serviços',True,True));
			array_push($cp,array('$T80:4','surv_16','Observações ou comentários',False,True));

			array_push($cp,array('$B8','','Salvar e continuar (3/4) >>',False,True));
			
			return($cp);			
		}	
	function cp_04()
		{
			global $dd,$acao;	
			$op2 = ' :selecione uma opção';
			$op2 .= '&Excelente:Excelente';
			$op2 .= '&Bom:Bom';
			$op2 .= '&Regular:Regular';
			$op2 .= '&Ruim:Ruim';
			$op2 .= '&Não utilizei:Não utilizei';
			
			$op3 = ' :selecione uma opção';
			$op3 .= '&SIM:SIM';
			$op3 .= '&NÃO:NÃO';			
			
			$op4 = ' :selecione uma opção';
			$op4 .= '&Verdade:Verdade';
			$op4 .= '&Falso:Falso';
			$op4 .= '&Não aplicado:Não aplicado';
			
			$op5 = ' :selecione uma opção';
			$op5 .= '&Muito bem, já fiz vários amigos:Muito bem, já fiz vários amigos';
			$op5 .= '&Bem, tenho alguns amigos:Bem, tenho alguns amigos';
			$op5 .= '&Bem:Bem';
			$op5 .= '&Razoável, tenho poucos amigos:Razoável, tenho poucos amigos';
			$op5 .= '&Ruim:Ruim';
			
			$cp = array();
			
			array_push($cp,array('$H8','id_surv','',False,True));
			
			array_push($cp,array('$A','','Questões financeiras',False,True));
			array_push($cp,array('$O '.$op3,'surv_0t','O valor da bolsa é/foi apropriado para minha manutenção',True,True));
			array_push($cp,array('$O '.$op3,'surv_0u','O pagamento da bolsa foi realizado de acordo com o cronograma',True,True));
			array_push($cp,array('$O '.$op3,'surv_0v','Precisei de recursos adicionais de familiares para me manter no programa',True,True));
			array_push($cp,array('$T80:4','surv_17','Observações ou comentários',False,True));			

			array_push($cp,array('$A','','Questões emocionais',False,True));
			array_push($cp,array('$O '.$op5,'surv_0w','Como você está se sentindo durante seu intercâmbio',True,True));
			array_push($cp,array('$O '.$op3,'surv_0x','A maneira que você se sente afeta sua performace acadêmica',True,True));
			array_push($cp,array('$T80:4','surv_18','Se respondeu "SIM" na questão anterior, explique como',False,True));			

			array_push($cp,array('$A','','Sobre o programa no geral',False,True));
			array_push($cp,array('$O '.$op2,'surv_0y','Qual a sua avaliação de todos os aspectos do intercâmbio até agora?',True,True));
			array_push($cp,array('$T80:4','surv_19','Complemente a sua resposta acima com exemplos dos aspectos que você gostaria que melhorassem até o final do seu intercâmbio',False,True));			

			array_push($cp,array('$A','','Contatos',False,True));
			array_push($cp,array('$T80:4','surv_1a','Informe seu endereço no exterior (rua, cidade, caixa-postal)',True,True));			
			array_push($cp,array('$T80:4','surv_1b','Contato do escritório internacional da Universidade destino (nome da pessoa de contato, telefone, e-mail, endereço)',True,True));			
			array_push($cp,array('$T80:4','surv_1c','Informe seu endereço no Brasil (rua, cidade, caixa-postal)',True,True));
			
			array_push($cp,array('$B8','','Salvar e continuar (4/4) >>',False,True));
									
						
			return($cp);
		}	
	function finish()
		{
			global $email_adm, $admin_nome,$dd;
			
			$ic = new ic;
			$rs = $ic->ic('CSF_SURVEY_FIM');
			
			$titulo = $rs['nw_titulo'];
			$texto = $rs['nw_descricao'];
			
			$email_adm = 'pibicpr@pucpr.br';
			$admin_nome = 'Ciencia sem Fronteiras - PUCPR';
			
			$sql = "select * from csf_survey where id_surv = ".$dd[0];
			$rlt = db_query($sql);
			 if ($line=db_read($rlt))
			 	{
					$nome = trim($line['surv_nome']);
			 	}
			
			$texto = troca($texto,'$link',$link);
			$texto = troca($texto,'$nome',$nome);
			
			echo '<p>'.$texto.'</P>';
			
			$sql = "update csf_survey set surv_status = 'A' where id_surv = ".$dd[0];
			$rlt = db_query($sql);
			
			echo 'enviando confirmação para '.$email_adm;
						
			enviaremail('renefgj@gmail.com','',$titulo,$texto);
			enviaremail('pibicpr@pucpr.br','',$titulo,$texto);

			redirecina('survey_finish.php?dd0='.$dd[0]);
			//enviaremail($admin_email,'',$titulo,$text);
			return($cp);
		}		
	}
?>

