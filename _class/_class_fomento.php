<?php
/**
 * Esse arquivo cont�m as classes e defini��es do sistema de envio de editais
 * @author Marco Kawajiri <kawajirimarco@googlemail.com>
 * @version v.0.13.41
 * @package fomento
 */

class fomento {
	/**
	 * Construtor, compat�vel com PHP4
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
	var $titulo_email;
	var $id;
	var $edital;
	var $total_editais = 0;

	function mostra_chamada($line,$pos) {
		$sta = $this -> tipo_edital();
		$link = '<A HREF="/reol/observatorio/editais_ver.php?dd0=' . $line['id_ed'] . '" target="_new_' . $line['id_ed'] . '">';
		$data = $line['ed_data_1'];
		$title = $line['ed_titulo'];
		$id = round($line['ed_edital_tipo']);
		$title_hr = $sta[$id];
		$img = trim($line['agf_imagem']);
		$visible = '';
		if ($pos > 1)
			{
				$visible = ' style="display: none;" ';
			}

		$sx = $link . '<div class="tile white" id="eve_'.$id.'_'.$pos.'" '.$visible.'>';
		$sx .= '<div class="chamada">';
		$sx .= '<span class="chamada_title">' . $title_hr . '</span><hr class="chamada_hr" >';
		if (strlen($img) > 0) {
			$sx .= '<img src="' . $img . '" width="70" align="left" class="chamada_imagem">';
		}
		$sx .= '<span class="chamada_texto">' . strtolower($title) . '</span>';
		$sx .= '<div class="chamada_deadline"><I>deadline</I>: ' . stodbr($data) . '</div>';
		$sx .= '</div>';
		$sx .= '</div>';
		$sx .= '</A>';
		return ($sx);
	}

	function chamadas_abertas() {
		$sql = "select * from " . $this -> tabela . "
			where ed_status = 'A' and ed_data_1 > " . date("Ymd") . "
			order by ed_data_1
			";
		$rlt = db_query($sql);
		$sx = '';
		while ($line = db_read($rlt)) {
			$link = '<A HREF="cip/editais_ver.php?dd0=' . $line['id_ed'] . '" class="link">';
			$sx .= '<B>' . $link . '<span style="color: #505050;">' . $line['ed_titulo'] . '</span></a></font></b>';
			$dt = '
				<BR>
				<span style="color: #ff7070;"><I>Deadline ' . stodbr($line['ed_data_1']) . '</I></span>';
			$sx .= $dt;
			$sx .= '
				<HR>';

			//print_r($line);
		}
		return ($sx);
	}

	function chamadas_abertas_icones() {
		$tipos = $this->tipo_edital();
		
		$id = 1;
		$sx = '';
		$sx .= '<h5><font style="color: white;">Bolsas / Recursos Humanos</font></h5>';
		$sx .= $this->chamadas_abertas_icones_show($id);
		$sx .= '<a href="/reol/observatorio/editais_mostra.php?dd0=1" class="observatorio_ver_mais" style="font-color: white; text-decoration: none;">
				<font color="white">ver todos...</a>
				</A>';
		$sx .= '<HR width="50%">';
		$sx .= '<script>
					var id_'.$id.' = '.$this->total_editais.'; var id_'.$id.'_pos = 1;
					var timer = setInterval(function () 
					{
						var obj = "#eve_'.$id.'_" + id_1_pos;
						$(obj).hide();
						id_'.$id.'_pos = id_'.$id.'_pos + 1;
						if (id_'.$id.'_pos > id_'.$id.') { id_'.$id.'_pos = 1; }
						var obj = "#eve_'.$id.'_" + id_'.$id.'_pos;
						$(obj).fadeIn();
					}, 5000);
				</script>';	
/* parte 2 */
		$id = 2;
		$sx .= '<h5 style="color: white;">Aux�lio a Pesquisa</h5>';
		$sx .= $this->chamadas_abertas_icones_show($id);
		$sx .= '<a href="/reol/observatorio/editais_mostra.php?dd0='.$id.'" class="observatorio_ver_mais" style="font-color: white; text-decoration: none;">
				<font color="white">ver todos...</a>
				</A>';
		$sx .= '<HR width="50%">';		
		$sx .= '<script>
					var id_'.$id.' = '.$this->total_editais.'; var id_'.$id.'_pos = 1;
					var timer = setInterval(function () 
					{
						if (id_'.$id.' > 1)
						{
							var obj = "#eve_'.$id.'_" + id_'.$id.'_pos;
							$(obj).hide();
							id_'.$id.'_pos = id_'.$id.'_pos + 1;
							if (id_'.$id.'_pos > id_'.$id.') { id_'.$id.'_pos = 1; }
							var obj = "#eve_'.$id.'_" + id_'.$id.'_pos;
							$(obj).fadeIn();
						}
					}, 6000);
					
				</script>';	
/* parte 3 */
		$id = 3;
		$sx .= '<h5 style="color: white;">Coopera��o Internacional</h5>';
		$sx .= $this->chamadas_abertas_icones_show($id);
		$sx .= '<a href="/reol/observatorio/editais_mostra.php?dd0='.$id.'" class="observatorio_ver_mais" style="font-color: white; text-decoration: none;">
				<font color="white">ver todos...</a>
				</A>';
		$sx .= '<HR width="50%">';
		$sx .= '<script>
					var id_'.$id.' = '.$this->total_editais.'; var id_'.$id.'_pos = 1;
					var timer = setInterval(function () 
					{
						if (id_'.$id.' > 1)
						{
							var obj = "#eve_'.$id.'_" + id_'.$id.'_pos;
							$(obj).hide();
							id_'.$id.'_pos = id_'.$id.'_pos + 1;
							if (id_'.$id.'_pos > id_'.$id.') { id_'.$id.'_pos = 1; }
							var obj = "#eve_'.$id.'_" + id_'.$id.'_pos;
							$(obj).fadeIn();
						}
					}, 6000);
					
				</script>';	
/* parte 4 */
		$id = 4;
		$sx .= '<h5 style="color: white;">Pr�mios</h5>';
		$sx .= $this->chamadas_abertas_icones_show($id);
		$sx .= '<a href="/reol/observatorio/editais_mostra.php?dd0='.$id.'" class="observatorio_ver_mais" style="font-color: white; text-decoration: none;">
				<font color="white">ver todos...</a>
				</A>';
		$sx .= '<HR width="50%">';
		$sx .= '<script>
					var id_'.$id.' = '.$this->total_editais.'; var id_'.$id.'_pos = 1;
					var timer = setInterval(function () 
					{
						if (id_'.$id.' > 1)
						{
						var obj = "#eve_'.$id.'_" + id_'.$id.'_pos;
						$(obj).hide();
						id_'.$id.'_pos = id_'.$id.'_pos + 1;
						if (id_'.$id.'_pos > id_'.$id.') { id_'.$id.'_pos = 1; }
						var obj = "#eve_'.$id.'_" + id_'.$id.'_pos;
						$(obj).fadeIn();
						}
					}, 8000);
				</script>';	

/* parte 5 */
		$id = 5;
		$sx .= '<h5 style="color: white;">Eventos</h5>';
		$sx .= $this->chamadas_abertas_icones_show($id);
		$sx .= '<a href="/reol/observatorio/editais_mostra.php?dd0='.$id.'" class="observatorio_ver_mais" style="font-color: white; text-decoration: none;">
				<font color="white">ver todos...</a>
				</A>';
		$sx .= '<HR width="50%">';
		$sx .= '<script>
					var id_'.$id.' = '.$this->total_editais.'; var id_'.$id.'_pos = 1;
					var timer = setInterval(function () 
					{
						if (id_'.$id.' > 1)
						{
						var obj = "#eve_'.$id.'_" + id_'.$id.'_pos;
						$(obj).hide();
						id_'.$id.'_pos = id_'.$id.'_pos + 1;
						if (id_'.$id.'_pos > id_'.$id.') { id_'.$id.'_pos = 1; }
						var obj = "#eve_'.$id.'_" + id_'.$id.'_pos;
						$(obj).fadeIn();
						}
					}, 9000);
				</script>';	

		return ($sx);
		}
			
	function chamadas_abertas_icones_show($tipo)
		{
		$sql = "select * from " . $this -> tabela . "
			left join agencia_de_fomento on agf_codigo = ed_agencia
			where ((ed_status = 'A' and ed_data_1 > " . date("Ymd") . ")
					or 
				  (ed_fluxo_continuo = 1))
			and ed_edital_tipo = '$tipo'
			order by ed_data_1
			";
		$rlt = db_query($sql);
		$sx = '<div id="eve'.strzero($tipo,2).'">';
		$nr = 0;
		while ($line = db_read($rlt)) {
			$nr++;
			$sx .= $this->mostra_chamada($line,$nr);
		}
		$sx .= '</div>';
		$this->total_editais = $nr;
		
		return($sx);
		
	}

	function ppg_coordenadores_email($email) {
		$sql = "select * from programa_pos
						inner join pibic_professor on pos_coordenador = pp_cracha  
						where pos_ativo = 1
						";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$email1 = trim($line['pp_email']);
			$email2 = trim($line['pp_email_alt']);
			$nome = trim($line['pp_nome']);
			if (strlen($email1) > 0) { array_push($email, $email1 . ';' . $nome);
			}
			if (strlen($email2) > 0) { array_push($email, $email2 . ';' . $nome);
			}
		}
		return ($email);
	}

	function ppg_secretaria_email($email) {
		$sql = "select * from programa_pos
						inner join pibic_professor on pos_coordenador = pp_cracha  
						where pos_ativo = 1
						";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$email1 = trim($line['pos_email_1']);
			$email2 = trim($line['pos_email_2']);
			$nome = trim($line['pos_nome']);

			if (strlen($email1) > 0) { array_push($email, $email1 . ';' . $nome);
			}
			if (strlen($email2) > 0) { array_push($email, $email2 . ';' . $nome);
			}
		}
		return ($email);
	}

	function lidos() {
		$edital = $this -> line['ed_codigo'];
		$sql = "select * from " . $this -> tabela_enviado_visualizado . "
						left join pibic_professor on evi_cracha = pp_cracha
						left join pibic_aluno on evi_cracha = pa_cracha
						where evi_edital = '" . $edital . "' ";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$sx .= '<BR>' . $line['evi_cracha'] . ' [' . $line['pp_nome'] . '] []' . $line['pa_nome'] . ']';
		}
		echo $sx;
	}

	function cancelar_email() {
		$sql .= "delete from " . $this -> tabela_fila_envio . " where 1=1" . chr(13) . chr(10);
		$rlt = db_query($sql);
	}

	function enviar_email($total) {

		$sql = "select * from " . $this -> tabela_fila_envio . "
						order by id_fle
						limit " . round($total);

		$rlt = db_query($sql);
		$sql = "";
		while ($line = db_read($rlt)) {
			$id = $line['id_fle'];
			$email = $line['fle_email'];
			$titulo = $line['fle_titulo'];
			$conteudo = $line['fle_content'];
			enviaremail($email, '', $titulo, $conteudo);
			echo '<BR>Enviado para ' . $email;
			$sql .= "delete from " . $this -> tabela_fila_envio . " where id_fle = " . round($id) . ';' . chr(13) . chr(10);
		}
		if (strlen($sql) > 0) { $rlt = db_query($sql);
		}

		$total = $this -> email_resumo_enviar();
		return ($total);
	}

	function email_resumo_enviar() {
		$sql = "select count(*) as total 
				from " . $this -> tabela_fila_envio;
		$rlt = db_query($sql);
		$line = db_read($rlt);
		return ($line['total']);
	}

	function modificar_data_envio($id) {
		$sql = "update " . $this -> tabela . "
						set ed_data_envio = '" . date("Ymd") . "' 
						where id_ed = " . round($id);
		$rlt = db_query($sql);
		return (1);
	}

	function email_gera_fila_envio($titulo, $conteudo, $email, $titulo_email = '') {
		$last = $this -> email_resumo_enviar();
		if ($last > 0) {
			echo '<h1>ERRO</h1>';
			echo '<h2>N�o � poss�vel gerar nova lista, existe ' . $last . ' e-mail para enviar da campanha anterior</h2>';
			echo 'click <A HREF="chamadas_enviar_email.php">AQUI</A> para finalizar o envio';
			exit ;
		}
		$xmail = '';
		$sql = '';

		for ($r = 0; $r < count($email); $r++) {
			$mail = substr($email[$r], 0, strpos($email[$r], ';'));
			echo '<BR>' . $email[$r];
			if ($mail != $xmail) {
				$nome = substr($email[$r], strpos($email[$r], ';') + 1, 255);
				$cracha = substr($nome, strpos($nome, ';') + 1, 255);
				//$nome = substr($nome, 0, strpos($nome, ';'));
				$cracha = substr($cracha, 0, strpos($cracha, ';'));
				/****/
				$titulo = troca($titulo, '<br>', '');
				$titulo = troca($titulo, '<BR>', '');
				$titulo = troca($titulo, '&nbsp', '');
				$tit = '[PD&I] - ' . $titulo;
				if (strlen($titulo_email) > 0) {
					$tit = '[PD&I] - ' . $titulo_email;
				}
				$nnome = substr($nome, 0, strpos($nome, ';'));
				$tit .= ' ' . $nnome;

				$txta = '
							<font style="font-size: 12px; font-family: tahoma, verdana, arial">
							Prezado(a) ' . $nome . ', segue para seu conhecimento<BR><BR><BR>';
				$txt = $txta . $conteudo;

				$txt = troca($txt, '$CRACHA', $cracha);
				$txt = troca($txt, '$NOME', $nome);
				$txt = troca($txt, '$EMAIL', $email);

				$sql .= "insert into " . $this -> tabela_fila_envio . " 
									( fle_email, fle_titulo, fle_content )
									values
									( '$mail','$tit','$txt');
							" . chr(13) . chr(10);
				echo ' <font color="blue">Adicionado</font>';
			}
			$xmail = $mail;
		}
		if (strlen($sql) > 0) { $rlt = db_query($sql);
		}
	}

	function email_cancelar($cracha) {
		$link = '<A HREF="' . $http . 'fomento/email_cancelar.php?dd0=' . $cracha . '&dd90=' . checkpost($cracha) . '" target="new">';
		$sx .= '<font style="font-size=10px; font-family: verdana, tahoma, arial">' . chr(13);
		$sx .= 'Voc� recebeu este e-mail por estar vinculado a PUCPR.<BR>' . chr(13);
		$sx .= 'Este comunicado � um produto do Observat�rio de Projetos (P&D&I) e da Diretoria de Pesquisa da Pr�-Reitoria de Pesquisa e P�s-Gradua��o.<BR>' . chr(13);
		$sx .= 'Se deseja n�o mais receber essas comunica��es, click ' . $linkc . 'AQUI</A> para bloquear.<BR>' . chr(13);
		return ($sx);
	}

	function le($id) {
		$sql = "select * from " . $this -> tabela . " 
				left join agencia_de_fomento on agf_codigo = ed_agencia
				where id_ed = " . round($id) . " or ed_codigo = '" . $id . "'";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			$this -> line = $line;
			$this -> titulo = $line['ed_titulo'];
			$this -> titulo_email = $line['ed_titulo_email'];
			$this -> id = $line['ed_codigo'];
			return (1);
		}
	}

	/*Grupos*/
	function alunos_ic($ea, $tipo = 0) {
		$this -> structure();
		$sql = "select pa_nome, pa_email, pa_email_1, pa_cracha
							from pibic_bolsa_contempladas
							inner join pibic_aluno on pb_aluno = pa_cracha 
							where (pb_status <> 'C' and pb_status <> 'S') ";
		if ($tipo == 1) { $sql .= " and pb_ano = '" . (date("Y") - 1) . "'";
		}
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$e1 = lowercase(trim($line['pa_email']));
			$e2 = lowercase(trim($line['pa_email_1']));

			$email1 = trim($e1) . ';' . trim($line['pa_nome']) . ';' . trim($line['pa_cracha']) . ';IC';
			$email2 = trim($e2) . ';' . trim($line['pa_nome']) . ';' . trim($line['pa_cracha']) . ';IC';

			if (strlen($e1) > 0) { array_push($ea, $email1);
			}
			if ((strlen($e2) > 0) and ($e1 <> $e2)) { array_push($ea, $email2);
			}
		}
		return ($ea);
	}

	function professores_ss($ea) {
		$sql = "select * from pibic_professor where pp_ativo=1 and pp_ss = 'S' and pp_update = '" . date("Y") . "' ";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$e1 = lowercase(trim($line['pp_email']));
			$e2 = lowercase(trim($line['pp_email_1']));

			$email1 = trim($e1) . ';' . trim($line['pp_nome']) . ';' . trim($line['pp_cracha']) . ';SS';
			$email2 = trim($e2) . ';' . trim($line['pp_nome']) . ';' . trim($line['pp_cracha']) . ';SS';

			if (strlen($e1) > 0) { array_push($ea, $email1);
			}
			if ((strlen($e2) > 0) and ($e1 <> $e2)) { array_push($ea, $email2);
			}
		}
		return ($ea);
	}

	function professores_dr($ea) {
		$sql = "select * from pibic_professor where pp_ativo=1 
					and pp_titulacao = '002' and pp_update = '" . date("Y") . "' ";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$e1 = lowercase(trim($line['pp_email']));
			$e2 = lowercase(trim($line['pp_email_1']));

			$email1 = trim($e1) . ';' . trim($line['pp_nome']) . ';' . trim($line['pp_cracha']) . ';Dr';
			$email2 = trim($e2) . ';' . trim($line['pp_nome']) . ';' . trim($line['pp_cracha']) . ';Dr';

			if (strlen($e1) > 0) { array_push($ea, $email1);
			}
			if ((strlen($e2) > 0) and ($e1 <> $e2)) { array_push($ea, $email2);
			}
		}
		return ($ea);
	}

	function professores($ea) {
		$sql = "select pp_nome,pp_email,pp_email_1,pp_cracha from pibic_professor where pp_ativo=1 and pp_update = '" . date("Y") . "' ";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$e1 = lowercase(trim($line['pp_email']));
			$e2 = lowercase(trim($line['pp_email_1']));

			$email1 = trim($e1) . ';' . trim($line['pp_nome']) . ';' . trim($line['pp_cracha']) . ';PF';
			$email2 = trim($e2) . ';' . trim($line['pp_nome']) . ';' . trim($line['pp_cracha']) . ';PF';

			if (strlen($e1) > 0) { array_push($ea, $email1);
			}
			if ((strlen($e2) > 0) and ($e1 <> $e2)) { array_push($ea, $email2);
			}
		}
		return ($ea);
	}

	function deadline($dt) {
		switch ($dt) {
			case 19100101 :
				$sx = '90 dias antes do evento';
				break;
		}
		return ($sx);
	}

	function mostra() {
		global $http;
		$sx = '<table width="640" border=0 align="center" style="border: 1px solid #000000; font-size: 14px; font-family: tahoma, verdana, arial;">';
		/* Titulo do e-mail */
		$titulo_email = trim($this -> titulo_email);
		echo '<TR><TD>';
		echo '<h2><font color="blue">' . $titulo_email . '</font></h2>';
		echo '</TD></TR>';

		$sx .= '<TR valign="top"><TD>';
		$sx .= '<img src="' . $http . 'img/email_pdi_header.png" ><BR>';
		$sx .= '<tr valign="top">
							<td valign="top" ALIGN="left" style="font-size:21px;">';

		if (strlen(trim($this -> line['agf_imagem']))) { $sx .= '<img src="' . trim($this -> line['agf_imagem']) . '" height="100" align="left"  style="padding: 0px 20px 0px 5px;">';
		}
		$tttt = trim($this -> line['ed_titulo']);
		$sx .= '<font style="font-size:25px">' . $tttt . '</font>';
		$sx .= '<BR><BR>';

		$cab = array('fomento_1' => 'Objetivo(s)', 'fomento_2' => 'Recursos', 'fomento_3' => 'Elegibilidade', 'fomento_4' => 'Contato', 'fomento_5' => '#(5)', 'fomento_6' => '�reas e categorias', 'fomento_7' => '#(7)', 'fomento_8' => '#(8)', 'fomento_9' => '#(9)', 'fomento_10' => '#(10)', 'fomento_11' => 'Submiss�o', 'fomento_12' => 'Contato na institui��o', 'deadline1' => '<I>Deadline</I> para submiss�o eletr�nica', 'deadline2' => 'Prazo para envio dos documentos', 'deadline3' => 'Predicting outcomes', 'deadline4' => 'Documentos e/ou assinaturas institucionais<BR>devem ser solicitados em at� 3 dias �teis antes do deadline', 'access1' => 'Para acessar a chamada na �ntegra e outras informa��es relevantes, acesse ', 'access2' => 'AQUI');
		$idioma = trim($this -> line['ed_idioma']);

		if ($idioma == 'us_EN') {
			$cab = array('fomento_1' => 'Objective', 'fomento_2' => 'Covered costs', 'fomento_3' => 'Eligibility', 'fomento_4' => 'Contact', 'fomento_5' => '#(5)', 'fomento_6' => 'Research topics', 'fomento_7' => '#(7)', 'fomento_8' => '#(8)', 'fomento_9' => '#(9)', 'fomento_10' => '#(10)', 'fomento_11' => 'Submission process', 'fomento_12' => 'Instutional contact', 'deadline1' => 'Deadline for electronic submission', 'deadline2' => 'Deadline for sending documents', 'deadline3' => 'Previs�o dos resultados', 'deadline4' => 'Documents and/or institutional signatures<BR> must be requested within 3 working days before the deadline', 'access1' => 'To access the full call and other relevant information, please click ', 'access2' => 'HERE');
		}
		for ($r = 1; $r <= 12; $r++) {
			$vl = trim($this -> line['ed_texto_' . $r]);
			if (strlen($vl) > 0) {
				//$sx .= '<TR><TD><B>'.UpperCase(msg('fomento_'.$r)).'</B>';
				$sx .= chr(13) . chr(10);
				$sx .= '<TR><TD><BR><B>' . $cab['fomento_' . $r] . '</B></td></tr>';
				$sx .= chr(13) . chr(10);
				$sx .= '<TR><TD>' . $vl . '<BR></td></tr>';
			}
		}
		$sx .= '<TR><TD>';
		$sx .= '<BR><BR>';
		$sx .= '<table width="500" align="center" border=0 style="border: 1px solid #000000; font-size: 14px; font-family: tahoma, verdana, arial;	">' . chr(13) . chr(10);
		if (round($this -> line['ed_data_1']) > 20000101) {
			$sx .= '<TR><TD align="right"><font style="font-size: 18px;">' . $cab['deadline1'] . ' <B><font color="red">' . stodbr($this -> line['ed_data_1']) . '</font>';
		} else {
			//$sx .= '<TR><TD align="right"><font style="font-size: 18px;"><I>Deadline</I> para submiss�o eletr�nica <B><font color="red">' . $this -> deadline($this -> line['ed_data_1']) . '</font>';
		}

		if ($this -> line['ed_data_2'] > 20000101) {
			$sx .= '<TR><TD align="right"><font style="font-size: 18px;">' . $cab['deadline2'] . ' <B>' . stodbr($this -> line['ed_data_2']) . '</font>';
		}

		if ($this -> line['ed_document_require'] == '1') {
			$sx .= '<TR><TD align="right"><font style="font-size:12 px; color: #000080;">
												' . $cab['deadline4'];
			$sx .= '</font>';
		}
		if ($this -> line['ed_data_3'] > 20000101) { $sx .= '<TR><TD align="right"><font style="font-size:30 px;">' . $cab['deadline3'] . ' <B>' . stodbr($this -> line['ed_data_3']) . '';
		}
		$sx .= '</table>';

		$url = trim($this -> line['ed_url_externa']);
		if (strlen($url) > 0) {
			$url = '<A HREF="' . $http . 'fomento/edital_ver.php?dd0=' . trim($this -> line['ed_codigo']) . '&dd1=$CRACHA" target="_black">';
			$sx .= '<TR><TD>';
			$sx .= '<BR><BR>';
			$sx .= $cab['access1'];
			$sx .= $url . $cab['access2'] . '</A>';
		}

		$sx .= '<TR><TD><BR> ';
		//$sx .= '<TR><TD><I>Tags:</I> ';
		//$sx .= $this->tags();

		$sx .= '<TR valign="top"><TD align="right"><BR><BR>';
		$sx .= '55 (41) 3271.2128 - e-mail: <A href="mailto:pdi@pucpr.br">pdi@pucpr.br</A>';
		$sx .= '<TR valign="top"><TD>';
		$sx .= '<img src="' . $http . 'img/email_pdi_foot.png" ><BR>';

		$sx .= '</table>';
		$sx .= '<BR><BR><BR>';
		$this -> texto = $sx;
		$ttt = trim($this -> line['ed_titulo']);
		$ttt = troca($tttt, '<br>', '');
		$ttt = troca($tttt, '<BR>', '');
		$this -> titulo = $ttt;

		return ($sx);
	}

	function tags() {
		$sql = "select * from fomento_categorizacao 
						inner join fomento_categoria on catp_categoria = ct_codigo
						where catp_produto = '" . $this -> id . "'				
				 ";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			if (strlen($sx) > 0) { $sx .= ', ';
			}
			$sx .= trim($line['ct_descricao']);
		}
		if (strlen($sx) > 0) { $sx .= '.';
		}
		return ($sx);
	}

	function tipo_edital() {
		$ed = array();
		$ed['1'] = 'Bolsas / Recursos Humanos';
		$ed['2'] = 'Auxilio a Pesquisa';
		$ed['3'] = 'Coopera��o Internacional';
		$ed['4'] = 'Pr�mios';
		$ed['5'] = 'Eventos';
		return ($ed);
	}

	function cp() {
		//$sql = "alter table ".$this->tabela." add column ed_edital_tipo char(2)";
		//$rlt = db_query($sql);

		$info = '<TR><TD><TD class="tabela01">
			Informar a data do <I>Deadline</I>
			<BR>Informar 01/01/1910 - Para 90 dias antes do evento (Deadline)
			';
		$cp = array();
		array_push($cp, array('$H8', 'id_ed', '', False, True));
		array_push($cp, array('$T70:3', 'ed_titulo', 'T�tulo da chamada', True, True));
		array_push($cp, array('$S100', 'ed_titulo_email', 'T�tulo do e-mail (opcional)', False, True));

		array_push($cp, array('$HV', 'ed_data', date("Ymd"), False, True));
		array_push($cp, array('$Q agf_nome:agf_codigo:select * from agencia_de_fomento where agf_ativo=1 order by agf_nome', 'ed_agencia', '', False, True));
		array_push($cp, array('$O : &Observat�rio:Observat�rio&IC:IC', 'ed_local', 'Disseminador', False, True));

		/* tipos */
		$op_tipo = '';
		$tp = $this -> tipo_edital();
		for ($r = 1; $r < (count($tp) + 1); $r++) {
			$op_tipo .= '&' . $r;
			$op_tipo .= ':';
			$op_tipo .= trim($tp[$r]);
		}

		array_push($cp, array('$O : ' . $op_tipo, 'ed_edital_tipo', 'Tipo', True, True));
		array_push($cp, array('$O : &pt_BR:Portugues&us_EN:Ingl�s', 'ed_idioma', 'Idioma', True, True));
		array_push($cp, array('$S20', 'ed_chamada', 'Chamada', True, True));
		array_push($cp, array('$H8', '', '', False, True));
		array_push($cp, array('$D8', 'ed_data_1', 'Deadline (eletr�nico)', False, True));
		array_push($cp, array('$M', '', $info, False, True));

		array_push($cp, array('$D8', 'ed_data_2', 'Deadline (envio da documenta��o)', False, True));
		array_push($cp, array('$D8', 'ed_data_3', 'Previs�o de divulga��o dos resultados', False, True));
		
		array_push($cp, array('$O 0:N�o&1:Sim', 'ed_fluxo_continuo', 'Fluxo continuo', True, True));		
		
		array_push($cp, array('$C1', 'ed_document_require', 'Requer assinatura de documento', False, True));

		array_push($cp, array('$S15', 'ed_login', 'Respons�vel (LOGIN)', True, True));
		//ed_data_envio

		array_push($cp, array('$T70:3', 'ed_texto_1', msg('fomento_1'), True, True));
		array_push($cp, array('$T70:3', 'ed_texto_2', msg('fomento_2'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_3', msg('fomento_3'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_4', msg('fomento_4'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_5', msg('fomento_5'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_6', msg('fomento_6'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_7', msg('fomento_7'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_8', msg('fomento_8'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_9', msg('fomento_9'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_10', msg('fomento_10'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_11', msg('fomento_11'), False, True));
		array_push($cp, array('$T70:3', 'ed_texto_12', msg('fomento_12'), False, True));

		array_push($cp, array('$S200', 'ed_url_externa', 'Link da chamada', False, True));

		array_push($cp, array('$O : &!:Editar&A:Aberto&B:Concluido&X:Cancelado', 'ed_status', 'Status', False, True));

		return ($cp);

	}

	function updatex() {
		global $base;
		$c = 'ed';
		$c1 = 'id_' . $c;
		$c2 = $c . '_codigo';
		$c3 = 7;
		$sql = "update " . $this -> tabela . " set $c2 = lpad($c1,$c3,0) where $c2='' ";
		if ($base == 'pgsql') { $sql = "update " . $this -> tabela . " set $c2 = trim(to_char(id_" . $c . ",'" . strzero(0, $c3) . "')) where $c2='' or $c2 isnull ";
		}
		$line = db_query($sql);
		return (1);
	}

	function lido($edital, $cracha) {
		//$this->structure();

		$data = date("Ymd");
		$hora = date("H:i");
		$sql = "select * from " . $this -> tabela_enviado_visualizado . "
							where evi_edital = '$edital' and evi_cracha = '$cracha' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
		} else {
			$sql = "insert into " . $this -> tabela_enviado_visualizado . "
								(evi_edital, evi_cracha, evi_data,
								evi_hora)
								values
								('$edital','$cracha',$data,
								'$hora')
						 ";
			$rlt = db_query($sql);
		}

	}

	function structure() {
		$sql = "drop table " . $this -> tabela_enviado_visualizado . " ";
		$rlt = db_query($sql);

		$sql = "create table " . $this -> tabela_enviado_visualizado . " 
						(
						id_evi serial not null,
						evi_edital char(7),
						evi_cracha char(8),
						evi_data integer,
						evi_hora char(5)
						)
				";
		$rlt = db_query($sql);

		return (1);
		$sql = "create table " . $this -> tabela_fila_envio . " 
						(
						id_fle serial not null,
						fle_content text,
						fle_titulo char(255),
						fle_email char(120)
						)
				";
		$rlt = db_query($sql);

		return (0);

		$sql = "create table " . $this -> tabela_cancelar_envio . " 
						(
						id_ecanc serial not null,
						ecanc_cracha char(7),
						ecanc_data integer
						)
				";
		$rlt = db_query($sql);
		exit ;

		$sql = "create table " . $this -> tabela . " 
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

	function row() {
		global $cdf, $cdm, $masc;
		$sql = "alter table " . $this -> tabela . " add column ed_login char(15) ";
		//$rlt = db_query($sql);

		$cdf = array('id_ed', 'ed_titulo', 'ed_chamada', 'ed_data_1', 'ed_status', 'ed_codigo', 'ed_data_envio', 'ed_login');
		$cdm = array('cod', 'T�tulo', 'Chamada', 'Deadline', 'Status', 'Codigo', 'Data envio', 'Login');
		$masc = array('', '', '', 'D', '', '', 'D', '');
		return (1);
	}

	function resumo() {
		$st = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
		$sql = "select ed_status, count(*) as total 
						from " . $this -> tabela . "  
						group by ed_status
						";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$sa = $line['ed_status'];
			$total = $line['total'];
			switch($sa) {
				case 'A' :
					$st[1] = $st[1] + $total;
					break;
				case 'B' :
					$st[2] = $st[2] + $total;
					break;
				case 'O' :
					$st[3] = $st[3] + $total;
					break;
				case 'X' :
					$st[4] = $st[4] + $total;
					break;
				default :
					echo '[' . $sa . ']';
					break;
			}
		}
		$total = $this -> email_resumo_enviar();
		if ($total > 0) {
			$linke = '<A HREF="chamadas_enviar_email.php">';
		}
		$sx .= '<table width="100%" class="tabela01">';
		$sx .= '<TR>';
		$sx .= '<TD align="center">e-mail n�o enviado';
		$sx .= '<TD align="center">Aberto';
		$sx .= '<TD align="center">Encerrado';
		$sx .= '<TD align="center">Cancelado';

		$sx .= '<TR>';
		$sx .= '<TD align="center">';
		$sx .= '<h1>' . $linke . $total . '</A>';
		$sx .= '<TD align="center">';
		$sx .= '<H1>' . $st[1] . '</h1>';

		$sx .= '<TD align="center">';
		$sx .= '<H1>' . $st[2] . '</h1>';

		$sx .= '<TD align="center">';
		$sx .= '<H1>' . $st[4] . '</h1>';

		$sx .= '</table>';
		return ($sx);
	}

}
?>