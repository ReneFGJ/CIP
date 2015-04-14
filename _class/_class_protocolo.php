<?php

class protocolo {
	var $tabela = 'protocolo_servicos';
	var $tabela_protocolo = 'protocolo';
	
	var $tipo = '';
	var $solicitante = '';
	var $cracha = '';
	
	var $line=array();
	
	function le($id)
		{
			$sql = "select * from ".$this->tabela." 
						left join pibic_professor on pr_solicitante = pp_cracha
						left join pibic_aluno on pr_solicitante = pa_cracha
						where id_pr = ".round($id);
			$rlt = db_query($sql);
			
			if ($line = db_read($rlt))
				{
					$this->tipo = $line['pr_tipo'];
					$this->cracha = $line['pp_cracha'];
					$this->solicitante = $line['pp_nome'];
					
					$this->line = $line;
					return(1);
				}
			return(0);
		}
	function mostra()
		{
			$status = $this->status();
			
			$line = $this->line;
			$tipo = trim($line['pr_tipo']);
			$sx .= '<table class="tabela00" width="100%">';
			$sx .= '<TR class="lt0">';
			$sx .= '<TD>PROTOCOLO';
			$sx .= '<TD>TIPO DE SOLICITAÇÃO';
			$sx .= '<TD>SOLICITANTE';
			
			$sx .= '<TR class="lt2">';
			$sx .= '<TD>'.strzero($line['id_pr'],5).'/'.$line['pr_ano'];
			$sx .= '<TD><B>'.msg('protocolo_'.$tipo).'</B>';
			$sx .= '<TD>'.$line['pp_nome'];
			
			$sx .= '<TR class="lt0">';
			$sx .= '<TD>DESCRIÇÃO';
			$sx .= '<TR class="lt2">';
			$sx .= '<TD colspan=3>
					<fieldset><legend>DESCRIÇÃO / TITULO</legend>
					'.mst($line['pr_descricao']).'
					</fieldset>
					';
			
			$sx .= '<TR class="lt2">';
			$sx .= '<TD colspan=3>
					<fieldset><legend>JUSTIFICATIVA</legend>
						'.mst($line['pr_justificativa']).'
					</fieldset>	
					';
					
			$sx .= '<TR class="lt0">
						<TD>Data e hora abertura
						<TD>Status
			';
			$sx .= '<TR class="lt2">
						<TD>'.stodbr($line['pr_data']).' '.$line['pr_hora'].'
						<TD>'.$status[$line['pr_status']];
			
			$sx .= '</table>';
			return($sx);
		}

	function structure() {
		return(1);
		$sql = "DROP TABLE " . $this -> tabela;
		$rlt = db_query($sql);
		$sql = "
					CREATE TABLE " . $this -> tabela . " (
					id_pr serial NOT NULL,
  					pr_protocolo char(7) ,
  					pr_protocolo_original char(7) ,
  					pr_local char(5),
  					pr_ano char(4) ,
  					pr_tipo char(3) ,
  					pr_solicitante char(8) ,
  					pr_beneficiador char(8) ,
  					pr_descricao text ,
  					pr_justificativa text ,
  					pr_status char(1) ,
  					pr_data int8 ,
  					pr_hora char(5) ,
  					pr_solucao text,
  					pr_solucao_data int8 ,
  					pr_solucao_hora char(5),
  					pr_solucao_log char(20)  
					)				
				";
		//$rlt = db_query($sql);

		$sql = "
				CREATE TABLE protocolo_servicos (
					id_sv serial NOT NULL,
  					sv_nome char(100) NOT NULL,
  					sv_descricao text NOT NULL,
  					sv_ativo int8 NOT NULL,
  					sv_pai char(5) NOT NULL,
  					sv_codigo char(5) NOT NULL,
  					sv_resp_1 char(8) NOT NULL,
  					sv_resp_2 char(8) NOT NULL,
  					sv_resp_3 char(8) NOT NULL
					)	
				";
		$rlt = db_query($sql);
		$sql = "INSERT INTO protocolo_servicos (id_sv, sv_nome, sv_descricao, sv_ativo, sv_pai, sv_codigo, sv_resp_1, sv_resp_2, sv_resp_3) 
						VALUES
							(1, 'Grupo de Pesquisa', 'Solicitação de Criação, Alteração, Atualização ou cancelamento de Grupos de Pesquisa', 1, '', 'GRUPO', '', '', '');";
		$rlt = db_query($sql);

	}

	function status()
		{
			$sta = array();
			$sta['@'] = '<font color="green">Aberto</font>';
			$sta['C'] = '<font color="orange">Cancelado</font>';
			$sta['A'] = '<font color="blue">Em análise</font>';
			$sta['F'] = 'Encerrado';
			return($sta);
		}
	function lista_protocolos_fechados($local='',$sta='B') {
		global $http;
		$wh = '';
		if (strlen($sta) > 0)
			{
				//$wh .= " and pr_status = '$sta' ";				
			}
						
		$status = $this->status();
		$sql = "select * from " . $this -> tabela . " 
					left join pibic_professor on pr_solicitante = pp_cracha
						where pr_local = '$local' 
						$wh
				 ";
		echo $sql;
		$rlt = db_query($sql);
		$tot = 0;
		$sx .= '<table width="100%" class="tabela00 lt2">';
		$sx .= '<TR>
				<TH width="5%">protocolo
				<TH width="8%">abertura
				<TH width="35%">tipo
				<TH width="35%">solicitante
				<TH width="5%">status';
		while ($line = db_read($rlt)) {
			$tot++;
			$link = '<A HREF="'.$http.'protocolo/protocolo_ver.php?dd0='.$line['id_pr'].'&dd1='.checkpost($line['id_pr']).'">';
			
			$sx .= '<TR>';
			$sx .= '<TD class="tabela01">';
			$sx .= $link;
			$sx .= strzero($line['id_pr'],5).'/'.$line['pr_ano'];
			$sx .= '</A>';
			$sx .= '<TD class="tabela01">'.stodbr($line['pr_data']);
			$sx .= '<TD class="tabela01"><B>'.msg('protocolo_'.trim($line['pr_tipo'])).'</B></td>';
			$sx .= '<TD class="tabela01">'.trim($line['pp_nome']);
			$sx .= '<TD class="tabela01">'.$status[trim($line['pr_status'])];
		}
		$sx .= '<TR><Td colspan=10 ><B>Total de '.$tot.' protocolo(s)</B>';
		$sx .= '</table>';
		$sx .= '<BR><BR>';	
		return ($sx);

	}		
	function lista_protocolos_abertos($local='',$sta='@',$professor='') {
		global $http;
		$wh = '';
		if (strlen($sta) > 0)
			{
				$wh .= " and pr_status = '$sta' ";				
			}
		if (strlen($professor) > 0)
			{
				$wh .= " and pr_solicitante = '$professor' ";				
			}
						
		$status = $this->status();
		$sql = "select * from " . $this -> tabela . " 
					left join pibic_professor on pr_solicitante = pp_cracha
						where pr_local = '$local' 
						$wh
				 ";
		$rlt = db_query($sql);
		$tot = 0;
		$sx .= '<table width="100%" class="tabela00 lt2">';
		$sx .= '<TR>
				<TH width="5%">protocolo
				<TH width="8%">abertura
				<TH width="35%">tipo
				<TH width="35%">solicitante
				<TH width="5%">status';
		while ($line = db_read($rlt)) {
			$tot++;
			$link = '<A HREF="'.$http.'protocolo/protocolo_ver.php?dd0='.$line['id_pr'].'&dd1='.checkpost($line['id_pr']).'">';
			
			$sx .= '<TR>';
			$sx .= '<TD class="tabela01">';
			$sx .= $link;
			$sx .= strzero($line['id_pr'],5).'/'.$line['pr_ano'];
			$sx .= '</A>';
			$sx .= '<TD class="tabela01">'.stodbr($line['pr_data']);
			$sx .= '<TD class="tabela01"><B>'.msg('protocolo_'.trim($line['pr_tipo'])).'</B></td>';
			$sx .= '<TD class="tabela01">'.trim($line['pp_nome']);
			$sx .= '<TD class="tabela01">'.$status[trim($line['pr_status'])];
		}
		$sx .= '<TR><Td colspan=10 ><B>Total de '.$tot.' protocolo(s)</B>';
		$sx .= '</table>';
		$sx .= '<BR><BR>';	
		return ($sx);

	}	
	
	function protocolos_abertos($local='') {
		$sql = "select count(*) as total from " . $this -> tabela . " 
						where pr_local = '$local' 
							and pr_status = '@' ";
		$rlt = db_query($sql);
		$tot = 0;
		if ($line = db_read($rlt)) {
			$tot = $line['total'];
		}
		return ($tot);

	}

	function verifica_sem_exite_protocolo_aberto($protocolo, $tipo) {
		$sql = "select * from " . $this -> tabela . " 
						where pr_protocolo_original = '$protocolo' 
							and pr_tipo = '$tipo'
							and pr_status = '@' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			return (1);
		} else {
			return (0);
		}
	}

	function criar_protocolo($local, $tipo, $autor, $protocolo, $descricao, $justificativa) {
		$data = date("Ymd");
		$hora = date("H:i");
		$ano = date("Y");
		//$this->structure();

		$ok = $this -> verifica_sem_exite_protocolo_aberto($protocolo, $tipo);
		if ($ok == 1) {
			return (-1);
		} else {
			$sql = "insert into " . $this -> tabela . "
						(
						pr_protocolo, pr_local, pr_solicitante, pr_protocolo_original,
						pr_tipo, pr_descricao, pr_justificativa,
						pr_data, pr_hora, pr_ano,
						
						pr_solucao, pr_solucao_data, pr_solucao_hora,
						pr_solucao_log,
						
						pr_status						
						) values (
						'','$local','$autor','$protocolo',
						'$tipo','$descricao','$justificativa',
						$data,'$hora','$ano',			
						'',19000101,'',
						'',
						'@')				
				 ";
			$rlt = db_query($sql);
			return (1);
		}
	}

	function editar_protocolo($proto, $tipo) {
		global $dd, $acao;
		$form = new form;
		$cp = $this -> cp_editar();
		if ($dd[1] == 'GPCOM') { $cp = $this -> cp_gpcom();
		}
		$tela = $form -> editar($cp, $tabela_protocolo);
		echo $tela;
	}

	function cp_editar() {
		global $dd, $acao;
		$cp = array();
		array_push($cp, array('$H8', 'id_pr', '', False, False));
		array_push($cp, array('$H8', 'pr_protocolo', '', False, False));
		array_push($cp, array('$H8', 'pr_ano', '', False, False));
		array_push($cp, array('$H8', 'pr_tipo', '', False, False));
		array_push($cp, array('$H8', 'pr_solicitante', '', False, False));
		array_push($cp, array('$H8', 'pr_beneficiador', '', False, False));
		array_push($cp, array('$T80:6', 'pr_descricao', 'Descrição das alterações', True, True));
		array_push($cp, array('$H8', 'pr_status', '', False, False));
		array_push($cp, array('$H8', 'pr_data', '', False, False));
		array_push($cp, array('$H8', 'pr_hora', '', False, False));
		array_push($cp, array('$H8', 'pr_solucao_data', '', False, False));
		array_push($cp, array('$H8', 'pr_solucao_hora', '', False, False));
		array_push($cp, array('$H8', 'pr_atual', '', False, False));
		return ($cp);
	}

	function cp_gpcom() {
		global $dd, $acao;
		$cp = array();
		array_push($cp, array('$H8', 'id_pr', '', False, False));
		array_push($cp, array('$H8', 'pr_protocolo', '', False, False));
		array_push($cp, array('$H8', 'pr_ano', '', False, False));
		array_push($cp, array('$H8', 'pr_tipo', '', False, False));
		array_push($cp, array('$H8', 'pr_solicitante', '', False, False));
		array_push($cp, array('$H8', 'pr_beneficiador', '', False, False));
		array_push($cp, array('$T80:6', 'pr_descricao', 'Descrição das alterações', True, True));
		array_push($cp, array('$H8', 'pr_status', '', False, False));
		array_push($cp, array('$H8', 'pr_data', '', False, False));
		array_push($cp, array('$H8', 'pr_hora', '', False, False));
		array_push($cp, array('$H8', 'pr_solucao_data', '', False, False));
		array_push($cp, array('$H8', 'pr_solucao_hora', '', False, False));
		array_push($cp, array('$H8', 'pr_atual', '', False, False));
		return ($cp);
	}

	function mostra_tipo_pai($id) {
		$sql = "select * from " . $this -> tabela . " where sv_codigo = '$id' ";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		$pai = $line['sv_pai'];

		$sql = "select * from " . $this -> tabela . " where sv_codigo = '$pai' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			return ($line['sv_nome']);
		}
		return ('não localizado');
	}

	function mostra_tipo($id) {
		$sql = "select * from " . $this -> tabela . " where sv_codigo = '$id' ";
		$rlt = db_query($sql);

		if ($line = db_read($rlt)) {
			return ($line['sv_nome']);
		}
		return ('não localizado');
	}

	function cp() {
		global $dd;
		//$sql = "delete from protocolo_servicos  ";
		//$rlt = db_query($sql);

		$cp = array();
		array_push($cp, array('$H8', 'id_sv', '', False, True));
		array_push($cp, array('$S100', 'sv_nome', 'Curso', True, True));
		array_push($cp, array('$S5', 'sv_codigo', 'Codigo', False, True));
		array_push($cp, array('$Q sv_nome:sv_codigo:select * from protocolo_servicos where sv_ativo = 1 ', 'sv_pai', 'Pai', False, True));
		array_push($cp, array('$O 1:Ativo&0:Inativo', 'sv_ativo', 'Ativo', False, True));
		array_push($cp, array('$T80:5', 'sv_descricao', 'Descricao', False, True));

		array_push($cp, array('$S8', 'sv_resp_1', 'Descricao', False, True));
		array_push($cp, array('$S8', 'sv_resp_2', 'Descricao', False, True));
		array_push($cp, array('$S8', 'sv_resp_3', 'Descricao', False, True));

		//				array_push($cp,array('$Q curso_nome:curso_codigo:select * from curso where curso_ativo=1 order by curso_nome_asc','curso_codigo_use',msg('remissiva'),False,True));
		return ($cp);
	}

	function row() {
		global $cdf, $cdm, $masc;
		$cdf = array('id_sv', 'sv_nome', 'sv_pai', 'sv_codigo');
		$cdm = array('cod', msg('nome'), msg('pai'), msg('codigo'));
		$masc = array('', '', '', '', 'SN', '', '', '');
		return (1);
	}

	function show_action($pai = '') {
		$sx = '';
		//$this -> structure();
		if (strlen($pai) > 0) {
			$sql = "select * from protocolo_servicos where sv_codigo = '$pai' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt)) {
				$sx .= '<h3>' . trim($line['sv_nome']) . '</h3>';
			}
		}
		$sql = "select * from protocolo_servicos 
							where sv_pai = '$pai' 
							and sv_ativo=1 
							order by sv_codigo ";
		$rlt = db_query($sql);
		$sx .= '<UL>';
		while ($line = db_read($rlt)) {
			$sx .= $this -> mostra_botao($line);
		}
		$sx .= '</UL>';
		return ($sx);
	}

	function cancela_protocolo($proto,$descricao='')
		{
			global $nw;
			$log = $nw->user_login;
			$data = date("Ymd");
			$hora = date("H:i");
			
			$sql = "update ".$this->tabela." set
					pr_solucao_data = $data,
					pr_solucao_hora = '$hora',
					pr_solucao_log = '$log',
					pr_solucao = '$descricao',
					pr_status = 'C'
				where id_pr = ".round($proto);
			$rlt = db_query($sql);			
		}
		
		
	function fecha_protocolo($proto,$descricao='')
		{
			global $nw;
			$log = $nw->user_login;
			$data = date("Ymd");
			$hora = date("H:i");
			
			$sql = "update ".$this->tabela." set
					pr_solucao_data = $data,
					pr_solucao_hora = '$hora',
					pr_solucao_log = '$log',
					pr_solucao = '$descricao',
					pr_status = 'F'
				where id_pr = ".round($proto);
			$rlt = db_query($sql);
		}

	function mostra_botao($line) {
		$sx = '';
		$link .= '<A HREF="' . page() . '?dd1=' . $line['sv_codigo'] . '" border=0>';
		if (strlen(trim($line['sv_pai'])) > 0) {
			$link .= '<A HREF="index_solicitacao.php?dd1=' . $line['sv_codigo'] . '" border=0>';
		}
		$sx .= $link;
		$sx .= '<LI class="botao_protocolo">';
		$sx .= trim($line['sv_nome']);
		$sx .= '</li></A>';
		return ($sx);
	}

}
?>