<?php
class formulario
	{
	var $nr_ordem = 1;
	var $nr_log = 'RENE.GABRIEL';
	var $vinculo = "COLABORADOR COM V�NCULO"; 
	
	var $ig_centro_resultado = "103507";
	var $ig_centro_nome = "Administra��o da Pr�-Reitoria de Pesquisa e P�s-Gradua��o";
	var $ig_empresa = "Associa��o Paranaense de Cultura - APC";
	var $ig_filial = "PUCPR - Campus Curitiba";
	var $ig_classificacao = "DESPESA";
	var $ig_pa = "Bonifica��o de 3% - projeto Atra��o e Reten��o de Talentos";
	var $ig_periodo_de = 'setembro/2014';
	var $ig_periodo_ate = 'stembro/2014';
	var $ig_vr = 100;
	var $ig_horas = 977;
	
	var $beneficiario = '';
	var $beneficiario_nome = '';
	var $artigo_id = 0;
	
	function cp()
		{
			global $dd,$acao,$user;
			$cr = ' : ';
			$cr .= '&103507:103507 - Adminstra��o da Pr�-Reitoria de Pesquisa e P�s-Gradua��';
			$cr .= '&103300:103300 - Diretoria de PEsquisa e Programas Stricto Sensu';
			$cr .= '&103309:103309 - N�cleo do Fundo de Pesquisa';
			$hv = 0;
			if ((strlen($dd[3]) > 0) and (strlen($dd[4]) > 0))
				{
					$dd[3] = troca($dd[3],',','');
					$dd[4] = troca($dd[4],',','');
					echo $dd[3].'--'.$dd[4];
					$dd[5] = (round($dd[3]/$dd[4]*100)/100);
				}
			$dd[6] = $user->user_login;
		
			$cp = array();
			array_push($cp,array('$H8','id_crp','',False,False));
			array_push($cp,array('$O ART:Bonifica��o de artigo','crp_tipo','Tipo',True,True));
			array_push($cp,array('$O '.$cr,'crp_tipo','Centro de resultado',True,True));
			array_push($cp,array('$N8','crp_valor','Valor pagamento',True,True));
			array_push($cp,array('$N8','crp_valor_hora','Valor hora',True,True));
			array_push($cp,array('$N8','crp_horas_minuto','Horas(Qta)',True,False));
			array_push($cp,array('$S20','crp_login','Login',True,False));
			array_push($cp,array('$S8','','Benefici�rio',True,False));
			array_push($cp,array('$S60','','Nome',True,False));
			array_push($cp,array('$HV','crp_beneficiario',$dd[7],True,False));
			
			array_push($cp,array('$O '.$dd[8].':'.$dd[8],'crp_doc_original','Prof. Original',True,True));
			
			array_push($cp,array('${','','Per�odo de execu��o da atividade',True,False));
			array_push($cp,array('$D8','crp_data_1','De',True,False));
			array_push($cp,array('$D8','crp_data_2','�',True,False));
			array_push($cp,array('$}','','Per�odo de execu��o da atividade',True,False));
			
			array_push($cp,array('$T60:5','crp_descricao','descri��o',True,True));			
			return($cp);			
		}
	
	function updatex()
		{
			
		}
	function structure()
		{
			$sql = "
			create table cr_pagamento
				{
					id_crp serial not null,
					crp_tipo char(3),
					crp_cr char(6),
					crp_nrpag char(7),
					crp_doc_original char(7),
					crp_status char(1),
					crp_descricao text,
					crp_classificacao char(40),
					crp_valor float;
					crp_valor_hora float;
					crp_horas_minuto float,
					crp_beneficiario char(8),
					crp_ordenador_necessidade char(8),
					crp_ordenador_gasto char(8),
					crp_data int,
					crp_hora char(5),
					crp_login char(20),
					crp_data_1 integer,
					crp_data_2 integer
				}
			";
			$rlt = db_query($sql);
		}
	
	function show_botton_create()
		{
			$sx = '
			<input type="button" 
						value="gerar formulario" 
						onclick="newxy2(\'pucpr_formulario.php?dd7='.$this->beneficiario
						.'&dd50='.strzero($this->artigo_id,7).'&dd8='.trim($this->beneficiario_nome)
						.'\',700,600);">
			<BR>';
			return($sx);
		}

	function show_horas($min)
		{
			$hora = round($min/(60));
			$min = $min - $hora * 60;
			$h = strzero($hora,2).':'.strzero($min,2);
			return($h);
		}
	
	function form_solicitacao_pagamento()
		{
			$sx .= '
			<style>
				body { font-family: Arial, Tahoma, Verdana; font-size: 12px; }
				.sz16 { font-size: 17px; }
				.sz14 { font-size: 15px; }
				.sz10 { font-size: 11px; }
				.sz8 { font-size: 9px; }
				.bi { border-bottom: 1px solid #000000; }
				.b1 { border: 2px solid #000000; padding: 2px; }
				.sp { height: 6px; }
			</style>
			';
			$sx .= '<table width="100%" cellpadding="0" cellspacing="0" class="b1" border=0 >';
			$sx .= '<TR>
						<TD width="10%">
						<TD width="10%">
						<TD width="3%">
						<TD width="10%">
						<TD width="17%">
						<TD width="10%">
						<TD width="5%">
						<TD width="5%">
						<TD width="15%">
						<TD width="15%">
					';
			/* TIPO */
			$sx .= '<TR><TD class="sz14" colspan="10" style="padding: 4px; border: 2px solid #000000; background-color: #FFFF99;"><B>SOLICITA��O DE PAGAMENTO</B></TR>';
			$sx .= '<TR><TD class="sz10" colspan="10" style="padding: 2px; border: 2px solid #000000; background-color: #C0C0C0;"><B>TIPO DE PAGAMENTO</B></TR>';
			$sx .= '<TR><TD rowspan=2 colspan=8 align="center" class="sz16 b1" ><B>'.$this->vinculo.'</B>';
			$sx .= '<TD colspan=2 class="sz10 b1" align="center" >USO EXCLUSIVO SETOR DE FINAN�AS';
			$sx .= '<TR>';
			$sx .= '<TD  colspan=1 class="sz10 b1" >Data<BR>&nbsp;';
			$sx .= '<TD  colspan=1 class="sz10 b1" >AP<BR>&nbsp;';
			
			$sx .= '<TR><TD class="sz10" colspan="10" 
							style="padding: 2px; border: 2px solid #000000; background-color: #C0C0C0;"
							><B>INFORMA��ES GERAIS</B></TR>';
			$sx .= '<TR><TD align="right" class="sz10">Centro de Resultado:
						<TD align="left" class="sz10" colspan=9><B>'.$this->ig_centro_resultado.' - 
						'.$this->ig_centro_nome.'</B>';
			
			$sx .= '<TR><TD align="right" class="sz10">Empresa:
						<TD colspan=9 class="sz10"><B>'.$this->ig_empresa.'</B>';
			
			$sx .= '<TR><TD align="right" class="sz10">Filial:
						<TD colspan=9 class="sz10"><B>'.$this->ig_filial.'</B>';
			
			$sx .= '<TR><TD align="right" class="sz10">Classifica��o:
						<TD colspan=9 class="sz10"><B>'.$this->ig_classificacao.'</B>';

			$sx .= '<TR><TD align="right" class="sz10" colspan=2
						><nobr>	Programa de aprendizagem / M�dulo:
						<TD colspan=9 class="sz10"><B>'.$this->ig_classificacao.'</B>';
			
			$sx .= '<TR><TD align="right" class="sz10" colspan=2
						>Per�odo de Execu�ao da Atividade:';
			$sx .= '<TD class="sz10" colspan=7
						>de: <B>'.$this->ig_periodo_de.'</B> � <B>'.$this->ig_periodo_ate.'</B>';
			$sx .= '<TD class="sz10" colspan=1
						>Horas (Qtda.): <B>'.$this->show_horas($this->ig_horas).'</B>';
			$sx .= '<TR><TD align="right" class="sz10" 
							colspan=3 
							>Valor Base (hora/aula ou hora t�cnica):';
			$sx .= '<TD class="sz10"><B>R$ '.number_format($this->ig_vr,2,',','.').'</B>';
			
			$sx .= '<TR><TD colspan=10 class="sp">';
			
			/* Informa��es para Pagamento */
			$sx .= '<TR><TD class="sz10" colspan="10" style="padding: 2px; border: 2px solid #000000; background-color: #C0C0C0;"><B>Informa��es para Pagamento</B></TR>';
			
			$sx .= '<TR><TD colspan=1 align="right" class="sz10"><B>Nome:</B>';
			$sx .= '<TD colspan=7 >&nbsp;'.$this->ip_nome;
			$sx .= '<TD class="sz10" align="right"><NOBR><B>C�digo funcional:';
			$sx .= '<TD><B>'.$this->ip_cracha.'</B>';

			$sx .= '<TR><TD colspan=1 align="right" class="sz10"><B>Valor a Pagar R$:</B>';
			$sx .= '<TD colspan=9>&nbsp;'.number_format($this->ip_valor,2,',','.');
			
			$sx .= '<TR><TD colspan=10 class="sp">';
			
			/* Descri��o dos servi�os */
			$sx .= '<TR><TD class="sz10" 
						colspan="10" 
						style="padding: 2px; border: 2px solid #000000; background-color: #C0C0C0;"
						><B>Descri��o do Servi�o / Justificativa:</B></TR>';
			
			$sx .= '<TR><TD colspan=10 height="60" >';			
			$sx .= '<TR><TD colspan=10 class="sp" >';	
			
			/* Preenchimento Exclusivo D.R.H. */
			$sx .= '<TR><TD class="sz10" 
						colspan="10" 
						style="padding: 2px; border: 2px solid #000000; background-color: #C0C0C0;"
						><B>Preenchimento Exclusivo D.R.H.</B></TR>';
			$sx .= '<TR><TD colspan=3 class="sz10" align="right">Incluso na Folha de Pagamento do m�s de:';
			$sx .= '<TD class="bi" colspan=7	>&nbsp';	

			$sx .= '<TR><TD colspan=1 class="sz10" align="right">Nome:';
			$sx .= '<TD class="bi" colspan=7>&nbsp';	

			$sx .= '<TD colspan=1 class="sz10" align="right">Data:';
			$sx .= '<TD class="bi">&nbsp';	

			$sx .= '<TR><TD colspan=1 class="sz10" align="right">Assinatura:';
			$sx .= '<TD class="bi" colspan=9>&nbsp';
			
			$sx .= '<TR><TD colspan=10 class="sp">';	

			/* Dados do solicitante */
			$sx .= '<TR><TD class="sz10" 
						colspan="10" 
						style="padding: 2px; border: 2px solid #000000; background-color: #C0C0C0;"
						><B>Dados do Solicitante</B></TR>';
			$sx .= '<TR><TD colspan=1 class="sz10" align="right">Solicitante:';
			$sx .= '<TD class="bi" colspan=9>&nbsp';	

			$sx .= '<TR><TD colspan=1 class="sz10" align="right">Telefone:';
			$sx .= '<TD class="bi" colspan=2>&nbsp';	

			$sx .= '<TD colspan=1 class="sz10" align="right">e-mail:';
			$sx .= '<TD class="bi" colspan=6>&nbsp';
			
			$sx .= '<TR><TD colspan=10 class="sp">';	

			/* Ordenador da Necessidade */
			$sx .= '<TR><TD class="sz10" 
						colspan="5" 
						style="padding: 2px; border: 2px solid #000000; background-color: #C0C0C0;"
						><B>Ordenador da Necessidade:</B>';
			$sx .= '<TD class="sz10" 
						colspan="5" 
						style="padding: 2px; border: 2px solid #000000; background-color: #C0C0C0;"
						><B>Ordenador de Gasto:</B>';						
			$sx .= '<TR valign="top">
						<TD colspan=1 height="40" class="sz10" align="right">Nome:';
			$sx .= '<TD class="sz10" colspan=4>&nbsp';	

			$sx .= '	<TD colspan=1 height="40" class="sz10" align="right">Nome:';
			$sx .= '<TD class="sz10" colspan=5>&nbsp';	

			$sx .= '<TR valign="top">
						<TD colspan=1 height="20" class="sz10" align="right">Assinatura:';
			$sx .= '<TD class="bi" colspan=4>&nbsp';	

			$sx .= '	<TD colspan=1 height="20" class="sz10" align="right">Assinatura:';
			$sx .= '<TD class="bi" colspan=5>&nbsp';	

			$sx .= '<TR valign="top">
						<TD colspan=1 height="20" class="sz10" align="right">Data:';
			$sx .= '<TD class="sz10" colspan=4>___/___/___';	

			$sx .= '	<TD colspan=1 height="20" class="sz10" align="right">Data:';
			$sx .= '<TD class="sz10" colspan=4>___/___/___';
			
			$sx .= '<TR><TD colspan=10 class="sp">';	

			/* Delibera��o */
			$sx .= '<TR><TD class="sz10" 
						colspan="10" 
						style="padding: 2px; border: 2px solid #000000; background-color: #C0C0C0;"
						><B>Delibera��es</B>';
			$sx .= '<TR valign="top">
						<TD colspan=10 height="100" class="sz10 bi" >';

			/* Complementos */
			$sx .= '<TR><TD class="sz8" 
						colspan="2" 
						>Controle: <B>'.strzero($this->nr_ordem,5).'</B>';
			$sx .= '	<TD class="sz8"
						align="center" 
						colspan="2" 
						>Revis�o 0.14.09 ';
			$sx .= '	<TD class="sz8"
						align="center" 
						colspan="2" 
						>'.$this->nr_log;						
			$sx .= '	<TD class="sz8"
						align="right" 
						colspan="4" 
						> '.date("d/m/Y H:i");

			$sx .= '</table>';
			return($sx);
		}	
	}
?>
