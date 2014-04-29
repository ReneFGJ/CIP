<?php
/**
* Esse arquivo contém as classes e definições do sistema de envio de editais (ver http://www2.pucpr.br/reol/fomento/index.php)
* @author Marco Kawajiri <kawajirimarco@googlemail.com>
* @version v.0.13.41
* @package fomento
*/

class fomento
	{
		/**
		 * Construtor, compatível com PHP4
		 */
		var $tabela = 'fomento_editais';
		var $tabela_editais = 'fomento_editais';
		var $tabela_tags = 'fomento_tags';
		var $tabela_tags_docentes = 'fomento_editais_tags_pibic_professor';
		var $tabela_tags_editais = 'fomento_editais_tags_editais';
		var $tabela_fila_envio = 'fomento_fila_envio';
		var $tabela_enviado_visualizado = 'fomento_editais_enviado_visualizado';
		var $tabela_cancelar_envio = 'fomento_email_nao_receber';
		var $texto;
		var $titulo;
		var $id;
		var $edital;
		
		function lidos()
			{
				$edital = $this->line['ed_codigo'];
				$sql = "select * from ".$this->tabela_enviado_visualizado."
						left join pibic_professor on evi_cracha = pp_cracha
						left join pibic_aluno on evi_cracha = pa_cracha
						where evi_edital = '".$edital."' ";
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						$sx .= '<BR>'.$line['evi_cracha'].' ['.$line['pp_nome'].'] []'.$line['pa_nome'].']';
					}
				echo $sx;
			}
		
		function enviar_email($total)
			{
				$sql = "select * from ".$this->tabela_fila_envio."
						order by id_fle
						limit ".round($total);
						
				$rlt = db_query($sql);
				$sql = "";
				while ($line = db_read($rlt))
					{
						$id = $line['id_fle'];
						$email = $line['fle_email'];
						$titulo = $line['fle_titulo'];
						$conteudo = $line['fle_content'];
						enviaremail($email,'',$titulo,$conteudo);
						echo '<BR>Enviado para '.$email;
						$sql .= "delete from ".$this->tabela_fila_envio." where id_fle = ".round($id).';'.chr(13).chr(10);
					}
				if (strlen($sql) > 0)
					{ $rlt = db_query($sql); }
					
				$total = $this->email_resumo_enviar();
				return($total);
			}
		function email_resumo_enviar()
			{
				$sql = "select count(*) as total from ".$this->tabela_fila_envio;
				$rlt = db_query($sql);
				$line = db_read($rlt);
				return($line['total']);
			}
		
		function email_gera_fila_envio($titulo,$conteudo,$email)
			{
				$last = $this->email_resumo_enviar();
				if ($last > 0)
					{
						echo '<h1>ERRO</h1>';
						echo '<h2>Não é possível gerar nova lista, existe '.$last.' e-mail para enviar da campanha anterior</h2>';
						echo 'click <A HREF="chamadas_enviar_email.php">AQUI</A> para finalizar o envio';
						exit;
					}
				$xmail = '';
				$sql = '';
				for ($r=0;$r < count($email);$r++)
					{
						$mail = substr($email[$r],0,strpos($email[$r],';'));
						
						if ($mail != $xmail)
							{
							$nome = substr($email[$r],strpos($email[$r],';')+1,255);
							$cracha = substr($nome,strpos($nome,';')+1,255);						
							$nome = substr($nome,0,strpos($nome,';'));
							$cracha = substr($cracha,0,strpos($cracha,';'));
							
							$tit = '[PUCPR] - '.$titulo;
							
							$txta = '
							<font style="font-size: 12px; font-family: tahoma, verdana, arial">
							Prezado '.$nome.' segue para seu conhecimento<BR><BR><BR>';
							$txt = $txta.$conteudo;
							
							$txt = troca($txt,'$CRACHA',$cracha);
							$txt = troca($txt,'$NOME',$nome);
							$txt = troca($txt,'$EMAIL',$email);
							
							$sql .= "insert into ".$this->tabela_fila_envio." 
									( fle_email, fle_titulo, fle_content )
									values
									( '$mail','$tit','$txt');
							".chr(13).chr(10);
							}
						$xmail = $mail;
					}
				$rlt = db_query($sql);						
			}
		
		function email_cancelar($cracha)
			{
				$link = '<A HREF="'.$http.'fomento/email_cancelar.php?dd0='.$cracha.'&dd90='.checkpost($cracha).'" target="new">';
				$sx .= '<font style="font-size=10px; font-family: verdana, tahoma, arial">'.chr(13);
				$sx .= 'Você recebeu este e-mail por estar vinculado a PUCPR.<BR>'.chr(13);
				$sx .= 'Este comunicado é um produto do Observatório de Projetos (P&D&I) e da Diretoria de Pesquisa da Pró-Reitoria de Pesquisa e Pós-Graduação.<BR>'.chr(13); 
				$sx .= 'Se deseja não mais receber essas comunicações, click '.$linkc.'AQUI</A> para bloquear.<BR>'.chr(13);
				return($sx);
			}
		function le($id)
			{
				$sql = "select * from ".$this->tabela." where id_ed = ".round($id)." or ed_codigo = '".$id."'";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$this->line = $line;
						$this->titulo = $line['ed_titulo'];
						$this->id = $line['ed_codigo'];
						return(1);
					}
			}

		/*Grupos*/
		function alunos_ic($ea,$tipo=0)
			{
				$this->structure();
				$sql = "select pa_nome, pa_email, pa_email_1, pa_cracha
							from pibic_bolsa_contempladas
							inner join pibic_aluno on pb_aluno = pa_cracha 
							where (pb_status <> 'C' and pb_status <> 'S') ";
							if ($tipo == 1)
								{ $sql .= " and pb_ano = '".(date("Y")-1)."'"; }
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						$e1 = lowercase(trim($line['pa_email']));
						$e2 = lowercase(trim($line['pa_email_1']));
						
						$email1 = trim($e1).';'.trim($line['pa_nome']).';'.trim($line['pa_cracha']).';IC';
						$email2 = trim($e2).';'.trim($line['pa_nome']).';'.trim($line['pa_cracha']).';IC';
						
						if (strlen($e1) > 0) { array_push($ea,$email1); }
						if ((strlen($e2) > 0) and ($e1 <> $e2)) { array_push($ea,$email2); }
					}
				return($ea);
			}		
		function professores_ss($ea)
			{
				$sql = "select * from pibic_professor where pp_ativo=1 and pp_ss = 'S' and pp_update = '".date("Y")."' ";
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						$e1 = lowercase(trim($line['pp_email']));
						$e2 = lowercase(trim($line['pp_email_1']));
						
						$email1 = trim($e1).';'.trim($line['pp_nome']).';'.trim($line['pp_cracha']).';SS';
						$email2 = trim($e2).';'.trim($line['pp_nome']).';'.trim($line['pp_cracha']).';SS';
						
						if (strlen($e1) > 0) { array_push($ea,$email1); }
						if ((strlen($e2) > 0) and ($e1 <> $e2)) { array_push($ea,$email2); }
					}
				return($ea);
			}
		function professores($ea)
			{
				$sql = "select pp_nome,pp_email,pp_email_1,pp_cracha from pibic_professor where pp_ativo=1 and pp_update = '".date("Y")."' ";
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						$e1 = lowercase(trim($line['pp_email']));
						$e2 = lowercase(trim($line['pp_email_1']));
						
						$email1 = trim($e1).';'.trim($line['pp_nome']).';'.trim($line['pp_cracha']).';PF';
						$email2 = trim($e2).';'.trim($line['pp_nome']).';'.trim($line['pp_cracha']).';PF';
						
						if (strlen($e1) > 0) { array_push($ea,$email1); }
						if ((strlen($e2) > 0) and ($e1 <> $e2)) { array_push($ea,$email2); }
					}
				return($ea);
			}
		function deadline($dt)
			{
				switch ($dt)
					{
					case 19100101:
						$sx = '90 dias antes do evento'; break;
					}
				return($sx);
			}
		function mostra()
			{
				global $http;
				$sx = '<table width="600" align="center"
							style="border: 1px solid #000000;
									font-size: 14px; font-family: tahoma, verdana, arial;
									"						
				>';
				$sx .= '<TR><TD>';
				$sx .= '<img src="'.$http.'img/email_pdi_header.png" ><BR>';
				$sx .= '<tr><td ALIGN="CENTER"><font style="font-size:25px;">';
				$sx .= trim($this->line['ed_titulo']);
				
				for ($r=1;$r <= 12;$r++)
					{
						$vl = trim($this->line['ed_texto_'.$r]);
						if (strlen($vl) > 0)
						//$sx .= '<TR><TD><B>'.UpperCase(msg('fomento_'.$r)).'</B>';
						$sx .= '<TR><TD><B>'.msg('fomento_'.$r).'</B>';
						$sx .= '<TR><TD><div align="justify">'.$vl.'</div>';
					}
				$sx .= '<BR>';					
				$sx .= '<TR><TD>';
				$sx .= '<BR><BR>';
				$sx .= '<table width="500" align="center" border=0 
							style="border: 1px solid #000000;
									font-size: 14px; font-family: tahoma, verdana, arial;
							" 
							>';
				if ($this->line['ed_data_1'] > 20000101)
					{ $sx .= '<TR><TD align="right"><font style="font-size: 18px;"><I>Deadline</I> para submissão eletrônica <B><font color="red">'.stodbr($this->line['ed_data_1']).'</font>'; }
				else 
					{ $sx .= '<TR><TD align="right"><font style="font-size: 18px;"><I>Deadline</I> para submissão eletrônica <B><font color="red">'.$this->deadline($this->line['ed_data_1']).'</font>'; }
				if ($this->line['ed_data_2'] > 20000101)
					{
						$sx .= '<TR><TD align="right"><font style="font-size: 18px;">Prazo para envio dos documentos <B>'.stodbr($this->line['ed_data_2']).'</font>';
						$sx .= '<TR><TD align="right"><font style="font-size:12 px; color: #000080;">
												Paras as assinaturas institucionais<BR>
												devem ser solicitadas em até 3 dias úteis, antes do <I>deadline</I>';
						$sx .= '</font>';
					}
				if ($this->line['ed_data_3'] > 20000101)
					{ $sx .= '<TR><TD align="right"><font style="font-size:30 px;">Previsão dos resultados <B>'.stodbr($this->line['ed_data_3']).''; }
				$sx .= '</table>';

				$url = trim($this->line['ed_url_externa']);
				if (strlen($url) > 0)
					{
						$url = '<A HREF="'.$http.'fomento/edital_ver.php?dd0='.trim($this->line['ed_codigo']).'&dd1=$CRACHA" target="_black">';
						$sx .= '<TR><TD>';
						$sx .= '<BR><BR>';
						$sx .= 'Para acessar a chamada na íntegra e outras informações relevantes, acesse ';
						$sx .= $url.'AQUI</A>';
					}
				
				$sx .= '<TR><TD><BR> ';
				//$sx .= '<TR><TD><I>Tags:</I> ';
				//$sx .= $this->tags();
				$sx .= '</table>';
				$sx .= '<BR><BR><BR>';
				$this->texto = $sx;
				$this->titulo = $this->line['ed_titulo'];
				
				return($sx);
			}
		function tags()
			{
				$sql = "select * from fomento_categorizacao 
						inner join fomento_categoria on catp_categoria = ct_codigo
						where catp_produto = '".$this->id."'				
				 ";
				 $rlt = db_query($sql);
				 while ($line = db_read($rlt))
				 	{
				 		if (strlen($sx) > 0) { $sx .= ', '; }
				 		$sx .= trim($line['ct_descricao']);
				 	}
				if (strlen($sx) > 0) { $sx .= '.'; }
				return($sx);
			}
		function cp()
			{
				$info = '<TR><TD><TD class="tabela01">
				Informar a data do <I>Deadline</I>
				<BR>Informar 01/01/1910 - Para 90 dias antes do evento (Deadline)
				';
				$cp = array();
				array_push($cp,array('$H8','id_ed','',False,True));
				array_push($cp,array('$T70:3','ed_titulo','Título da chamada',True,True));
				array_push($cp,array('$HV','ed_data',date("Ymd"),False,True));
				array_push($cp,array('$Q agf_nome:agf_codigo:select * from agencia_de_fomento where agf_ativo=1 order by agf_nome','ed_agencia','',False,True));
				array_push($cp,array('$O : &Observatório:Observatório&IC:IC','ed_local','Disseminador',False,True));
				array_push($cp,array('$O : &pt_BR:Portugues&us_EN:Inglês','ed_idioma','Idioma',True,True));
				array_push($cp,array('$S20','ed_chamada','Chamada',True,True));
				array_push($cp,array('$H8','','',False,True));
				array_push($cp,array('$D8','ed_data_1','Deadline (eletrônico)',True,True));
				array_push($cp,array('$M','',$info,False,True));
				
				array_push($cp,array('$D8','ed_data_2','Deadline (envio da documentação)',False,True));
				array_push($cp,array('$D8','ed_data_3','Previsão de divulgação dos resultados',False,True));
				
				array_push($cp,array('$T70:3','ed_texto_1',msg('fomento_1'),True,True));
				array_push($cp,array('$T70:3','ed_texto_2',msg('fomento_2'),False,True));
				array_push($cp,array('$T70:3','ed_texto_3',msg('fomento_3'),False,True));
				array_push($cp,array('$T70:3','ed_texto_4',msg('fomento_4'),False,True));
				array_push($cp,array('$T70:3','ed_texto_5',msg('fomento_5'),False,True));
				array_push($cp,array('$T70:3','ed_texto_6',msg('fomento_6'),False,True));
				array_push($cp,array('$T70:3','ed_texto_7',msg('fomento_7'),False,True));
				array_push($cp,array('$T70:3','ed_texto_8',msg('fomento_8'),False,True));
				array_push($cp,array('$T70:3','ed_texto_9',msg('fomento_9'),False,True));
				array_push($cp,array('$T70:3','ed_texto_10',msg('fomento_10'),False,True));
				array_push($cp,array('$T70:3','ed_texto_11',msg('fomento_11'),False,True));
				array_push($cp,array('$T70:3','ed_texto_12',msg('fomento_12'),False,True));
				
				array_push($cp,array('$S200','ed_url_externa','Link da chamada',False,True));
				
				array_push($cp,array('$O : &A:Editar&B:Concluido&X:Cancelado','ed_status','Status',False,True));
				
				return($cp);
				
			}	
		function updatex()
		{
			global $base;
			$c = 'ed';
			$c1 = 'id_'.$c;
			$c2 = $c.'_codigo';
			$c3 = 7;
			$sql = "update ".$this->tabela." set $c2 = lpad($c1,$c3,0) where $c2='' ";
			if ($base=='pgsql') { $sql = "update ".$this->tabela." set $c2 = trim(to_char(id_".$c.",'".strzero(0,$c3)."')) where $c2='' or $c2 isnull "; }
			 $line = db_query($sql);	
			return(1);
		}
		function lido($edital,$cracha)
			{
				//$this->structure();
				
				$data = date("Ymd");
				$hora = date("H:i");
				$sql = "select * from ".$this->tabela_enviado_visualizado."
							where evi_edital = '$edital' and evi_cracha = '$cracha' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
					} else {
						$sql = "insert into ".$this->tabela_enviado_visualizado."
								(evi_edital, evi_cracha, evi_data,
								evi_hora)
								values
								('$edital','$cracha',$data,
								'$hora')
						 ";
						 $rlt = db_query($sql);
					}
								
			}
		function structure()
			{
				$sql = "drop table ".$this->tabela_enviado_visualizado." ";
				$rlt = db_query($sql);
				 
				$sql = "create table ".$this->tabela_enviado_visualizado." 
						(
						id_evi serial not null,
						evi_edital char(7),
						evi_cracha char(8),
						evi_data integer,
						evi_hora char(5)
						)
				";
				$rlt = db_query($sql);

				return(1);
				$sql = "create table ".$this->tabela_fila_envio." 
						(
						id_fle serial not null,
						fle_content text,
						fle_titulo char(255),
						fle_email char(120)
						)
				";
				$rlt = db_query($sql);
				
				return(0);			
				
				$sql = "create table ".$this->tabela_cancelar_envio." 
						(
						id_ecanc serial not null,
						ecanc_cracha char(7),
						ecanc_data integer
						)
				";
				$rlt = db_query($sql);
				exit;
				
				$sql = "create table ".$this->tabela." 
						(
						id_ed serial not null,
						ed_titulo text,
						ed_data integer,
						ed_agencia char(7),
						ed_idioma char(5),
						ed_chamada char(30),
						ed_data_1 integer,
						ed_data_2 integer,
						ed_data_3 integer,
						ed_texto_1 text,
						ed_texto_2 text,
						ed_texto_3 text,
						ed_texto_4 text,
						ed_texto_5 text,
						ed_texto_6 text,
						ed_texto_7 text,
						ed_texto_8 text,
						ed_texto_9 text,
						ed_texto_10 text,
						ed_texto_11 text,
						ed_texto_12 text,
						ed_status char(1),
						ed_autor char(20),
						ed_corpo text,
						ed_local char(15),
						ed_url_externa char(200),
						ed_total_visualizacoes integer,
						ed_codigo char(7)
						)
				";
				$rlt = db_query($sql);				
			}
		function row()
			{
				global $cdf,$cdm,$masc;
				$cdf = array('id_ed','ed_titulo','ed_chamada','ed_data_1','ed_status','ed_codigo');
				$cdm = array('cod','Título','Chamada','Deadline','Status','Codigo');
				$masc = array('','','','D','','','','');
				return(1);				
			}
		function resumo()
			{
				$st = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);		
				$sql = "select ed_status, count(*) as total 
						from ".$this->tabela."  
						group by ed_status
						";
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
				{
					$sa = $line['ed_status'];
					switch($sa)
						{
							case 'A':
								$st[1] = $st[1] + 1;
								break;
							case 'B':
								$st[2] = $st[2] + 1;
								break;								 	
						}
				}
				$sx .= '<table width="100%" class="tabela01">';
				$sx .= '<TR><TD align="center">Aberto';
				$sx .= '<TD align="center">Encerrado';
				
				$sx .= '<TR><TD align="center">';
				$sx .= '<H1>'.$st[1].'</h1>';
				
				
				$sx .= '<TD align="center">';
				$sx .= '<H1>'.$st[2].'</h1>';
				
				$sx .= '</table>';
				return($sx);
			}

	}


?>