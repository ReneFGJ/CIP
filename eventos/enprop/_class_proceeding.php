<?php
class proceeding
	{
	var $line;
	var $tabela = "evento_enprop";
	
	function __construct()
		{
			
		}

	function certificado_valida_email($email='')
		{
			$sql = "select * from ".$this->tabela." where ev_email = '".trim($email)."' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->line = $line;
					$checkit = trim($line['ev_checkit']);
					if (strlen($checkit)==0)
						{
							return(2);
						}
					return(1);
				} else {
					return(0);
				}
		}
	function resumo_inscritos()
		{
			$sql = "select count(*) as total, ev_cargo from ".$this->tabela." where ev_status='A' group by ev_cargo order by total desc";
			$rlt = db_query($sql);
			
			$sa = '';
			$tot = 0;
			while ($line = db_read($rlt))
				{
					$tot = $tot + $line['total'];
					$sa .= $line['ev_cargo'].' ('.$line['total'].')';
					$sa .= '<BR>';
				}
				/* ev_instituicao */
			$sql = "select count(*) as total, ev_cargo from ".$this->tabela." where ev_status='A' and ev_checkit='1' group by ev_cargo order by total desc";
			$rlt = db_query($sql);
			
			$sa .= '<B>Total de inscritos: '.$tot;
			
			$sb = '';
			while ($line = db_read($rlt))
				{
					$sb .= $line['ev_cargo'].' ('.$line['total'].')';
					$sb .= '<BR>';
				}
					echo '<BR><BR>';		
			echo '<table width="600" align="center">';
			echo '<TR><TH><B>Inscritos<TH><B>Presentes';
			echo '<TR valign="top">';
			echo '<TD>'.$sa;
			echo '<TD>'.$sb;
			echo '</table>';
						
			/* Instituicoes */
			
			$sql = "select count(*) as total, trim(ev_instituicao) as ev_instituicao from ".$this->tabela." where ev_status='A' group by ev_instituicao order by ev_instituicao";
			$rlt = db_query($sql);
			
			$sa = '';
			$tot = 0;
			while ($line = db_read($rlt))
				{
					$tot++;
					$sa .= $line['ev_instituicao'].' ('.$line['total'].')';
					$sa .= '<BR>';
				}			
			$sa = 'Institui��es representadas:'.$tot;
			$sql = "select count(*) as total, ev_instituicao from ".$this->tabela." where ev_status='A' and ev_checkit='1' group by ev_instituicao order by ev_instituicao";
			$rlt = db_query($sql);
			
			$sb = '';
			$tot = 0;
			while ($line = db_read($rlt))
				{
					$tot = $tot + 1;
					$sb .= $line['ev_instituicao'].' ('.$line['total'].')';
					$sb .= '<BR>';
				}
			$sb = '<B>Total de instirui��es: '.$tot.'</B><BR>'.$sb;
						
			echo '<table width="600" align="center">';
			echo '<TR><TH><B>Inscritos<TH><B>Presentes';
			echo '<TR valign="top">';
			echo '<TD>'.$sa;
			echo '<TD>'.$sb;
			echo '</table>';
			return($sx);			
		}
	function checkin($id)
		{
			$sql = "update ".$this->tabela." set ev_checkit = '1' where id_ev = ".$id;
			echo $sql;
			$rlt = db_query($sql);
			echo 'ok';
			return(1);
		}
		
	function lista_transfer_aeroporto()
		{
			$fld = 'in';
			$sql = "select * from ".$this->tabela." 
					where ev_status <> 'X' and ev_voo".$fld."_nr <> '' 
					order by ev_vooin_data, ev_vooin_hora, ev_nome
				";				
			$rlt = db_query($sql);

			$sx = '<table width="98%" align="center">';
			$sh = '<TR>';
			$sh .= '<TH width="5%"><B>Hora Voo</B>';
			$sh .= '<TH width="5%"><B>Voo</B>';
			$sh .= '<TH width="5%"><B>Cia</B>';
			$sh .= '<TH width="5%"><B>Pos.</B>';
			$sh .= '<TH><B>Nome</B>';
			
			$sh .= '<TH><B>Hotel</B>';
			$sh .= '<TH><B>Pessoas</B>';
			$id = 0;
			$tot = 0;
			$xvoo = '';
			
			$xhora = 'x';
			
			while ($line = db_read($rlt))
				{
					$pessoas = $line['ev_lunch_01'];
					$hora = substr($line['ev_voo'.$fld.'_hora'],0,2);

					$link = '<A HREF="secreratia_ver.php?dd0='.$line['id_ev'].'" target="new'.$line['id_ev'].'">';
					$id++;
					$tot++;
					$voo = $line['ev_voo'.$fld.'_data'];
					if ($voo != $xvoo)
						{
							if ($id > 1)
								{ $sx .= '<TR><TD colspan=5><I>Total '.($id-1); }
							$sx .= '<TR><TD colspan=10><font style="font-size:33px;"><B>Data: '.stodbr($voo).'</b></font>';
							$sx .= $sh;
							$xvoo = $voo;
							$id = 1;
						}
						
					if ($hora != $xhora)
						{
							$sx .= '<TR><TD colspan=5><font style="font-size:24px;">'.$hora.':00</font>';
							$xhora = $hora;
						}						
					$cargo = $this->mostra_cargo($line);
					$sx .= '<TR style="border-bottom: 1px solid #111111;">';
					$sx .= '<TD align="center">'.$line['ev_voo'.$fld.'_hora'];
					$sx .= '<TD align="center">'.$line['ev_voo'.$fld.'_cia'];
					$sx .= '<TD align="center">'.$line['ev_voo'.$fld.'_nr'];
					$sx .= '<TD width="10" align="center">'.($id).'.';
					$sx .= '<TD>'.$link.trim($line['ev_nome']).'</A>';
					$sx .= '<TD>'.trim($line['ev_vooin_hotel']);
					$sx .= '<TD>'.$pessoas;
					$ln = $line;
					
				}
			$sx .= '</table>';
			return($sx);
		}

	function imprime_todas_etiquetas_inscritos($tp='',$filtro='')
		{
			$wh = " where (ev_status = 'A' or ev_status = 'B' or (ev_status isnull )) ";
			if (strlen($tp) > 0)
				{
					$wh = " where ev_status = '".$tp."' ";
				}
			if (strlen($filtro) > 0)
				{
					$wh .= " and ((ASC7(UPPER(ev_instituicao)) like '%".$filtro."%') ";
					$wh .= " or (ASC7(UPPER(ev_nome)) like '%".$filtro."%') ";
					$wh .= " or (ASC7(UPPER(ev_cargo)) like '%".$filtro."%' ))";
					
				}
			$sql = "select * from ".$this->tabela." 
					 $wh
					order by ev_nome ";	
			$rlt = db_query($sql);
			
			while ($line = db_read($rlt))
			{
				$nome = trim($line['ev_nome']);
				$inst = trim($line['ev_instituicao']);
				$carg = trim($line['ev_cargo']);
				$outr = trim($line['ev_cargo_outros']);
				if ($carg == 'Outros')
				{ $carg = $outr; }				
					$sx .= $this->etiqueta_cracha($nome,$inst,$carg);
				}
			return($sx);
		}
					
		
	function etiqueta_cracha_imprimir($id)
		{
			global $dd;
			$sx = '<A HREF="secreratia_etiqueta.php?dd0='.($id).'" class="bottom_submit"
			
					>etiqueta</a>';
			return($sx);
		}

	function etiqueta_cracha($nome,$instituicao,$cargo)
		{
			global $header;
			$sx = '';
			if (!(isset($header)))
				{
			$sx = '<head>
	<title>Etiqueta</title>
</head>
<meta charset="UTF-8">
<body style="font-family: verdana,sans-serif; margin: 0 auto;">
	<style type="text/css">
	#navbar-container{display: none;}
	.main{ width: 340px; height: 105px; margin:10px 0px 0px 10px;}
	.name{ font-size: 23px; display: block; font-weight: bold; text-align: center;}
	.local{ font-size: 17px; display: block; margin-bottom: 6px; text-align: center;}
	.cargo{ font-size: 11px; display: block; text-align: center; }
	</style>
	';
	$header = '1';
	}
$sx .= '
<div style="page-break-after: always">
	<div class="main">
		
		<span class="name">'.$nome.'</span>
		<span class="local">'.$instituicao.'</span>
		<span class="cargo">'.$cargo.'</span>
	
	</div>
</div>
			';
			return($sx);
		}

	function busca_form()
		{
			global $dd,$acao;
			$sx .= '<table>';
			$sx .= '<form method="get" action="secretaria_busca.php">';
			$sx .= '<TR valign="top"><TD>';
			$sx .= '<input name="dd1" type="text" size="80" maxsize="100" style="width:600px; height:30px; font-size: 16px; font-family: Tahoma, Verdana, Arial; ">';
			$sx .= '<TD>';
			$sx .= '<input name="acao" type="submit" value="BUSCA" style="font-size: 16px;">';
			$sx .= '<TD></form>';
			$sx .= '</table>';
			
			return($sx);
		}

	function  inscricao_editar()
		{
			global $dd;
			$sx = '<A HREF="secreratia_editar.php?dd0='.$dd[0].'" class="bottom_submit">editar</a>';
			return($sx);
		}
	function cp_todos()
		{
			//$this->structure();
			$cp = array();
			array_push($cp,array('$H8','id_ev','',False,True));
			array_push($cp,array('$M','','Nome completo',False,True));
			array_push($cp,array('$S80','ev_nome','',True,True));

			array_push($cp,array('$M','','Institui��o',False,True));
			array_push($cp,array('$S80','ev_instituicao','',True,True));

			array_push($cp,array('$M','','Categoria',False,True));
			$op = '';
			$op .= "Pr�-Reitor:Pr�-Reitor";
			$op .= "&Diretor/Coordenador:Diretor/Coordenador";
			$op .= '&Outros:Outros'; 
			array_push($cp,array('$O '.$op,'ev_cargo','',True,True));
			array_push($cp,array('$M','','informe o cargo em caso de outros',False,True));
			array_push($cp,array('$S80','ev_cargo_outros','',False,True));

			array_push($cp,array('$M','','e-mail',False,True));
			array_push($cp,array('$EMAIL_UNIQUE','ev_email','',True,True));
			
			array_push($cp,array('$M','','',False,True));
			//array_push($cp,array('$P20','ev_pass','',True,True));
			
			array_push($cp,array('$M','','Telefone Celular com DDD',False,True));
			array_push($cp,array('$S20','ev_telefone','',False,True));
			array_push($cp,array('$M','','Seu telefone ser� mantido em sigilo, somente ser�o enviados SMS com lembretes para sua informa��o. Caso n�o queira receber, deixe o campo de telefone em branco.',False,True));
			
			array_push($cp,array('$O :N�o confirmado&1:Confirmado','ev_checkit','Presen�a',False,True));
			
			$hotel = ' : ';
			$hotel .= '&Hotel Bourbon Curitiba:Hotel Bourbon Curitiba';
			$hotel .= '&Hotel Alta Reggia:Hotel Alta Reggia';
			$hotel .= '&Slavieiro Slim Centro:Slavieiro Slim Centro';
			$hotel .= '&Caravelle Palace Hotel:Caravelle Palace Hotel';
			$hotel .= '&Hotel Tibagi:Hotel Tibagi';
			$hotel .= '&Hotel Del Rey:Hotel Del Rey';
			$hotel .= '&Curitiba Palace Hotel:Curitiba Palace Hotel';
			$hotel .= '&sem translado:Outro Hotel sem translado';
			
			array_push($cp,array('$H8','id_ev','',False,True));
			//array_push($cp,array('$M','','informe um e-mail alternativo',False,True));
			//array_push($cp,array('$EMAIL_UNIQUE','ev_email_alt','',True,True));
			
			//array_push($cp,array('${','','Jantar por ades�o',False,True));
			//array_push($cp,array('$M','ev_vooin_hotel','No dia 12/12 ser� realizado jantar por ades�o no restaurante XXXX, ousto ser� de R$ xx,00 mais bebidas',False,True));
			//array_push($cp,array('$O : &1:SIM&0:N�O','ev_vooin_hotel','Participar',True,True));
			//array_push($cp,array('$}','','Jantar por ades�o',False,True));

			array_push($cp,array('$A','','<B>Translado (Aeroporto-Hotel)</B>',False,True));
			array_push($cp,array('$M','','Nos dias 10, 11, 12, e 13 haver� translado entre o aeroporto e hotel, e entre hotel e a PUCPR. Se quiser contar com este servi�o preencha os dados baixo.',False,True));
			array_push($cp,array('$O 0:N�o � necess�rio translado&1:1 pessoa&2:1 pessoa + acompanhanete&3:1 pessoa + 2 acompanhantes&4:1 pessoa + 3 acompanhantes','ev_lunch_01','N�mero de pessoas e acompanhantes',True,True));
			
			array_push($cp,array('${','','Sobre a hospedagem em Curitiba',False,True));
			array_push($cp,array('$M','','Haver� translado para os seguinte hoteis:',False,True));
			array_push($cp,array('$O '.$hotel,'ev_vooin_hotel','Nome do Hotel',False,True));
			array_push($cp,array('$M','','Somente s�o ofertados translado para os Hoteis relacionados acima.<BR>',False,True));
			array_push($cp,array('$}','','Sobre a chegada',False,True));

			array_push($cp,array('${','','Sobre a chegada em Curitiba',False,True));
			array_push($cp,array('$C1','','SIM, quero servi�o de translado',False,True));
			array_push($cp,array('$O : &20131210:10/12/2013&20131211:11/12/2013&20131212:12/12/2013','ev_vooin_data','Data do voo (chegada)',False,True));
			array_push($cp,array('$O : &ABSA:ABSA&AVIANCA:AVIANCA&AZUL:AZUL&GOL:GOL&TAM:TAM&TRIP:TRIP','ev_vooin_cia','Companhia A�rea',False,True));
			array_push($cp,array('$S8','ev_vooin_nr','N�mero do Voo',False,True));
			array_push($cp,array('$S5','ev_vooin_hora','Hor�rio de chegada (HH:mm)',False,True));
			array_push($cp,array('$}','','Sobre a chegada',False,True));

			array_push($cp,array('$M','','<BR>',False,True));

			array_push($cp,array('${','','Sobre o retorno',False,True));
			array_push($cp,array('$O : &20131213:13/12/2013','ev_vooout_data','Data do voo (partida)',False,True));			
			array_push($cp,array('$S5','ev_vooout_hora','Hor�rio no aeroporto (HH:mm)',False,True));
			array_push($cp,array('$}','','Sobre a chegada',False,True));

			array_push($cp,array('$B8','','Gravar >>>',False,True));			
			return($cp);
		}

	function acoes()
		{
			global $dd, $acao, $email_adm;
			
			if ((strlen($acao) > 0) and ($dd[1]=='S'))
				{
					echo '<BR><BR><Center>';
					echo '** CANCELADO INSCRI��O **';
					$sql = "update ".$this->tabela." set 
							ev_status = 'X',
							ev_motivo = '".$dd[5]."'
							where id_ev = ".round($dd[0]);
					$rlt = db_query($sql);
					
					$texto = '
					Prezado inscrito,
					
					Estamos cancelando sua inscri��o pelo motivo:
					<BR><B>'.mst($dd[5]).'</B>
					<BR>
					<BR>Caso n�o esteja correto esta informa��o, entre em contato o mais breve poss�vel com a comiss�o organizadora pelo e-mail enprop@pucpr.br
					<BR>
					<BR>Att,
					<BR>Enprop2013				
					';
					$email = trim($this->line['ev_email']);
					$titulo = 'Cancelamento de Inscri��o';
					enviaremail('renefgj@gmail.com','',$titulo,$texto);
					enviaremail($email,'',$titulo,$texto);
					echo '<BR>Enviado e-mail para: '.$email;
					if (strlen($email) > 0) { enviaremail($email_adm,'',$titulo,$texto); }
						
				} else {
					$sx .= '<table width="900" align="center">';
					$sx .= '<TR><TD>';
					$sx .= '<form method="post" action="'.page().'">';
					$sx .= '<input type="hidden" name="dd0" value="'.$dd[0].'">';
					$sx .= 'Confirma cancelamento? ';
					$sx .= '<select name="dd1"><option value=""></option>';
					$sx .= '<option value="S">SIM</option>';
					$sx .= '</select>';
					$sx .= '<BR>';
					$sx .= 'Motivo do cancelamento<BR>';
					$sx .= '<textarea name="dd5" cols=60 rows=5>'.$dd[5].'</textarea>';
					$sx .= '<BR>';
					$sx .= '<input type="submit" value="cancelar inscri��o" name="acao">';
					$sx .= '</form>';
					$sx .= '</table>';
				}		
			return($sx);			
		}	
	function mostra_cargo($line)
		{
			$cargo = trim($line['ev_cargo']);
			if ($cargo == 'Outros')
				{
					$cargo = trim($line['ev_cargo_outros']);		
				}
			return($cargo);	
		}
	function status($line)
		{
			$sta = trim($line['ev_status']);
			switch ($sta)
				{
				case 'A': $sx = '<font color="blue">a confirmar</font>'; break;
				case 'B': $sx = '<font color="green">confirmado</font>'; break;
				case 'X': $sx = '<font color="red">cancelado</font>'; break;
				default: $sx = '????????';
				}
			return($sx);
		}
	function lista_inscritos($tp='',$filtro='')
		{
			$wh = " where (ev_status = 'A' or ev_status = 'B' or (ev_status isnull )) ";
			if (strlen($tp) > 0)
				{
					$wh = " where ev_status = '".$tp."' ";
				}
			if (strlen($filtro) > 0)
				{
					$wh .= " and ((ASC7(UPPER(ev_instituicao)) like '%".$filtro."%') ";
					$wh .= " or (ASC7(UPPER(ev_nome)) like '%".$filtro."%') ";
					$wh .= " or (ASC7(UPPER(ev_cargo)) like '%".$filtro."%' ))";
					
				}
			$sql = "select * from ".$this->tabela." 
					 $wh
					order by ev_nome ";	
			$rlt = db_query($sql);
			
			$sx = '<table width="98%" align="center">';
			$sx .= '<TR>';
			$sx .= '<TH><B>Pos.</B>';
			$sx .= '<TH><B>Nome</B>';
			
			$sx .= '<TH><B>Universidade</B>';
			$sx .= '<TH><B>Cargo</B>';
			$sx .= '<TH><B>e-mail</B>';
		
			$id = 0;
			$tot = 0;
			$xvoo = '';
			
			
			while ($line = db_read($rlt))
				{
					$link = '<A HREF="secreratia_ver.php?dd0='.$line['id_ev'].'" target="new'.$line['id_ev'].'">';
					if ($line['ev_checkit']=='1')
						{
							$ckeckin = '<font color="blue">Confirmado</font>';
						} else {
							$ckeckin = '<A HREF="secreratia_checkin.php?dd0='.$line['id_ev'].'">CHECKIN</A>';
						}
					$id++;
					$tot++;
					$cargo = $this->mostra_cargo($line);
					$sx .= '<TR style="border-bottom: 1px solid #111111;">';
					$sx .= '<TD width="10" align="center">'.($id).'.';
					$sx .= '<TD>'.$link.trim($line['ev_nome']).'</A>';
					$sx .= '<TD>';
					$sx .= trim($line['ev_instituicao']);
					$sx .= '<TD>'.trim($cargo);
					$sx .= '<TD>'.$ckeckin;
					$sx .= trim($line['ev_email']);
					$ln = $line;
					
				}
			$sx .= '</table>';
			return($sx);
	
		}
	function mostra()
		{
			$line = $this->line;
			$cargo = $this->mostra_cargo($line);
									
			$sx .= '<table width="98%" border=0 >';
			$sx .= '<TR><TD align="right" width="20%">Nome:';
			$sx .= '<TD><B>'.$line['ev_nome'].'</B>';
			
			$sx .= '<TR><TD align="right" width="20%">Institui��o:';
			$sx .= '<TD><B>'.$line['ev_instituicao'].'</B>';

			$sx .= '<TR><TD align="right" width="20%">Cargo:';
			$sx .= '<TD><B>'.$cargo.'</B>';

			$sx .= '<TR><TD align="right" width="20%">Inscri��o:';
			$sx .= '<TD><B>'.$this->status($line).'</B>';			
			
			$sx .= '<TR><TD align="right" width="20%">e-mail:';
			$sx .= '<TD><B>'.$line['ev_email'].'</B>';
			
			$sx .= '<TR><TD align="right" width="20%">telefone:';
			$sx .= '<TD><B>'.$line['ev_telefone'].'</B>';

			$sx .= '<TR><TD><TD>Credenciado em ';
			$sx .= '<font color="red">'.stodbr($line['ev_credenciamento']).'</font>';	
			
			if ($line['ev_checkit']=='1')
				{
					$sx .= '<BR><span class="bottom_submit" style="background-color: green;">Presente</span>&nbsp;';
					$sx .= '<a href="certificado_emissao.php?dd0='.$line['id_ev'].'" class="bottom_submit" style="background-color: green;">Certificado</span><BR><BR>';
				} else {
			
			$sx .= '<TR><TD><TD>';
				$sx .= '<fieldset style="border: 1px solid #101010;"><legend>CHECK-IN</legend>';
				$sx .= '<table width="98%" border=0 >';

				$sx .= '<TR><TD align="right" width="20%">Data Chegada:';
				$sx .= '<TD><B>'.stodbr($line['ev_vooin_data']);
			
				$sx .= '<TD align="right" width="20%">Voo:';
				$sx .= '<TD><B>';
				$sx .= '&nbsp;'.$line['ev_vooin_cia'];
				$sx .= '&nbsp;'.$line['ev_vooin_nr'];
				$sx .= trim($line['ev_vooin_hora']);
				$sx .= '</B><TD align="right" width="20%">Hotel:';
				$sx .= '<TD><B>'.trim($line['ev_vooin_hotel']);
				$sx .= '</table>';
				}
			

			$sx .= '<TR><TD><TD>';
				$sx .= '<fieldset style="border: 1px solid #101010;"><legend>CHECK-OUT</legend>';
				$sx .= '<table width="98%" border=0 >';

				$sx .= '<TR><TD align="right" width="20%">Data Sa�da:';
				$sx .= '<TD><B>'.stodbr($line['ev_vooout_data']);
			
				$sx .= '<TD align="right" width="20%">Voo:';
				$sx .= '<TD><B>';
				$sx .= '&nbsp;'.$line['ev_vooout_cia'];
				$sx .= '&nbsp;'.$line['ev_vooout_nr'];
				$sx .= trim($line['ev_vooout_hora']);
				$sx .= '</table>';
				
			$sx .= '<TR><TD><TD>';
			$sx .= '<font color="red">'.mst($line['ev_motivo']).'</font>';

			$sx .= '</table>';
			/* Chegada */
			
			//print_r($line);
			return($sx);
		}
	function lista_transfer_hoteis()
		{
			$fld = 'in';
			$sql = "select * from ".$this->tabela." 
				where ev_vooin_hotel <> ''
				and ev_status <> 'X'
				order by ev_vooin_hotel, ev_vooin_data, ev_vooin_hora, ev_nome
			";	
			$rlt = db_query($sql);
			$sx = '<table width="98%" align="center">';
			$sh = '<TR>';
			$sh .= '<TH><B>Hora Voo</B>';
			$sh .= '<TH><B>Voo</B>';
			$sh .= '<TH><B>Cia</B>';
			$sh .= '<TH><B>Pos.</B>';
			$sh .= '<TH><B>Nome</B>';
			
			$sh .= '<TH><B>Cargo</B>';
			$sh .= '<TH><B>Instituicao</B>';
			$id = 0;
			$tot = 0;
			$xvoo = '';
			
			
			while ($line = db_read($rlt))
				{
					$link = '<A HREF="secreratia_ver.php?dd0='.$line['id_ev'].'" target="new'.$line['id_ev'].'">';
					$id++;
					$tot++;
					$voo = $line['ev_vooin_hotel'];
					if ($voo != $xvoo)
						{
							if ($id > 1)
								{ $sx .= '<TR><TD colspan=5><I>Total '.($id-1); }
							$sx .= '<TR><TD colspan=10>Hotel: <B>'.($voo).'</b>';
							$sx .= $sh;
							$xvoo = $voo;
							$id = 1;
						}
					$cargo = $this->mostra_cargo($line);
					$sx .= '<TR style="border-bottom: 1px solid #111111;">';
					$sx .= '<TD align="center"><NOBR>'.substr(stodbr($line['ev_voo'.$fld.'_data']),0,5).' '.$line['ev_voo'.$fld.'_hora'];
					$sx .= '<TD align="center">'.$line['ev_voo'.$fld.'_cia'];
					$sx .= '<TD align="center">'.$line['ev_voo'.$fld.'_nr'];
					$sx .= '<TD width="10" align="center">'.($id).'.';
					$sx .= '<TD>'.$link.trim($line['ev_nome']).'</A>';
					$sx .= '<TD>'.trim($cargo);
					$sx .= '<TD>'.trim($line['ev_instituicao']);
					$ln = $line;
					
				}
			$sx .= '</table>';
			return($sx);			
		}
	function lista_transfer($d1=0,$d2=20509999,$tipo=0)
		{
			if ($tipo == 1)
				{
					$fld = 'out';
					$sql = "select * from ".$this->tabela." 
						where ev_status <> 'X'
						order by ev_vooout_data, ev_vooout_hora, ev_nome
					";					
				} else {
					$fld = 'in';
					$sql = "select * from ".$this->tabela." 
						where ev_status <> 'X'
						order by ev_vooin_data, ev_vooin_hora, ev_nome
					";				
				}	
			$rlt = db_query($sql);
			$sx = '<table width="98%" align="center">';
			$sh = '<TR>';
			$sh .= '<TH><B>Hora Voo</B>';
			$sh .= '<TH><B>Voo</B>';
			$sh .= '<TH><B>Cia</B>';
			$sh .= '<TH><B>Pos.</B>';
			$sh .= '<TH><B>Nome</B>';
			
			$sh .= '<TH><B>Cargo</B>';
			$sh .= '<TH><B>Hotel</B>';
			$id = 0;
			$tot = 0;
			$xvoo = '';
			
			
			while ($line = db_read($rlt))
				{
					$link = '<A HREF="secreratia_ver.php?dd0='.$line['id_ev'].'" target="new'.$line['id_ev'].'">';
					$id++;
					$tot++;
					$voo = $line['ev_voo'.$fld.'_data'];
					if ($voo != $xvoo)
						{
							if ($id > 1)
								{ $sx .= '<TR><TD colspan=5><I>Total '.($id-1); }
							$sx .= '<TR><TD colspan=10>Data	: <B>'.stodbr($voo).'</b>';
							$sx .= $sh;
							$xvoo = $voo;
							$id = 1;
						}
					$cargo = $this->mostra_cargo($line);
					$sx .= '<TR style="border-bottom: 1px solid #111111;">';
					$sx .= '<TD align="center">'.$line['ev_voo'.$fld.'_hora'];
					$sx .= '<TD align="center">'.$line['ev_voo'.$fld.'_cia'];
					$sx .= '<TD align="center">'.$line['ev_voo'.$fld.'_nr'];
					$sx .= '<TD width="10" align="center">'.($id).'.';
					$sx .= '<TD>'.$link.trim($line['ev_nome']).'</A>';
					$sx .= '<TD>'.trim($cargo);
					$sx .= '<TD>'.trim($line['ev_vooin_hotel']);
					$ln = $line;
					
				}
			$sx .= '</table>';
			return($sx);
		}
	function le($id)
		{
			$sql = "select * from ".$this->tabela." 
					where id_ev = ".round($id);
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->line = $line;
				} else {
					return(0);
				}
		}
	function recupera_email($email)
		{
			$email = lowercase($email);
			$sql = "select * from ".$this->tabela." 
					where ev_email = '".$email."' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{ return($line['id_ev']); } 
			else 
				{ return(0); }
		}
	function cp()
		{
			//$this->structure();
			$cp = array();
			array_push($cp,array('$H8','id_ev','',False,True));
			array_push($cp,array('$M','','Nome completo',False,True));
			array_push($cp,array('$S80','ev_nome','',True,True));

			array_push($cp,array('$M','','Institui��o',False,True));
			array_push($cp,array('$S80','ev_instituicao','',True,True));

			array_push($cp,array('$M','','Categoria',False,True));
			$op = '';
			$op .= "Pr�-Reitor:Pr�-Reitor";
			$op .= "&Diretor/Coordenador:Diretor/Coordenador";
			$op .= '&Outros:Outros'; 
			array_push($cp,array('$O '.$op,'ev_cargo','',True,True));
			array_push($cp,array('$M','','informe o cargo em caso de outros',False,True));
			array_push($cp,array('$S80','ev_cargo_outros','',False,True));

			array_push($cp,array('$M','','e-mail',False,True));
			array_push($cp,array('$EMAIL_UNIQUE','ev_email','',True,True));
			
			array_push($cp,array('$M','','',False,True));
			//array_push($cp,array('$P20','ev_pass','',True,True));
			
			array_push($cp,array('$M','','Telefone Celular com DDD',False,True));
			array_push($cp,array('$S20','ev_telefone','',False,True));
			array_push($cp,array('$M','','Seu telefone ser� mantido em sigilo, somente ser�o enviados SMS com lembretes para sua informa��o. Caso n�o queira receber, deixe o campo de telefone em branco.',False,True));
			
			array_push($cp,array('$B8','','Cadastrar >>>',False,True));
			array_push($cp,array('$H8','','',False,True));
			array_push($cp,array('$HV','ev_novo','1',False,True));
			array_push($cp,array('$HV','ev_credenciamento',date("Ymd"),False,True));
			
			return($cp);
		}

	function cp_email()
		{
			//$this->structure();
			$cp = array();
			array_push($cp,array('$H8','id_ev','',False,True));

			array_push($cp,array('$M','','e-mail',False,True));
			array_push($cp,array('$EMAIL_UNIQUE','ev_email','',True,True));
			
			array_push($cp,array('$B','','emitir certificado',False,True));
						
			return($cp);
		}

	function cp_login()
		{
			$forgot_password = '<A href="#" onclick="newxy2(\'registration_forgot_password.php\',700,150);">Esqueci a senha</A>';
			$cp = array();
			array_push($cp,array('$H8','id_ev','',False,True));

			array_push($cp,array('$M','','informe seu e-mail',False,True));
			array_push($cp,array('$EMAIL_UNIQUE','ev_email','',True,True));
			
			array_push($cp,array('$M','','informe uma senha',False,True));
			array_push($cp,array('$P20','ev_pass','',True,True));
			
			array_push($cp,array('$B8','','Acessar',False,True));
			
			array_push($cp,array('$M','',$forgot_password,False,True));
			array_push($cp,array('$H8','','',False,True));
			return($cp);
		}		
	function cp_dados()
		{
			$cp = array();
			$hotel = ' : ';
			$hotel .= '&Hotel Bourbon Curitiba:Hotel Bourbon Curitiba';
			$hotel .= '&Hotel Alta Reggia:Hotel Alta Reggia';
			$hotel .= '&Slavieiro Slim Centro:Slavieiro Slim Centro';
			$hotel .= '&Caravelle Palace Hotel:Caravelle Palace Hotel';
			$hotel .= '&Hotel Tibagi:Hotel Tibagi';
			$hotel .= '&Hotel Del Rey:Hotel Del Rey';
			$hotel .= '&Curitiba Palace Hotel:Curitiba Palace Hotel';
			$hotel .= '&sem translado:Outro Hotel sem translado';
			
			array_push($cp,array('$H8','id_ev','',False,True));
			//array_push($cp,array('$M','','informe um e-mail alternativo',False,True));
			//array_push($cp,array('$EMAIL_UNIQUE','ev_email_alt','',True,True));
			
			//array_push($cp,array('${','','Jantar por ades�o',False,True));
			//array_push($cp,array('$M','ev_vooin_hotel','No dia 12/12 ser� realizado jantar por ades�o no restaurante XXXX, ousto ser� de R$ xx,00 mais bebidas',False,True));
			//array_push($cp,array('$O : &1:SIM&0:N�O','ev_vooin_hotel','Participar',True,True));
			//array_push($cp,array('$}','','Jantar por ades�o',False,True));

			array_push($cp,array('$A','','<B>Translado (Aeroporto-Hotel)</B>',False,True));
			array_push($cp,array('$M','','Nos dias 10, 11, 12, e 13 haver� translado entre o aeroporto e hotel, e entre hotel e a PUCPR. Se quiser contar com este servi�o preencha os dados baixo.',False,True));
			array_push($cp,array('$O 0:N�o � necess�rio translado&1:1 pessoa&2:1 pessoa + acompanhanete&3:1 pessoa + 2 acompanhantes&4:1 pessoa + 3 acompanhantes','ev_lunch_01','N�mero de pessoas e acompanhantes',True,True));
			
			array_push($cp,array('${','','Sobre a hospedagem em Curitiba',False,True));
			array_push($cp,array('$M','','Haver� translado para os seguinte hoteis:',False,True));
			array_push($cp,array('$O '.$hotel,'ev_vooin_hotel','Nome do Hotel',False,True));
			array_push($cp,array('$M','','Somente s�o ofertados translado para os Hoteis relacionados acima.<BR>',False,True));
			array_push($cp,array('$}','','Sobre a chegada',False,True));

			array_push($cp,array('${','','Sobre a chegada em Curitiba',False,True));
			array_push($cp,array('$C1','','SIM, quero servi�o de translado',False,True));
			array_push($cp,array('$O : &20131210:10/12/2013&20131211:11/12/2013&20131212:12/12/2013','ev_vooin_data','Data do voo (chegada)',False,True));
			array_push($cp,array('$O : &ABSA:ABSA&AVIANCA:AVIANCA&AZUL:AZUL&GOL:GOL&TAM:TAM&TRIP:TRIP','ev_vooin_cia','Companhia A�rea',False,True));
			array_push($cp,array('$S8','ev_vooin_nr','N�mero do Voo',False,True));
			array_push($cp,array('$S5','ev_vooin_hora','Hor�rio de chegada (HH:mm)',False,True));
			array_push($cp,array('$}','','Sobre a chegada',False,True));

			array_push($cp,array('$M','','<BR>',False,True));

			array_push($cp,array('${','','Sobre o retorno',False,True));
			array_push($cp,array('$O : &20131213:13/12/2013','ev_vooout_data','Data do voo (partida)',False,True));			
			array_push($cp,array('$S5','ev_vooout_hora','Hor�rio no aeroporto (HH:mm)',False,True));
			array_push($cp,array('$}','','Sobre a chegada',False,True));

			array_push($cp,array('$B8','','Finalizar inscri��o >>>',False,True));
			//array_push($cp,array('$H8','','',True,True));
			return($cp);
		}	
	function lista_inscritos_xls()
		{
			$sql = "select * from ".$this->tabela." ";
			$rlt = db_query($sql);
			
			$sx .= '<table border=1>';
			$sx .= '<TR>';
			$sx .= '<TH>id<TH>Nome<TH>Institui��o<TH>Cargo<TH>Outro cargo<TH>Telefone
					<TH>e-mail<TH>Data<TH>Voo<TH>Cia<TH>Data Voo<TH>Hora<TH>Hotel
					<TH>Voo<TH>Cia<TH>Data<TH>Hora';
			$id = 0;
			while ($line = db_read($rlt))
				{
					$id++;
					$sx .= '<TR>';
					$sx .= '<TD><NOBR>'.$id;
					$sx .= '<TD><NOBR>';					
					$sx .= $line['ev_nome'];
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_instituicao'];
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_cargo'];					
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_cargo_outros'];
					$sx .= '<TD><NOBR>';
					$sx .= '(FONE)'.$line['ev_telefone'];
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_email'];
					$sx .= '<TD><NOBR>';
					$sx .= ($line['ev_data']);
					
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_vooin_nr'];
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_vooin_cia'];
					$sx .= '<TD><NOBR>';
					$sx .= stodbr($line['ev_vooin_data']);
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_vooin_hora'];
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_vooin_hotel'];
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_vooout_nr'];
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_vooout_cia'];
					$sx .= '<TD><NOBR>';
					$sx .= stodbr($line['ev_vooout_data']);
					$sx .= '<TD><NOBR>';
					$sx .= $line['ev_vooout_hora'];

					// http://www2.pucpr.br/reol/eventos/enprop/lista.php
					}
			$sx .= '<table>';
			return($sx);
		}	
	function structure()
		{
			$sql = "
			DROP TABLE ".$this->tabela;
			//$rlt = db_query($sql);
			
			$sql = "
			CREATE TABLE ".$this->tabela."
				(
				id_ev serial not null,
				ev_email char(100),
				ev_nome char(100),
				ev_senha char(30),
				ev_instituicao char(100),
				ev_data integer,
				ev_hora char(8),
				ev_tipo char(30),
				
				ev_cargo_outros char(80),
				ev_cargo char(80),
				ev_telefone char(40),
				
				ev_vooin_nr char(10),
				ev_vooin_cia char(20),
				ev_vooin_data char(10),
				ev_vooin_hora char(5),
				ev_vooin_hotel char(100),

				ev_vooout_nr char(10),
				ev_vooout_cia char(20),
				ev_vooout_data char(10),
				ev_vooout_hora char(5),
				
				ev_lunch_01 char(10),
				ev_lunch_02 char(10),
				ev_lunch_03 char(10)
				)
			";
			//echo $sql;
			$rlt = db_query($sql);
			//echo '<HR>';
		}
	}
?>
