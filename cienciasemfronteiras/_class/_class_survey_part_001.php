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
			$opa .= '&Engenharias e demais �reas tecnol�gicas:Engenharias e demais �reas tecnol�gicas';
			$opa .= '&Ci�ncias Exatas e da Terra:Ci�ncias Exatas e da Terra';
			$opa .= '&Biologia, Ci�ncias Biom�dicas e da Sa�de:Biologia, Ci�ncias Biom�dicas e da Sa�de';
			$opa .= '&Computa��o e Tecnologias da Informa��o:Computa��o e Tecnologias da Informa��o';
			$opa .= '&Tecnologia Aeroespacial:Tecnologia Aeroespacial';
			$opa .= '&F�rmacos:F�rmacos';
			$opa .= '&Produ��o Agr�cola Sustent�vel:Produ��o Agr�cola Sustent�vel';
			$opa .= '&Petr�leo, G�s e Carv�o Mineral:Petr�leo, G�s e Carv�o Mineral';
			$opa .= '&Energias Renov�veis:Energias Renov�veis';
			$opa .= '&Tecnologia Mineral:Tecnologia Mineral';
			$opa .= '&Biotecnologia:Biotecnologia';
			$opa .= '&Nanotecnologia e Novos Materiais:Nanotecnologia e Novos Materiais';
			$opa .= '&Tecnologias de Preven��o e Mitiga��o de Desastres Naturais:Tecnologias de Preven��o e Mitiga��o de Desastres Naturais';
			$opa .= '&Biodiversidade e Bioprospec��o:Biodiversidade e Bioprospec��o';
			$opa .= '&Ci�ncias do Mar:Ci�ncias do Mar';
			$opa .= '&Ind�stria Criativa:Ind�stria Criativa';
			$opa .= '&Novas Tecnologias de Engenharia Construtiva:Novas Tecnologias de Engenharia Construtiva';
			$opa .= '&Forma��o de Tecn�logos:Forma��o de Tecn�logos';
			
			array_push($cp,array('$A8','','Destino do interc�mbio',False,True));
			array_push($cp,array('$Q pais_nome:pais_codigo:select * from ajax_pais order by pais_nome','surv_pais','Pa�s de destino',True,True));
			array_push($cp,array('$S200','surv_universidade','Nome da universidade',True,True));
			
			array_push($cp,array('$A8','','Gest�o da bolsa',False,True));
			array_push($cp,array('$O'.$opa,'surv_area','�rea priorit�ria',True,True));
			array_push($cp,array('$O : &CNPq:CNPq&CAPES:CAPES','surv_gestao','Gest�o',True,True));
			
			array_push($cp,array('$A8','','Vig�ncia da bolsa (estimado)',False,True));
			
			array_push($cp,array('$D8','surv_inicio','Data de in�cio',True,True));
			array_push($cp,array('$D8','surv_fim','Data de finaliza��o',True,True));
			
			array_push($cp,array('$O : &SIM:SIM&N�O:N�O','surv_lingua','Realizou curso de idima no extrangeiro?',True,True));
			array_push($cp,array('$M8','','Se marcou "sim", informe as dados do curso de idioma',False,True));
			array_push($cp,array('$D8','surv_lingua_di','Data de in�cio',False,True));
			array_push($cp,array('$D8','surv_linhua_df','Data de finaliza��o',False,True));
			
			array_push($cp,array('$B8','','Salvar e continuar (1/4) >>',False,True));
						
			return($cp);
		}
		

	function cp_02()
		{
			global $dd,$acao;
			$op1 = ' :selecione uma op��o';
			$op1 .= '&televis�o:pela televis�o';
			$op1 .= '&divulga��o PUCPR:por divulga��o da PUCPR';
			$op1 .= '&professor:pelo professor';
			$op1 .= '&amigo:por um amigo';
			$op1 .= '&r�dio:pelo r�dio';
			$op1 .= '&jornal:pelo jornal impresso';
			$op1 .= '&internet:pela internet';
			$op1 .= '&rede sociais:pelas rede sociais';
			
			$op2 = ' :selecione uma op��o';
			$op2 .= '&Excelente:Excelente';
			$op2 .= '&Bom:Bom';
			$op2 .= '&Regular:Regular';
			$op2 .= '&Ruim:Ruim';
			$op2 .= '&N�o utilizei:N�o utilizei';
			
			$cp = array();
			array_push($cp,array('$H8','id_surv','',False,True));
			
			array_push($cp,array('$V','surv_nome','',False,False));
			
			array_push($cp,array('${','','Sobre a divulga��o do Ci�ncia sem Fronteiras (CsF)',False,True));
			array_push($cp,array('$A','','Divulga��o do CsF na PUCPR',False,True));
			array_push($cp,array('$O '.$op1,'surv_01','Como ficou sabendo do programa?',True,True));
			array_push($cp,array('$}','','Sobre a divulga��o do Ci�ncia sem Fronteiras',False,True));
			
			array_push($cp,array('${','','Sobre a processo de inscri��o no programa Ci�ncia sem Fronteiras (CsF)',False,True));
			array_push($cp,array('$A','','CsF no CNPq, CAPES e Parceiros',False,True));
			array_push($cp,array('$O '.$op2,'surv_02','Inscri��o no site Csf Oficial (CNPq, CAPES)',True,True));
			array_push($cp,array('$O '.$op2,'surv_03','Servi�os de apoio prestados pelo CNPq, Capes e Parceiro',True,True));
			array_push($cp,array('$O '.$op2,'surv_04','Informa��es em rela��o aos documentos exigidos',True,True));
			array_push($cp,array('$T80:4','surv_10','Observa��es ou coment�rios',False,True));

			array_push($cp,array('$A','','CsF na PUCPR',False,True));
			array_push($cp,array('$O '.$op2,'surv_05','Processo de Inscri��o no site CsF da PUCPR',True,True));
			array_push($cp,array('$O '.$op2,'surv_06','Servi�os de apoio e orienta��o da PUCPR',True,True));
			array_push($cp,array('$O '.$op2,'surv_07','Informa��es e orienta��es em rela��o aos documentos exigidos',True,True));
			array_push($cp,array('$T80:4','surv_11','Observa��es ou coment�rios',False,True));
			array_push($cp,array('$}','','',False,True));

			array_push($cp,array('${','','Sobre a prepara��o pr�-partida',False,True));
			array_push($cp,array('$O '.$op2,'surv_08','Servi�os de apoio prestados pelo escrit�rio internacional e Coordena��o do CsF da PUCPR',True,True));
			array_push($cp,array('$O '.$op2,'surv_09','Sess�es informativas de pr�-partida',True,True));
			array_push($cp,array('$T80:4','surv_12','Observa��es ou coment�rios',False,True));
			array_push($cp,array('$}','','',False,True));

			array_push($cp,array('$B8','','Salvar e continuar (2/4) >>',False,True));

			return($cp);
		}
	function cp_03()
		{
			global $dd,$acao;	
			$op2 = ' :selecione uma op��o';
			$op2 .= '&Excelente:Excelente';
			$op2 .= '&Bom:Bom';
			$op2 .= '&Regular:Regular';
			$op2 .= '&Ruim:Ruim';
			$op2 .= '&N�o utilizei:N�o utilizei';
			
			$op3 = ' :selecione uma op��o';
			$op3 .= '&SIM:SIM';
			$op3 .= '&N�O:N�O';

			$op4 = ' :selecione uma op��o';
			$op4 .= '&Verdade:Verdade';
			$op4 .= '&Falso:Falso';
			$op4 .= '&N�o aplicado:N�o aplicado';
			
			$op5 = ' :selecione uma op��o';
			$op5 .= '&Muito:Muito';
			$op5 .= '&N�o muito:N�o Muito';
			$op5 .= '&Pouco:Pouco';
			
			$op6 = ' :selecione uma op��o';
			$op6 .= '&Alojamento da Universidade:Alojamento da Universidade';
			$op6 .= '&Loca��o com outros amigos:Loca��o com outros amigos';
			$op6 .= '&Alojamento particular (alugado):Alojamento particular (alugado)';
			$op6 .= '&Casa de parentes/amigos:Casa de parentes/amigos';
			$op6 .= '&Outros:Outros';
			
			$cp = array();
			array_push($cp,array('$H8','id_surv','',False,True));

			array_push($cp,array('$A','','Universidade estrangeira',False,True));
			array_push($cp,array('$O '.$op2,'surv_0a','Apoio pr�-partida',True,True));
			array_push($cp,array('$O '.$op2,'surv_0b','Organiza��o',True,True));
			array_push($cp,array('$O '.$op2,'surv_0c','Programa de recep��o aos alunos internacionais',True,True));
			array_push($cp,array('$O '.$op2,'surv_0d','Servi�o de apoio aos alunos internacionais',True,True));
			array_push($cp,array('$O '.$op2,'surv_0e','Auxil�o com a escolha das mat�rias',True,True));
			array_push($cp,array('$O '.$op3,'surv_0f','Contei com o apoio de um professor tutor/supervisor para a escolha das disciplinas',True,True));
			array_push($cp,array('$O '.$op2,'surv_0g','Eventos sociais e de integra��o',True,True));
			array_push($cp,array('$T80:4','surv_13','Observa��es ou coment�rios',False,True));
			
			array_push($cp,array('$A','','Quest�es Acad�micas (apenas para os alunos que j� iniciaram as atividades letivas)',False,True));
			array_push($cp,array('$O '.$op4,'surv_0h','As mat�rias que fiz s�o de grande relev�ncia para o meu curso ou para meu desenvolvimento acad�mico',True,True));
			array_push($cp,array('$O '.$op4,'surv_0i','A maioria das mat�rias poder�o ser aproveitadas no meu curso atual',True,True));
			array_push($cp,array('$O '.$op5,'surv_0j','O quanto voc� considera que a barreira da lingua impactou a sua per performace acad�mica?',True,True));
			array_push($cp,array('$O '.$op4,'surv_0k','A minha experi�ncia faz com que eu deseje continuar meus estudos em n�vel de p�s-gradua��o (mestrado)',True,True));
			array_push($cp,array('$T80:4','surv_14','Observa��es ou coment�rios',False,True));

			array_push($cp,array('$A','','Curso de idioma',False,True));
			array_push($cp,array('$O '.$op2,'surv_0l','Minha performace no curso de idioma est� sendo',True,True));
			array_push($cp,array('$O '.$op2,'surv_0m','Performace dos professores',True,True));
			array_push($cp,array('$O '.$op2,'surv_0n','Qualidade geral do curso',True,True));
			array_push($cp,array('$T80:4','surv_15','Observa��es ou coment�rios',False,True));
			
			array_push($cp,array('$A','','Acomoda��es',False,True));
			array_push($cp,array('$O '.$op6,'surv_0o','Acomoda��o',True,True));
			array_push($cp,array('$O '.$op2,'surv_0p','Localiza��o',True,True));
			array_push($cp,array('$O '.$op2,'surv_0q','Processos de inscri��o e reserva',True,True));
			array_push($cp,array('$O '.$op2,'surv_0r','Quartos',True,True));
			array_push($cp,array('$O '.$op2,'surv_0s','Servi�os',True,True));
			array_push($cp,array('$T80:4','surv_16','Observa��es ou coment�rios',False,True));

			array_push($cp,array('$B8','','Salvar e continuar (3/4) >>',False,True));
			
			return($cp);			
		}	
	function cp_04()
		{
			global $dd,$acao;	
			$op2 = ' :selecione uma op��o';
			$op2 .= '&Excelente:Excelente';
			$op2 .= '&Bom:Bom';
			$op2 .= '&Regular:Regular';
			$op2 .= '&Ruim:Ruim';
			$op2 .= '&N�o utilizei:N�o utilizei';
			
			$op3 = ' :selecione uma op��o';
			$op3 .= '&SIM:SIM';
			$op3 .= '&N�O:N�O';			
			
			$op4 = ' :selecione uma op��o';
			$op4 .= '&Verdade:Verdade';
			$op4 .= '&Falso:Falso';
			$op4 .= '&N�o aplicado:N�o aplicado';
			
			$op5 = ' :selecione uma op��o';
			$op5 .= '&Muito bem, j� fiz v�rios amigos:Muito bem, j� fiz v�rios amigos';
			$op5 .= '&Bem, tenho alguns amigos:Bem, tenho alguns amigos';
			$op5 .= '&Bem:Bem';
			$op5 .= '&Razo�vel, tenho poucos amigos:Razo�vel, tenho poucos amigos';
			$op5 .= '&Ruim:Ruim';
			
			$cp = array();
			
			array_push($cp,array('$H8','id_surv','',False,True));
			
			array_push($cp,array('$A','','Quest�es financeiras',False,True));
			array_push($cp,array('$O '.$op3,'surv_0t','O valor da bolsa �/foi apropriado para minha manuten��o',True,True));
			array_push($cp,array('$O '.$op3,'surv_0u','O pagamento da bolsa foi realizado de acordo com o cronograma',True,True));
			array_push($cp,array('$O '.$op3,'surv_0v','Precisei de recursos adicionais de familiares para me manter no programa',True,True));
			array_push($cp,array('$T80:4','surv_17','Observa��es ou coment�rios',False,True));			

			array_push($cp,array('$A','','Quest�es emocionais',False,True));
			array_push($cp,array('$O '.$op5,'surv_0w','Como voc� est� se sentindo durante seu interc�mbio',True,True));
			array_push($cp,array('$O '.$op3,'surv_0x','A maneira que voc� se sente afeta sua performace acad�mica',True,True));
			array_push($cp,array('$T80:4','surv_18','Se respondeu "SIM" na quest�o anterior, explique como',False,True));			

			array_push($cp,array('$A','','Sobre o programa no geral',False,True));
			array_push($cp,array('$O '.$op2,'surv_0y','Qual a sua avalia��o de todos os aspectos do interc�mbio at� agora?',True,True));
			array_push($cp,array('$T80:4','surv_19','Complemente a sua resposta acima com exemplos dos aspectos que voc� gostaria que melhorassem at� o final do seu interc�mbio',False,True));			

			array_push($cp,array('$A','','Contatos',False,True));
			array_push($cp,array('$T80:4','surv_1a','Informe seu endere�o no exterior (rua, cidade, caixa-postal)',True,True));			
			array_push($cp,array('$T80:4','surv_1b','Contato do escrit�rio internacional da Universidade destino (nome da pessoa de contato, telefone, e-mail, endere�o)',True,True));			
			array_push($cp,array('$T80:4','surv_1c','Informe seu endere�o no Brasil (rua, cidade, caixa-postal)',True,True));
			
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
			
			echo 'enviando confirma��o para '.$email_adm;
						
			enviaremail('renefgj@gmail.com','',$titulo,$texto);
			enviaremail('pibicpr@pucpr.br','',$titulo,$texto);

			redirecina('survey_finish.php?dd0='.$dd[0]);
			//enviaremail($admin_email,'',$titulo,$text);
			return($cp);
		}		
	}
?>

